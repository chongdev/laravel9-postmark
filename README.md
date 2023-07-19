
# Laravel9 Postmark

## Installation
You can install the package via composer:
``` sh
$ composer require symfony/postmark-mailer symfony/http-client
```

The package will automatically register itself.

## Usage
Update your .env file by adding your server key and set your mail driver to postmark.

``` sh 
MAIL_MAILER=smtp
MAIL_HOST=smtp.postmarkapp.com
MAIL_PORT=587
MAIL_USERNAME=YOUR-SERVER-KEY-HERE
MAIL_PASSWORD=YOUR-SERVER-KEY-HERE
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="support@uchoosetour.com"
MAIL_FROM_NAME="${APP_NAME}"

POSTMARK_TOKEN=YOUR-SERVER-KEY-HERE
```

## Ref
- **[Postmark Driver](https://laravel.com/docs/9.x/mail)**
- **[How to send transactional emails with Laravel PHP framework](https://postmarkapp.com/blog/how-to-send-transactional-emails-with-laravel-php-framework)**
- **[Postmark setup Domain & DNS](https://www.youtube.com/watch?v=HpdfubMKNOw)**

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
