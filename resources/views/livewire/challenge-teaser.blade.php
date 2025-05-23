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
            <button wire:click="$set('filter', 'own')" class="btn cursor-pointer p-1.5 min-w-18 {{ $filter === 'own' ? 'bg-yellow rounded-full' : '' }}">Eigene</button>
            <button wire:click="$set('filter', 'public')" class="btn cursor-pointer p-1.5 min-w-18 {{ $filter === 'public' ? 'bg-yellow rounded-full' : '' }}">Öffentliche</button>
            <button wire:click="$set('filter', 'all')" class="btn cursor-pointer p-1.5 min-w-18 {{ $filter === 'all' ? 'bg-yellow rounded-full' : '' }}">Alle</button>
        </div>
    @endauth
    <div class="flex flex-col gap-4 min-h-[calc(100vh-850px)]">
        @if($challenges->isNotEmpty() )
            @foreach($challenges->slice(0, 4) as $challenge)
                <a href="{{ route('challenges.show', $challenge) }}" 
                class="rounded-md border-2 border-zinc-200 p-2 w-full hover:bg-gray-50 transition-colors">
                    <h2 class="font-bold text-2xl text-gray-800 mb-2">{{ $challenge->title }}</h2>
                    <div class="md:grid md:grid-cols-3 gap-3">
                        <div class="flex-shrink-0 w-full md:col-span-1 aspect-video bg-gray-200 rounded-md flex items-center justify-center overflow-hidden">
                            @if($challenge->image_path)
                                <img src="{{ asset('storage/'.$challenge->image_path) }}" 
                                    alt="{{ $challenge->title }}" 
                                    class="object-cover w-full h-full rounded-md">
                            @else
                                <!-- Platzhalter-Icon, z.B. von Heroicons -->
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <rect x="3" y="3" width="18" height="18" rx="2" stroke-width="2"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16l2-2 4 4m0-8h.01"/>
                                </svg>
                            @endif
                        </div>
                        <p class="text-gray-600 mt-1.5 md:mt-0 md:col-span-2 text-sm leading-relaxed line-clamp-6">{{ $challenge->body }}</p>
                    </div>
                </a>
            @endforeach
            <div class="mt-4 text-center">
                <a href="{{ route('challenges.all') }}" class="fill-zinc-800 hover:fill-custom-green">
                    <div class="flex flex-row items-center justify-center hover:text-custom-green hover:fill-custom-green">
                        <span class="mr-1 pb-0.5 font-medium">Alle anzeigen</span>
                        <?xml version="1.0" ?><!DOCTYPE svg  PUBLIC '-//W3C//DTD SVG 1.1//EN'  'http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd'><svg height="18px"  id="Layer_1" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" width="18px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><polygon points="160,128.4 192.3,96 352,256 352,256 352,256 192.3,416 160,383.6 287.3,256 "/></svg>
                    </div>
                </a>
            </div>
        @else
            <p>Keine Posts gefunden</p>
        @endif
    </div>

    <div>
        <hr class="my-10 border-1 border-zinc-200">
    </div>
    <div class="text-zinc-800 border-2 border-zinc-200 rounded-md">
        <div class="mb-2 text-stone-100 bg-custom-green text-center py-1 rounded-t-md">
            <h1 id="verfassen" class="font-bold text-4xl">Verfassen</h1>
        </div>
        <form wire:submit.prevent="submit" class="w-full p-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="flex flex-col">
                    <label for="title" class="w-full font-bold my-1">Titel</label>
                    <input id="title" wire:model="title" maxlength="40" type="text" placeholder="Titel eingeben" class="w-full mb-2 border-2 px-1 border-zinc-200 rounded-md">
                    <div class="text-sm font-light mb-2">max. 40 Zeichen</div>
                    @error('title') <span class="text-red-500">{{ $message }}</span> @enderror
                    <label for="text" class="inline-block w-full font-bold my-1">Text</label>
                    <textarea wire:model="body" placeholder="Text" id="body" class="w-full border-2 px-1 border-zinc-200 rounded-md min-h-40"></textarea>
                    @error('body') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="flex flex-col items-center col-span-1 md:col-start-2">
                    <label for="image" class="inline-block w-full font-bold my-1">Bild hochladen (optional)</label>
                    <x-image-dropzone :image="$image" />
                    @error('image') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
            </div>
            <label>
                @guest
                    <input type="checkbox" wire:model="public" onclick="return false;" class="mt-5"/>
                    Öffentlich sichtbar (um private Posts anzulegen logge Dich bitte ein)
                @endguest
                @auth
                    <input type="checkbox" wire:model="public" class="mt-5"/>
                    Öffentlich sichtbar
                @endauth
            </label>
            @if (session()->has('success'))
                <div class="text-green-600 mt-2">{{ session('success') }}</div>
            @endif
            <div class="flex flex-wrap w-full">
                <button type="submit" class="text-lg ml-auto my-auto inline-block items-center px-3 py-2 mb-2 rounded-full text-center text-zinc-800 bg-yellow w-max cursor-pointer hover:bg-yellow-300">Absenden</button>
            </div>
        </form>
    </div>

</div>
