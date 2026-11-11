<x-app-layout>
    <div class="container mx-auto px-4 py-8 max-w-2xl">
        <div class="bg-white rounded-xl shadow-lg p-8">
            
            {{-- Judul --}}
            <div class="text-center mb-6">
                <h1 class="text-2xl font-bold text-green-600">✅ Nota Transaksaun rai ho susesu!</h1>
                <p class="text-gray-600">Karaubox Store — Nota Transaksaun</p>
            </div>
            @php
             $dados = session('dados_kliente', []);
            @endphp
            {{-- Data Klien --}}
            <div class="border-b pb-4 mb-4">
                <p class="font-bold">Naran: {{ $dados['nome'] ?? '-' }}</p>
                <p>Telefone: {{ $dados['telefone'] ?? '-' }}</p>
                <p>Enderesu: {{ $dados['enderesu'] ?? '-' }}</p>
                @if(!empty($dados['nota']))
                    <p>Nota: {{ $dados['nota'] }}</p>
                @endif
                <p>Metode Pagamentu: 📦 COD — Pagamentu iha entrega</p>
                <p>Data: {{ now()->format('d/m/Y H:i') }}</p>
            </div>

            {{-- Lista Produtu --}}
            <h3 class="font-bold mb-3">Lista Produtu:</h3>
            <table class="w-full mb-4">
                @php $total = 0; @endphp
                @foreach($cart as $item)
                    @php $total += $item['price'] * $item['quantity']; @endphp
                    <tr class="border-b">
                        <td class="py-2">{{ $item['name'] }}</td>
                        <td class="py-2 text-center">{{ $item['quantity'] }}</td>
                        <td class="py-2 text-right">${{ number_format($item['price'], 2) }}</td>
                    </tr>
                @endforeach
                <tr class="font-bold text-lg">
                    <td colspan="2" class="py-3">Total Hamutuk:</td>
                    <td class="py-3 text-right text-blue-600">${{ number_format($total, 2) }}</td>
                </tr>
            </table>

            {{-- Tombol --}}
            <div class="flex justify-center gap-4 mt-6">
                <a href="{{ route('home') }}"
                   style="background-color: #3b82f6; color: white; padding: 12px 32px; border-radius: 15px; font-weight: bold; text-decoration: none;">
                    Hola Seluk
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
