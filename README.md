# AIRO

## Running the project locally

Build and start the containers:

```
docker compose up
```

Get inside the `airo_api` container:

```
docker exec -it airo_api bash
```

Install the dependencies:

```
composer install
```

Exit the `airo_api` container or open a new terminal and get inside the `airo_client` container:

```
docker exec -it airo_client bash
```

Install the dependencies:

```
npm install
```

Build the client assets:

```
npm run build
```

Visit [localhost:8081](http://localhost:8081/). (For the API, [localhost:8080](http://localhost:8080/)).

## Running tests

For the API:

```
# from inside the `airo_api` container
./vendor/bin/phpunit
```

For the client:

```
# from inside the `airo_client` container
npm run test
```

## Running the development servers

If you wish to run the development servers for better debugging and DX, you can do so.

For the API:

```
# from inside the `airo_api` container
composer run dev
```

For the client:

```
# from inside the `airo_client` container
npm run start
```
