PHP_BIN:=$(shell which php)
CURL_BIN:=$(shell which curl)

setup: composer.phar

composer.phar:
	$(PHP_BIN) -r "eval('?>'.file_get_contents('https://getcomposer.org/installer'));"

install:
	$(PHP_BIN) composer.phar install

