FROM node:22

# Install system dependencies
RUN apt-get update \
    && apt-get install -y \
        chromium \
    && rm -rf \
        /var/lib/apt/lists/*

# Set chrome binary path
ENV CHROME_BIN=/usr/bin/chromium

# Copy the current directory contents into the container
COPY . /var/www/html/client

# Set working directory
WORKDIR /var/www/html/client
