<?php

namespace AngryMoustache\Rambo\Resource\Fields;

class FileSizeField extends Field
{
    public function getShowValue()
    {
        $value = parent::getShowValue();
        return number_format($value / (1 << 20), 2) . ' MB';
    }
}
