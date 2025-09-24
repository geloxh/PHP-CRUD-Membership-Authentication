### PHP CRUD Membership Authentication
A full-stack web application built in PHP and MySQL that provides a complete user membership system with CRUD (Create, Read, Update, Delete) functionality. Users can register, log in, and manage their own list of items in a secure environment.

### Features
* **User Authentication:** Secure user registration and login system with password hashing.
* **CRUD Operations:** Authenticated users can Create, Read, Update and Delete their own items.
* **Session Management:** Keeps users logged in and protects pages from unauthorized access.
* **Public/Private Posts:** Users can choose to make their posts public or private.
* **Modern UI:** A clean and responsive user interface styled with CSS.
* **SQL Injection Prevention:** Uses prepared statements to ensure database security.

### Technologies Used

* **Frontend:** HTML, CSS
* **Backend:** PHP
* **Database:** MySQL

### Setup and Installation
To run the project locally, it requires web sever environment: XAMPP, WAMP OR MAMP.

1. **Clone the repository:**
``` bash
git clone <repo-url>
```
Or download the sourcode and place it in web server's root directory(htdocs for XAMPP).

2. **Create the database:**
* Open MySQL database management tool (phpMyAdmin for XAMPP).
* Create a new database named `simple_db`.
* Run the following SQL queries to create the necessary tables:

``` sql
CREATE TABLE `users` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `username` varchar(50) NOT NULL,
    `password` varchar(255) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `list` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `details` text NOT NULL,
    `date_posted` timestamp NOT NULL DEFAULT current_timestamp(),
    `time_posted` time NOT NULL DEFAULT current_timestamp(),
    `is_public` varchar(3) NOT NULL DEFAULT 'no',
    `username` varchar(50) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

### Usage
```
http://localhost/Php-CRUD-Membership-Authentication/index.php

```