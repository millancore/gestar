FROM php:8.2-fpm-alpine

RUN apk add --no-cache task

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

# Install xdebug
RUN set -eux; \
	install-php-extensions xdebug
