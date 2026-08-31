<x-layout>
    <div class="flex justify-center items-center min-h-[calc(100vh-8rem)]">
       
        <form action="/login" method="POST">
            @csrf
            <fieldset class="fieldset bg-base-200 border-base-300 rounded-box w-xs border p-4">
                <legend class="fieldset-legend">Login</legend>

                <x-form.field name="email" label="Email" type="email"/>
                <x-form.field name="password" label="Password" type="password"/>

                <button class="btn btn-neutral mt-4">Login</button>
            </fieldset>
        </form>
    </div>
</x-layout>