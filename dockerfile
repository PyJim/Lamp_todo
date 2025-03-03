# Use the official PHP image
FROM php:8.2-apache

# Install dependencies (e.g., PDO for MySQL, mysqli, and GD for image handling)
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql mysqli

# Enable Apache mod_rewrite for clean URLs
RUN a2enmod rewrite

# Set the ServerName to avoid warnings
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Set DocumentRoot to the public folder (ensure it exists)
RUN echo "DocumentRoot /var/www/html/public" > /etc/apache2/sites-available/000-default.conf

# Copy your app files into the container
COPY . /var/www/html/

# Ensure correct permissions for Apache to access the files
RUN chown -R www-data:www-data /var/www/html/

# Add directory settings for Apache to allow directory indexing and override .htaccess
RUN echo "<Directory /var/www/html/public/>" >> /etc/apache2/apache2.conf
RUN echo "    Options Indexes FollowSymLinks" >> /etc/apache2/apache2.conf
RUN echo "    AllowOverride All" >> /etc/apache2/apache2.conf
RUN echo "    Require all granted" >> /etc/apache2/apache2.conf
RUN echo "</Directory>" >> /etc/apache2/apache2.conf

# Set the working directory
WORKDIR /var/www/html/

# Expose the port the app will run on
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]

