<x-layouts.app.sidebar>
    <h1 class="font-bold text-4xl mb-3">Alle Posts</h1>
    @auth
        <div class="mb-4 flex flex-row gap-5 justify-center text-center">
            <a href="{{ route('challenges.all', ['filter' => 'own']) }}" class="btn cursor-pointer p-1.5 min-w-18 {{ request('filter', 'all') === 'own' ? 'bg-yellow rounded-full' : '' }}">Eigene</a>
            <a href="{{ route('challenges.all', ['filter' => 'public']) }}" class="btn cursor-pointer p-1.5 min-w-18 {{ request('filter', 'all') === 'public' ? 'bg-yellow rounded-full' : '' }}">Öffentliche</a>
            <a href="{{ route('challenges.all', ['filter' => 'all']) }}" class="btn cursor-pointer p-1.5 min-w-18 {{ request('filter', 'all') === 'all' ? 'bg-yellow rounded-full' : '' }}">Alle</a>
        </div>
    @endauth
    <div class="flex flex-col gap-4 min-h-[calc(100vh-300px)]">
        @if($challenges->count())
            <a href="{{ route('challenges.show', $challenges[0]) }}"
            class="rounded-md relative flex flex-col justify-end overflow-hidden w-full max-w-full h-40 md:h-60 bg-cover bg-center"
            style="{{ $challenges[0]->image_path 
                ? "background-image: url('".asset('storage/'.$challenges[0]->image_path)."')" 
                : 'background-color: #e5e7eb;' }}"
            >
                <div class="absolute inset-0 pointer-events-none bg-gradient-to-b from-zinc-800/0 to-zinc-800/60"></div>
                <div class="relative z-10 p-4">
                    <h2 class="font-roboto text-3xl text-stone-100 font-extrabold">{{ $challenges[0]->title }}</h2>
                    <p class="font-roboto text-1xl text-stone-100 line-clamp-2">{{ $challenges[0]->body }}</p>
                </div>
                @auth
                    @if($challenges[0]->user_id === Auth::id())
                    <form action="{{ route('challenges.delete', $challenges[0]) }}" method="POST" class="absolute top-2 right-2 z-20">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="cursor-pointer h-[30px] w-[30px] place-items-center bg-white/70 rounded-full"><?xml version="1.0" ?><svg height="24" viewBox="0 0 16 16" width="24" xmlns="http://www.w3.org/2000/svg"><polygon fill-rule="evenodd" fill="red" points="8 9.414 3.707 13.707 2.293 12.293 6.586 8 2.293 3.707 3.707 2.293 8 6.586 12.293 2.293 13.707 3.707 9.414 8 13.707 12.293 12.293 13.707 8 9.414"/></svg></button>
                    </form>
                    @endif
                @endauth
            </a>
            @if($challenges->count() > 1)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($challenges->slice(1) as $challenge)
                    <a href="{{ route('challenges.show', $challenge) }}"
                    class="rounded-md relative flex flex-col justify-end overflow-hidden w-full h-40 bg-cover bg-center"
                    style="{{ $challenge->image_path 
                        ? "background-image: url('".asset('storage/'.$challenge->image_path)."')" 
                        : 'background-color: #e5e7eb;' }}"
                    >
                        <div class="absolute inset-0 pointer-events-none bg-gradient-to-b from-zinc-800/0 to-zinc-800/60"></div>
                        <div class="relative z-10 p-4 h-full flex flex-col justify-between">
                            @auth
                                @if($challenge->user_id === Auth::id())
                                <form action="{{ route('challenges.delete', $challenge) }}" method="POST" class="self-end z-10">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="cursor-pointer"><?xml version="1.0" ?><svg height="24" viewBox="0 0 16 16" width="24" xmlns="http://www.w3.org/2000/svg"><polygon fill-rule="evenodd" fill="red" points="8 9.414 3.707 13.707 2.293 12.293 6.586 8 2.293 3.707 3.707 2.293 8 6.586 12.293 2.293 13.707 3.707 9.414 8 13.707 12.293 12.293 13.707 8 9.414"/></svg></button>
                                </form>
                                @endif
                            @endauth
                            <div class="mt-auto">
                                <h2 class="font-roboto text-md text-stone-100 font-extrabold">{{ $challenge->title }}</h2>
                                <p class="font-roboto text-stone-100 line-clamp-2">{{ $challenge->body }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            @endif
        @else
            <p>Keine Posts gefunden.</p>
        @endif
    </div>

</x-layouts.app.sidebar>
        