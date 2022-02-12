<div class="crud-index-attachments-container">
    <div class="crud-index-attachments">
        @foreach ($items as $item)
            <div class="crud-index-attachments-item">
                <div
                    class="crud-index-attachments-item-image"
                    style="background-image: url('{{ $item->format('thumb') }}?rand={{ rand(0, 1000) }}')"
                ></div>

                <div class="crud-index-attachments-item-actions">
                    @foreach ($resource->actions('table') as $key =>  $action)
                        <livewire:is
                            :key="$key . '_' . $item->id"
                            :component="$action->getLivewireComponent()"
                            :resource="$resource->item($item)"
                            :action="$action"
                            :item="$item"
                            :no-redirect="true"
                        />
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>
