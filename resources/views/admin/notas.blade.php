<x-app-layout>
    <div class="min-h-screen bg-gray-100 py-6 px-4">
        <div class="max-w-2xl mx-auto">
            
            {{-- Judul Halaman Admin --}}
            <div class="text-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">📋 Lista Nota Transasaun</h1>
                <p class="text-gray-500">nota kompletu</p>
            </div>

            {{-- Kalau Kosong --}}
            @if($notas->isEmpty())
                <div class="bg-white p-12 text-center shadow-sm">
                    <div class="text-5xl mb-4">📭</div>
                    <h3 class="text-lg font-bold text-gray-600">Seidauk iha Nota ida</h3>
                    <p class="text-gray-400 mt-2">Bainhira kliente hola produtu, nota sira sei aparece iha ne'e</p>
                </div>
            @else

                {{-- Loop Semua Nota --}}
                @foreach($notas as $nota)
                
                {{-- 📄 NOTA KOMPLETU --}}
                <div class="bg-white border-2 border-pink-500 mb-8 shadow-sm">
                    
                    {{-- CABEÇALHO LOJA --}}
                    <div class="p-6 border-b-2 border-pink-500">
                        <div class="flex justify-between items-start">
                            <div class="flex items-center gap-4">
                                {{-- LOGO KARAUBOX STORE --}}
                                <div class="w-16 h-16 flex items-center justify-center flex-shrink-0">
                                    <img src="{{ asset('images/logo.jpg') }}" alt="Karaubox Store" class="w-full h-full object-contain">
                                </div>
                                <div>
                                    <h2 class="text-2xl font-bold text-pink-600">KARAUBOX STORE</h2>
                                    <p class="text-sm text-gray-600">Loja fan ropa & Equipamentu</p>
                                    <p class="text-xs text-gray-500 mt-1">📍Fomentu Dili, Timor-Leste</p>
                                </div>
                            </div>
                            <div class="text-right text-sm">
                                <p><strong>NO:</strong> {{ str_pad($nota->id, 5, '0', STR_PAD_LEFT) }}</p>
                                <p><strong>TGL:</strong> {{ $nota->created_at->format('d/m/Y') }}</p>
                                <p><strong>TEMPO:</strong> {{ $nota->created_at->format('H:i') }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- DATA KLIENTE --}}
                    <div class="p-4 border-b-2 border-black text-sm">
                        <div class="grid grid-cols-2 gap-2">
                            <div><strong>Naran:</strong> {{ $nota->nome ?? $nota->nama ?? '-' }}</div>
                            <div><strong>NO. HP:</strong> {{ $nota->telefone }}</div>
                            <div class="col-span-2"><strong>Enderesu:</strong> {{ $nota->enderesu }}</div>
                        </div>
                    </div>

                    {{-- TABELA PRODUTU --}}
                    <div class="p-4">
                        <table class="w-full text-sm border border-black">
                            <thead>
                                <tr class="bg-pink-500 text-black">
                                    <th class="py-2 px-2 text-center w-12 border border-black">No</th>
                                    <th class="py-2 px-3 text-left border border-black">Produtu</th>
                                    <th class="py-2 px-2 text-center w-16 border border-black">Qtd</th>
                                    <th class="py-2 px-3 text-right w-24 border border-black">Presu</th>
                                    <th class="py-2 px-3 text-right w-24 border border-black">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php 
                                    $produtu = [];
                                    if (is_string($nota->produtu)) {
                                        $temp = json_decode($nota->produtu, true);
                                        if (is_array($temp)) $produtu = $temp;
                                    } elseif (is_array($nota->produtu)) {
                                        $produtu = $nota->produtu;
                                    }
                                    $no = 1;
                                @endphp

                                @if(!empty($produtu))
                                    @foreach($produtu as $item)
                                    <tr class="border-b border-black">
                                        <td class="py-2 px-2 text-center border border-black">{{ $no++ }}</td>
                                        <td class="py-2 px-3 border border-black">
                                            <div class="flex items-center gap-3">
                                                {{-- FOTO LEBIH KECIL DAN RAPI --}}
                                                <div class="w-10 h-10 bg-gray-100 rounded overflow-hidden flex items-center justify-center flex-shrink-0">
                                                    @if(!empty($item['image']))
                                                        <img src="{{ asset('products/' . basename($item['image'])) }}" alt="{{ $item['name'] ?? '-' }}" 
                                                             class="w-full h-full object-cover"
                                                             onerror="this.src='{{ asset('storage/' . str_replace('public/', '', $item['image'])) }}'">
                                                    @else
                                                        <span class="text-sm">📦</span>
                                                    @endif
                                                </div>
                                                <span class="text-sm">{{ $item['name'] ?? '-' }}</span>
                                            </div>
                                        </td>
                                        <td class="py-2 px-2 text-center border border-black">{{ $item['quantity'] ?? 1 }}</td>
                                        <td class="py-2 px-3 text-right border border-black">${{ number_format($item['price'] ?? 0, 2) }}</td>
                                        <td class="py-2 px-3 text-right border border-black">${{ number_format(($item['price'] ?? 0) * ($item['quantity'] ?? 1), 2) }}</td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="py-6 text-center text-gray-400 border border-black">Seidauk iha produtu</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    {{-- NOTA & TOTAL --}}
                    <div class="p-4 border-t-2 border-black">
                        <div class="flex flex-col sm:flex-row justify-between">
                            <div class="text-sm mb-4 sm:mb-0">
                                @if($nota->nota)
                                    <p><strong>COMENTARIU:</strong> {{ $nota->nota }}</p>
                                @endif
                                <p class="text-gray-500 italic mt-2">Produtu ne'ebé hola ona la bele troka ka fo fila fali </p>
                            </div>
                            <div class="text-right">
                                <p class="text-lg font-bold text-pink-600">TOTAL: ${{ number_format($nota->total, 2) }}</p>
                                <p class="text-sm text-gray-500 mt-1">Pagamentu: {{ $nota->metode }}</p>
                            </div>
                        </div>
                    </div>

                </div>
                @endforeach
            @endif
        </div>
    </div>
</x-app-layout>
