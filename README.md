<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# 🚀 Social Media App

![Laravel](https://img.shields.io/badge/Laravel-10-orange) ![Bootstrap](https://img.shields.io/badge/Bootstrap-5-blue)

## 📝 Introduction
The Social Media App project is developed using Laravel 10 and Bootstrap 5. It utilizes Laravel Debug-Bar to optimize database queries using Eager Loading method. The website allows user registration, login with authentication, and session management. Each user can create posts, which can be commented on by other users. Users can also follow each other and like posts. Only the user who created a post can edit or delete it. Each user has a profile section where they can edit their photo, biography, and view their posts. If a user follows another user, they will see the latest posts from those they follow in the Followers section. The database structure in this project uses relationships between tables and pivot tables.

## 🎯 Features
- User registration and authentication
- Session management
- Create, edit, and delete posts
- Comment on posts
- Follow other users
- Like posts
- Profile section for users
- Followers section to view latest posts from followed users
- Admin Dashboard for administrator
- Tests written in PHPUnit for code unit testing

## Admin Account
There is one administrator account with access to the Admin Dashboard. The administrator can view, edit, and delete users, posts, and comments.

### Admin Credentials
- Username: Admin
- Password: admin

### User Credentials
- Username: User
- Password: user


## 🌐 Getting Started
To run the project, follow these steps:
1. Run `composer install`.
2. Run `php artisan serve` to start the server.
3. Run `php artisan migrate` to create the tables in the database.
4. Use `php artisan db:seed --class=UsersTableSeeder` to add predefined users to the database. One of them is the administrator account.


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
