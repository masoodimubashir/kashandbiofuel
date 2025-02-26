<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>



    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">


            @include('profile.partials.update-profile-information-form')

            @include('profile.partials.update-password-form')

            {{-- @include('profile.partials.delete-user-form') --}}


        </div>
    </div>


</x-app-layout>
