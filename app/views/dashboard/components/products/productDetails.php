<div class="modal-overlay product-details fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-xl p-6 w-full max-w-3xl mx-4 max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-semibold text-gray-900">Product Details</h3>
            <button id="close-product-details" class="modal-close text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div>
                <div class="w-full h-64 bg-gray-200 rounded-lg mb-4 flex items-center justify-center">
                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h4 class="text-lg font-semibold text-gray-900 mb-2"><?php echo htmlspecialchars($row['product_name']); ?></h4>
                <p class="text-gray-600 mb-4"><?php echo htmlspecialchars($row['description']); ?></p>
            </div>
            <div class="space-y-4">
                <div>
                    <h5 class="font-semibold text-gray-900 mb-2">Product Information</h5>
                    <div class="space-y-2 text-sm">
                        <p><span class="font-medium">Vendor:</span> <?php echo htmlspecialchars($row['username']); ?></p>
                        <p><span class="font-medium">Category:</span> <?php echo htmlspecialchars($row['category_id']); ?></p>
                        <p><span class="font-medium">Price:</span> <?php echo htmlspecialchars($row['price']); ?></p>
                        <p><span class="font-medium">Status:</span> <span class="status-badge status-<?php echo htmlspecialchars($row['status']); ?>"><?php echo htmlspecialchars($row['status']); ?></span></p>
                        <p><span class="font-medium">Stock:</span> <?php echo htmlspecialchars($row['quantity']); ?> units</p>
                        <p><span class="font-medium">SKU:</span> PRD-<?php echo htmlspecialchars($row['id']); ?></p>
                    </div>
                </div>
                <div>
                    <h5 class="font-semibold text-gray-900 mb-2">Sales Stats</h5>
                    <div class="space-y-2 text-sm">
                        <p><span class="font-medium">Total Sales:</span> 234 units</p>
                        <p><span class="font-medium">Revenue:</span> $23,400</p>
                        <p><span class="font-medium">Reviews:</span> 4.5/5 (89 reviews)</p>
                        <p><span class="font-medium">Views:</span> 12,847</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>