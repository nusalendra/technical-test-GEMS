<x-app-layout>
    @section('title', 'Notifikasi')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 mt-14">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <header>
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Notifikasi') }}
                </h2>
            </header>

            <div class="mt-6 space-y-4">
                @foreach ($data as $item)
                    @if ($item->suratPerintahLembur->status == 'Setuju')
                        <div class="p-4 bg-blue-100 border border-blue-200 rounded">
                            <p class="text-sm text-blue-800">
                                <a href="/notifikasi/{{ $item->id }}"
                                    class="font-medium text-blue-600 hover:text-blue-800">{{ $item->pesan }}</a>
                            </p>
                            <span
                                class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($item->created_at)->locale('id')->translatedFormat('l, d F Y') }}</span>
                            <div class="mt-4">
                                <a href="{{ asset('storage/surat_lembur/' . basename($item->url_surat_perintah_lembur)) }}"
                                    class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                                    download>
                                    Unduh Surat
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="p-4 bg-red-100 border border-red-200 rounded">
                            <p class="text-sm text-red-800">
                                <a href="/notifikasi/{{ $item->id }}"
                                    class="font-medium text-red-600 hover:text-red-800">{{ $item->pesan }}</a>
                            </p>
                            <span
                                class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($item->created_at)->locale('id')->translatedFormat('l, d F Y') }}</span>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
