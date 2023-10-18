<?php

namespace Tests\Feature;

use App\Http\Middleware\CheckIsJson;
use Illuminate\Http\Request;
use Tests\TestCase;

class CheckJsonTest extends TestCase
{
    /**
     * Test route middleware with valid json input
     */
    public function test_valid_json(): void
    {
        // Arrange
        $expected = 'Valid JSON';
        $request = Request::create(
            uri: route('api.payload.difference'),
            method: 'POST',
            content: '{ "test" : "json", "type" : "string" }'
        );
        $next = function () {
            return response('Valid JSON');
        };

        // Act
        // Create a middleware instance
        $middleware = new CheckIsJson();
        $response = $middleware->handle($request, $next);

        // Assert
        $this->assertEquals($expected, $response->getContent());
    }

    /**
     * Test route middleware with an invalid json input
     */
    public function test_invalid_json(): void
    {
        // Arrange
        $request = Request::create(
            uri: route('api.payload.difference'),
            method: 'POST',
            content: '{'
        );
        $next = function () {
            return response('Valid JSON');
        };

        // Act
        // Create a middleware instance
        $middleware = new CheckIsJson();
        $response = $middleware->handle($request, $next);

        // Assert
        $this->assertJson($response->getContent());
        $actual = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('message', $actual);
        $this->assertEquals('The request is not a valid JSON.', $actual['message']);
    }
}
