<?php

namespace AngryMoustache\Rambo\Http\Livewire;

use AngryMoustache\Rambo\Enums\ToastType;
use Livewire\Component;

class RamboComponent extends Component
{
    public $layout = 'rambo::layouts.admin';
    protected $componentData = [];

    public function booted()
    {
        //
    }

    public function addComponentData($values)
    {
        $this->componentData = array_merge($values, $this->componentData);
    }

    public function getComponentData()
    {
        return $this->componentData;
    }

    public function render()
    {
        return view($this->component, $this->getComponentData())
            ->extends($this->layout);
    }

    public function toast($message, $type = null)
    {
        $this->dispatchBrowserEvent('rambo-toast', [
            'message' => $message,
            'type' => $type ?? ToastType::OK,
        ]);
    }

    public function toastOk($message)
    {
        $this->toast($message, ToastType::OK);
    }

    public function toastWarning($message)
    {
        $this->toast($message, ToastType::WARNING);
    }

    public function toastError($message)
    {
        $this->toast($message, ToastType::WARNING);
    }
}
