# Use PHP with Apache server
FROM php:8.0-apache

# Install mysqli extension
RUN docker-php-ext-install mysqli

# Copy your PHP source code into the image
COPY . /var/www/html/

# Expose port 80 for Apache
EXPOSE 80