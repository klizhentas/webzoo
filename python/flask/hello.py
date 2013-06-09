import json
from flask import Flask, request
from base64 import b64encode

app = Flask(__name__)

app.debug = True

@app.route('/', methods=['POST'])
def echo():
    try:
        out = {
            'args': {},
            'form': {},
            'files': {},
            'headers': {}
            }

        for key in request.args:
            out['args'][key] = request.args.getlist(key)

        for key in request.form:
            out['form'][key] = request.form.getlist(key)

        for key, val in request.headers:
            out['headers'].setdefault(key, []).append(val)

        for key in request.files:
            for f in request.files.getlist(key):
                obj = {
                    'name': f.filename,
                    'data': b64encode(f.read())
                }
                out['files'].setdefault(key, []).append(obj)
        return json.dumps(out)
    except Exception:
        import traceback
        traceback.print_exc()
        raise

if __name__ == '__main__':
    app.run(host="0.0.0.0", port=8000)
