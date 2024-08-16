<?php

use PHPUnit\Framework\TestCase;
use PHPsecretroom\SecretRoom;

class SecretRoomTest extends TestCase
{
    protected $secretRoom;

    protected function setUp(): void
    {
        $responses = [
            'test' => 'ok',
            'hello' => 'Hello there!',
            '42' => 'The answer to life, the universe, and everything.',
        ];

        $this->secretRoom = new SecretRoom($responses);
    }

    public function testHandleTextRequest()
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_SERVER['CONTENT_TYPE'] = 'application/json';
        $input = json_encode(['text' => 'hello']);

        ob_start();
        $this->secretRoom->handleRequest();
        $output = ob_get_clean();

        $expectedOutput = json_encode(['status' => 'success', 'message' => 'Hello there!']);
        $this->assertEquals($expectedOutput, $output);
    }

    public function testHandleNumberRequest()
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_SERVER['CONTENT_TYPE'] = 'application/json';
        $input = json_encode(['number' => '42']);

        ob_start();
        $this->secretRoom->handleRequest();
        $output = ob_get_clean();

        $expectedOutput = json_encode(['status' => 'success', 'message' => 'The answer to life, the universe, and everything.']);
        $this->assertEquals($expectedOutput, $output);
    }

    public function testHandleDefaultRequest()
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_SERVER['CONTENT_TYPE'] = 'application/json';
        $input = json_encode(['text' => 'unknown']);

        ob_start();
        $this->secretRoom->handleRequest();
        $output = ob_get_clean();

        $expectedOutput = json_encode(['status' => 'error', 'message' => 'Invalid request.']);
        $this->assertEquals($expectedOutput, $output);
    }
}