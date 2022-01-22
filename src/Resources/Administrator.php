<?php

namespace AngryMoustache\Rambo\Resources;

use AngryMoustache\Rambo\Models\Administrator as ModelsAdministrator;
use AngryMoustache\Rambo\Resource;

class Administrator extends Resource
{
    public $model = ModelsAdministrator::class;
}
