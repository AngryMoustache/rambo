<tr>
    @php $showLabel = $field->getHideLabelOnShow() @endphp
    @if (! $showLabel)
        <td class="crud-show-table-label">
            <span>
                {{ $field->getLabel() }}
            </span>
        </td>
    @endif

    <td
        class="crud-show-table-value"
        @if ($showLabel) colspan="2" @endif
    >
        <x-rambo::crud.fields.show
            :resource="$resource"
            :field="$field"
            :item="$item"
        />
    </td>
</tr>
