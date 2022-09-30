<div class="crud-form-field-tab-group" x-data="{ open: false }">
    <div class="crud-form-field-tab-group-content">
        <ul
            class="crud-form-field-tab-group-content-tabs"
            x-on:click="open = ! open"
        >
            <li>
                {{ $field->getLabel() }}
            </li>
        </ul>

        <table
            class="w-100"
            x-show="open"
            style="display: none;"
        >
            @foreach ($field->getFields() as $_field)
                @include($_field->getShowWrapperComponent(), [
                    'field' => $_field,
                ])
            @endforeach
        </table>
    </div>
</div>
