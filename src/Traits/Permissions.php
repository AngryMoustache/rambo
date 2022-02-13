<?php

namespace AngryMoustache\Rambo\Traits;

trait Permissions
{
    public $defaultPermission = true;

    public function getDefaultPermission()
    {
        return $this->defaultPermission;
    }

    public function canViewIndex()
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
