<?php

namespace AngryMoustache\Rambo\Rambo;

use AngryMoustache\Media\Models\Attachment as ModelsAttachment;
use AngryMoustache\Rambo\Resource\Fields\Button;
use AngryMoustache\Rambo\Resource\Fields\FileSizeField;
use AngryMoustache\Rambo\Resource\Fields\ImageField;
use AngryMoustache\Rambo\Resource\Fields\SelectField;
use AngryMoustache\Rambo\Resource\Fields\TextField;
use AngryMoustache\Rambo\Resource\Filters\FolderFilter;
use AngryMoustache\Rambo\Resource\Resource;

class Attachment extends Resource
{
    public $displayName = 'original_name';

    public $model = 'AngryMoustache\Media\Models\Attachment';

    public $indexView = 'rambo::crud.attachments.index';

    public $indexTableView = 'rambo::components.crud.tables.attachments';

    public $paginate = 18;

    public $defaultSortDir = 'desc';

    public $searchableFields = [
        'original_name',
        'alt_name',
    ];

    public function indexActions()
    {
        return [];
    }

    public function fields()
    {
        return [
            TextField::make('alt_name')
                ->label('Alternative name'),

            TextField::make('extension')
                ->label('File extension')
                ->readonly()
                ->hideFrom(['edit']),

            TextField::make('mime_type')
                ->label('File mime type')
                ->readonly()
                ->hideFrom(['edit']),

            FileSizeField::make('size')
                ->label('File size')
                ->readonly()
                ->hideFrom(['edit']),

            TextField::make('width')
                ->label('File width')
                ->readonly()
                ->hideFrom(['edit']),

            TextField::make('height')
                ->label('File height')
                ->readonly()
                ->hideFrom(['edit']),

            TextField::make('folder_location'),

            ImageField::make('id')
                ->label('Image')
                ->hideFrom(['edit']),

            Button::make('submit'),
        ];
    }

    public function filters()
    {
        return [
            FolderFilter::class,
        ];
    }

    public function routeAfterEdit($item)
    {
        return $this->index();
    }
}
