<?php

namespace AngryMoustache\Rambo\Fields;

use Carbon\Carbon;

/**
 * @method $this format(string $format = 'd M Y h:i:s') Formats the date on overview/detail pages
 * @method $this humanReadable(boolean $humanReadable = true) Makes the date more human readable on overview/detail pages
 */
class DateTimeField extends Field
{
    public $format = 'd M Y h:i:s';
    public $formFormat = 'Y-m-d\TH:i';

    public $humanReadable = false;

    public $type = 'datetime-local';

    public function beforeSave($value, $fields, $id)
    {
        return (string) new Carbon($value);
    }

    public function getValue()
    {
        $value = parent::getValue();
        if (! $value instanceof Carbon) {
            $value = new Carbon($value);
        }

        return optional($value)->format($this->getFormFormat());
    }

    public function getShowValue()
    {
        $value = new Carbon($this->getValue());
        if ($value && $this->isHumanReadable()) {
            return $value->diffForHumans();
        }

        return optional($value)->format($this->getFormat());
    }
}
