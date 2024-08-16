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

#### Input Parameters:
- **"date"**: Instead of using a date, you can specify a string of text or a number, or leave it to handle a default case. This input is used to match against predefined Easter eggs in the `easter_eggs.json` file. If a match is found, the corresponding message is returned.
  
  - **Text Input**: You can send any text to the library. If it matches an Easter egg defined in `easter_eggs.json`, the corresponding message is returned.
  
  - **Number Input**: You can also send numbers. Similar to text, if the number matches an Easter egg in `easter_eggs.json`, the message is returned.

  - **Default Case**: If the input does not match any defined Easter eggs, a default response or an error message is returned.

- **"lang"**: This optional parameter allows you to request the response in a specific language. If the language is not provided or if the requested language is not available, the library will return the message in the default language.

Example:

```json
{
    "text": "hello",
    "lang": "ru"
}
```

This would return the Easter egg response for the text "hello" in Russian, if defined, or the default message if not.

### Localization

SecretRoom supports localization by allowing you to define different responses based on the provided language code. The `easter_eggs.json` file can include localized messages for specific inputs. If no localization is found for the requested language, a default message will be returned.

Example structure of `easter_eggs.json`:

```json
{
    "1980": {
        "en": "Thank you for discovering the first Easter egg in the video game 'Adventure'.",
        "ru": "Спасибо за то, что обнаружили первое пасхальное яйцо в видеоигре 'Adventure'."
    },
    "hello": {
        "en": "Hello there!",
        "es": "¡Hola!"
    },
    "42": {
        "default": "The answer to life, the universe, and everything."
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
