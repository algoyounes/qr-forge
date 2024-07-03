<p align="center">
<img width="150" height="150" src="assets/logo.png" alt="QR Forge"/>
<br><b>QR Forge</b>
</p>
<p align="center">
<a href="https://github.com/algoyounes/qr-forge/actions"><img src="https://github.com/algoyounes/qr-forge/actions/workflows/unit-tests.yml/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/algoyounes/qr-forge"><img src="https://img.shields.io/packagist/dt/algoyounes/qr-forge" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/algoyounes/qr-forge"><img src="https://img.shields.io/packagist/v/algoyounes/qr-forge" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/algoyounes/qr-forge"><img src="https://img.shields.io/packagist/l/algoyounes/qr-forge" alt="License"></a>
</p>

A PHP package that allows you to generate QR codes with ease.

## Installation

You can install the package globally via composer:

```bash
  composer global require algoyounes/qr-forge
```

## Usage

### Generate Base64

```php
use AlgoYounes\QRForge\Facades\QRForge;

$base64 = QRForge::fromArray([ Tag::create(1, 'test') ])->base64();
```

### Generate Plain

```php
use AlgoYounes\QRForge\Facades\QRForge;

$plain = QRForge::fromArray([ Tag::create(1, 'test') ])->plain();
```

### Render A QR Code Image

```php
use AlgoYounes\QRForge\Facades\QRForge;

QRForge::fromArray([ Tag::create(1, 'test') ])->render();
```
