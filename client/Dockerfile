FROM node:22

# Copy the current directory contents into the container
COPY . /var/www/html/client

# Create nginx user
# RUN useradd -ms /bin/bash nginx
# RUN chown -R nginx:nginx /var/www/html/client

# Switch to nginx user
# USER nginx

# Set working directory
WORKDIR /var/www/html/client
