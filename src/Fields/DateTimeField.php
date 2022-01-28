<?php

namespace AngryMoustache\Rambo\Fields;

/**
 * @method object humanReadable(boolean $humanReadable = true)
 */
class DateTimeField extends Field
{
    public $format = 'd M Y h:i:s';

    public $humanReadable = false;

    public function getShowValue()
    {
        $value = optional($this->getValue());

        if ($this->humanReadable) {
            return $value->diffForHumans();
        }

        return $value->format($this->format);
    }
}
