# For the frontend, we want to get all the Laravel files,
# and run a production compile
FROM node:22-alpine as frontend

# We need to copy in the Laravel files to make everything is available to our frontend compilation
WORKDIR /app
COPY . .

# We want to install all the NPM packages,
# and compile the MIX bundle for production
RUN npm install
RUN npm run build


FROM webdevops/php-nginx:8.3-alpine
ENV WEB_DOCUMENT_ROOT=/app/public
ENV PHP_DISMOD=bz2,calendar,exiif,ffi,intl,gettext,ldap,mysqli,imap,pdo_pgsql,pgsql,soap,sockets,sysvmsg,sysvsm,sysvshm,shmop,xsl,zip,gd,apcu,vips,yaml,imagick,mongodb,amqp
WORKDIR /app
COPY . .
COPY --from=frontend /app/public /app/public

RUN composer install --no-interaction --optimize-autoloader --no-dev


# RUN php artisan optimize
# RUN php artisan migrate
COPY docker/php-nginx /opt/docker

# Ensure all of our files are owned by the same user and group.
RUN chown -R application:application .