shell:
	docker-compose run  admin-panel /bin/bash

start:
	docker-compose up -d

stop:
	docker-compose stop 

build:
	docker-compose build