docker-up:
	docker-compose up -d

docker-build:
	docker-compose up --build -d

migrate:
	docker-compose exec php-cli php artisan migrate

db-seed:
	docker-compose exec php-cli php artisan db:seed

docker-down:
	docker-compose down

rm-db:
	sudo rm -rf ./storage/docker/postgresql

test:
	docker-compose exec php-cli php artisan test
perm:
	sudo chown ${USER}:${USER} bootstrap/cache -R
	sudo chown ${USER}:${USER} storage -R
storage:
	sudo chmod 777 storage -R
passport-token:
	php artisan passport:install
