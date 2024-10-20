<?php

namespace App\Controllers;

abstract class MainController
{

    /**
     * Send a JSON response
     *
     * @param mixed $data - The data to be returned as JSON
     * @param int $statusCode - HTTP status code (default: 200)
     * @return void
     */
    public function sendResponse(mixed $data, int $statusCode = 200): void
    {
        // Set content-type to application/json
        header('Content-Type: application/json');

        // Set the HTTP status code
        http_response_code($statusCode);

        // Encode data as JSON and output it
        echo json_encode($data);
        exit();
    }
}