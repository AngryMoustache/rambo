<div class="card">
    <div class="auth-card-form-logo">
        <x-rambo::logo />
    </div>

    <form
        wire:submit.prevent="attemptLogin"
    >
        <input
            type="text"
            placeholder="E-Mail"
            wire:model="email"
        >

        <input
            type="password"
            placeholder="Password"
            wire:model="password"
        >

        <input
            type="submit"
            value="Login"
        >
    </form>
</div>
