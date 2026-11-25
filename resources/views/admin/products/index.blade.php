
<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
            <h1 style="font-size: 1.5rem; font-weight: bold;">Manajementu Produtu</h1>
            <a href="{{ route('admin.products.create') }}" style="background: #2563eb; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: bold;">
                + Aumenta produtu foun
            </a>
        </div>

        @if(session('success'))
            <div style="background: #dcfce7; color: #166534; padding: 12px; border-radius: 8px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        <table style="width: 100%; border-collapse: collapse; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
            <thead>
                <tr style="background: #f3f4f6;">
                    <th style="padding: 12px; text-align: left; border-bottom: 1px solid #e5e7eb;">Foto</th>
                    <th style="padding: 12px; text-align: left; border-bottom: 1px solid #e5e7eb;">Naran produtu</th>
                    <th style="padding: 12px; text-align: left; border-bottom: 1px solid #e5e7eb;">folin</th>
                    <th style="padding: 12px; text-align: left; border-bottom: 1px solid #e5e7eb;">Stok</th>
                    <th style="padding: 12px; text-align: left; border-bottom: 1px solid #e5e7eb;">Aksaun</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $p)
                <tr>
                    <td style="padding: 12px; border-bottom: 1px solid #e5e7eb;">
                        @if($p->image)
                            <img src="{{ asset('products/' . $p->image) }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                        @else
                            -
                        @endif
                    </td>
                    <td style="padding: 12px; border-bottom: 1px solid #e5e7eb;">{{ $p->name }}</td>
                    <td style="padding: 12px; border-bottom: 1px solid #e5e7eb;">${{ number_format($p->price, 2) }}</td>
                    <td style="padding: 12px; border-bottom: 1px solid #e5e7eb;">{{ $p->stock }}</td>
                    <td style="padding: 12px; border-bottom: 1px solid #e5e7eb;">
                        {{-- Ikon Edit --}}
                        <a href="{{ route('admin.products.edit', $p->id) }}" style="background: #facc15; color: black; padding: 7px; border-radius: 4px; text-decoration: none; display:inline-block;">
                            ✏️
                        </a>
                        {{-- Ikon Hapus --}}
                        <form action="{{ route('admin.products.destroy', $p->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Tebes atu hamos?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: #ef4444; color: white; padding: 7px; border-radius: 4px; border:none; cursor:pointer;">
                                🗑️
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
