@if (session('success'))
<div class="mb-4 px-4 py-4 bg-green-100 text-green-700 rounded">
    {{-- {{ session('success') }} --}}
    {{ $slot }}
</div>

@endif
