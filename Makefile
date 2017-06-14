run:
	cd docker && docker-compose up -d;
	php app/console server:start;

install:
	composer install;
	php app/console doctrine:database:create;
	php app/console doctrine:schema:update --dump-sql;
	php app/console doctrine:schema:update --force;

stop:
	cd docker && docker-compose stop;
	php app/console server:stop;

reset-database:
	php app/console doctrine:schema:update --dump-sql;
	php app/console doctrine:schema:update --force;
