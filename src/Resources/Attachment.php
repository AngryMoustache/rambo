<?php

namespace AngryMoustache\Rambo\Resources;

use AngryMoustache\Media\Models\Attachment as ModelsAttachment;
use AngryMoustache\Rambo\Fields\IDField;
use AngryMoustache\Rambo\Resource;

class Attachment extends Resource
{
    public $model = ModelsAttachment::class;

    public function fields()
    {
        return [
            IDField::make(),
        ];
    }
}
