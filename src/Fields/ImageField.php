<?php

namespace AngryMoustache\Rambo\Fields;

use AngryMoustache\Media\Models\Attachment;

class ImageField extends Field
{
    public $showComponent = 'rambo::livewire.fields.show.image';

    public function getShowValue()
    {
        return optional(Attachment::find(parent::getValue()))->path();
    }
}
