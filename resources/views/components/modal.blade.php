<div class="modal">
    <div class="modal-card no-padding">
        @isset($title)
            <div class="modal-card-title" wire:loading.remove>
                <h4>{{ $title }}</h4>
            </div>
        @endisset

        @isset($content)
            <div class="modal-card-content" wire:loading.remove>
                {{ $content }}
            </div>
        @endisset

        <div wire:loading class="modal-card-content">
            <x-rambo::loading />
        </div>

        @isset($footer)
            <div class="modal-card-footer" wire:loading.remove>
                {{ $footer }}
            </div>
        @endisset
    </div>
</div>
