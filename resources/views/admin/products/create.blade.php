<x-app-layout>
    <div class="container mx-auto px-4 py-6 max-w-2xl">
        <h1 style="font-size: 1.5rem; font-weight: bold; margin-bottom: 24px;">Aumenta produtu foun</h1>

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" 
              style="background: white; padding: 24px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
            @csrf

            <div style="margin-bottom: 16px;">
                <label style="display: block; font-weight: bold; margin-bottom: 6px;">Naran Produtu</label>
                <input type="text" name="name" required 
                       style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 16px;">
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; font-weight: bold; margin-bottom: 6px;">Deskripsaun</label>
                <textarea name="description" rows="3" 
                          style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 16px;"></textarea>
            </div>

            <div style="display: flex; gap: 16px; margin-bottom: 16px;">
                <div style="flex: 1;">
                    <label style="display: block; font-weight: bold; margin-bottom: 6px;">Folin ($)</label>
                    <input type="number" name="price" step="0.01" required 
                           style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 16px;">
                </div>
                <div style="flex: 1;">
                    <label style="display: block; font-weight: bold; margin-bottom: 6px;">Stok</label>
                    <input type="number" name="stock" required 
                           style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 16px;">
                </div>
            </div>

            <div style="margin-bottom: 24px;">
                <label style="display: block; font-weight: bold; margin-bottom: 6px;">Foto Produtu</label>
                <input type="file" name="image" accept="image/*" 
                       style="width: 100%; padding: 8px; font-size: 15px;">
            </div>

            <div class="mb-4">
                <label class="block font-bold mb-2">Kategoria</label>
                     <select name="category_id" class="w-full border rounded-lg p-2" required>
                        <option value="">-- Hili Kategoria --</option>
                        <option value="1">Ropa / Kalsa</option>
                        <option value="2">Ropa Boxing</option>
                        <option value="3">Equipamentu Boxing</option>
                    </select>
            </div>
           

            <button type="submit" 
                    style="background: #2563eb; color: white; padding: 12px 30px; border: none; border-radius: 8px; font-size: 16px; font-weight: bold; cursor: pointer;">
                Save Produtu
            </button>
        </form>
    </div>
</x-app-layout>
