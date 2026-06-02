<nav class="border-b border-border px-6">
    <div class="max-w-7x1 mx-auto h-16 flex items-center justify-between">
        <div class="flex items-center font-bold">
                <x-icons.idea-logo/>
                <a href="/">Ideas</a>
        </div>
        @guest

        <div class="flex gap-3 justify-center items-center">
            <a href="/login" class="flex h-10 items-center font-bold px-4">
                Login
            </a>
            <a href="/register" class="btn flex h-10 items-center font-bold px-4">
                Create Account
            </a>
        </div>
        @endguest

        @auth
            <form action="/logout" method="post">
                <button type="submit" class="btn flex h-10 items-center font-bold px-4">Log Out</button>
            </form>
        @endauth
    </div>
</nav>
