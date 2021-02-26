FROM php:7.4.15-fpm-buster

WORKDIR "/application"

RUN apt-get update && \
    apt-get install -y \
        git \
        zip \
        libzip-dev \
        vim \
        libicu-dev \
        zlib1g-dev \
        mariadb-client \
        libpng-dev \
        libjpeg-dev \
        libpq-dev \
        libonig-dev && \
    apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/* && \
    # PHP extensions
    docker-php-ext-configure gd --with-jpeg=/usr && \
    docker-php-ext-install intl zip mysqli gd mbstring pdo pdo_mysql pdo_pgsql && \
    # Set Timezone & localtime in docker
    echo "Europe/Madrid" > /etc/timezone && \
    rm /etc/localtime && \
    ln -s /usr/share/zoneinfo/Europe/Madrid localtime && \
    # Composer
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    chmod +x /usr/local/bin/composer && \
    # User for DEV environment / Fix permission problems
    useradd nico -m -u 1000 && \
    # Alias
    echo 'alias ll="ls -l"' >> ~/.bashrc && \
    echo 'alias sf="php bin/console"' >> ~/.bashrc
