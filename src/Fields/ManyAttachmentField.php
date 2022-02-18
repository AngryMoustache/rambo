<?php

namespace AngryMoustache\Rambo\Fields;

use AngryMoustache\Media\Models\Attachment;

class ManyAttachmentField extends Field
{
    public $bladeShowComponent = 'rambo::livewire.fields.show.many-attachment';
    public $livewireFormComponent = 'rambo-form-many-attachment-field';

    public $folder = 'uploads';

    public $hasManyRelation = true;

    public function getValue()
    {
        $value = parent::getValue();
        if (! $value) {
            return [];
        }

        return parent::getValue()->pluck('id')->toArray();
    }

    public function getShowValue()
    {
        return Attachment::whereIn('id', $this->getValue())->get();
    }
}
