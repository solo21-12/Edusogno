# Use an official PHP image as the base image
FROM php:7.4-apache-buster

# Copy the custom Apache configuration file into the container
COPY apache.conf /etc/apache2/conf-available/

# Enable the custom configuration
RUN a2enconf apache

# Set the working directory inside the container
WORKDIR /var/www/html

# Copy the application code into the container
COPY . .

# Install Composer and dependencies
RUN apt-get update && \
    apt-get install -y git && \
    apt-get install -y unzip && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    composer install --no-dev --no-interaction --no-progress --optimize-autoloader

# Expose port 80 to allow external access
EXPOSE 80

# Start Apache server when the container starts
CMD ["apache2-foreground"]
