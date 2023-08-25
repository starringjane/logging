<?php

return [
    'teams' => [
        'webhook_url' => env('TEAMS_WEBHOOK_URL'),
    ],

    'loggly' => [
        'token' => env('LOGGLY_TOKEN'),
        'tag' => env('LOGGLY_TAG'),
    ],
];
