@props(['image' => null])

<div class="relative group w-full flex flex-col items-center justify-center" style="min-height: 180px;">
    <input
        type="file"
        accept="image/*"
        wire:model="image"
        name="image"
        id="image"
        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
    >
    <div class="flex flex-col items-center justify-center border-2 border-zinc-200 rounded-lg p-6 transition w-full h-full pointer-events-none">
        @if($image)
            <img src="{{ $image->temporaryUrl() }}" alt="Vorschau" class="w-32 h-32 object-cover rounded mb-2 border">
        @else
            <div class="text-gray-500 flex flex-col items-center font-bold">
                <div class="flex flex-row gap-3 text-custom-green bg-green-300 rounded-full p-3"> 
                    <span>
                        <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M14.2647 15.9377L12.5473 14.2346C11.758 13.4519 11.3633 13.0605 10.9089 12.9137C10.5092 12.7845 10.079 12.7845 9.67922 12.9137C9.22485 13.0605 8.83017 13.4519 8.04082 14.2346L4.04193 18.2622M14.2647 15.9377L14.606 15.5991C15.412 14.7999 15.8149 14.4003 16.2773 14.2545C16.6839 14.1262 17.1208 14.1312 17.5244 14.2688C17.9832 14.4253 18.3769 14.834 19.1642 15.6515L20 16.5001M14.2647 15.9377L18.22 19.9628M18.22 19.9628C17.8703 20 17.4213 20 16.8 20H7.2C6.07989 20 5.51984 20 5.09202 19.782C4.7157 19.5903 4.40973 19.2843 4.21799 18.908C4.12583 18.7271 4.07264 18.5226 4.04193 18.2622M18.22 19.9628C18.5007 19.9329 18.7175 19.8791 18.908 19.782C19.2843 19.5903 19.5903 19.2843 19.782 18.908C20 18.4802 20 17.9201 20 16.8V13M11 4H7.2C6.07989 4 5.51984 4 5.09202 4.21799C4.7157 4.40973 4.40973 4.71569 4.21799 5.09202C4 5.51984 4 6.0799 4 7.2V16.8C4 17.4466 4 17.9066 4.04193 18.2622M18 9V6M18 6V3M18 6H21M18 6H15" stroke="#087A30" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                    <span>
                        Datei hochladen
                    </span>
                </div>
                <span class="mt-2">oder Drag and Drop</span>
            </div>
        @endif
    </div>
</div>
