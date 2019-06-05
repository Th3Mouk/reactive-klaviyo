cs:
	vendor/bin/phpcs

fix_cs:
	vendor/bin/phpcbf

stan:
	vendor/bin/phpstan analyse

test:
	vendor/bin/kahlan --ff=1

ci: cs stan test
