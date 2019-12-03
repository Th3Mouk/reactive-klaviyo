cs:
	vendor/bin/phpcs -d error_reporting='E_ALL & ~E_NOTICE & ~E_DEPRECATED'

fix_cs:
	vendor/bin/phpcbf -d error_reporting='E_ALL & ~E_NOTICE & ~E_DEPRECATED'

stan:
	vendor/bin/phpstan analyse

test:
	vendor/bin/kahlan --ff=1

ci: cs stan test
