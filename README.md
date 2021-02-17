# Camagru<!-- omit in toc -->

- [Introduction](#introduction)
- [Objectives](#objectives)
- [Mandatory](#mandatory)
- [How To Use](#how-to-use)
- [Final Mark 122/100 👍](#final-mark-122100-)
- [Installation](#installation)
  - [How to Download Source Code](#how-to-download-source-code)
  - [How to Setup and Configure Database & Web Server](#how-to-setup-and-configure-database--web-server)
  - [How to Run Program](#how-to-run-program)
  - [Code Breakdown](#code-breakdown)
    - [Back-End Technologies](#back-end-technologies)
    - [Front-End Technologies](#front-end-technologies)
    - [Database Management Systems](#database-management-systems)
    - [File Structure](#file-structure)
      - [Config](#config)
      - [docs](#docs)
      - [resources](#resources)
      - [View](#view)
  - [Testing](#testing)
    - [Tests I Ran](#tests-i-ran)
    - [Expected Outcomes](#expected-outcomes)
 The goal of this project is to build a web application a little more complex than the previous ones with a little less means.

## Introduction

 The purpose of this project is to rebuild clones of Snapchat and Instagram and place them together in a Web Application of your own original design.

## Objectives

 This web project is challenging you to create a small web application allowing you to make basic photo and video editing using your webcam and some predefined images.

App’s users should be able to select an image in a list of superposable images (for instance a picture frame, or other “we don’t wanna know what you are using this for” objects), take a picture with his/her webcam and admire the result that should be mixing both pictures.

All captured images should be public, likeables and commentable.

## Mandatory

Your website should have a decent page layout (meaning at least a header, a main section and a footer), be able to display correctly on mobile devices and have an adapted layout on small resolutions.
All your forms should have correct validations and the whole site should be secured.
This point is MANDATORY and shall be verified when your application would be evaluated. To have an idea, here are some stuff that is NOT considered as SECURE:

- Store plain or unencrypted passwords in the database.
- Offer the ability to inject HTML or “user” JavaScript in badly protected variables.
- Offer the ability to upload unwanted content on the server.
- Offer the possibility of altering an SQL query.
- Use an extern form to manipulate so-called private data

The application should allow a user to sign up by asking at least a valid email
address, an username and a password with at least a minimum level of complexity.

- At the end of the registration process, an user should confirm his account via a
unique link sent at the email address fullfiled in the registration form.
- The user should then be able to connect to your application, using his username
and his password. He also should be able to tell the application to send a password
reinitialisation mail, if he forget his password.
- The user should be able to disconnect in one click at any time on any page.
- Once connected, an user should modify his username, mail address or password.

## How To Use

- Use your favourite apache or Nginx server to host the server.
- Configure the file database.php in config to use your credentials to access your MySQL server.
- PDO is used and other databases may be supported but this was not the explicit aim, MySQL is preferred.
- Run setup.php in config folder, this will redirect you to index.php if successful.
- Ensure your mail server is active, this application sends confirmation emails to:
  - activate accounts
  - reset passwords
  - update details
  - notify of comments & likes

## Final Mark 122/100 👍

## Installation

### How to Download Source Code

- Navigate to [https:github.com/sinkosi/Camagru](https://github.com/sinkosi/Camagru)
- Click clone or Download

### How to Setup and Configure Database & Web Server

- Download MAMP from the Bitnami Website
- Copy the Camagru directory into the folder MAMP/apache2/htdocs
- Open the manager-osx.
- Go to Manage Servers tab and make sure MySQL database and Apache Web Server are running.
- If not, restart the process.
- Select Configure, this should show details about the port.
- Open a web browser and go to <http://localhost:(port)/phpmyadmin>
- Create the database title camagru
- Navigate to import and upload a camagru file.

### How to Run Program

- Navigate to <http://localhost:(port)/camagru>

### Code Breakdown

#### Back-End Technologies

- PHP
- JavaScript

#### Front-End Technologies

- HTML
- CSS

#### Database Management Systems

- MySQL

#### File Structure

##### Config

- createConnection.php
- createDB.php
- createTable.php
- database.php
- fakePeople.php
- setup.php

##### docs

- camagruMarkingSheet.pdf

##### resources

- blank.png
- cheese.png
- favicon.png
- flame.png
- grunt.png
- pig.png
- splash.png

##### View

- my_comment.php
- stylesheet.css

- camera.php
- chat.php
- chatinsert.php
- checkmail.php
- comment.php
- contact.php
- delete_account.php
- delete_img.php
- email.php
- footer.php
- forgot.php
- gallery.php
- header.php
- index.php
- like.php
- login.php
- logout.php
- profile.php
- register.php
- reset_mail_validate.php
- reset_mail.php
- reset-password.php
- save_img.php
- session_update.php
- upload.php
- verify.php

### Testing

#### Tests I Ran

[Camagru Marking Sheet](./docs/camagru.markingsheet.pdf)

1. Preliminary Checks
   1. Usage of PHP
   2. No external frameworks
   3. config/database.php
   4. config/setup.php
   5. Use PDO only to connect to Database
2. Start Webserver
3. Create an Account
4. Login
5. Webcam
6. Homepage
7. Change User Credentials

#### Expected Outcomes

1. Preliminary Checks:
   1. Checking Source Code should reveal Back-End code is written in PHP
   2. Checking source code should reveal no additional libraries or frameworks.
   3. config/database.php should exist
   4. config/setup.php should exist
   5. config/database.php should show PDO connection
2. If you start the apache web server and navigate to <https://localhost:(port)/Camagru>, you should see the landing page for this Web Application
3. You should be able to sign-up and register an account and receive feedback
4. You should be able to login using the credentials you created at sign-up
5. You should be able to use the webcam when opting to take a photo
6. You should be able to Navigate to the homepage from anywhere in the site and see the gallery
7. You should be able to navigate to the <http://localost/Camagru/profile.php> page and edit your name, surname and alter your credentials for log in and these should be persistent
