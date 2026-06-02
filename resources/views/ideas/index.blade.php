<x-layout>
    <!-- People find pleasure in different ways. I find it in keeping my mind clear. - Marcus Aurelius -->
    <header class="py-8 md:py-12">
        <h1 class="text-3xl font-bold">Ideas</h1>
        <p class="text-muted-foreground text-sm mt-2">Capture your thoughts. Make a Plan</p>
    </header>

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

