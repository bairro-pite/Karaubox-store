<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <div class="max-w-2xl mx-auto bg-white rounded-xl shadow p-6">
            <div class="h-64 bg-gray-100 flex items-center justify-center text-gray-500 mb-6 rounded-lg">Foto Produk</div>
            <h1 class="text-3xl font-bold mb-4">{{ $product->name }}</h1>
            <p class="text-green-600 font-bold text-3xl mb-4">${{ number_format($product->price, 2) }}</p>
            <p class="text-gray-600 mb-6">{{ $product->description }}</p>
            <p class="mb-6">Stok: {{ $product->stock }}</p>
            @auth
            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                @csrf
                <button class="w-full bg-blue-600 text-white py-3 rounded-lg text-lg hover:bg-blue-700">aumenta iha Raga</button>
            </form>
            @else
            <a href="{{ route('login') }}" class="block text-center bg-gray-600 text-white py-3 rounded-lg hover:bg-gray-700">Login hodi hola</a>
            @endauth
        </div>
    </div>
</x-app-layout>

