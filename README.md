# AIRO

## Running the project locally

Build and start the containers:

```
docker compose up
```

Install the API dependencies:

```
docker exec -it airo_api composer install

```

Install the client dependencies:

```
docker exec -it airo_client npm install
```

Build the client assets:

```
docker exec -it airo_client npm run build
```

Visit [localhost:8081](http://localhost:8081/). (For the API, [localhost:8080](http://localhost:8080/)).

## Running tests

For the API:

```
docker exec -it airo_api vendor/bin/phpunit
```

For the client:

```
docker exec -it airo_client npm run test
```

Visit [localhost:9876](http://localhost:9876/) to access Karma server.

## Running the development servers

If you wish to run the development servers for better debugging and DX, you can do so.

For the API:

```
docker exec -it airo_api composer run dev
```

For the client:

```
docker exec -it airo_client npm run start
```
