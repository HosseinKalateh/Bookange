<div>

<h1 dir="ltr" align="left">Bookange</h1>
<h2>What is Bookange ?</h2>

<p>Bookange is a free & open-source book store project that completing using laravel/react with api</p>

### Features :
- Admin Panel 
	- ✅Category CRUD
	- ✅Author CRUD
	- ✅Publisher CRUD
	- ✅Translator CRUD
	- ✅Book CRUD
	- ❌User CRUD
	
- Api
	-✅Show Categories
	-✅Show Category(books of a category)
	-✅Show Authors
	-✅Show Author(books of an author)
	-✅Show Publishers
	-✅Show Publisher(books of a publisher)
	-✅Show Translators
	-✅Show Translator(books of a translator)
	-✅Show Books
	-✅Show Book
	-❌Authentication
	-❌Show User Profile
	-❌Edit User Profile
	-❌Add Book To Wishlist
	-❌Add Comment For Book
	-❌Search In Books
	-❌Search In Categories
	-❌Search In Authors
	-❌Search In Publishers
	-❌Search In Translators
	
<br />

## Install:
Clone Repository and install Composer
</div>

```php
git clone https://github.com/HosseinKalateh/Bookange.git
```

```php
composer install
```

<p>Config Database in .env file then migrate and seed database</p>

```php
php artisan migrate
```

```php
php artisan db:seed
```

<a href="https://www.postman.com/collections/60b4249646e1198c8604" target="_blank">
Api Document in Persian language(Import in Postman)
</a>

## What do we use in this project?
- [Laravel EasyPanel](https://github.com/rezaamini-ir/laravel-easypanel)


