# Number Viewer

This application build on [Symfony framework](https://symfony.com/) with [Symfony Docker](https://github.com/dunglas/symfony-docker) to as infrastructure

## Getting Started

1. If not already done, [install Docker Compose](https://docs.docker.com/compose/install/)
2. Run `SYMFONY_VERSION=5.2.* docker-compose up --build` to state the contender
4. Open `https://localhost` in your favorite web browser and [accept the auto-generated TLS certificate](https://stackoverflow.com/a/15076602/1352334)

## Application structure

* Folder `src` contains all app implantation.
* `src/Controller/NumberController` contain the http controller with routes (one for render html and other for API).
* Folder `src/Services` contain all business logic, That was designed based on **DDD** concept.
* Folder `src/Services/Number/Application` That represent the application layer in **DDD** and contain just one query.
* Folder `src/Services/Number/Domain` Contain all number domain implementation (models & value object and repositories contract).
* Folder `src/Services/Number/Infrastructure` Repositories for numbers (query from sqlite) and country (query from json file) implementation.

**Enjoy!**
