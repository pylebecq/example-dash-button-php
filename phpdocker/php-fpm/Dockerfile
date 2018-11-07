FROM phpdockerio/php72-fpm:latest
WORKDIR "/application"

# Fix debconf warnings upon build
ARG DEBIAN_FRONTEND=noninteractive

# Install selected extensions and other stuff
RUN apt-get update \
    && apt-get install -y apt-transport-https \
    && curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add - \
    && echo "deb https://dl.yarnpkg.com/debian/ stable main" > /etc/apt/sources.list.d/yarn.list \
    && curl -sL https://deb.nodesource.com/setup_8.x | bash - \
    && apt-get -y --no-install-recommends install git nodejs php7.2-mysql php-redis php7.2-sqlite3 php-xdebug php7.2-bcmath php7.2-gd php-igbinary php7.2-intl php7.2-soap yarn \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Install Zenaton agent
RUN curl https://install.zenaton.com | bash

CMD ["bash", "./phpdocker/php-fpm/init.sh"]
