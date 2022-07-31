# Package is meant to help development teams easily manage their env variables across environments

[![Latest Version on Packagist](https://img.shields.io/packagist/v/omenejoseph/dynamic-env.svg?style=flat-square)](https://packagist.org/packages/omenejoseph/dynamic-env)
[![Total Downloads](https://img.shields.io/packagist/dt/omenejoseph/dynamic-env.svg?style=flat-square)](https://packagist.org/packages/omenejoseph/dynamic-env)
![GitHub Actions](https://github.com/omenejoseph/dynamic-env/actions/workflows/main.yml/badge.svg)

So imagine you are onboarding a new member of your team and you need to send them all the variables they need to be up and running in your laravel application or you add a new variable to your .env file and you want all your engineers to be able to have that new variable and its actual value you cannot push to git in .env example, this package utilises AWS secrets to help solve this problem. With as little as one command you can sync your current .env file to AWS secrets manager and ask your team to re populate their .env file with all the new variables added. Another advantage of this package is that you are able to specify which environment you want to sync to and populate from, thus properly seperating your environments making them clean and tidy.

## Installation

You can install the package via composer:

```bash
composer require omenejoseph/dynamic-env
```

Dont forget to publish the application config and prefill with the appopriate credentials
```php
return [
    /* Secret manager */
    'secret_manager' => 'aws',

    /* AWS credentials */
    'aws_key' => env('AWS_ACCESS_KEY_ID'),
    'aws_secret' => env('AWS_SECRET_ACCESS_KEY'),
    'aws_secret_region' => env('AWS_SECRET_REGION'),

    /* Environments that you would be saving the envs to */
    'environments' => [
        'local',
        'qa',
        'production'
    ],

    /* suffix appended to .env when generating the new file eg. .env.sync */
    'env-suffix' => 'sync',
];
```

## Usage

```bash
php artisan sync:env
```
This command asks for the environment you want to sync to and populates AWS secret with the variables in your current .env file

```bash
php artisan populate:env
```
This command asks for the environment you want to populate from and replaces your current .env file with the env variables for that environment on AWS secrets.

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email runoomene01@gmail.com instead of using the issue tracker.

## Credits

-   [Omene Joseph](https://github.com/omenejoseph)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
