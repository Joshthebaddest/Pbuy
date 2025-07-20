<div class="modal-overlay fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-xl p-6 w-full max-w-3xl mx-4 max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-semibold text-gray-900">Order Details - ${order.id}</h3>
            <button class="modal-close text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div>
                <h5 class="font-semibold text-gray-900 mb-3">Order Information</h5>
                <div class="space-y-2 text-sm">
                    <p><span class="font-medium">Order ID:</span> ${order.id}</p>
                    <p><span class="font-medium">Customer:</span> ${order.customer}</p>
                    <p><span class="font-medium">Vendor:</span> ${order.vendor}</p>
                    <p><span class="font-medium">Date:</span> ${order.date}</p>
                    <p><span class="font-medium">Status:</span> <span class="status-badge status-${order.status === 'delivered' ? 'approved' : order.status}">${order.status}</span></p>
                    <p><span class="font-medium">Total:</span> ${order.total}</p>
                </div>
            </div>
            <div>
                <h5 class="font-semibold text-gray-900 mb-3">Shipping Information</h5>
                <div class="space-y-2 text-sm">
                    <p><span class="font-medium">Address:</span> 123 Main St, City, State 12345</p>
                    <p><span class="font-medium">Phone:</span> (555) 123-4567</p>
                    <p><span class="font-medium">Shipping Method:</span> Standard Delivery</p>
                    <p><span class="font-medium">Tracking:</span> TRK123456789</p>
                    <p><span class="font-medium">Estimated Delivery:</span> Jan 20, 2024</p>
                </div>
            </div>
        </div>
        <div class="mt-6">
            <h5 class="font-semibold text-gray-900 mb-3">Order Items</h5>
            <div class="border rounded-lg overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-900">Product</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-900">Quantity</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-900">Price</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-900">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-t">
                            <td class="px-4 py-2 text-sm">Wireless Headphones</td>
                            <td class="px-4 py-2 text-sm">1</td>
                            <td class="px-4 py-2 text-sm">$89.99</td>
                            <td class="px-4 py-2 text-sm font-medium">$89.99</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="flex justify-end space-x-3 pt-6 border-t mt-6">
            <button class="modal-close px-4 py-2 text-gray-600 hover:text-gray-800">Close</button>
            <button class="btn-secondary">Update Status</button>
            <button class="btn-primary">Contact Customer</button>
        </div>
    </div>
</div>