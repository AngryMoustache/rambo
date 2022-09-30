@if ($items->isEmpty())
    <div class="crud-index-search">
        <p>No <strong>{{ $resource->label() }}</strong> found using the current filters.</p>
    </div>
@endif

@if ($items->isNotEmpty())
    <div class="crud-index-attachments-container">
        <div class="crud-index-attachments">
            @foreach ($items as $item)
                <div class="crud-index-attachments-item">
                    <div
                        class="crud-index-attachments-item-image"
                        style="background-image: url('{{ $item->format('thumb') }}')"
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
@endif

@if ($items->hasPages())
    <div class="pagination">
        {{ $items->withQueryString()->links('rambo::components.crud.tables.pagination') }}
    </div>
@endif
