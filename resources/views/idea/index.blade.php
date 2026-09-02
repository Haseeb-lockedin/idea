<x-layout>
    <div class="px-8 py-6">
        <header class="mx-auto max-w-5xl">
            <h1 class="text-3xl text-center font-bold">Your Bitchass Ideas</h1>
        </header>

        <div class="mt-4 mx-auto max-w-5xl">
            <x-dropfilter class="m-1" name="{{ $current }}">
                <li><a href="{{ route('idea.index') }}">
                        All <span class="text-xs pl-3">({{ $statusCounts->get('all') }})</span>
                    </a></li>

                @foreach (App\IdeaStatus::cases() as $status)
                    <li><a href="{{ route('idea.index', ['status' => $status->value]) }}">
                            {{ $status->label() }} <span
                                class="text-xs pl-3">({{ $statusCounts->get($status->value) }})</span>
                        </a></li>
                @endforeach

            </x-dropfilter>
            <div class="grid gap-6 justify-items-center md:grid-cols-2 mt-4">
                @forelse ($ideas as $idea)
                    <x-card href="{{ route('idea.show', $idea) }}">
                        <div class="card-body">
                            <h2 class="card-title">{{ $idea->title }}</h2>
                            <div>
                                <x-status-pill status="{{ $idea->status }}">
                                    {{ $idea->status->label() }}
                                </x-status-pill>
                            </div>
                            <p class="text-sm text-slate-300/80 leading-relaxed">{{ $idea->description }}</p>
                            <div class="text-xs text-slate-400">{{ $idea->created_at->diffForHumans() }}</div>
                        </div>
                    </x-card>
                @empty
                    <div class="flex flex-col items-center justify-center col-span-2">
                        <p class="text-md font-semibold text-center text-gray-500">No ideas yet at the moment dawg.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-layout>
