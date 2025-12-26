@props(['stats'])

<aside class="w-full lg:w-80">
    <h3 class="text-2xl font-bold text-blue-950 pb-2 border-b-4 border-blue-600 inline-block mb-10">
        Info Cepat
    </h3>

    <div class="space-y-6">
        <div class="bg-blue-50 rounded-xl p-8 text-center shadow">
            <p class="text-5xl font-bold text-blue-900">{{ $stats['alumni'] }}</p>
            <p class="text-gray-700 mt-2">Alumni</p>
        </div>

        <div class="bg-green-50 rounded-xl p-8 text-center shadow">
            <p class="text-5xl font-bold text-green-700">{{ $stats['companies'] }}</p>
            <p class="text-gray-700 mt-2">Perusahaan Mitra</p>
        </div>

        <div class="bg-yellow-50 rounded-xl p-8 text-center shadow">
            <p class="text-5xl font-bold text-yellow-700">{{ $stats['jobs'] }}</p>
            <p class="text-gray-700 mt-2">Lowongan Aktif</p>
        </div>
    </div>
</aside>
