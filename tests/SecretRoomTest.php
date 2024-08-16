<?php

use PHPUnit\Framework\TestCase;
use PHPsecretroom\SecretRoom;

class SecretRoomTest extends TestCase
{
    public function testHandleRequestWithValidDate()
    {
        // Mock responses and Easter egg data
        $responses = ['1980' => 'Thank you!'];
        $secretRoom = new SecretRoom($responses);

        // Simulate a POST request
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_SERVER['CONTENT_TYPE'] = 'application/json';
        $input = json_encode(['date' => '1980']);
        file_put_contents('php://input', $input);

        // Capture output
        ob_start();
        $secretRoom->handleRequest();
        $output = ob_get_clean();

        // Assert that the response is as expected
        $expectedOutput = json_encode(['status' => 'success', 'message' => 'Thank you!']);
        $this->assertEquals($expectedOutput, $output);
    }

    // You can add more tests for other scenarios (e.g., text, number, default request)
}
