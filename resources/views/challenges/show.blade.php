<x-layouts.app.sidebar>
    @if($challenge->image_path)
        <div class="bg-cover aspect-video bg-center h-80 w-full md:rounded-md relative" style="{{ "background-image: url('".asset('storage/'.$challenge->image_path)."')" }}" >
            <div class="absolute inset-0 pointer-events-none bg-gradient-to-b md:rounded-md from-zinc-800/0 to-zinc-800/60"></div>
            <div class="relative z-10 p-4 h-full">
                    <h2 class="bottom-0 pb-4 absolute font-roboto text-3xl text-stone-100 font-extrabold">{{ $challenge->title }}</h2>
            </div>
        </div>
    @else
        <h1 class="font-bold text-4xl mb-4 -mt-3">{{ $challenge->title }}</h1>
    @endif
    <p class="my-4 min-h-[calc(100vh-680px)]">{!! nl2br(e($challenge->body)) !!}</p>
    <a href="{{ url()->previous() }}"  class="text-lg ml-auto w-full md:w-fit my-auto inline-block items-center px-3 py-2 mb-10 rounded-full text-center text-zinc-800 bg-yellow cursor-pointer hover:bg-yellow-300">Zurück zur Übersicht</a>
</x-layouts.app.sidebar>