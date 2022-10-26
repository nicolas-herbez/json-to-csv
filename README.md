<p align="center">
    <img src="https://img.shields.io/badge/pipeline-passed-green" />
    <img src="https://img.shields.io/badge/coverage-100%25-green" />
</p>
<p align="center">
    <img src="https://img.shields.io/badge/PHP-7.4-blue" />
    <img src="https://img.shields.io/badge/Symfony-5.4-blue" />
    <img src="https://img.shields.io/badge/MySQL-8-blue" />
    <img src="https://img.shields.io/badge/phpMyAdmin-5.2-blue" />
</p>

# JSON to CSV
![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)
![Symfony](https://img.shields.io/badge/symfony-%23000000.svg?style=for-the-badge&logo=symfony&logoColor=white)
![GitLab CI](https://img.shields.io/badge/gitlab%20ci-%23181717.svg?style=for-the-badge&logo=gitlab&logoColor=white)
<!-- https://github.com/Ileriayo/markdown-badges -->

The goal is to form csv files from a json file using Postman.
![json-to-csv.png](https://github.com/nicolas-herbez/json-to-csv/blob/main/json-to-csv.png?raw=true)
![Visual Studio Code](https://img.shields.io/badge/Visual%20Studio%20Code-0078d7.svg?style=for-the-badge&logo=visual-studio-code&logoColor=white)

## Thanks

Thanks to the Colorz team for this test.

## Composition

* API (<a href="https://symfony.com/" target="_blanc">Symfony</a>)
* Docker (Dockerfile, docker-compose)
* Postman (JSON collections, <a href="https://github.com/sivcan/ResponseToFile-Postman" target="_blanc">ResponseToFile</a>)

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

> ### Prerequisites

What things you need

* <a href="https://git-scm.com/downloads" target="_blanc">Git</a>
* <a href="https://www.docker.com/get-started" target="_blanc">Docker</a>
* <a href="https://www.postman.com/downloads" target="_blanc">Postman</a>
* <a href="https://docs.npmjs.com/downloading-and-installing-node-js-and-npm" target="_blanc">npm</a> (optionnal)

> ### Installation

Create a folder and position yourself inside
```bash
cd your-folder
```

Open a terminal at the root of your folder and clone repository
```bash
git clone https://github.com/nicolas-herbez/json-to-csv.git .
```

## How to use

Launch Docker.

> ### Start

If you have *npm* run this command
```bash
npm run docker-start
```

Whithout *npm* run this command
```bash
docker-compose up -d --build && docker logs --tail 1000 --follow api --details
```

> ### Postman

You can import in Postman the collections as well as the environment located in the directory
* postman/collections

> ### Get csv files

After running the "json to csv" collection queries in Postman, you will be able to retrieve the csv files in this directory
* postman/rtf/generated-csv-files

> ### API terminal

Open API terminal
```bash
docker exec -it api bash
```

> ### Stop

Execute from project folder
```bash
docker-compose down
```

## Authors

* [Nicolas Herbez](https://github.com/nicolas-herbez)
