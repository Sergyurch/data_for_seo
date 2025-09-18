<?php

return [
    'DATAFORSEO_LOGIN' => env('DATAFORSEO_LOGIN'), 
    'DATAFORSEO_PASSWORD' => env('DATAFORSEO_PASSWORD'),
    'timeoutForEachRequests' => 120,  
    'apiVersion' => '/v3/',  
    'url' => env('DATAFORSEO_API_BASE'),
    'extraEntitiesPaths' => []
];
