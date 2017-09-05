# Net Natives Interview Task

An implementation of the [Net Natives Interview Task](http://akerolabs.com/dev-task) using AngularJS on the front-end and Lumen for the backend API functionality.

## System Requirements

* Apache
* Database (MySQL, Postgres, SQLite, and SQL Server)
* PHP

## Setup

* Setup the database ENV variables using the .env file, or via the control panel in Heroku.

## Implemented Functionality

* Display of the contact data in an appropriate visual format.
    * Contact data is displayed using Bootstrap Thumbnails in list view (`/contacts`).
    * Contact data is displayed using a form in detail view (`/contact/:id`).
* Ability to add a new contact.
    * New contacts can be added using the new contacts page (`/contact/new`).
* Ability to remove a contact.
    * Contacts can be removed by pressing the Delete button on the contact's list or detail views.
* Ability to update/edit a contact.
    * Contacts can be updated using the form in detail view (`/contact/:id`).
* Individual user login using an appropriate authentication method (i.e. not plain text).
    * Users can provide their login details to be authenticated using the login page (`/login`).
    * Password hashs are generated using the BCrypt and a randomly generated salt.
    * Users are authenticated by matching the password input with the user's salt value against the saved password hash.
* A solution developed around your own api.
    * The backend API functionality is provided via a basic implementation using Lumen, available API calls are:
        * `POST /api/public/artisan/db-seed` Seeds the database with sample data
        * `POST /api/public/authentication` Authenticates the user
        * `POST /api/public/contact` Saves a new contact
        * `GET /api/public/contacts?q` Returns a list of contacts matching the query string
        * `GET /api/public/contact/:id` Return the specified contact details
        * `PUT /api/public/contact/:id` Updates the specified contact details
        * `DELETE /api/public/contact/:id` Removes the specified contact from the database
* Any additional features.
    * Users can search for a contact by name, location, email or phone using the search bar at the top of the page

## Implemented or Modified Files

### AngularJS

* `/app.config.js`
* `/app.module.js`
* `/app/application.controller.js`
* `/app/authentication/_form.html`
* `/app/authentication/authentication.controller.js`
* `/app/authentication/login.html`
* `/app/contacts/_form.html`
* `/app/contacts/_list.html`
* `/app/contacts/contact-detail.controller.js`
* `/app/contacts/contact-detail.html`
* `/app/contacts/contacts.controller.js`
* `/app/contacts/contacts.html`
* `/app/home/home.controller.js`
* `/app/home/home.html`
* `/app/places.html`
* `/app/services/authentication.service.js`
* `/app/services.contacts.service.js`

### Lumen

* `/api/app/Http/Contact.php`
* `/api/app/Http/User.php`
* `/api/app/Http/Controllers/ArtisanController.php`
* `/api/app/Http/Controllers/AuthenticationController.php`
* `/api/app/Http/Controllers/ContactsController.php`
* `/api/app/Http/Providers/AuthServiceProvider.php`
* `/api/database/migrations/2017_09_01_000000_Contacts.php`
* `/api/database/migrations/2017_09_01_000000_Users.php`
* `/api/database/seeds/ContactsSeeder.php`
* `/api/database/seeds/UsersSeeder.php`
* `/api/routes/web.php`
* `/api/storage/data/contacts.json`
* `/api/storage/data/users.json`