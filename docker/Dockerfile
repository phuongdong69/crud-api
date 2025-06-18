FROM edulive/php-base

ARG UID=1000
ARG GID=1000

ENV TZ=Asia/Ho_Chi_Minh
ENV WEB_DIR=/opt/sources/web

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN groupmod -g $GID www-data && usermod -u $UID www-data

RUN mkdir -p /var/log/supervisor $WEB_DIR \
    && chown -R www-data:www-data $WEB_DIR /var/log/supervisor

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY --chown=www-data:www-data . /opt/sources/web
COPY ./docker/supervisord.conf /etc/supervisor/supervisord.conf
COPY ./docker/apache.conf /etc/apache2/sites-available/000-default.conf

RUN a2enmod rewrite expires proxy mpm_event proxy_fcgi headers

RUN chown -R www-data:www-data $WEB_DIR \
    && chmod -R 755 $WEB_DIR/storage \
    && chmod -R 755 $WEB_DIR/bootstrap/cache

WORKDIR $WEB_DIR

EXPOSE 80

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/supervisord.conf"]
