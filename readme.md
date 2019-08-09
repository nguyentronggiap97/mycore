Demen Books Backend
===================

Demen Books Backend Project

Tasks
-----
- [ ] Add product module
- [ ] Add account module
- [x] Add backend module
- [x] Add authorization support
- [x] Add authentication support
- [x] Add themes support
- [x] Add modules support

Modules
-------

Các module của dự án
- Backend: user, role, permissions
- Bookcase: school, class, bookcase
- Media: filesystem, upload, ...
- Store: product (book), cart, order, payment, ...

Installation
------------

Các bước cài đặt project

```sh
# (1) Yêu cầu hệ thống
# - Laravel: 5.8
# - PHP: 7.1.3 trở lên
# - Extension: Mongodb

# (2) Cài đặt mongodb
# - Cài đặt mongodb sử dụng Docker
# - Cài Docker, cài Kitematic
# - Dùng Kitematic tạo Mongodb

# (3) Cài đặt mongodb extension cho PHP
# - Cài đặt dùng PECL
$ pecl install mongodb
$ apt install imagemagick
$ apt install php-imagick

# (4) Cài đặt các modules
$ composer install
$ composer update

# (5) Cấu hình laravel
# - Cập nhật cấu hình trong file .env
# - Cập nhật cấu hình mongodb

```

Authorization
-------------
- [Laravel Authorization](https://allaravel.com/laravel-tutorials/phan-quyen-nguoi-dung-voi-laravel-authorization/)

Authentication
--------------
- [Laravel Authentication](https://allaravel.com/laravel-tutorials/laravel-authentication-xac-thuc-nguoi-dung-that-don-gian/)
- [Xác thực trong Laravel](https://code.tutsplus.com/vi/tutorials/how-to-create-a-custom-authentication-guard-in-laravel--cms-29667)
- [Laravel bảo mật 2 lớp](https://techblog.vn/gui-sms-bang-laravel-phuc-vu-bao-mat-2-lop)

Modules
-------

Add modules to composer.json for autoload

```js
{
    "autoload": {
        "psr-4": {
            "App\\": "app/",
            "Modules\\": "modules/" // Add module to autoload
        },
        "classmap": [
            "database/seeds",
            "database/factories"
        ]
    }
}
```

Update modules to composer autoload

```sh
$ composer install
$ composer update
```

MongoDB
-------

Install php-mongodb-ext

```sh
$ pecl install mongodb
```

Install laravel mongodb driver

```sh
$ composer require mongodb/mongodb
$ composer require jenssegers/mongodb
```

Generate resource

```sh
$ php artisan make:controller ProductController --resource --model=Product
```

Laravel mongodb example

> https://itsolutionstuff.com/post/laravel-5-mongodb-crud-tutorialexample.html

Laravel mongodb issues

> Issue unique database field validate

Domain
------
- Frontend: 
    - Desktop `www.domain.com`
    - Mobile `m.domain.com`
    - API `api.domain.com`
- Backend: desktop only
    - `id.domain.com`
    - `work.domain.com`
    - `admin.domain.com`
- Single sign on: 
    - `id.domain.com`

Author
------

TDN

