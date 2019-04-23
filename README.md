For project setup you just have to run composer install.

Project structure:

Controller
 - ContactController containing the route / to list the contacts, Add, Edit and Delete actions
 
Entity
 - Contact endity which contains the contact table definition and Assertions for form validation
 
Form
 - ContactType is building the contact form with related fileds. Here I added the Image validation
 
Services
 - UploaderHelper, a service which I used for Picture upload
