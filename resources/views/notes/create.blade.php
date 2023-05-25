<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                {{-- <form action="{{route('notes.store')}}" method="post">
                    @csrf
                    <x-text-input type="text" name="title" field='title' placeholder="Title" class="w-full" aria-autocomplete="off"></x-text-input>

                    <x-textarea name="text"  rows="10" field = 'text' placeholder="Start Typing here" class="w-full mt-6"></x-textarea>

                    <x-primary-button class="mt-6">Save Note</x-primary-button>
                </form> --}}
                <form action="{{ route('notes.store') }}" method="post">
                    @csrf
                    <x-text-input
                        type="text"
                        name="title"
                        placeholder="Title"
                        class="w-full"
                        aria-autocomplete="off"
                        :value="@old('title')"></x-text-input>
                    @error('title')
                        <div class="text-red-600 text-sm">
                            {{$message }}
                        </div>
                    @enderror
                    <x-textarea
                    name="text"
                    rows="10"
                    placeholder="Typing here "
                    class="w-full mt-6"
                    :value="@old('text')" ></x-textarea>

                    @error('text')
                        <div class="text-red-600 text-sm">
                            {{$message }}
                        </div>
                    @enderror
                    <x-primary-button class="mt-6">Save Note</x-primary-button>
                </form>
            </div>
       </div>
   </div>
</x-app-layout>
