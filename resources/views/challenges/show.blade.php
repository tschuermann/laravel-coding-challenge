<x-layouts.app.sidebar>
    <h1 class="font-bold text-4xl mb-4 -mt-3">{{ $challenge->title }}</h1>
    @if($challenge->image_path)
        <div class="bg-cover bg-center h-80 w-full" style="{{ "background-image: url('".asset('storage/'.$challenge->image_path)."')" }}" >

        </div>
    @endif
    <p class="my-4">{!! nl2br(e($challenge->body)) !!}</p>
    <a href="{{ url()->previous() }}"  class="text-lg ml-auto my-auto inline-block items-center px-3 py-2 mb-10 rounded-full text-center text-zinc-800 bg-yellow w-max cursor-pointer hover:bg-yellow-300">Zurück</a>
</x-layouts.app.sidebar>