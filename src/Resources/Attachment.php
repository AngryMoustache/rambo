<?php

namespace AngryMoustache\Rambo\Resources;

use AngryMoustache\Media\Models\Attachment as ModelsAttachment;
use AngryMoustache\Rambo\Fields\FileSizeField;
use AngryMoustache\Rambo\Fields\IDField;
use AngryMoustache\Rambo\Fields\ImageField;
use AngryMoustache\Rambo\Fields\TextField;
use AngryMoustache\Rambo\Resource;

class Attachment extends Resource
{
    public $model = ModelsAttachment::class;

    public $indexTableBlade = 'rambo::components.crud.tables.attachments';

    public $paginate = 24;

    public function fields()
    {
        return [
            IDField::make(),

            TextField::make('original_name')
                ->hideFrom(['edit'])
                ->searchable(),

            TextField::make('alt_name')
                ->searchable(),

            TextField::make('extension')
                ->label('File extension')
                ->hideFrom(['edit'])
                ->readonly(),

            TextField::make('mime_type')
                ->label('File mime type')
                ->hideFrom(['edit'])
                ->readonly(),

            FileSizeField::make('size')
                ->label('File size')
                ->readonly()
                ->hideFrom(['edit']),

            TextField::make('width')
                ->label('File width')
                ->hideFrom(['edit'])
                ->readonly(),

            TextField::make('height')
                ->label('File height')
                ->hideFrom(['edit'])
                ->readonly(),

            TextField::make('folder_location'),

            ImageField::make('id')
                ->label('Image')
                ->hideFrom(['edit']),
        ];
    }
}
