# Fields

In this page you will find all the fields that you can use in your resources.

* [General notes and information](#important-notes)
  * [Custom component](#custom-component)
  * [Custom Livewire field](#custom-livewire-field)
  * [Adding a field](#adding-field)
  * [Label](#label)
  * [Hiding fields](#hiding-fields)
  * [Sortable](#sortable)
  * [Validation](#validation)
  * [Default values](#defaults)
  * [Custom component](#custom-component)
  * [Specific blade variables](#specific-variables)
* [Attachment](#attachment)
* [Attachment (Many)](#attachment-many)
* [Boolean](#boolean)
* [Button](#button)
* [Editor](#editor)
* [HABTM](#habtm)
* [Has Many](#has-many)
* [Password](#password)
* [Select](#select)
* [Tab Group](#tab-group)
* [Textarea](#textarea)
* [Text](#text)
* [Youtube](#youtube)


## <a name="important-notes"></a>General Information

### <a name="adding-field"></a>Adding a field

When adding a field, you should be aware that the first argument you pass in the `::make()` function is _always_ the field name in the database. This value will be used when saving your data.

```php
AttachmentField::make('image_id')
```

### <a name="label"></a>Label

If you want your label in the CMS to be prettier, you can call the `->label($label)` method.

```php
AttachmentField::make('image_id')
    ->label('Image')
```

### <a name="sortable"></a>Sortable

If you want your column to be sortable, you can add `->sortable()` to the field.

```php
TextField::make('title')
    ->sortable()
```

### <a name="hiding-fields"></a>Hiding fields

You can hide you fields from certain views using `->hideFrom([])`.
```php
TextField::make('title')
    ->hideFrom(['index', 'show', 'edit', 'create'])
```

### <a name="validation"></a>Validation

You can also pass along rules, just like you would anywhere else in Laravel:

```php
TextField::make('title')
    ->rules('required_if:fields.contact_info,true')
```

```php
TextField::make('amount')
    ->rules(['required_if:fields.contact_info,true', 'number'])
```

### <a name="defaults"></a>Default values

You can define a default value for your field by calling the `default` method.

```php
TextField::make('name')
    ->default('Clark Kent')
```

### <a name="custom-component"></a>Custom component

If you want full control of your blade file, you can call a different blade file like so:

```php
TextField::make('title')
    ->component('components.fields.custom_field')
```

If you want to change the "show component" (the blade component that is used to display the data in the show/index pages), you can use the `->showComponent($component)` method.

### <a name="custom-livewire-field"></a>Custom Livewire component

You can make custom fields that utilize a Livewire component, if this is the case, extend the `LivewireComponentField` instead of the normal `Field`, and pass it a `$livewireComponent` to load.

```php
namespace App\Rambo\Fields;

use AngryMoustache\Rambo\Resource\Fields\LivewireComponentField;

class CustomLivewireField extends LivewireComponentField
{
    public $livewireComponent = 'rambo-fields-attachment-picker';
}
```

### <a name="specific-variables"></a>Specific blade variables

Should you, for whatever reason, require a specific variable for a field, you can pass along anything you like.

```php
TextField::make('name')
    ->superman('Clark Kent')
```

You can then call this data in the blade file:

```php
{{ $field->superman }}
```


## <a name="attachment"></a>Attachment
This field will use the `angry-moustache/media` package and create a useful modal to select or upload attachments.

```php
AttachmentField::make('image_id'),
```

You can define the folder that you want it to be saved using the `->folder($folder)` method.
This "folder" is only used in the index page of the attachments resource.
The folder uses dot notation for parent/child "directories".

```php
AttachmentField::make('image_id')
    ->folder('uploads.avatars'),
```

## <a name="attachment-many"></a>Attachment (Many)
You can add and sort multiple attachments in this field.
It uses the same methods that you can use on the `AttachmentField`.
The first parameter in this field is the relation name that stores the attachments.

```php
ManyAttachmentField::make('images'),
```

## <a name="boolean"></a>Boolean
A simple boolean field.

```php
BooleanField::make('online'),
```

## <a name="button"></a>Button
Adds the "Submit" button to the form.
TODO: add "action" method to this, so that you can define custom actions to buttons.

## <a name="editor"></a>Editor
A WYSIWYG (ProseMirror) field, can be used to add/edit HTML content.

```php
EditorField::make('description'),
```

## <a name="habtm"></a>HABTM
A field that represents a HABTM relation.
The first parameter in this field is the relation name.
You always need to pass a resource, to tell the field what you are relating with.

```php
HabtmField::make('tags')
    ->resource(\App\Rambo\Tag::class),
```

## <a name="has-many"></a>Has Many
A field that represents a Has Many relation.
The first parameter in this field is the relation name.
You always need to pass a resource, to tell the field what you are relating with.

```php
HasMany::make('tags')
    ->resource(\App\Rambo\Tag::class),
```

This field will only be shown on the `show` view of a resource.

## <a name="password"></a>Password
A password field, if left empty, nothing will be saved/overwritten.

```php
PasswordField::make('password'),
```

## <a name="select"></a>Select
A select dropdown, you will need to pass an array in the `options` method.

```php
SelectField::make('amount')
    ->options([
        0 => 'zero',
        5 => 'five',
        10 => 'ten',
    ]),
```

## <a name="tab-group"></a>Tab Group
This will group fields into a tab group. this is useful for if you have many fields and don't want to clutter the page.

```php
TabGroup::make()->tabs([
    // Tab titles
    'general' => 'General',
    'media' => 'Media',
])->fields([
    // Tab fields
    'general' => [
        TextField::make('name'),

        PageArchitect::make('description'),
    ],
    'media' => [
        AttachmentField::make('attachment_id'),

        ManyAttachmentField::make('variants'),
    ],
]),

```

## <a name="textarea"></a>Textarea
A simple textarea field.

```php
TextareaField::make('intro'),
```

## <a name="text"></a>Text
A simple text field.

```php
TextField::make('title'),
```

## <a name="youtube"></a>Youtube
This field will parse a Youtube link, and save the Youtube ID in the database.

```php
YoutubeField::make('title'),
```
