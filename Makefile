start-local:
	make env-local \
	&& docker compose -f docker-compose.local.yml up -d \
	&& sleep 10 \
	&& docker exec -it app composer install \
	&& docker exec -it app php artisan migrate --force \
	&& docker exec -it app php artisan jwt:secret --force \
	&& docker exec -it app php artisan key:generate \
	&& docker exec -it app php artisan route:cache \
	&& docker exec -it app php artisan test \
	&& make chmod

env-local:
	cp .env.local .env

chmod:
	docker exec -it app chmod -R 777 vendor \
	&& docker exec -it app chmod -R 777 storage

enter:
	docker exec -it app bash

test:
	docker exec -it app ./vendor/bin/phpunit

testError:
	docker exec -it app ./vendor/bin/phpunit --group=error

optimize:
	docker exec -it app php artisan optimize \
	&& docker exec -it app php artisan cache:clear
