<?php

use AngryMoustache\Rambo\Resources\Administrator;
use AngryMoustache\Rambo\Resources\Attachment;

return [
    'admin-route' => 'admin',
    'admin-guard' => 'rambo',
    'resources' => [
        'General' => [
            Administrator::class,
            Attachment::class,
            App\Resources\Pull::class,
        ],
    ],
];
