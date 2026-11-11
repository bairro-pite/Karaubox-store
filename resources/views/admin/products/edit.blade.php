<x-app-layout>
    <div class="container mx-auto px-4 py-8 max-w-2xl">
        <h1 class="text-2xl font-bold mb-6">✏️ Edit Produk</h1>
        <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Nama Produk</label>
                <input type="text" name="name" value="{{ old('name',$product->name) }}" class="w-full border rounded-lg p-2" required>
                @error('name')<p class="text-red-500 text-sm">{{$message}}</p>@enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Deskripsi</label>
                <textarea name="description" class="w-full border rounded-lg p-2">{{ old('description',$product->description) }}</textarea>
                @error('description')<p class="text-red-500 text-sm">{{$message}}</p>@enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Harga</label>
                <input type="number" name="price" value="{{ old('price',$product->price) }}" class="w-full border rounded-lg p-2" required>
                @error('price')<p class="text-red-500 text-sm">{{$message}}</p>@enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Stok</label>
                <input type="number" name="stock" value="{{ old('stock',$product->stock) }}" class="w-full border rounded-lg p-2" required>
                @error('stock')<p class="text-red-500 text-sm">{{$message}}</p>@enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Category ID</label>
                <input type="number" name="category_id" value="{{ old('category_id',$product->category_id) }}" class="w-full border rounded-lg p-2" required>
                @error('category_id')<p class="text-red-500 text-sm">{{$message}}</p>@enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Foto Baru (jika mau ganti)</label>
                <input type="file" name="image" class="w-full border rounded-lg p-2">
                @if($product->image)
                    <img src="{{ asset('products/'.$product->image) }}" class="h-20 mt-2">
                @endif
                @error('image')<p class="text-red-500 text-sm">{{$message}}</p>@enderror
            </div>

            {{-- Tombol Update pakai Ikon 💾 --}}
            <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded-lg font-medium">
                💾 Update
            </button>
            <a href="{{ route('admin.products.index') }}" class="ml-3 text-gray-500">Batal</a>
        </form>
    </div>
</x-app-layout>


