<x-layout>
    <!-- People find pleasure in different ways. I find it in keeping my mind clear. - Marcus Aurelius -->
    <header class="py-8 md:py-12">
        <h1 class="text-3xl font-bold">Ideas</h1>
        <p class="text-muted-foreground text-sm mt-2">Capture your thoughts. Make a Plan</p>
    </header>

    <details class="group border border-border rounded-lg bg-card w-full max-w-60 transition-all duration-300">
        <summary class="flex items-center justify-between p-4 font-semibold cursor-pointer list-none select-none text-white">
            <span>Filter</span>
            <span class="relative flex items-center justify-center w-4 h-4 text-xl font-light">
                <span class="absolute transition-transform duration-300 transform group-open:rotate-135">+</span>
            </span>
        </summary>

        <a href="/ideas" class="mx-2 px-4 py-3 text-sm rounded-lg flex items-center justify-between transition-all duration-300 ease-in-out text-white hover:bg-slate-100/10 hover:opacity-80 active:scale-[0.99]">
                
            <div class="font-medium" >Clear Filter</div>
            <span class="text-xs bg-slate-700/20 border border-slate-500/20 text-slate-200 px-2 py-0.5 rounded-full font-medium">
                {{ $statusCounts->get('all', 0) }}
            </span>
        </a>

    @foreach (App\IdeaStatus::cases() as $status)
        @php
            // Store full explicit strings so Tailwind V4 compiler can see them perfectly
            [$textColor, $badgeColor] = match($status->value) {
                'pending'     => ['text-yellow-500', 'bg-yellow-500/10 text-yellow-500 border border-yellow-500/20'],
                'in_progress' => ['text-blue-500', 'bg-blue-500/10 text-blue-500 border border-blue-500/20'],
                'completed'   => ['text-primary', 'bg-primary/10 text-primary border border-primary/20'],
                default       => ['text-white', 'bg-slate-700 text-white']
            };
            
            $count = $statusCounts->get($status->value, 0);
        @endphp
        <a href="/ideas?status={{ $status->value }}" 
            class="mx-2 px-4 py-3 text-sm rounded-lg flex items-center justify-between transition-all duration-300 ease-in-out {{ $textColor }} hover:bg-slate-100/10 hover:opacity-80 active:scale-[0.99]">
                
            <div class="font-medium">
                {{ $status->label() }}
            </div>

            <span class="text-xs px-2 py-0.5 rounded-full font-semibold {{ $badgeColor }}">
                {{ $count }}
            </span>
    
        </a>
    @endforeach
    </details>


    <div class="mt-10 text-muted-foreground">
        <div class="grid md:grid-cols-2 gap-6">
            @forelse ($ideas as $idea)
                <x-layout.card href="{{route('ideas.show',$idea)}}">
                    <h3 class="text-foreground text-lg">{{$idea -> title}}</h3>
                    <div>
                        <x-ideas.status-label status="{{$idea->status}}" class="mt-1">
                            {{$idea->status->label()}}
                        </x-ideas.status-label>
                    </div>
                    <div class="mt-5 line-clamp-2">{{$idea->description}}</div>
                    <div class="mt-4">{{$idea->created_at->diffForHumans()}}</div>
                </x-layout.card>
            @empty
                <p>No ideas at this time. Add one!</p>
            @endforelse
        </div>
    </div>

</x-layout>

