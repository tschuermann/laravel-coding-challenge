<!-- resources/views/components/layouts/app/sidebar.blade.php -->
<!DOCTYPE html>
<html lang="de" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <title>Challenge App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-white min-h-screen">
    <div class="w-auto mb-5 sticky top-0 z-50">
        <div class="bg-custom-green py-3 px-4 md:px-16">
            <nav x-data="{ open: false }" class="max-w-4xl mx-auto my-2">
                <div class="flex items-center justify-between">
                    <a href="{{ route('home') }}">
                        <h1 class="font-silkscreen -top-1 relative tracking-wide text-4xl text-stone-100">
                            Post
                        </h1>
                    </a>
                    <button @click="open = !open"
                            class="md:hidden text-stone-100 focus:outline-none">
                        <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                    <div class="hidden md:flex space-x-6 w-full">
                        <a href="{{ route('home') }}" class="font-roboto text-lg my-auto mx-10 px-2 text-stone-100">Verfassen</a>
                        <a href="{{ route('challenges.all') }}" class="font-roboto text-lg my-auto px-2 text-stone-100">Übersicht</a>
                        @guest
                            <a href="{{ route('auth.login') }}" class="font-roboto text-lg my-auto inline-flex items-center px-3 py-2 ml-auto rounded-full text-center text-zinc-800 bg-yellow w-max hover:bg-yellow-300">Login</a>
                        @endguest
                        @auth
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="font-roboto text-lg my-auto inline-flex items-center px-3 py-2 ml-auto rounded-full text-center text-zinc-800 bg-yellow w-max hover:bg-yellow-300">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="hidden">
                                @csrf
                            </form>
                        @endauth
                    </div>
                </div>
                <div x-show="open" class="md:hidden flex flex-col mt-4 space-y-2">
                    <a href="{{ route('home') }}" class="font-roboto text-lg px-2 py-1 text-stone-100 bg-custom-green">Verfassen</a>
                    <a href="{{ route('challenges.all') }}" class="font-roboto text-lg px-2 py-1 text-stone-100 bg-custom-green">Übersicht</a>
                    @guest
                        <a href="{{ route('auth.login') }}" class="font-roboto text-lg inline-flex items-center px-3 py-2 rounded-full text-center text-zinc-800 bg-yellow w-max hover:bg-yellow-300">Login</a>
                    @endguest
                    @auth
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="font-roboto text-lg my-auto inline-flex items-center px-3 py-2 ml-auto rounded-full text-center text-zinc-800 bg-yellow w-max hover:bg-yellow-300">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="hidden">
                            @csrf
                        </form>
                    @endauth
                </div>
            </nav>
        </div>
    </div>
    <main class="max-w-4xl mx-auto p-4">
        {{ $slot }}
    </main>
    <div x-data="{ show: false }"
        x-init="window.addEventListener('scroll', () => { show = window.scrollY > 200 })"
        class="fixed bottom-6 right-6 z-50">
        <button
            x-show="show"
            x-transition
            @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
            class="bg-yellow hover:bg-yellow-300 text-zinc-800 rounded-full p-4 shadow-lg focus:outline-none"
            title="Nach oben scrollen"
            aria-label="Nach oben scrollen"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
            </svg>
        </button>
    </div>
    <div class="bg-custom-green h-20 w-full mt-10">

    </div>
    @livewireScripts
</body>
</html>
