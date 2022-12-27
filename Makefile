test: phpstan phpcs psalm phpunit

phpunit:
	vendor/bin/phpunit

phpcs:
	vendor/bin/phpcs src

phpcbf:
	vendor/bin/phpcbf src

phpstan:
	vendor/bin/phpstan --memory-limit=256M analyse

psalm:
	vendor/bin/psalm

rector:
	vendor/bin/rector process src