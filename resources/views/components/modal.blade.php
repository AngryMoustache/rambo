<div class="modal">
    <div class="modal-card no-padding">
        @isset($title)
            <div {{ $title->attributes->merge(['class' => 'modal-card-title']) }}>
                <h4>{{ $title }}</h4>
            </div>
        @endisset

        @isset($subtitle)
            <div {{ $subtitle->attributes->merge(['class' => 'modal-card-subtitle']) }}>
                {{ $subtitle }}
            </div>
        @endisset

        @isset($content)
            <div {{ $content->attributes->merge(['class' => 'modal-card-content']) }}>
                {{ $content }}
            </div>
        @endisset

        @if (! isset($loader))
            <div wire:loading class="modal-card-content">
                <x-rambo::loading />
            </div>
        @endisset

        @isset($preFooter)
            {{ $preFooter }}
        @endisset

        @isset($footer)
            <div {{ $footer->attributes->merge(['class' => 'modal-card-footer']) }}>
                {{ $footer }}
            </div>
        @endisset
    </div>
</div>
