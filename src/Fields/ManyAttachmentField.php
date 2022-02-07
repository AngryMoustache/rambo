<?php

namespace AngryMoustache\Rambo\Fields;

use AngryMoustache\Media\Models\Attachment;

class ManyAttachmentField extends Field
{
    public $formComponent = 'rambo::livewire.fields.form.many-attachment';
    public $showComponent = 'rambo::livewire.fields.show.many-attachment';

    public $folder = 'uploads';

    public $hasManyRelation = true;

    public function getValue()
    {
        return parent::getValue()->pluck('id')->toArray();
    }

    public function getShowValue()
    {
        return Attachment::whereIn('id', $this->getValue())->get();
    }
}
