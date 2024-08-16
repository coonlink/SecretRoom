<?php

namespace PHPsecretroom;

class SecretRoom {
    private $easterEggs;
    private $defaultResponses;

    public function __construct($defaultResponses = []) {
        $this->defaultResponses = $defaultResponses;

        $filePath = __DIR__ . '/easter_eggs.json';
        
        if (file_exists($filePath)) {
            $this->easterEggs = json_decode(file_get_contents($filePath), true);
        } else {
            $this->easterEggs = [];
        }
    }

    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SERVER['CONTENT_TYPE'] === 'application/json') {
            $inputJSON = file_get_contents('php://input');
            $input = json_decode($inputJSON, TRUE);
            $response = array();

            if (isset($input['date'])) {
                $response = $this->handleDateRequest($input['date'], $input['lang'] ?? null);
            } elseif (isset($input['text'])) {
                $response = $this->handleTextRequest($input['text'], $input['lang'] ?? null);
            } elseif (isset($input['number'])) {
                $response = $this->handleNumberRequest($input['number'], $input['lang'] ?? null);
            } elseif (isset($input['default'])) {
                $response = $this->handleDefaultRequest($input['default'], $input['lang'] ?? null);
            } else {
                $response = $this->handleDefaultRequest('default', $input['lang'] ?? null);
            }

            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }
    }

    private function handleDateRequest($date, $lang) {
        if (isset($this->easterEggs[$date])) {
            return $this->getLocalizedMessage($this->easterEggs[$date], $lang);
        } elseif (isset($this->defaultResponses[$date])) {
            return ['status' => 'success', 'message' => $this->defaultResponses[$date]];
        } else {
            return ['status' => 'error', 'message' => 'Invalid request.'];
        }
    }

    private function handleTextRequest($text, $lang) {
        if (isset($this->easterEggs[$text])) {
            return $this->getLocalizedMessage($this->easterEggs[$text], $lang);
        } elseif (isset($this->defaultResponses[$text])) {
            return ['status' => 'success', 'message' => $this->defaultResponses[$text]];
        } else {
            return ['status' => 'error', 'message' => 'Invalid request.'];
        }
    }

    private function handleNumberRequest($number, $lang) {
        if (isset($this->easterEggs[$number])) {
            return $this->getLocalizedMessage($this->easterEggs[$number], $lang);
        } elseif (isset($this->defaultResponses[$number])) {
            return ['status' => 'success', 'message' => $this->defaultResponses[$number]];
        } else {
            return ['status' => 'error', 'message' => 'Invalid request.'];
        }
    }

    private function handleDefaultRequest($default, $lang) {
        if (isset($this->easterEggs[$default])) {
            return $this->getLocalizedMessage($this->easterEggs[$default], $lang);
        } elseif (isset($this->defaultResponses[$default])) {
            return ['status' => 'success', 'message' => $this->defaultResponses[$default]];
        } else {
            return ['status' => 'error', 'message' => 'Invalid request.'];
        }
    }

    private function getLocalizedMessage($messages, $lang) {
        if ($lang && isset($messages[$lang])) {
            return ['status' => 'success', 'message' => $messages[$lang]];
        } elseif (isset($messages['default'])) {
            return ['status' => 'success', 'message' => $messages['default']];
        } else {
            $firstMessage = reset($messages);
            return ['status' => 'error', 'message' => $firstMessage];
        }
    }
}