<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */
    'supports_credentials' => false,
    'allowed_origins' => ['http://localhost:4200'], // Autoriser les requêtes de cette origine
    'allowed_headers' => ['Content-Type', 'X-Requested-With', 'Authorization', 'Origin', 'Accept', 'X-CSRF-TOKEN'],
    'allowed_methods' => ['*'], // Accepter toutes les méthodes HTTP (GET, POST, PUT, DELETE)
    'exposed_headers' => [],
    'max_age' => 0,
    'hosts' => [],
    'paths' => ['api/*'],

];
