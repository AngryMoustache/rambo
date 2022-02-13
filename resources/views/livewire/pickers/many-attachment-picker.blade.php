<div>
    <div class="attachment-picker attachment-picker-many" wire:sortable="sortAttachments">
        @foreach ($attachments as $key => $attachment)
            <div
                class="attachment-picker-selection"
                style="background-image: url('{{ $attachment->format('thumb') }}')"
                wire:key="attachment-{{ $key }}"
                wire:sortable.item="{{ $key }}"
            >
                <i
                    wire:click="removeAttachment({{ $key }})"
                    class="button fa fa-trash"
                ></i>

                <i
                    class="button fas fa-arrows-alt"
                    style="cursor: all-scroll;"
                    wire:sortable.handle
                ></i>

                @if (Rambo::cropperEnabled())
                    <i
                        class="button fas fa-crop"
                        wire:click="openCropper({{ $key }})"
                    ></i>
                @endif
            </div>
        @endforeach
    </div>

    <livewire:rambo-attachment-picker
        :field="$field"
        clear-on-update="true"
        emit="picker:update"
    />

    @if ($cropping)
        <div wire:key="cropper-{{ $cropping->id }}">
            <x-rambo::modals.attachment-picker.cropping
                :attachment="$cropping"
            />
        </div>
    @endif
</div>
