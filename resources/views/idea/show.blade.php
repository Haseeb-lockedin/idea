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
            <div class="mt-2 space-y-6">
                @if ($idea->image_path)
                    <div class="rounded-lg overflow-hidden">
                        <img src="{{ asset('storage/' . $idea->image_path) }}" alt=""
                            class="w-full h-auto object-cover">
                    </div>
                @endif
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

            @if ($idea->steps->count())
                <div>
                    <h3 class="text-xl font-bold">Steps</h3>
                    @foreach ($idea->steps as $step)
                        <div class="flex gap-2 items-center mt-4">
                            <x-mycard>
                                <form method="POST" action="{{ route('step.update', $step) }}">
                                    @csrf
                                    @method('PATCH')
                                    <div class="flex items-center gap-x-3">
                                        <button type="submit" role="checkbox"
                                            class="size-5 flex items-center justify-center rounded-md border-2 transition-colors {{ $step->completed ? 'border-sky-300 bg-sky-300 text-slate-900' : 'border-slate-400 bg-transparent text-transparent hover:border-sky-300' }}">
                                            <span aria-hidden="true">&check;</span>
                                        </button>
                                        <span
                                            class="{{ $step->completed ? 'text-slate-400 line-through' : '' }}">{{ $step->description }}</span>
                                    </div>
                                </form>
                            </x-mycard>
                        </div>
                    @endforeach
                </div>
            @endif

            @if ($idea->links->count())
                <div>
                    <h3 class="text-xl font-bold">Links</h3>
                    @foreach ($idea->links as $link)
                        <div class="flex gap-2 items-center mt-4">
                            <x-mycard :href="$link"
                                class="flex gap-x-3 items-center font font-medium text-accent-content">
                                <x-icons.external />
                                {{ $link }}
                            </x-mycard>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-layout>
