<div class="flex justify-start w-full bg-white border-b px-4 py-2">
    <div class="px-3 py-2">
        <a href="/" target="_blank" class="text-xl font-bold">
            {{ config('app.name') }}
        </a>
    </div>

    <div class="ml-auto">
        <div id="js-open-toggle" class="flex m-2 cursor-pointer">
            @if ($avatar = optional(\RamboAuth::user())->avatar)
                <img
                    class="w-8 h-8 rounded-full border"
                    src="{{ $avatar->format('thumb') }}"
                >
            @endif

            <p class="px-4 text-xl">
                {{ optional(\RamboAuth::user())->username }}
                <i class="fas fa-chevron-down pl-1 text-base"></i>
            </p>

            {{-- Dropdown --}}
            <div
                id="js-dropdown"
                class="hidden right-5 pt-12 w-48"
            >
                <div class="flex flex-wrap w-full bg-white rounded-lg shadow-xl border overflow-hidden">
                    <x-rambo::header-button link="/admin/administrators/{{ \RamboAuth::user()->id }}">
                        <i class="fas fa-user mr-1"></i>
                        User
                    </x-rambo::header-button>

                    <x-rambo::header-button link="/admin/logout">
                        <i class="fas fa-sign-out-alt mr-1"></i>
                        Logout
                    </x-rambo::header-button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var openToggle = document.getElementById('js-open-toggle')
    var dropdown = document.getElementById('js-dropdown')

    openToggle.addEventListener('mouseenter', function () {
        dropdown.classList.remove('hidden')
        dropdown.classList.add('absolute')
    })

    openToggle.addEventListener('mouseleave', function () {
        dropdown.classList.add('hidden')
        dropdown.classList.remove('absolute')
    })
</script>
