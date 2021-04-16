# Laravel package for Multi-Step Lead Generation

[![Latest Version on Packagist](https://img.shields.io/packagist/v/roberts/leads.svg?style=flat-square)](https://packagist.org/packages/roberts/leads)
![Tests](https://github.com/roberts/leads/workflows/Tests/badge.svg)
[![Total Downloads](https://img.shields.io/packagist/dt/roberts/leads.svg?style=flat-square)](https://packagist.org/packages/roberts/leads)

This is where your description should go.

## Installation

You can install the package via composer:

```bash
composer require roberts/leads
```

You can publish the config file with:

```bash
php artisan vendor:publish --provider="Roberts\Leads\LeadsServiceProvider" --tag="leads-config"
```

Publish the SCSS files:

```bash
php artisan vendor:publish --provider="Roberts\Leads\LeadsServiceProvider" --tag="styles"
```

Now import the published SCSS file into your main SCSS.

## Models

We include the following model in this package:

**List of Models**

- Lead
- Lead Business

For each of these models, this package implements an [authorization policy](https://laravel.com/docs/8.x/authorization) that extends the roles and permissions approach of the [tipoff/authorization](https://github.com/tipoff/authorization) package. The policies for each model in this package are registered through the package and do not need to be registered manually.

The models also have [Laravel Nova resources](https://nova.laravel.com/docs/3.0/resources/) in this package and they are also registered through the package and do not need to be registered manually.

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Drew Roberts](https://github.com/drewroberts)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
