<x-app-layout>
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        
        {{-- Judul Halaman --}}
        <div class="mb-8 text-center">
            <h1 class="text-2xl font-bold text-gray-800 flex justify-center items-center gap-3">
                {{-- Ikon Lonceng SVG --}}
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
                Notifikasaun Orderan Foun
            </h1>
            <p class="text-gray-500 mt-1">Lista Orderan ne'ebé seidauk konfirmadu</p>
        </div>

        {{-- Jika Tidak Ada Notifikasi --}}
        @if($notifikasi->isEmpty())
            <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl p-12 text-center border border-green-100 shadow-sm">
                {{-- Ikon Centang SVG --}}
                <div class="inline-flex items-center justify-center w-20 h-20 bg-green-100 rounded-full mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-700">Sei iha orderan Foun</h3>
                <p class="text-gray-500 mt-2">Orderan konfirmadu hotu ona.</p>
            </div>
        @else
            {{-- Daftar Notifikasi --}}
            <div class="space-y-4">
                @foreach($notifikasi as $n)
                    <div class="bg-white border-l-4 border-orange-500 rounded-xl shadow-sm p-5 hover:shadow-md transition-shadow">
                        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start mb-3 gap-2">
                            <h3 class="font-bold text-lg text-gray-800 flex items-center gap-2">
                                <span class="text-orange-500">📦</span> Hola Foun — {{ $n->nome }}
                            </h3>
                            <span class="text-xs text-gray-400 bg-gray-100 px-2 py-1 rounded">
                                {{ $n->created_at->format('d/m/Y H:i') }}
                            </span>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm mb-4">
                            <div>
                                <span class="text-gray-500">Naran:</span>
                                <span class="font-medium ml-1 text-gray-800">{{ $n->nome }}</span>
                            </div>
                            <div>
                                <span class="text-gray-500">Telefone:</span>
                                <span class="font-medium ml-1 text-gray-800">{{ $n->telefone }}</span>
                            </div>
                            <div class="md:col-span-2">
                                <span class="text-gray-500">Enderesu:</span>
                                <span class="font-medium ml-1 text-gray-800">{{ $n->enderesu }}</span>
                            </div>
                            <div>
                                <span class="text-gray-500">Total:</span>
                                <span class="font-bold text-green-600 ml-1">${{ number_format($n->total, 2) }}</span>
                            </div>
                            <div>
                                <span class="text-gray-500">Pagamentu:</span>
                                <span class="bg-blue-100 text-blue-700 px-2 py-0.5 rounded text-xs font-medium ml-1">COD</span>
                            </div>
                        </div>
                        
                        {{-- TOMBOL KONFIRMASI --}}
                        <div class="mt-4 pt-3 border-t flex justify-end">
                            <a href="{{ route('admin.nota.konfirmasi', $n->id) }}" 
                               class="inline-flex items-center gap-2 px-6 py-2.5 bg-blue-600 text-black rounded-lg hover:bg-blue-700 transition-colors font-medium"
                               onclick="return confirm('✅ Tebes atu marka transasaun ida nee SUSESU?')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Konfirma Orderan
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
