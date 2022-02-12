<?php

namespace AngryMoustache\Rambo\Http\Livewire\Fields\Form;

use AngryMoustache\Media\Models\Attachment;
use AngryMoustache\Rambo\Http\Livewire\Fields\FormField;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FormCropperField extends FormField
{
    public $component = 'rambo::livewire.fields.form.cropper';

    public $listeners = [
        'cropped' => 'saveCrop',
    ];

    public Attachment $item;

    public $formats;

    public $current = null;

    public function mount($field = null, $item = null, $rules = [])
    {
        parent::mount($field, $item, $rules);
        $this->formats = config('media.cropper.formats', []);
    }

    public function updatedCurrent()
    {
        // Don't check if the method exists, to make sure we always add it
        $options = $this->current::cropperOptions();
        $initial = ($this->item->crops ?? [])[$this->formatName()] ?? [];
        $this->dispatchBrowserEvent('load-cropper', compact('options', 'initial'));
    }

    public function saveCrop($event)
    {
        $crop = $event['crop'];
        $data = $event['data'];

        $format = $this->formatName();
        $url = $this->item->id . '/' . ($format ? $format . '-' : '') . $this->item->original_name;

        // Save the crop in the storage
        $crop = preg_replace('/data:image\/(.*?);base64,/' ,'', $crop);
        $crop = str_replace(' ', '+', $crop);
        Storage::disk($this->item->disk)->put($url, base64_decode($crop));

        // Save the crop on the attachment, for later adjustments
        $crops = $this->item->crops ?? [];
        $crops[$format] = $data;
        $this->item->crops = $crops;
        $this->item->save();

        // Toast!
        $this->toastOk("Cropped ${format} successfully!");
    }

    private function formatName()
    {
        return lcfirst(Str::afterLast($this->current, '\\'));
    }
}
