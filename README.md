WebZoo
======

A collection of echo apps in some frameworks and languages
created to test webhooks.

Rationale
---------
Sometimes you need to see how various frameworks treat your POST/GET requests.

Each framework responsds to the POST request to the following
json response:

```json
{
  "headers": {
       "Content-Length": [123]
   },
   "form": {
        "param": ["val1", "val2"]
   },
   "args": {
        "param": ["val1", "val2"]
   },
   "files": {
        "file": [{"name": "file.txt", data: "base64-encoded-data"}]
   }
}
```

Status
------
Just started doign stuff, not reliable.

Supported frameworks
--------------------
* Flask

Installation & usage
---------------------
* Install docker: http://docker.readthedocs.org
* Build image with framework you need:

```bash
docker build -t webzoo/flask python/flask/
```

* Run container with framework

```bash
WEB_WORKER=$(docker run -d -p 8000 webzoo/flask)
WEB_PORT=$(docker port $WEB_WORKER 8000)
```

* Start testing your webhook poster

```bash
curl -X POST -F a=b -F a=d -F f=@./python/flask/hello.py http://localhost:$WEB_PORT
```

Development mode
----------------

* Build a dev image with framework you need:

```bash
docker build -t webzoo/flask-dev < python/flask/Dockerfile-Dev
```

* Run your interactive session for the instance

```bash
WORKER=$(docker run -i -t -p 8000 webzoo/flask-dev /bin/bash)
```

* Mount webzoo dir to the image using this bridge:

https://gist.github.com/jpetazzo/5668338

sudo bash rectifier.sh $WORKER /mnt /home/alex/github/webzoo/

* Start playing
