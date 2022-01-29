<?php

namespace AngryMoustache\Rambo\Fields;

/**
 * @method $this format(string $format = 'd M Y h:i:s') Formats the date on overview/detail pages
 * @method $this humanReadable(boolean $humanReadable = true) Makes the date more human readable on overview/detail pages
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

        return $value->format($this->getFormat());
    }
}
