<?php

namespace AngryMoustache\Rambo\Fields;

use AngryMoustache\Media\Models\Attachment;

class AttachmentField extends Field
{
    public $bladeShowComponent = 'rambo::livewire.fields.show.attachment';
    public $livewireFormComponent = 'rambo-form-attachment-field';

    public $folder = 'uploads';

    public function getShowValue()
    {
        return Attachment::find($this->getValue());
    }
}
