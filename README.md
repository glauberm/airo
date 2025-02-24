# AIRO

## Running the project locally

Build and start the containers:

```
sudo docker compose up -d
```

Install the API dependencies:

```
sudo docker exec -it airo_api composer install
```

Setup the API:

```
sudo docker exec -it airo_api composer run setup
```

Install the client dependencies:

```
sudo docker exec -it airo_client npm install
```

Build the client assets:

```
sudo docker exec -it airo_client npm run build
```

Visit [localhost:8081](http://localhost:8081/). (For the API, [localhost:8080](http://localhost:8080/)).

## Running tests

For the API:

```
sudo docker exec -it airo_api vendor/bin/phpunit
```

For the client:

```
sudo docker exec -it airo_client npm run test
```

Visit [localhost:9876](http://localhost:9876/) to access the Karma server.

## Running the development servers

If you wish to run the development servers for better debugging and DX, you can do so.

For the API:

```
sudo docker exec -it airo_api composer run dev
```

Visit [localhost:8000](http://localhost:8000/).

For the client:

```
sudo docker exec -it airo_client npm run start
```

Visit [localhost:4200](http://localhost:4200/).
