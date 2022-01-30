<?php

namespace AngryMoustache\Rambo\Traits;

trait Permissions
{
    public $defaultPermission = true;

    public function can($type)
    {
        $type = ucfirst($type);
        if (method_exists($this, "can{$type}")) {
            return $this->{"can{$type}"}();
        }

        return $this->getDefaultPermission();
    }

    public function getDefaultPermission()
    {
        return $this->defaultPermission;
    }

    public function canIndex()
    {
        return $this->getDefaultPermission();
    }

    public function canEdit()
    {
        return $this->getDefaultPermission();
    }

    public function canShow()
    {
        return $this->getDefaultPermission();
    }

    public function canCreate()
    {
        return $this->getDefaultPermission();
    }

    public function canDelete()
    {
        return $this->getDefaultPermission();
    }
}
