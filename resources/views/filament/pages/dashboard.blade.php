<x-filament-panels::page>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="bg-white shadow-md rounded-xl p-6">
            <h2 class="text-xl font-semibold mb-4 text-gray-800">Trend Kepuasan Pelanggan</h2>

            {{ $this->headerWidgets }}

            {{-- Jika ingin tambahkan widget lain --}}
            <div class="mt-6">
                {{ $this->widgets }}
            </div>
        </div>
    </div>
</x-filament-panels::page>
