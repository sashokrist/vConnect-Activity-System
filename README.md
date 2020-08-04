<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Activity System

Activity System is PHP Laravel based project for manage the vConnect company's activity.

How to run it?
1. git clone: git@gitlab.vconnect.systems:vconnect/activity-system.git
2. composer install
3. cp .env.example .env
4. php artisan key:generate

Put in .env:

ALGOLIA_APP_ID=P8B9OM151A

ALGOLIA_SECRET=bce8d24b3e84edbeeaf65245b6878422

Set database credentials

5. php artisan migrate
6. php artisan db:seed
7. php artisan queue:listen

Open project on localhost:8000

Administration: localhost:8000/admin-login

 ADMIN: 
 
 admin@admin.com
 
 password: admin
 
 Admin can create new Post(News) and new Poll,
 generate new time slots,
 assign user's roles,
 manege post, poll, user, role,
 vote, sign up, comment, read news, reserve time.
 
 USER:
 
 user@user.com
 
 password: user
 
 User can vote, sign up, read news, comment, reserve time.

