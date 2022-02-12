<?php

namespace AngryMoustache\Rambo\Http\Livewire\Pickers;

use AngryMoustache\Media\Models\Attachment;
use AngryMoustache\Rambo\Fields\Field;
use AngryMoustache\Rambo\Http\Livewire\RamboComponent;
use Illuminate\Database\Eloquent\Collection;

class ManyAttachmentPicker extends RamboComponent
{
    public $value;
    public Field $field;
    public ?Attachment $cropping;

    public $component = 'rambo::livewire.pickers.many-attachment-picker';

    protected $listeners = [
        'picker:update' => 'addAttachment',
    ];

    public function getComponentData()
    {
        return array_merge([
            'attachments' => collect($this->value)->map(fn ($id) => Attachment::find($id)),
        ], parent::getComponentData());
    }

    public function addAttachment($value, Field $field)
    {
        $this->value[] = $value;
        $this->emitValue();
    }

    public function removeAttachment($index)
    {
        unset($this->value[$index]);
        $this->emitValue();
    }

    public function sortAttachments($attachments)
    {
        $value = $this->value;
        $this->value = [];

        foreach ($attachments as $attachment) {
            $this->value[] = $value[$attachment['value']];
        }

        $this->emitValue();
    }

    public function emitValue()
    {
        $this->emitUp(
            'changed-value',
            $this->value,
            $this->field->toLivewire()
        );
    }

    public function openCropper($index)
    {
        $this->cropping = Attachment::find($this->value[$index]);
    }

    public function closeModal()
    {
        $this->cropping = null;
    }
}
