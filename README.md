# Witchcraft

Opionated PHP magic methods as traits.

[![Author](http://img.shields.io/badge/author-@tuupola-blue.svg?style=flat-square)](https://twitter.com/tuupola)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.txt)
[![Build Status](https://img.shields.io/travis/tuupola/witchcraft/master.svg?style=flat-square)](https://travis-ci.org/tuupola/slim-basic-auth)
[![HHVM Status](https://img.shields.io/hhvm/tuupola/witchcraft.svg?style=flat-square)](http://hhvm.h4cc.de/package/tuupola/slim-basic-auth)

## Install

You can install latest version using [composer](https://getcomposer.org/).

```
$ composer require tuupola/witchcraft
```

## Usage

You have your usual class with boilerplate mutators.

```php
class Unicorn
{
    private $color;
    private $owner;

    public function __construct($color, $owner)
    {
        $this->color = $color;
        $this->color = $owner;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function setColor($color)
    {
        $this->color = $color;
        return $this;
    }

    public function getOwner()
    {
        return $this->owner;
    }

    public function setOwner($owner)
    {
        $this->owner = $owner;
        return $this;
    }
}
```

It is all works really nice with ide autocompletes and everything. Problem is your code looks quite ugly.

```php
$unicorn = new Unicorn();
$unicorn->setOwner("tuupola")->setColor("rainbow");
print $unicorn->getOwner();
```

Witchcraft to the resque. If you add `Witchcraft\MagicMethods` trait you can use pretty methods.

```php
class Unicorn
{
    use \Witchcraft\MagicMethods;

    private $color;
    private $owner;
```

```php
$unicorn = new Unicorn();
$unicorn->owner("tuupola")->color("rainbow");
print $unicorn->owner();
```

If you add `Witchcraft\MagicProperties` trait you can use pretty properties.

```php
class Unicorn
{
    use \Witchcraft\MagicProperties;

    private $color;
    private $owner;
```

```php
$unicorn = new Unicorn();
$unicorn->owner = "tuupola";
$unicorn->color = "rainbow";

print $unicorn->owner;
```
