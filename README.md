# PHP Multi-Factor Authentication (MFA) Login System

This project demonstrates how to implement a secure login system using PHP and Google Authenticator for two-factor authentication (MFA). It consists of a user registration and login system with basic user data management, along with MFA integration for enhanced security.

## Known Issue

**Error:** Fatal error: Uncaught Error: Call to undefined function mysqli_connect() in /var/www/html/index.php:3

**Resolution:**

Open the interactive terminal with your docker container that's running the www service and run the command:

```bash
docker-php-ext-install mysqli && docker-php-ext-enable mysqli && apachectl restart


This command will install the mysqli extension, enable it, and restart the Apache web server. This should resolve the error.

## Features

- User registration and login functionality
- Password hashing for secure password storage
- Google Authenticator integration for MFA
- QR code generation for MFA setup
- User location tracking based on IP address

## Technologies Used

- PHP
- MySQL
- Google Authenticator
- PHPMyAdmin

## Project Structure

- index.php: Handles user login and redirects to welcome.php or mfa_setup.php
- welcome.php: Displays welcome message with user information and location
- mfa_verify.php: Verifies the MFA code entered by the user
- mfa_setup.php: Generates a secret key and displays QR code for MFA setup
- docker-compose.yml: Defines the Docker environment for the project
- Dockerfile: Builds the Docker image for the PHP application
- php_docker_table.sql: SQL script to create the database tables

## Dependencies

- PHP MySQL extension
- Google Authenticator library for PHP

## Installation

1. Clone the project repository
2. Create a `.env` file and add the following environment variables:
   - DB_HOST: MySQL host name
   - DB_NAME: MySQL database name
   - DB_USER: MySQL database username
   - DB_PASSWORD: MySQL database password
3. Run `docker-compose up -d` to build and start the Docker containers
4. Access the application at `http://localhost`

## Usage

1. Register a new user by entering username and password on the index.php page
2. Log in using the registered username and password
3. If MFA is not set up, you will be redirected to mfa_setup.php
4. Scan the QR code displayed on mfa_setup.php using the Google Authenticator app on your mobile device
5. Enter the generated code from the Google Authenticator app into mfa_setup.php
6. Once MFA is set up, you will be redirected to welcome.php
7. Subsequent logins will require both username/password and the MFA code
