build:
	docker build -t ghcr.io/olekluk/v:latest .

prod:
	docker-compose -f ./docker-compose.production.yml -p prod --env-file ./.env.prod up

sail: 
	./vendor/bin/sail up

