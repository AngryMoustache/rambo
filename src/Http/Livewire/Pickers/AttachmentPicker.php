<?php

namespace AngryMoustache\Rambo\Http\Livewire\Pickers;

use AngryMoustache\Media\Models\Attachment;
use AngryMoustache\Rambo\Fields\Field;
use AngryMoustache\Rambo\Http\Livewire\RamboComponent;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class AttachmentPicker extends RamboComponent
{
    use WithFileUploads;
    use WithPagination;

    public Field $field;

    public $component = 'rambo::livewire.pickers.attachment-picker';

    public $value;

    public $emit = 'changed-value';

    public $clearOnUpdate = false;

    public $search;

    public $uploadedFile;

    // Modals
    public $selecting = false;
    public $uploading = false;

    public function mount()
    {
        parent::mount();
        $this->value = Attachment::find($this->value);
    }

    public function clearSelection()
    {
        $this->updateAttachment(null);
    }

    public function updateAttachment($id)
    {
        $this->value = Attachment::find($id);
        $this->emitUp($this->emit, $id, $this->field->toLivewire());
        $this->closeModal();

        if ($this->clearOnUpdate) {
            $this->value = null;
        }
    }

    public function openSelectModal()
    {
        $this->selecting = true;
    }

    public function openUploadModal()
    {
        $this->uploading = true;
    }

    public function closeModal()
    {
        $this->selecting = false;
        $this->uploading = false;
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function getComponentData()
    {
        $attachments = collect();

        if ($this->selecting) {
            $attachments = Attachment::where('alt_name', 'LIKE', "%{$this->search}%")
                ->orWhere('original_name', 'LIKE', "%{$this->search}%")
                ->orderBy('created_at', 'desc')
                ->paginate(15);
        }

        return array_merge([
            'attachments' => $attachments,
        ], parent::getComponentData());
    }

    public function uploadImage()
    {
        $attachment = $this->createAttachmentFromUpload();
        $this->updateAttachment($attachment);
        $this->uploadedFile = null;
    }

    private function createAttachmentFromUpload($file = null)
    {
        $file ??= $this->uploadedFile;
        $attachment = Attachment::livewireUpload($file);
        return $attachment->id;
    }
}
