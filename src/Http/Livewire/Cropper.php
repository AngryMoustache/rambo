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
    public $hash;

    public $listeners = [
        'cropped' => 'saveCrop',
    ];

    public function mount()
    {
        $this->formats = config('media.cropper.formats', []);
        $this->hash = md5(rand(1000, 9999));
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
        $saveAsNew = $event['saveAsNew'];

        if ($saveAsNew) {
            $attachment = Attachment::firstOrCreate([
                'original_name' => $this->attachment->original_name,
                'alt_name' => $this->attachment->alt_name . ' - ' . rand(10000, 99999),
                'mime_type' => $this->attachment->mime_type,
                'extension' => $this->attachment->extension,
                'disk' => config('media.default-disk', 'public'),
            ]);

            Storage::putFileAs(
                "public/attachments/{$attachment->id}/",
                $crop,
                $this->attachment->original_name
            );

            $path = "public/attachments/{$attachment->id}/{$attachment->original_name}";
            $sizes = getimagesize(Storage::path($path));
            $attachment->size = Storage::size($path);
            $attachment->width = $sizes[0];
            $attachment->height = $sizes[1];
            $attachment->save();

            $this->toastOk("Cropped successfully and saved as a new attachment ({$attachment->id})!");
            $this->current = null;
            return;
        }

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
