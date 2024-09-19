FROM alpine:latest
LABEL description="Alpine based image with apache2 and php8 for HomeHub."

# Setup apache and php
RUN apk --no-cache --update \
    add apache2 \
    curl \
    php83-apache2 \
    php83-curl \
    php83-xml \
    php83-simplexml \
    php83-mbstring \
    php83-ctype \
    && mkdir /htdocs

COPY ./ /htdocs/
COPY docker-entrypoint.sh /
RUN chmod +x /docker-entrypoint.sh

EXPOSE 80

HEALTHCHECK CMD wget -q --no-cache --spider localhost

ENTRYPOINT ["/docker-entrypoint.sh"]
