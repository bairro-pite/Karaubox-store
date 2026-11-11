<x-app-layout>
    <div class="container mx-auto px-4 py-6 max-w-2xl">
        <h1 class="text-2xl font-bold mb-6 text-center">Metodu Pagamentu</h1>

        {{-- Daftar Barang --}}
        <div class="bg-white rounded-xl shadow p-6 mb-6">
            <h3 class="font-bold text-lg mb-4">Produtu Ita Hili</h3>
            @php $total = 0; @endphp
            @foreach($cart as $id => $item)
                @php $total += $item['price'] * $item['quantity']; @endphp
                <div class="flex items-center gap-4 py-3 border-b">
                    <div class="w-20 h-20 bg-gray-100 rounded-lg flex items-center justify-center overflow-hidden">
                        @if(!empty($item['image']))
                            <img src="{{ asset('products/' . $item['image']) }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                        @else
                            <span class="text-gray-400">Foto</span>
                        @endif
                    </div>
                    <div class="flex-1">
                        <p class="font-bold">{{ $item['name'] }}</p>
                        <p class="text-gray-500">Kuantidade: {{ $item['quantity'] }}</p>
                    </div>
                    <p class="font-bold">${{ number_format($item['price'] * $item['quantity'], 2) }}</p>
                </div>
            @endforeach
            <div class="flex justify-between items-center mt-4 pt-4 border-t text-xl font-bold">
                <span>Total Hamutuk:</span>
                <span class="text-blue-600">${{ number_format($total, 2) }}</span>
            </div>
        </div>

        {{-- FORMULIR DATA KLIENTE --}}
        <div class="bg-white rounded-xl shadow p-6 mb-6">
            <h3 class="font-bold text-lg mb-4">Dadus Costumer / Nota Transasaun</h3>
            
            <form action="{{ route('checkout.proses') }}" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label class="block font-bold mb-2">Naran Kompletu *</label>
                    <input type="text" name="nome" required
                           class="w-full border rounded-lg p-3" placeholder="Halo Naran...">
                </div>

                <div class="mb-4">
                    <label class="block font-bold mb-2">Numeru Telefone *</label>
                    <input type="text" name="telefone" required
                           class="w-full border rounded-lg p-3" placeholder="+670 777 000 000">
                </div>

                <div class="mb-4">
                    <label class="block font-bold mb-2">Hela Fatin *</label>
                    <textarea name="enderesu" rows="3" required
                              class="w-full border rounded-lg p-3" placeholder="..."></textarea>
                </div>

                <div class="mb-4">
                    <label class="block font-bold mb-2">Observasaun</label>
                    <textarea name="nota" rows="2"
                              class="w-full border rounded-lg p-3" placeholder="Informasaun seluk..."></textarea>
                </div>

                {{-- METODE PAGAMENTU --}}
                <h3 class="font-bold text-lg mb-4 mt-6">Hili Metode Pagamentu</h3>
                <label class="flex items-center gap-3 p-4 border-2 border-blue-500 rounded-lg cursor-pointer bg-blue-50 mb-6">
                    <input type="radio" name="metode" value="cod" checked class="w-5 h-5 text-blue-600">
                    <div>
                        <p class="font-bold text-lg">💵 COD — Pagamentu iha Tempo Entrega</p>
                        <p class="text-sm text-gray-500">Pagamento no entrega iha fatin</p>
                    </div>
                </label>

                <button type="submit" style="width:100%; background-color:#2563eb; color:#ffffff; padding:12px; border-radius:6px; font-weight:bold; font-size:18px; border:none; cursor:pointer;"">
                     prossesa agora
                </button>
            </form>
        </div>

        <a href="{{ route('cart.index') }}" class="block text-center text-gray-600">← Fila Raga Orderan</a>
    </div>
</x-app-layout>




