## Local Development

### Prerequisites

* Docker
* Docker-compose

### Setup

To run the project locally run the following commands fromm the route of the project:
```
make install
make start
```

The to access the front end nuxt application you can visit `http://frontend.localhost`

The nuxt end will communicate with the back end API using the following url `http://backend.localhost`.

to stop the env run `make stop`

**NOTE** It can take a few minutes for the front end to start, once started you will be able to make changes with hot reloading

## Front End

The front end application is a Vue and Nuxt app that calls the backend API to retrieve the 10 crypto currencies by market cap and then allows you to view a single currency

## Backend

The back end API as 2 endpoints:
* `/api/list` - This will list the top 10 crypto currencies by market cap
* `/api/find/{id}` - This url will list further details for a single currency

The backend has a config file `config/crypto-info.php` this file will allow you to set API configuration as well as enbale caching on the repsonses
