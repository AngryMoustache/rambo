<?php

namespace AngryMoustache\Rambo\Http\Livewire;

use AngryMoustache\Media\Models\Attachment;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class AttachmentPicker extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $item = null;
    public $picked = null;
    public $name = null;
    public $selecting = false;
    public $uploading = false;
    public $search = '';
    public $upload;
    public $emit;
    public $compact = false;
    public $page = 1;

    public function mount(
        $field = null,
        $name = null,
        $emit = 'field:update',
        $item = null
    ) {
        $this->name = $name;
        $this->emit = $emit;
        $this->item = $item;

        if ($field) {
            $this->name = $field->getName();
            $this->item = optional($field->getValue())->id;
        }
    }

    public function openSelectingModal()
    {
        $this->selecting = true;
    }

    public function openUploadingModal()
    {
        $this->uploading = true;
    }

    public function closeModal()
    {
        $this->selecting = false;
        $this->uploading = false;
    }

    public function chooseAttachment($attachment)
    {
        $this->item = $attachment;
        $this->picked = $attachment;
        $this->closeModal();
        $this->emit($this->emit, $attachment, $this->name);
    }

    public function uploadFile()
    {
        $attachment = Attachment::livewireUpload($this->upload);
        if (optional($attachment)->id) {
            $this->chooseAttachment($attachment->id);
        }
    }

    public function resetImage()
    {
        $this->item = null;
        $this->picked = null;
        $this->chooseAttachment(null);
    }

    public function render()
    {
        if ($this->item) {
            $item = Attachment::find($this->item);
            if ($item) {
                $this->item = $item->format('thumb');
            }
        }

        if ($this->selecting) {
            $attachments = Attachment::where('alt_name', 'LIKE', "%{$this->search}%")
                ->orWhere('original_name', 'LIKE', "%{$this->search}%")
                ->paginate(15);

            return view('rambo::livewire.attachment-picker', [
                'attachments' => $attachments
            ]);
        }

        return view('rambo::livewire.attachment-picker');
    }

    public function nextPage()
    {
        $this->page++;
    }

    public function previousPage()
    {
        $this->page--;
    }

    public function gotoPage($page)
    {
        $this->page = $page;
    }

    public function getQueryString()
    {
        return $this->queryString;
    }
}
