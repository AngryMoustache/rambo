<?php

namespace AngryMoustache\Rambo\Resource\Fields;

use AngryMoustache\Media\Models\Attachment;

class AttachmentField extends LivewireCustomField
{
    public $livewireComponent = 'rambo-fields-attachment-picker';

    public $showComponent = 'rambo::fields.show.attachment';

    public $folder = 'uploads';

    public function getShowValue()
    {
        return Attachment::find($this->getValue());
    }
}
