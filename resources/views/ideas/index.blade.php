<x-layout>
    <header class="py-8 md:py-12">
        <h1 class="text-3xl font-bold">Ideas</h1>
        <p class="text-muted-foreground text-sm mt-2">Capture your thoughts. Make a Plan</p>

        <x-layout.card 
            x-data @click="$dispatch('open-modal', 'create-idea')"
            is="button" class="mt-10 cursor-pointer h-32 w-full text-left"> 
            <p>What's the idea?</p>
        </x-layout.card>
    </header>

    <div class="flex flex-col md:flex-row gap-8 items-start w-full mt-6">
        
        <div class="w-full md:w-64 shrink-0">
            <details class="group border border-border rounded-lg bg-card w-full transition-all duration-300" open>
                <summary class="flex items-center justify-between p-4 font-semibold cursor-pointer list-none select-none text-white">
                    <span>Filter</span>
                    <span class="relative flex items-center justify-center w-4 h-4 text-xl font-light">
                        <span class="absolute transition-transform duration-300 transform group-open:rotate-135">+</span>
                    </span>
                </summary>

                <a href="/ideas" class="mx-2 mb-2 px-4 py-3 text-sm rounded-lg flex items-center justify-between transition-all duration-300 ease-in-out text-white hover:bg-slate-100/10 hover:opacity-80 active:scale-[0.99]">
                    <div class="font-medium">Clear Filter</div>
                    <span class="text-xs bg-slate-700/20 border border-slate-500/20 text-slate-200 px-2 py-0.5 rounded-full font-medium">
                        {{ $statusCounts->get('all', 0) }}
                    </span>
                </a>

                @foreach (App\IdeaStatus::cases() as $status)
                    @php
                        [$textColor, $badgeColor] = match($status->value) {
                            'pending'     => ['text-yellow-500', 'bg-yellow-500/10 text-yellow-500 border border-yellow-500/20'],
                            'in_progress' => ['text-blue-500', 'bg-blue-500/10 text-blue-500 border border-blue-500/20'],
                            'completed'   => ['text-primary', 'bg-primary/10 text-primary border border-primary/20'],
                            default       => ['text-white', 'bg-slate-700 text-white']
                        };
                        $count = $statusCounts->get($status->value, 0);
                    @endphp
                    <a href="/ideas?status={{ $status->value }}" 
                        class="mx-2 mb-2 px-4 py-3 text-sm rounded-lg flex items-center justify-between transition-all duration-300 ease-in-out {{ $textColor }} hover:bg-slate-100/10 hover:opacity-80 active:scale-[0.99]">
                        <div class="font-medium">{{ $status->label() }}</div>
                        <span class="text-xs px-2 py-0.5 rounded-full font-semibold {{ $badgeColor }}">{{ $count }}</span>
                    </a>
                @endforeach
            </details>
        </div>

        <div class="flex-1 w-full text-muted-foreground">
            <div class="grid grid-cols-1 gap-6 items-start w-full">
                @forelse ($ideas as $idea)
                    <x-layout.card href="{{ route('ideas.show', $idea) }}"> 
                        <h3 class="text-foreground text-lg font-semibold">{{ $idea->title }}</h3>
                        <div class="mt-2">
                            <x-ideas.status-label status="{{ $idea->status }}" class="mt-1">
                                {{ $idea->status->label() }}
                            </x-ideas.status-label>
                        </div>
                        <div class="mt-5 line-clamp-2 text-sm text-muted-foreground/90">{{ $idea->description }}</div>
                        <div class="mt-4 text-xs tracking-wide opacity-75">{{ $idea->created_at->diffForHumans() }}</div>
                    </x-layout.card>
                @empty
                    <div class="col-span-full border border-dashed border-border rounded-xl p-12 text-center">
                        <p class="text-sm">No ideas found matching this status. Time to map a new plan!</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>

    <x-layout.models name="create-idea" title="New Idea">
        <form x-data="{status:'pending'}" action="{{ route('ideas.store') }}" method="post" class="space-y-4">
            @csrf
            <div class="space-y-6">
                <x-form.field title="Title" name="title" placeholder="Your title" autofocus required/>

                <div class="space-y-2">
                    <label for="status" class="label font-bold">Status</label>

                    <div class="flex gap-x-3">
                        @foreach (App\IdeaStatus::cases() as $status)
                            @php
                                // Pre-determine the base highlight color using full Tailwind strings
                                $colorClass = match($status->value) {
                                    'pending'     => 'bg-yellow-500 text-black border-yellow-600',
                                    'in_progress' => 'bg-blue-500 text-white border-blue-600',
                                    'completed'   => 'bg-primary text-white border-primary-dark',
                                    default       => 'bg-slate-500 text-white'
                                };
                            @endphp

                            <button type="button" 
                                    @click="status = @js($status->value)" 
                                    class="btn flex-1 h-10 transition-all duration-200 font-medium rounded-lg border"
                                    :class="status === @js($status->value) ? @js($colorClass) : 'btn-outlined text-muted-foreground bg-transparent border-border hover:bg-slate-100/10'"
                            >
                                {{ $status->label()  }}
                            </button>
                        @endforeach

                        <input type="hidden" name="status" :value="status" class="input">
                    </div>
                    <x-form.error name="status"></x-form.error>
                </div>

                <x-form.field title="Description" name="description" type="textarea" placeholder="Describe your idea..." autofocus/>

                <div class="flex justify-end gap-x-5">
                    <button type="button" @click="$dispatch('close-modal')">Cancel</button>
                    <button type="submit" class="btn">Create</button>
                </div>
            
            </div>
        </form>
    </x-layout.models>
</x-layout>