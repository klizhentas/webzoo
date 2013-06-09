from ubuntu:12.10
ENV DEBIAN_FRONTEND noninteractive
run apt-get update
run apt-get install -q -y python
run apt-get install -q -y python-pip
run pip install Flask
add . /src
expose 8000
cmd ["python", "/src/hello.py"]
