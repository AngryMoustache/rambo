<div class="crud-form-field-tab-group" x-data="{ open: true }">
    <div class="crud-form-field-tab-group-content">
        <ul
            class="crud-form-field-tab-group-content-tabs"
            x-on:click="open = ! open"
        >
            <li>
                {{ $field->getLabel() }}
            </li>
        </ul>

        <div class="crud-form-field-tab-group-content-fields" x-show="open">
            @foreach ($field->getFields() as $_field)
                <x-rambo::crud.fields.form
                    :resource="$resource"
                    :field="$_field"
                    :item="$field->item"
                />
            @endforeach
        </div>
    </div>
</div>
