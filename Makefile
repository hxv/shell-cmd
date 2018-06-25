all: phpstan phpunit

phpstan:
	./vendor/bin/phpstan analyse

phpunit:
	./vendor/bin/phpunit

install:
	composer install

update:
	composer update
