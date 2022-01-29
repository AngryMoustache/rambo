<?php

namespace AngryMoustache\Rambo\Http\Livewire;

use AngryMoustache\Media\Models\Attachment;
use AngryMoustache\Rambo\Fields\Field;

class AttachmentPicker extends RamboComponent
{
    public $component = 'rambo::livewire.media.attachment-picker';

    public Field $field;

    public $value;

    public function mount()
    {
        parent::mount();
        $this->value = Attachment::find($this->value);
    }

    public function clearSelection()
    {
        $this->value = null;
        $this->emitUp('changed-value', $this->value, $this->field->toLivewire());
    }

    private function createAttachmentFromUpload($file = null)
    {
        $file ??= $this->upload;
        $attachment = Attachment::livewireUpload($file);
        return $attachment;
    }
}
