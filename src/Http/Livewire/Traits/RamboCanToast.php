<?php

namespace AngryMoustache\Rambo\Http\Livewire\Traits;

use AngryMoustache\Rambo\Enums\ToastType;

trait RamboCanToast
{
    /** Normal toasting */

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

    /** Toast in session (for redirects) */

    public function sessionToast($message, ToastType $type = null)
    {
        $toasts = session()->pull('rambo-toasts', []);
        $toasts[] = [
            'message' => $message,
            'type' => $type ?? ToastType::OK,
            'show' => true,
        ];

        session()->flash('rambo-toasts', $toasts);
    }

    public function sessionToastOk($message)
    {
        $this->sessionToast($message, ToastType::OK);
    }

    public function sessionToastWarning($message)
    {
        $this->sessionToast($message, ToastType::WARNING);
    }

    public function sessionToastError($message)
    {
        $this->sessionToast($message, ToastType::ERROR);
    }
}
