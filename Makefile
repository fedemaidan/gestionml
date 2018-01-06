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

dump-db:
	docker exec -it gestionml_db_1 'mysql -usymfony-admin-starter-kit -psymfony-admin-starter-kit --quick --lock-tables=false symfony-admin-starter-kit > dump.sql'

importar-reservas:
	php app/console app:importacion:reservas --archivo=/server/src/AppBundle/Resources/public/reservas.csv

importar-productos:
	php app/console app:importacion:productos --archivo=/server/src/AppBundle/Resources/public/productos.csv
	php app/console app:importacion:productos:extras --archivo=/server/src/AppBundle/Resources/public/productos_extras.csv

update-ml-netbooks:
	php app/console ml:actualizar:publicaciones --categoria_ml='MLA1652'

update-ml-tablets:
	php app/console ml:actualizar:publicaciones --categoria_ml='MLA82085'
#limpiar set foreign_key_checks=0; truncate table reserva; truncate table producto; truncate table reserva_audit; truncate table producto_audit; set foreign_key_checks=1;