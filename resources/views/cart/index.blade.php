<x-app-layout>
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        
        <h1 class="text-2xl font-bold text-center mb-8 text-gray-800">🛒 Raga Orderan</h1>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 p-4 rounded-xl mb-6 text-center font-medium">
                ✅ {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-lg p-6">
            
            {{-- TABEL --}}
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-blue-600 text-black">
                            <th class="border border-gray-200 p-3 text-center w-16">No</th>
                            <th class="border border-gray-200 p-3 text-left">Naran Ropa</th>
                            <th class="border border-gray-200 p-3 text-center w-32">Presu</th>
                            <th class="border border-gray-200 p-3 text-center w-32">Kuantidade</th>
                            <th class="border border-gray-200 p-3 text-right w-36">Subtotal</th>
                            <th class="border border-gray-200 p-3 text-center w-28">Asaun</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @if(empty($cart))
                            <tr>
                                <td colspan="6" class="border border-gray-200 p-8 text-center text-gray-500">
                                    <div class="text-4xl mb-4">🛒</div>
                                    <p class="text-lg font-medium">Raga Orderan Ita Sei Mamuk</p>
                                    <a href="{{ route('home') }}" class="inline-block mt-4 bg-blue-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-blue-700">
                                        Hola Produtu
                                    </a>
                                </td>
                            </tr>
                        @else
                            @foreach($cart as $id => $item)
                                @php $subtotal = $item['price'] * $item['quantity']; $total += $subtotal; @endphp
                                <tr class="hover:bg-gray-50">
                                    <td class="border border-gray-200 p-3 text-center font-medium">{{ $loop->iteration }}</td>
                                    <td class="border border-gray-200 p-3 font-bold">{{ $item['name'] }}</td>
                                    <td class="border border-gray-200 p-3 text-center">${{ number_format($item['price'], 2) }}</td>
                                    <td class="border border-gray-200 p-3 text-center">{{ $item['quantity'] }}</td>
                                    <td class="border border-gray-200 p-3 text-right font-semibold">${{ number_format($subtotal, 2) }}</td>
                                    <td class="border border-gray-200 p-3 text-center">
                                        <a href="{{ route('cart.remove', $id) }}" 
                                           class="bg-red-500 text-white px-3 py-1 rounded text-sm font-bold hover:bg-red-600"
                                           onclick="return confirm('Tebes hamos item ida ne?')">
                                            Hamos
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            <tr class="bg-gray-50 font-bold">
                                <td colspan="4" class="border border-gray-200 p-3 text-right text-lg">Total:</td>
                                <td class="border border-gray-200 p-3 text-right text-lg text-blue-600">${{ number_format($total, 2) }}</td>
                                <td class="border border-gray-200"></td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            {{-- TOMBOL --}}
            @if(!empty($cart))
                <div class="flex flex-col sm:flex-row gap-4 mt-6 pt-4">
                    <a href="{{ route('home') }}" 
                       class="flex-1 bg-gray-500 text-white py-3 rounded-xl font-bold text-center hover:bg-gray-600">
                        ← Kontinua Hola
                    </a>
                    <a href="{{ route('checkout') }}" 
                       class="flex-1 bg-blue-600 text-black py-3 rounded-xl font-bold text-center hover:bg-blue-700">
                        Checkout →
                    </a>
                </div> 
            @endif
        </div>
    </div>
</x-app-layout>
