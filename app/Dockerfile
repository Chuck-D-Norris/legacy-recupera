# syntax=docker/dockerfile:1

#* Create a prod stage for installing app dependencies defined in Composer.
FROM composer:lts AS prod-deps
WORKDIR /app
RUN --mount=type=bind,source=./composer.json,target=composer.json \
    --mount=type=bind,source=./composer.lock,target=composer.lock \
    --mount=type=cache,target=/tmp/cache \
    composer install --no-dev --no-interaction

#* Create a dev stage for installing app dev dependencies defined in Composer.
FROM composer:lts AS dev-deps
WORKDIR /app
RUN --mount=type=bind,source=./composer.json,target=composer.json \
    --mount=type=bind,source=./composer.lock,target=composer.lock \
    --mount=type=cache,target=/tmp/cache \
    composer install --no-interaction

#* Create a base stage for building the app image.
FROM php:8.4-apache AS base
ARG IMAGE_VERSION
ENV IMAGE_VERSION=$IMAGE_VERSION
RUN docker-php-ext-install pdo pdo_mysql
RUN a2enmod rewrite
COPY ./src /var/www/html

#* Create a development stage.
FROM base AS development
ENV APP_ENV=development
# Add PECL extensions, and enable Xdebug.
# See https://github.com/docker-library/docs/tree/master/php#pecl-extensions
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"
RUN pecl install excimer xdebug \
    && docker-php-ext-enable excimer xdebug
COPY --from=dev-deps app/vendor/ /var/www/html/vendor
COPY ./tests /var/www/html/tests
COPY ./phpunit.xml** /var/www/html

#* Run tests when building
FROM development AS test
ENV APP_ENV=test
ENV XDEBUG_MODE=coverage
WORKDIR /var/www/html
CMD ["./vendor/bin/phpunit", "--log-junit", "/reports/junit.xml", "--coverage-clover=/reports/coverage.xml"]

#* Create a production stage.
FROM base AS final
ENV APP_ENV=production
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
COPY --from=prod-deps app/vendor/ /var/www/html/vendor
# Switch to a non-privileged user (defined in the base image) that the app will run under.
# See https://docs.docker.com/go/dockerfile-user-best-practices/
USER www-data
