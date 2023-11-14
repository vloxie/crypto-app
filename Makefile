install:
	cp -n ./.env.example ./.env || true
	docker-compose build
	docker-compose up -d mysql
	docker-compose run --rm php composer install
	docker-compose run --rm nuxt yarn install
	docker-compose run --rm php php artisan migrate
	docker-compose run --rm php php artisan key:generate


stop:
	docker-compose down

start:
	docker-compose up -d
