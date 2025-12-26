@props(['profile', 'categories'])
<!DOCTYPE html>
<html lang="id">

<x-layout.head :profile="$profile"/>

<body class="bg-gray-50 font-sans text-gray-800 min-h-screen flex flex-col">

    {{-- Layout Header --}}
    <x-layout.header :profile="$profile" :categories="$categories" />

    <!-- Main Content -->
    {{ $slot }}

    <!-- Layout Footer -->
    <x-layout.footer :profile="$profile" />

    {{-- JavaScript --}}
    <script src="{{ asset('js/main.js') }}"></script>

</body>

</html>
