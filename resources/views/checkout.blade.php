<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-6 text-center">Pagamentu</h1>
        
        <div class="max-w-xl mx-auto bg-white rounded-xl shadow p-6">
            <h3 class="font-bold text-lg mb-4">Hili metodu Pagamentu</h3>
            
            <div class="space-y-4 mb-8">
                <label class="flex items-center gap-3 p-4 border rounded-lg cursor-pointer hover:bg-gray-50">
                    <input type="radio" name="payment" value="bank" class="w-5 h-5">
                    <div>
                        <p class="font-bold">Transfer Bank BRI Timor-Leste</p>
                        <p class="text-sm text-gray-500">
                            Bank BRI Timor-Leste<br>
                            No. Rekening: 0012345678<br>
                            Atas Nama: Karaubox Store
                        </p>
                    </div>
                </label>
                
                <label class="flex items-center gap-3 p-4 border rounded-lg cursor-pointer hover:bg-gray-50">
                    <input type="radio" name="payment" value="mosan" class="w-5 h-5">
                    <div>
                        <p class="font-bold">Mosan — Timor-Leste</p>
                        <p class="text-sm text-gray-500">
                            Nomor: +670 777 123 456<br>
                            Nama: Karaubox Store
                        </p>
                    </div>
                </label>
            </div>

            <h3 class="font-bold text-lg mb-2">Rezumu Pedidu</h3>
            @php $total = 0; @endphp
            @foreach($cartItems as $item)
                @php $total += $item->product->price * $item->quantity; @endphp
                <p>{{ $item->product->name }} × {{ $item->quantity }} — ${{ number_format($item->product->price * $item->quantity, 2) }}</p>
            @endforeach
            <p class="font-bold text-xl text-green-600 mt-3">Total: ${{ number_format($total, 2) }}</p>

            <button class="w-full mt-6 bg-green-600 text-white py-3 rounded-lg text-lg hover:bg-green-700">Konfirmasi Pesanan</button>
        </div>
    </div>
</x-app-layout>
