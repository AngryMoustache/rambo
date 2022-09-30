<div>
    @if ($filter->canBeShown())
        <div class="modal-card-content-header">
            <input
                type="checkbox"
                id="{{ $filter->getLabel() }}"
                wire:model="enabled"
            >

            <label for="{{ $filter->getLabel() }}">
                {{ $filter->getLabel() }}
            </label>
        </div>

        @if ($enabled)
            @foreach ($filter->filterFields() as $field)
                <x-rambo::crud.fields.form
                    :resource="$resource"
                    :field="$field"
                />
            @endforeach
        @endif
    @endif
</div>
