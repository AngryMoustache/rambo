<?php

namespace AngryMoustache\Rambo\Http\Livewire;

use AngryMoustache\Media\Models\Attachment;
use AngryMoustache\Rambo\Http\Livewire\RamboComponent;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Cropper extends RamboComponent
{
    public $component = 'rambo::livewire.cropper';
    public $formats = [];
    public Attachment $attachment;

    public $current = null;

    public $listeners = [
        'cropped' => 'saveCrop',
    ];

    public function mount()
    {
        $this->formats = config('media.cropper.formats', []);
    }

    public function updatedCurrent()
    {
        if (! empty($this->current)) {
            // Don't check if the method exists, to make sure we always add it
            $options = $this->current::cropperOptions();
            $initial = ($this->attachment->crops ?? [])[$this->formatName()] ?? [];
            $this->dispatchBrowserEvent(
                'load-cropper',
                compact('options', 'initial')
            );
        }
    }

    public function saveCrop($event)
    {
        $crop = $event['crop'];
        $data = $event['data'];

        $format = $this->formatName();
        $url = $this->attachment->id . '/' . ($format ? $format . '-' : '') . $this->attachment->original_name;

        // Save the crop in the storage
        $crop = preg_replace('/data:image\/(.*?);base64,/' ,'', $crop);
        $crop = str_replace(' ', '+', $crop);
        Storage::disk($this->attachment->disk)->put($url, base64_decode($crop));

        // Save the crop on the attachment, for later adjustments
        $crops = $this->attachment->crops ?? [];
        $crops[$format] = $data;
        $this->attachment->crops = $crops;
        $this->attachment->save();

        // Toast!
        $this->toastOk("Cropped ${format} successfully!");
        $this->current = null;
    }

    private function formatName()
    {
        return lcfirst(Str::afterLast($this->current, '\\'));
    }
}
