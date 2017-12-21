shell:
	docker-compose run  admin-panel /bin/bash

start:
	docker-compose up -d

stop:
	docker-compose stop 

build:
	docker-compose build

shell-db:
	docker exec -it gestionml_db_1 mysql -usymfony-admin-starter-kit -psymfony-admin-starter-kit symfony-admin-starter-kit

importar-reservas:
	php app/console app:importacion:reservas --archivo=/server/src/AppBundle/Resources/public/reservas.csv

importar-productos:
	php app/console app:importacion:productos --archivo=/server/src/AppBundle/Resources/public/productos.csv
	php app/console app:importacion:productos:extras --archivo=/server/src/AppBundle/Resources/public/productos_extras.csv


#limpiar set foreign_key_checks=0; truncate table reserva; truncate table producto; truncate table reserva_audit; truncate table producto_audit; set foreign_key_checks=1;