# Camagru<!-- omit in toc -->

- [Introduction](#introduction)
- [Objectives](#objectives)
- [Mandatory](#mandatory)
- [How To Use](#how-to-use)
- [Final Mark 122/100 👍](#final-mark-122100-)
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
