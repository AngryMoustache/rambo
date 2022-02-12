<div class="modal">
    <div class="modal-card no-padding">
        @isset($title)
            <div class="modal-card-title">
                <h4>{{ $title }}</h4>
            </div>
        @endisset

        @isset($subtitle)
            <div class="modal-card-subtitle">
                {{ $subtitle }}
            </div>
        @endisset

        @isset($content)
            <div
                wire:loading.remove
                @class([
                    'modal-card-content' => ! isset($fixed),
                    'modal-card-content-fixed' => isset($fixed) && $fixed,
                ])
            >
                {{ $content }}
            </div>
        @endisset

        <div wire:loading class="modal-card-content">
            <x-rambo::loading />
        </div>

        @isset($preFooter)
            {{ $preFooter }}
        @endisset

        @isset($footer)
            <div class="modal-card-footer" wire:loading.remove>
                {{ $footer }}
            </div>
        @endisset
    </div>
</div>
