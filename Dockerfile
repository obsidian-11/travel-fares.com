FROM php:7.4-apache

# Install dependencies
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        curl \
        git \
        unzip \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY ./public_html /usr/src/myapp
WORKDIR /usr/src/myapp
# CMD ["php", "./index.html"]
# Expose port 80
EXPOSE 80