<?php

namespace AngryMoustache\Rambo\Resource\Fields;

use AngryMoustache\Rambo\Rambo\Attachment;

class ManyAttachmentField extends HabtmField
{
    public $livewireComponent = 'rambo-fields-many-attachment-picker';

    public $showComponent = 'rambo::fields.show.many-attachment';

    public $resource = Attachment::class;

    public $folder = 'uploads';
}
