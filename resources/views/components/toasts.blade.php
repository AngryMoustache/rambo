<div
    class="rambo-toasts"
    x-data="ramboToasts()"
    x-init="init"
>
    <template x-for="(toast, key) in toasts" :key="key">
        <div
            class="rambo-toasts-toast"
            :class="{
                'rambo-toasts-toast-leave': (! toast.show),
                [toast.type]: true
            }"
        >
            <span x-text="toast.message"></span>
        </div>
    </template>
</div>

<script>
    function ramboToasts () {
        return {
            toasts: [],
            showTime: 3000,
            init () {
                // Flashed toasts
                this.toasts = @json(session()->pull('rambo-toasts', []))

                for (let i = 0; i < this.toasts.length; i++) {
                    console.log(i)
                    window.setTimeout(() => {
                        this.toasts[i].show = false
                    }, this.showTime)
                }

                // On-page toasts
                window.addEventListener('rambo-toast', (e) => {
                    let id = this.toasts.length
                    this.toasts[id] = {
                        message: e.detail.message,
                        type: e.detail.type,
                        show: true,
                    }
                    window.setTimeout(() => {
                        this.toasts[id].show = false
                    }, this.showTime)
                })
            }
        }
    }
</script>
