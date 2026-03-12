FROM php:8.2-apache

LABEL maintainer="SalonManager"
LABEL description="Sistema de gestão para salões de beleza com site público administrável"
LABEL version="1.0"

# Instalar extensões PHP necessárias
RUN apt-get update && apt-get install -y \
    libsqlite3-dev \
    libgd-dev \
    libpng-dev \
    libjpeg-dev \
    libwebp-dev \
    && docker-php-ext-configure gd --with-jpeg --with-webp \
    && docker-php-ext-install pdo pdo_sqlite gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Habilitar mod_rewrite
RUN a2enmod rewrite

# Configuração PHP
RUN echo "upload_max_filesize=64M\n\
post_max_size=64M\n\
memory_limit=256M\n\
max_execution_time=120\n\
max_input_time=120" > /usr/local/etc/php/conf.d/salonmanager.ini

# Configurar Apache VirtualHost apontando para /public
RUN echo '<VirtualHost *:80>\n\
    DocumentRoot /var/www/html/public\n\
    <Directory /var/www/html/public>\n\
        Options -Indexes +FollowSymLinks\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
    ErrorLog ${APACHE_LOG_DIR}/error.log\n\
    CustomLog ${APACHE_LOG_DIR}/access.log combined\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

# Copiar código da aplicação
COPY . /var/www/html/

# Garantir que a pasta de uploads e o diretório do banco existem
RUN mkdir -p /var/www/html/public/uploads \
    && mkdir -p /var/www/html/database \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/public/uploads

EXPOSE 80
