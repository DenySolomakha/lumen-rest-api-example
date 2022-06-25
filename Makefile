# Only first start application!!!
bootstrap:
	cp ./api/.env.example ./api/.env
	cp docker-compose.override.example.yml docker-compose.override.yml
	make build
	make start
	make chmod-permissions
	make artsan cmd="jwt:secret"
	make artisan cmd="migrate:fresh --seed"

# Build and up docker containers
build:
	docker-compose build

# Build and up docker containers
rebuild:
	make stop
	make build

# Wake up docker containers
start:
	docker-compose up -d --remove-orphans
	make composer cmd="install"
	make artisan cmd="migrate"

# Restart all containers
restart:
	make stop
	make start

# Shut down docker containers
stop:
	docker-compose down

# Show a status of each container
status:
	docker-compose ps

# Run terminal of the php container
exec:
	docker-compose exec api /bin/sh

# Run composer commands
composer:
	docker-compose up -d api
    ifneq ($(cmd),)
	    docker-compose exec -T api /bin/sh -c "composer $(cmd)"
    else
	    docker-compose exec -T api /bin/sh -c "composer"
    endif

# Run artisan commands
artisan:
    ifneq ($(cmd),)
		docker-compose exec -T api php artisan $(cmd)
    else
		docker-compose exec -T api php artisan
    endif

# Run code style fix
code-style-fix:
	make artisan cmd="fixer:fix --diff"

# Run code style check
code-style-check:
	make artisan cmd="fixer:fix  --verbose --show-progress=dots --dry-run"

# Set permissions on storage folder
chmod-permissions:
	docker-compose exec -T --user root api chmod 777 -R storage/