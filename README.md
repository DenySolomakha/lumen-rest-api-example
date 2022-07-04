## Technology
````
Laravel Framework Lumen (9.0.2) (Laravel Components ^9.0)
PHP 8.1.7
PostgreSQL 13.4
Nginx 1.21.1
GNU Make 3.81
Docker version 20.10.16
docker-compose version 1.29.2
Composer version 2.3.7
````

### How start for local development?

------------
* For the **first** run application in DEV-mode:
  `make bootstrap`

* **Start** / **Stop** / **Restart** application:
  `make start` / `make stop` / `make restart`

* Use command composer:
  `make composer cmd="any composer command"`

* Use artisan with commands:
  `make artisan cmd="any artisan command"`

* Use test commands: <br/>
  `make test` - run all tests <br/>
  `make test TESTCOVARAGE=1` - run for generate coverage report

**Application home page url:** [localhost::8083](http:://localhost::8083)

**API url:** [localhost::8083/api](http:://localhost::8083/api)

<br/>

###### Dependencies
- [php-open-source-saver/jwt-auth](https://github.com/PHP-Open-Source-Saver/jwt-auth)
- [stechstudio/Laravel-PHP-CS-Fixer](https://github.com/stechstudio/Laravel-PHP-CS-Fixer)

### For testing end points
For testing endpoints, I recommend using the [insomnia](https://insomnia.rest/) client or any other analogs such as [postman](https://www.postman.com/). 
The insomnia collections file is located at the root of the project with the name **Insomnia_xxxx-xx-xx.json**

### NOTE

---
Command `make bootstrap` uses unix cp command, on windows platforms you will get an error. <br/>
In order for sending mail to work, you need to assign data to **MAIL_USERNAME** and **MAIL_PASSWORD**.
I used the service [mailtrap.io](https://mailtrap.io/).