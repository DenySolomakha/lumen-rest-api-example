# How start?

Local development start
------------
* For the **first** run application in DEV-mode:
  `make bootstrap`

* **Start** / **Stop** / **Restart** application:
  `make start` / `make stop` / `make resrtart`

* Use command composer:
  `make composer cmd="any composer command"`

* Use artisan with commands:
  `make artisan cmd="any artisan command"`

**Application home page url:** [localhost::8085](http:://localhost::8080)

**API url:** [localhost::8085/api](http:://localhost::8080/api)

<br/>

###### Third party packages:
- [php-open-source-saver/jwt-auth](https://github.com/PHP-Open-Source-Saver/jwt-auth)
- [stechstudio/Laravel-PHP-CS-Fixer](https://github.com/stechstudio/Laravel-PHP-CS-Fixer)


**NOTE!**
---
Command `make bootstrap` uses unix cp command, on windows platforms you will get an error. <br/>
In order for sending mail to work, you need to assign data to **MAIL_USERNAME** and **MAIL_PASSWORD**.
I used the service [mailtrap.io](https://mailtrap.io/).