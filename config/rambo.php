<?php

use AngryMoustache\Rambo\Cards\WelcomeCard;
use AngryMoustache\Rambo\Rambo\Administrator;
use AngryMoustache\Rambo\Rambo\Attachment;
use AngryMoustache\Rambo\Rambo\StaticString;

return [
    'admin-route' => 'admin',

    'admin-guard' => 'rambo',

    'resources' => [
        Administrator::class,
        Attachment::class,
        StaticString::class,
    ],

    'cards' => [
        WelcomeCard::class,
    ],
];
