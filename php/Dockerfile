FROM php:5.6.30-apache
RUN apt-get update
RUN apt-get install -y wget lsb-release
RUN wget http://packages.couchbase.com/releases/couchbase-release/couchbase-release-1.0-2-amd64.deb
RUN dpkg -i couchbase-release-1.0-2-amd64.deb
RUN rm couchbase-release-1.0-2-amd64.deb
RUN apt-get update
RUN apt-get install -y libcouchbase-dev build-essential php5-dev zlib1g-dev
RUN pecl install pcs-1.3.3
RUN pecl install couchbase
WORKDIR /var/www/html
COPY ./configuration/php.ini /usr/local/etc/php/
COPY ./application/ /var/www/html/
RUN chown www-data:www-data . -R