<x-layout>
    <div class="px-4 py-6 sm:px-8">
        <header class="mx-auto max-w-6xl">
            <h1 class="text-center text-3xl font-bold tracking-tight">Your Bitchass Ideas</h1>

            <div class="mt-4">
                <x-mycard x-data="{}" @click="$dispatch('open-modal', 'create-idea')" is="button"
                    data-test="create-idea-button" class="btn btn-ghost w-full text-lg font-medium sm:text-2xl">
                    Create New Idea
                </x-mycard>
            </div>
        </header>

        <div class="mx-auto mt-8 max-w-6xl">
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
            <div class="mt-5 grid gap-5 md:grid-cols-2">
                @forelse ($ideas as $idea)
                    <x-card href="{{ route('idea.show', $idea) }}"
                        class="group overflow-hidden border border-white/10 bg-neutral shadow-lg shadow-black/20 transition duration-200 hover:-translate-y-1 hover:border-white/20 hover:shadow-xl">
                        @if ($idea->image_path)
                            <div class="aspect-16/6 overflow-hidden bg-base-300">
                                <img src="{{ asset('storage/' . $idea->image_path) }}" alt="{{ $idea->title }}"
                                    class="h-full w-full object-cover transition duration-300 group-hover:scale-105">
                            </div>
                        @endif
                        <div class="card-body gap-3 p-4 sm:p-5">
                            <h2 class="card-title text-lg font-semibold leading-tight sm:text-xl">{{ $idea->title }}
                            </h2>
                            <div>
                                <x-status-pill status="{{ $idea->status }}">
                                    {{ $idea->status->label() }}
                                </x-status-pill>
                            </div>
                            @if ($idea->description)
                                <p class="line-clamp-2 text-sm leading-relaxed text-slate-300/75">
                                    {{ $idea->description }}</p>
                            @endif
                            <div class="text-xs font-semibold text-amber-400/80">
                                {{ $idea->created_at->diffForHumans() }}</div>
                        </div>
                    </x-card>
                @empty
                    <div class="flex flex-col items-center justify-center col-span-2">
                        <p class="text-md font-semibold text-center text-gray-500">No ideas yet at the moment dawg.</p>
                    </div>
                @endforelse
            </div>
        </div>
        <x-modal name="create-idea" title="Create New Idea">
            <form x-data="{ status: @js(App\IdeaStatus::PENDING->value), newLink: '', links: [], newStep: '', steps: [] }" action="{{ route('idea.store') }}" method="POST"
                enctype="multipart/form-data" class="flex flex-col gap-4">
                @csrf
                <input type="hidden" name="status" x-model="status">
                <div class="space-y-6">

                    <x-form.field label="Title" name="title" type="text" placeholder="Enter an idea for title"
                        required autofocus />

                    <div>
                        <label for="status" class="label">Status</label>

                        <div class="flex gap-3 mt-2">
                            @foreach (App\IdeaStatus::cases() as $status)
                                <button type="button" @click="status = @js($status->value)" class="btn flex-1"
                                    :class="status === @js($status->value) ? 'btn-active' : 'btn-outline'"
                                    data-test="button-status-{{ $status->value }}">
                                    {{ $status->label() }}
                                </button>
                            @endforeach
                        </div>
                        <x-form.error name="status" />
                    </div>

                    <x-form.field label="Description" name="description" type="textarea"
                        placeholder="Enter an idea for description" />

                    <div>
                        <label for="image" class="label">Featured Image</label>

                        <div
                            class="rounded-box border border-dashed border-base-content/20 bg-base-200/30 p-4 transition-colors has-focus-within:border-primary has-focus-within:bg-base-200/60">
                            <input id="image" type="file" name="image" accept="image/*"
                                class="file-input file-input-bordered w-full bg-base-100/60">
                            <p class="mt-2 text-xs text-base-content/60">Add a clear image to make your idea easier to
                                spot. PNG, JPG, or WEBP.</p>
                        </div>
                        <x-form.error name="image" />
                    </div>

                    <div>
                        <label for="steps" class="label">Steps</label>

                        <div class="flex items-center justify-between gap-2">
                            <input x-model="newStep" id="new-step" placeholder="step 1" spellcheck="false"
                                class="input flex-1 w-full mt-2">

                            <button @click="steps.push(newStep.trim()); newStep ='';" class="cursor-pointer"
                                type="button" :disabled="newStep.trim().length === 0" aria-label="add new step">
                                <x-icons.close class="rotate-45" />
                            </button>
                        </div>

                        <div class="mt-2 flex flex-col gap-2" :key="step">
                            <template x-for="(step, index) in steps">
                                <div class="flex items-center justify-between gap-2">
                                    <input type="text" name="steps[]" x-model="step" class="input w-full">

                                    <button @click="steps.splice(index, 1)" class="cursor-pointer" type="button"
                                        aria-label="remove step">
                                        <x-icons.close />
                                    </button>
                                </div>
                            </template>
                        </div>
                    </div>

                    <div>
                        <label for="links" class="label">Links</label>

                        <div class="flex items-center justify-between gap-2">
                            <input x-model="newLink" type="url" id="new-link" placeholder="http://example.com"
                                autocomplete="url" spellcheck="false" class="input flex-1 w-full mt-2">

                            <button @click="links.push(newLink.trim()); newLink ='';" class="cursor-pointer"
                                type="button" :disabled="newLink.trim().length === 0" aria-label="add new link">
                                <x-icons.close class="rotate-45" />
                            </button>
                        </div>

                        <div class="flex flex-col gap-2">
                            <template x-for="(link, index) in links" :key="link">
                                <div class="flex items-center justify-between gap-2">
                                    <input type="text" name="links[]" x-model="link" class="input w-full">

                                    <button @click="links.splice(index, 1)" class="cursor-pointer" type="button"
                                        aria-label="remove link">
                                        <x-icons.close />
                                    </button>
                                </div>
                            </template>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3">
                        <button class="btn btn-active">Create</button>
                        <button type="button" class="btn btn-soft" @click="dispatch('close-modal')">Cancel</button>
                    </div>
            </form>
        </x-modal>
    </div>
    </div>
</x-layout>
