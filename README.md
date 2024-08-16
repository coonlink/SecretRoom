# SecretRoom

SecretRoom is a PHP library designed to manage Easter eggs based on user inputs such as dates, texts, or numbers. The library allows you to define custom responses for specific inputs and supports localization, making it a versatile tool for PHP-based projects.

## Requirements

- PHP version 8.3.0 or higher
- Composer

## Installation

To install the SecretRoom library via Composer, run the following command:

```bash
composer require coonlink/SecretRoom
```

This will download and install the library and its dependencies in your project.

## Usage

To use SecretRoom in your project, include the Composer autoload file and create an instance of the `SecretRoom` class.

Here is a basic example of how to set it up:

```php
require 'vendor/autoload.php';

use PHPsecretroom\SecretRoom;

$responses = [
    'test' => 'ok',
];

$requestHandler = new SecretRoom($responses);
$requestHandler->handleRequest();
```

### Handling Requests

The `SecretRoom` class processes incoming POST requests in JSON format. Based on the provided input (date, text, or number), the library searches for a matching Easter egg or returns a default response.

Example JSON input:

```json
{
    "date": "1980",
    "lang": "en"
}
```

The library will respond with a JSON-encoded message based on the predefined Easter eggs in the `easter_eggs.json` file. If no match is found, a default response or an error message will be returned.

### Localization

SecretRoom supports localization by allowing you to define different responses based on the provided language code. The `easter_eggs.json` file can include localized messages for specific inputs. If no localization is found for the requested language, a default message will be returned.

Example structure of `easter_eggs.json`:

```json
{
    "1980": {
        "en": "Thank you for discovering the first Easter egg in the video game 'Adventure'.",
        "ru": "Спасибо за то, что обнаружили первое пасхальное яйцо в видеоигре 'Adventure'."
    }
}
```

### Autoloading Classes

The library uses a custom autoloader defined in `autoload.php`. This autoloader ensures that PHP classes are automatically loaded when they are needed, based on the PSR-4 standard.

### Error Handling

The library performs a PHP version check at runtime. If the installed PHP version is lower than 8.3.0, an error message will be displayed, and the script will terminate.

For command-line usage, the error message will be output to `STDERR`. In a web context, the message will be displayed with a `500 Internal Server Error` response.

## File Structure

Here is an overview of the key files and directories:

```
SecretRoom/
│
├── src/
│   ├── autoload.php           # Custom autoloader
│   └── PHPsecretroom/
│       ├── SecretRoom.php     # Main class handling requests and responses
│       └── easter_eggs.json   # Easter egg definitions
│
├── tests/                     # (Optional) Unit tests
│   └── SecretRoomTest.php
│
├── composer.json              # Composer configuration
├── README.md                  # Project documentation (this file)
└── index.php                  # Example usage of the library
```

## Testing

If you wish to run unit tests, you can install PHPUnit as a development dependency and create test cases for your classes. To install PHPUnit, run:

```bash
composer require --dev phpunit/phpunit
```

Then, you can create test files in the `tests/` directory and run them with the following command:

```bash
vendor/bin/phpunit tests
```

## Contributing

If you would like to contribute to this project, feel free to fork the repository and submit a pull request. All contributions are welcome!

## License

This project is licensed under the MIT License. See the `LICENSE` file for more details.
