@props(['name', 'title'])

<div x-data="{ show: false, name: @js($name) }" x-show="show" @open-modal.window="if ($event.detail === name)  show = true"
    @close-modal="show = false" @keydown.escape.window="show = false"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-xs"
    x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-4 -translate-x-4"
    x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0 translate-y-4 translate-x-4" style="display: none;" role="dialog"
    aria-modal="true" aria-labelledby="modal-{{ $name }}-title" :aria-hidden="!show" tabindex="-1">
    <x-mycard @click.away="show = false"
        class="flex-col gap-5 p-5 shadow-xl max-w-xl w-[calc(100%-2rem)] max-h-[80dvh] overflow-auto">
        <div class="w-full flex justify-between items-center">
            <h2 id="modal-{{ $name }}-title" class="text-lg font-bold">{{ $title }}</h2>

            <button class="cursor-pointer" aria-label="close button" @click="show = false">
                <x-icons.close />
            </button>
        </div>
        <div class="w-full mt-4">
            {{ $slot }}
        </div>
    </x-mycard>
</div>
