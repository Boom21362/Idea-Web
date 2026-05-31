@props(['name', 'type'=>'text', 'title'])

<div class="space-y-2">
    <label for="{{$name}}" class="label">{{$title}}</label>
    <input type="{{$type}}" class="input" id="{{$name}}" name="{{$name}}" {{ $attributes }}>
    @error($name)
    <p class="error">{{$message}}</p>
    @enderror
</div>
