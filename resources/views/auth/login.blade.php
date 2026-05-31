<x-layout>
    <x-form title="Login" description="Glad you're back!">
            <form action="/login" method="POST" class="mt-10 space-y-4" >
@csrf
<x-form.field name="name" type="name" title="Name"></x-form.field>

<x-form.field name="email" type="email" title="Email"></x-form.field>

<x-form.field name="password" t ype="password" title="Pasword"></x-form.field>

<button type="submit" class="btn mt-2 h-10 font-bold w-full ">Create Account</button>
</form>
</x-form>
</x-layout>
