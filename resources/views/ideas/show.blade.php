<x-layout>
    <div class="py-8 max-w-4xl mx-auto">
        <div class="flex justify-between pb-2">
            <a href="{{route('ideas.index')}}" class="flex items-center gap-x-2 text-sm font-medium ">
                <x-icons.arrow-back />
                Back To Ideas
            </a>
        

            <div class="gap-x-3 flex items-center">
                <button class="btn btn-outlined text-yellow-300">Edit Idea</button>
                <form action="{{route('ideas.destroy',$idea)}}" method="post">
                    @csrf
                    @method('DELETE')
        
                    <button class="btn btn-outlined text-red-500">Delete</button>
                </form>
            </div>
        </div>
        <div class="mt-8 space-y-6">
            <h1 class="font-bold text-4xl">{{$idea->title}}</h1>

            <div class="mt-2 flex gap-x-3 items-center">
                <x-ideas.status-label :status="$idea->status->value">{{ $idea->status->label()}}</x-ideas.status-label>

                <div class="text-muted-foreground text-sm">{{$idea->created_at->diffForHumans()}}</div>
            </div>

            <x-layout.card class="mt-6">
                <div class="text-foreground max-w-none cursor-pointer">{{$idea->description}}</div>
            </x-layout.card>

            @if($idea->links->count())
                <div>
                    <h3 class="font-bold text-xl mt-6">Links</h3>

                    <div class="mt-3 space-y-2">
                        @foreach ($idea->links as $link)
                            <x-layout.card :href="$link" class="text-primary font-medium flex gap-x-3 items-center"> 
                                <x-icons.link/>
                                {{$link}} 
                            </x-layout.card>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-layout>