require 'rubygems'
require 'sinatra'
require 'json'
require "base64"

set :bind, '0.0.0.0'


def convert(r)
  Hash[r.map{|key, value| [key, value.kind_of?(Array) ? value : [value] ]}]
end

def split_files_and_params(r)
  files = {}
  params = {}
  def set(h, key, val)
    if h.has_key?(key)
      h[key] << val
    else
      h[key] = [val]
    end
  end

  r.each_pair do |k,v|
    v.each do |el|
      set(el.kind_of?(Hash) ? files : params, k, el)
    end
  end
  [params, files]
end

def encode_file(value)
  {
    :name => value[:filename],
    :data => Base64.strict_encode64(value[:tempfile].read())
  }
end

def encode_files(files)
  Hash[
       files.map{
         |key, values|
         [
          key,
          values.map{|value| encode_file(value)}
         ]
       }
      ]
end

post '/' do
  form, files = split_files_and_params(convert(request.POST()))
  content_type :json
  {
    :form => form,
    :args => convert(request.GET()),
    :files => encode_files(files)
  }.to_json
end
