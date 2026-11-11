<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-6">Produk Hotu-Hotu</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($products as $p)
            <div class="border rounded-xl overflow-hidden shadow hover:shadow-lg transition">
                <div class="h-48 bg-gray-100 flex items-center justify-center text-gray-500">Foto Produtu</div>
                <div class="p-4">
                    <h3 class="font-bold text-lg mb-2">{{ $p->name }}</h3>
                    <p class="text-green-600 font-bold text-xl mb-3">${{ number_format($p->price, 2) }}</p>
                    <div class="flex gap-2">
                        <a href="{{ route('products.show', $p->id) }}" class="flex-1 text-center bg-gray-200 py-2 rounded-lg hover:bg-gray-300">Detail</a>
                        @auth
                        <form action="{{ route('cart.add', $p->id) }}" method="POST" class="flex-1">
                            @csrf
                            <button class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">Hola</button>
                        </form>
                        @endauth
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>

