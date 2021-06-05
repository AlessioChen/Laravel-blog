# Laravel blog api 

### About the project

Project made for Full Stack developer course. 

### Requirements
It requires the creation of API Rest using Laravel framework that allows the user trhough authentication to add text posts to a feed giving the possibility to tag other users and edit the post itself.

### Endpoints

- Authentication: Login
- Authentication : Registration
- Authentication : Logout
- Feed: List of paged and filterable feed
- Feed: add new post (Title, Description, User which is associated)
- Feed: edit post (Title Description, User which is associated)
- Feed: post Delete
- Notification list of a tag in a post 

### Features
- Send an email every time a user is tagged in a post
- Log table for all actions on the posts

### Build With
- PHP using Laravel as framework

### Getting started
Make sure to have docker installed in the computer.
1. Clone the repo
``` bash
git clone https://github.com/AlessioChen/Laravel-blog.git
```
2. Lauch these commands to inizialize docker.
```
 cd Laravel-blog
 docker run --rm -v $(pwd):/app composer install
```
3. Create e `.env` file and fill with DB and mailtrap data, you can find an example in `.env.example`
4. Start the server 
```
 vendor/bin/sail sail up 
```

### Usage 
- To test the endpoints use [postman](https://www.postman.com/).
- Random data can be seed into the DB with the command
```
vendor/bin/sail sail artisan migrate --seed 
```
- All endpoints can be founded in the `api.php` file for example the login route is
```
http://localhost/api/v1/login
```

### Acknowledgements

- [Laravel](https://laravel.com/)
- [Laravel Sanctum](https://laravel.com/docs/8.x/sanctum)
- [Docker](https://www.docker.com/)
- [Mysql](https://www.mysql.com/it/)
- [Postman](https://www.postman.com/)
- [Mailtrap](https://mailtrap.io)


