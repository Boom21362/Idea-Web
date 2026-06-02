@props(['title'=> false ,'name', 'type'=>'text', 'title'])

<div class="space-y-2">
    @if($title)
        <label for="{{$name}}" class="label">{{$title}}</label>
    @endif

    @if($type === 'textarea')
        <textarea 
            name="{{$name}}"
            id="{{$name}}"
            class="textarea"
            {{$attributes}}
        ></textarea>
    
    @else
        <input 
        type="{{$type}}" 
        class="input" 
        id="{{$name}}" 
        name="{{$name}}" {{ $attributes }}>
    @endif

    <x-form.error name="{{$name}}"></x-form.error>
</div>

