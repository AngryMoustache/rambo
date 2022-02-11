<?php

namespace AngryMoustache\Rambo\Fields;

class FileSizeField extends Field
{
    private $units = ['B', 'kB', 'MB', 'GB'];

    public function getShowValue()
    {
        $value = parent::getShowValue();

        $i = 0;
        while (($value / 1024) > 0.9) {
            $value = $value / 1024;
            $i++;
        }

        return round($value, 2) . ' ' . $this->units[$i];
    }
}
