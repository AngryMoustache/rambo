<?php

namespace AngryMoustache\Rambo\Http\Livewire\Traits;

use AngryMoustache\Rambo\Enums\ToastType;

trait RamboCanToast
{
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
