# laravel-rally

A followers system for laravel 5, Trait for Laravel Eloquent models to allow easy implementation of a "follow" or "like" or "favorite" or "remember" or "subscribe" feature.

[![StyleCI](https://styleci.io/repos/105341654/shield?branch=master)](https://styleci.io/repos/105341654)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/emanci/laravel-rally/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/emanci/laravel-rally/?branch=master)
[![Build Status](https://travis-ci.org/emanci/laravel-rally.svg?branch=master)](https://travis-ci.org/emanci/laravel-rally)
[![Packagist](https://img.shields.io/packagist/l/doctrine/orm.svg)](https://packagist.org/packages/emanci/laravel-rally)

## Installation

Via [Composer](https://getcomposer.org) to add the package to your project's dependencies:

```bash
$ composer require emanci/laravel-rally
```

First add service providers into the config/app.php

```php
\Emanci\Rally\RallyServiceProvider::class,
```

Publish the migrations

```bash
$ php artisan vendor:publish --provider="Emanci\Rally\RallyServiceProvider" --tag="migrations"
```

Publish the config

```bash
$ php artisan vendor:publish --provider="Emanci\Rally\RallyServiceProvider" --tag="config"
```

## Setup the model

Add CanFollow Traits to your User model.

```php
use Emanci\Rally\Traits\CanFollow

class User extends Model
{
    use CanFollow;
}
```

Add CanBeFollowed Trait to your Post model or Video model and more.

```php
use Emanci\Rally\Traits\CanBeFollowed

class Post extends Model
{
    use CanBeFollowed;
}
```

Add CanFollow and CanBeFollowed feature trait into your User model:

```php
use Emanci\Rally\Traits\Followable

class User extends Model
{
    use Followable;
}
```

## Usage

##### CanFollow

Follow and Unfollow users

```php
$user->follow(1);
$user->unfollow(1);

$user->follow([1, 2]);
$user->unfollow([1, 2]);

$user->follow(1, Post::class);
$user->unfollow(1, Post::class);
```

Check if being followed by someone

```php
$user->isFollowing(1);
$user->isFollowing($otherUser);

$user->isFollowing(2, Post::class);
$user->isFollowing($post, Post::class);
```

Toggle follow

```php
$user->toggleFollow([2, 4]);
$user->toggleFollow([2, 4], Post::class);
```

Following

```php
$user->following;
$user->following()->get();    // It's the same thing as this
$user->following()->count();  // Get the total following
```

##### CanBeFollowed

Check if following by someone

```php
$user->isFollowedBy(3);
$user->isFollowedBy($otherUser);
```

Followers

```php
$user->followers;
$user->followers()->get();    // It's the same thing as this
$user->followers()->count();  // Get the total followers
```

##### Followable

Check if it is mutual follow

```php
$user->isMutualFollow(1);
$user->isMutualFollow($otherUser);
```

## Inspiration

* [Rally](https://github.com/fenos/Rally)

## License

Licensed under the [MIT license](https://github.com/emanci/laravel-rally/blob/master/LICENSE).
