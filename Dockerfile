FROM  php:8.0.2-cli-alpine

WORKDIR /app

COPY --from=composer:2.0.11 /usr/bin/composer /usr/local/bin/composer
COPY . .

ENTRYPOINT [ "/app/docker-entrypoint.sh" ]