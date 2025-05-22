<div>
    @guest
        <h1 class="font-bold text-4xl mb-3">Aktuellste</h1>
    @endguest
    @auth
        <h1 class="font-bold text-4xl mb-3">
            @if($filter === 'own')
                Deine Beiträge
            @elseif($filter === 'public')
                Öffentliche Beiträge
            @elseif($filter === 'all')
                Alle Beiträge
            @else
                Aktuellste
            @endif
        </h1>
        <div class="flex flex-row gap-5 justify-center text-center mb-4">
            <button wire:click="$set('filter', 'own')" class="btn cursor-pointer p-1.5 min-w-18 {{ $filter === 'own' ? 'bg-yellow-300 rounded-full' : '' }}">Eigene</button>
            <button wire:click="$set('filter', 'public')" class="btn cursor-pointer p-1.5 min-w-18 {{ $filter === 'public' ? 'bg-yellow-300 rounded-full' : '' }}">Öffentliche</button>
            <button wire:click="$set('filter', 'all')" class="btn cursor-pointer p-1.5 min-w-18 {{ $filter === 'all' ? 'bg-yellow-300 rounded-full' : '' }}">Alle</button>
        </div>
    @endauth
    <div class="flex flex-col gap-4">
        @if($challenges->count())
            <a href="{{ route('challenges.show', $challenges[0]) }}"
            class="relative flex flex-col justify-end overflow-hidden w-full max-w-full h-60 bg-cover bg-center"
            style="{{ $challenges[0]->image_path 
                ? "background-image: url('".asset('storage/'.$challenges[0]->image_path)."')" 
                : 'background-color: #e5e7eb;' }}"
            >
                <div class="absolute inset-0 pointer-events-none bg-gradient-to-b from-zinc-800/0 to-zinc-800/40"></div>
                <div class="relative z-10 p-4">
                    <h2 class="font-roboto text-3xl text-stone-100 text-md font-extrabold">{{ $challenges[0]->title }}</h2>
                    <p class="font-roboto text-1xl text-stone-100 text-md line-clamp-2">{{ $challenges[0]->body }}</p>
                </div>
            </a>
        @if($challenges->count() > 1)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 ">
                @foreach($challenges->slice(1, 4) as $challenge)
                    <a href="{{ route('challenges.show', $challenge) }}"
                    class="relative flex flex-col justify-end overflow-hidden w-full h-40 bg-cover bg-center"
                    style="{{ $challenge->image_path 
                        ? "background-image: url('".asset('storage/'.$challenge->image_path)."')" 
                        : 'background-color: #e5e7eb;' }}"
                    >
                        <div class="absolute inset-0 pointer-events-none bg-gradient-to-b from-zinc-800/0 to-zinc-800/40"></div>
                        <div class="relative z-10 p-4">
                            <h2 class="font-roboto text-md text-stone-100 font-extrabold">{{ $challenge->title }}</h2>
                            <p class="font-roboto text-stone-100 line-clamp-2">{{ $challenge->body }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
        @if($challenges->count() > 4)
            <div class="mt-4 text-center">
                <a href="{{ route('challenges.all') }}" class="fill-zinc-800 hover:fill-purple">
                    <div class="flex flex-row items-center justify-center hover:text-purple hover:fill-purle">
                        <span class="mr-1 pb-0.5 font-medium">Alle anzeigen</span>
                        <?xml version="1.0" ?><!DOCTYPE svg  PUBLIC '-//W3C//DTD SVG 1.1//EN'  'http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd'><svg height="18px"  id="Layer_1" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" width="18px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><polygon points="160,128.4 192.3,96 352,256 352,256 352,256 192.3,416 160,383.6 287.3,256 "/></svg>
                    </div>
                </a>
            </div>
        @endif
        @else
            <p>Keine Posts vorhanden</p>
        @endif
    </div>

    <div>
        <hr class="my-10 border-1">
    </div>
    <div class="text-zinc-800">
        <h1 id="verfassen" class="font-bold text-4xl mb-2">Verfassen</h1>
        <form wire:submit.prevent="submit" class="w-full">
            <label for="title" class="inline-block w-full font-bold my-1">Titel</label>
            <input id="title" wire:model.live="title" maxlength="40" type="text" placeholder="Titel eingeben" class="w-full mb-2 border px-1 border-stone-800">
            <div class="text-sm font-light mb-2">{{ strlen($title ?? '') }}/40 Zeichen</div>
            @error('title') <span class="text-red-500">{{ $message }}</span> @enderror
            <label for="text" class="inline-block w-full font-bold my-1">Text</label>
            <textarea wire:model.live="body" placeholder="Text" id="body" class="w-full border px-1 border-stone-800 min-h-40"></textarea>
            <div class="text-sm font-light mb-2">{{ strlen($body ?? '') }} Zeichen</div>
            @error('body') <span class="text-red-500">{{ $message }}</span> @enderror
            <label for="image" class="inline-block w-full font-bold my-1">Bild hochladen (optional)</label>
            <input type="file" wire:model="image" id="image" class="block w-full border border-stone-800 cursor-pointer mb-4 file:text-stone-100 file:py-2 file:px-4 file:border-0 file:bg-purple file:font-semibold file:cursor-pointer">
            @error('image') <span class="text-red-500">{{ $message }}</span> @enderror
            <label>
                @guest
                    <input type="checkbox" wire:model="public" onclick="return false;"/>
                    Öffentlich sichtbar (um private Posts anzulegen logge Dich bitte ein)
                @endguest
                @auth
                    <input type="checkbox" wire:model="public" />
                    Öffentlich sichtbar
                @endauth
            </label>
            @if (session()->has('success'))
                <div class="text-green-600 mt-2">{{ session('success') }}</div>
            @endif
            <div class="flex flex-wrap w-full mb-15">
                <button type="submit" class="text-lg ml-auto my-auto inline-block items-center px-3 py-2 mb-10 rounded-full text-center text-zinc-800 bg-yellow w-max cursor-pointer hover:bg-yellow-300">Absenden</button>
            </div>
        </form>
    </div>

</div>
