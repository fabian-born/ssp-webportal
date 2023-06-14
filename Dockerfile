# Stage 1: Build stage
FROM php:7.4-fpm AS builder

# Install Git
RUN apt-get update && \
    apt-get install -y git

# Clone the GitHub repository
RUN git clone https://github.com/fabian-born/ssp-webportal.git /app

# Stage 2: Final stage
FROM php:7.4-fpm

# Copy the source code from the builder stage
COPY --from=builder /app/app /var/www/html

# Set the working directory
WORKDIR /var/www/html

# Install PHP extensions and dependencies
RUN apt-get update && \
    apt-get install -y \
        libpq-dev \
        libzip-dev \
        && \
    docker-php-ext-install pdo pdo_mysql mysqli zip && \
    ls /var/www/html

# Expose the port that PHP-FPM listens on
EXPOSE 9000

# Start the PHP-FPM process
CMD ["php-fpm"]

