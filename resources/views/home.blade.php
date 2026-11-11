<x-app-layout>
    <div class="container mx-auto px-4 py-6">
            @if(request()->has('search') && request()->search != '')
                <p class="mb-4 text-gray-600">Hasil cari untuk: <strong>{{ request()->search }}</strong></p>
            @endif

        <!-- Pencarian -->

        <!-- Judul -->
        <h2 style="font-size: 1.5rem; font-weight: bold; margin-bottom: 24px;">Produtu Ropa Foun</h2>

        <!-- 🔥 1 BARIS = 4 KOTAK PERSIS 🔥 -->
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px;">
            
            @foreach($products as $p)
            <div style="border: 1px solid #e5e7eb; border-radius: 8px; overflow: hidden; background: #fff;">
                
                <!-- Foto -->
                <div style="width: 100%; height: 180px; background: #f3f4f6; display: flex; align-items: center; justify-content: center;">
                    @if($p->image)
                        <img src="{{ asset('products/' . $p->image) }}" alt="{{ $p->name }}" 
                             style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                        Produtu kualidade
                    @endif
                </div>

                <!-- Nama & Harga -->
                <div style="padding: 12px;">
                    <h3 style="font-size: 14px; font-weight: 500; margin: 0 0 6px 0;">{{ $p->name }}</h3>
                    <p style="font-size: 15px; font-weight: bold; color: #16a34a; margin: 0 0 12px 0;">${{ number_format($p->price, 2) }}</p>

                    <!-- Tombol -->
                    <div style="display: flex; gap: 8px;">
                        @auth
                            <form action="{{ route('cart.add', $p->id) }}" method="POST" style="flex: 1;">
                                @csrf
                                <button style="width: 100%; background: #2563eb; color: white; border: none; padding: 8px 0; border-radius: 4px; font-weight: bold; cursor: pointer;">
                                    Hola
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" style="flex: 1; text-decoration: none;">
                                <button style="width: 100%; background: #2563eb; color: white; border: none; padding: 8px 0; border-radius: 4px; font-weight: bold; cursor: pointer;">
                                    Hola
                                </button>
                            </a>
                        @endauth

                        <a href="{{ route('products.show', $p->id) }}" 
                           style="flex: 1; background: #e5e7eb; color: #333; text-align: center; padding: 8px 0; border-radius: 4px; text-decoration: none; font-weight: bold; font-size: 14px;">
                            Detail
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
