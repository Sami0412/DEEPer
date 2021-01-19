# Getting Started

### Docker

You will be working via Docker virtualisation for your project and exercises.

To complete initial set up, you will need to copy `docker-compose.override.yml.dist` as `docker-compse.override.yml`
(e.g. you will end up with a copy of the file without the `.dist` extension). It is important to keep the override file
in sync with the `.dist` file, so that any new features or attributes provided in the distribution version of the file
are available.

You can then start your docker container(s) using `docker-compose up -d` in a terminal window, inside the folder where
the `docker-compose.yml` file resides. The first time this is run, docker will download the base images for your
container(s) and build any non-standard elements it requires. On subsequent launches, the containers will spin up more
quickly as they're already built and/or cached in your local set up. You can check it's all working as expected by
loading the [docker test](http://localhost/project/docker.html) page in your browser.

To close/stop containers, you will use `docker-compose down` in the folder where the `docker-compose.yml` file resides.
