<x-layout>
    <div class="py-12 max-w-4xl mx-auto">
        <div class="flex flex-col gap-4">
            <div class="flex justify-between items-center">
                <a href="{{ route('idea.index') }}" class="flex gap-2 font-medium items-center">
                    <x-icons.back-arrow />
                    Back to ideas
                </a>
                <div class="flex gap-x-3 items-center">
                    <button class="btn btn-outline">
                        <x-icons.external />
                        Edit
                    </button>
                    <form action="{{ route('idea.delete', $idea) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-warning">Delete</button>
                    </form>
                </div>
            </div>
            <h1 class="text-2xl font-bold">{{ $idea->title }}</h1>
            <x-card>
                <div class="card-body">
                    <div>
                        <x-status-pill status="{{ $idea->status }}">
                            {{ $idea->status->label() }}
                        </x-status-pill>
                    </div>
                    <p>{{ $idea->description }}</p>
                    <div class="text-xs">{{ $idea->created_at->diffForHumans() }}</div>
                </div>
            </x-card>

            <div>
                <h3 class="text-xl font-bold">Links</h3>
                @foreach ($idea->links as $link)
                    <div class="flex gap-2 items-center mt-4">
                        <div class="flex space-y-2 gap-2 bg-neutral border w-full rounded-2xl border-neutral px-4 py-2">
                            <x-icons.external />
                            <a target="_blank" class="text-blue-500 hover:underline">{{ $link }}</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-layout>
