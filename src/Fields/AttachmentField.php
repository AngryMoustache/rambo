<?php

namespace AngryMoustache\Rambo\Fields;

use AngryMoustache\Media\Models\Attachment;

class AttachmentField extends Field
{
    public $formComponent = 'rambo::livewire.fields.form.attachment';
    public $showComponent = 'rambo::livewire.fields.show.attachment';

    public $folder = 'uploads';

    public function getShowValue()
    {
        return Attachment::find($this->getValue());
    }
}
