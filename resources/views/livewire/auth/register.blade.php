<div class="flex flex-col gap-6">
    <x-auth-header title="アカウントを作成する" description="アカウントを作成するには、以下の詳細を入力してください" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="register" class="flex flex-col gap-6">
        <!-- Name -->
        <flux:input
            wire:model="name"
            id="name"
            :label="__('Name')"
            type="text"
            name="name"
            required
            autofocus
            autocomplete="name"
            placeholder="フルネーム"
        />

        <!-- Email Address -->
        <flux:input
            wire:model="email"
            id="email"
            :label="__('Email address')"
            type="email"
            name="email"
            required
            autocomplete="email"
            placeholder="test@test.com"
        />

        <!-- Password -->
        <flux:input
            wire:model="password"
            id="password"
            :label="__('Password')"
            type="password"
            name="password"
            required
            autocomplete="new-password"
            placeholder="パスワード"
        />

        <!-- Confirm Password -->
        <flux:input
            wire:model="password_confirmation"
            id="password_confirmation"
            :label="__('Confirm password')"
            type="password"
            name="password_confirmation"
            required
            autocomplete="new-password"
            placeholder="確認用パスワード"
        />

        <div class="flex items-center justify-end">
            <flux:button type="submit" variant="primary" class="w-full">
                {{ __('Create account') }}
            </flux:button>
        </div>
    </form>

    <div class="space-x-1 text-center text-sm text-zinc-600 dark:text-zinc-400">
        Already have an account?
        <flux:link :href="route('login')" wire:navigate>Log in</flux:link>
    </div>
</div>
