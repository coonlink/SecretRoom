<?php

class CustomAutoloader {
    private $minPHPVersion = '8.0.0';

    public function __construct() {
        $this->checkPHPVersion();
        spl_autoload_register([$this, 'autoload']);
    }

    private function checkPHPVersion() {
        if (version_compare(PHP_VERSION, $this->minPHPVersion, '<')) {
            $this->handleIncompatibleVersion();
        }
    }

    private function handleIncompatibleVersion() {
        $errorMessage = 'This application requires PHP version ' . $this->minPHPVersion . ' or higher. You are running ' . PHP_VERSION . '. Please upgrade your PHP version.';

        if (PHP_SAPI === 'cli' || PHP_SAPI === 'phpdbg') {
            fwrite(STDERR, $errorMessage . PHP_EOL);
        } else {
            if (!headers_sent()) {
                header('HTTP/1.1 500 Internal Server Error');
            }
            echo $errorMessage;
        }

        trigger_error($errorMessage, E_USER_ERROR);
        exit;
    }

    public function autoload($className) {
        $file = __DIR__ . '/' . str_replace('\\', '/', $className) . '.php';
        if (file_exists($file)) {
            require_once $file;
        } else {
            error_log("Class $className could not be loaded. File $file not found.");
        }
    }
}

$autoloader = new CustomAutoloader();