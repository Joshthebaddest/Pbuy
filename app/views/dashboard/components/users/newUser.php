<div id="productModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h3 id="modalTitle" class="text-lg font-semibold text-gray-900">Add New User</h3>
                    <button id="closeModal" class="text-gray-400 border hover:text-gray-600">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                </div>
            </div>
            <form action="/pbuy/public/dashboard/products?action=create" method="POST" id="productForm" class="p-6" enctype="multipart/form-data">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Basic Information -->
                    <div class="space-y-4">
                        <h4 class="text-md font-semibold text-gray-900">Basic Information</h4>
                        
                        <div>
                            <label for="userName" class="block text-sm font-medium text-gray-700 mb-1">User Name *</label>
                            <input type="text" id="userName" name="user_name" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                        </div>

                        <div>
                            <label for="userEmail" class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                            <input type="email" id="userEmail" name="user_email" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                        </div>

                        <div>
                            <label for="userPassword" class="block text-sm font-medium text-gray-700 mb-1">Password *</label>
                            <input type="password" id="userPassword" name="user_password" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                        </div>

                        <div>
                            <label for="userRole" class="block text-sm font-medium text-gray-700 mb-1">Role *</label>
                            <select id="userRole" name="user_role" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                                <option value="">Select Role</option>
                                <option value="admin">Admin</option>
                                <option value="vendor">Vendor</option>
                                <option value="customer">Customer</option>
                            </select>
                        </div>
                        </div>

                        <div>
                            <label for="productCategory" class="block text-sm font-medium text-gray-700 mb-1">Category *</label>
                            <select id="productCategory" name="category_id" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                                <option value="">Select Category</option>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= htmlspecialchars($category['id']) ?>">
                                        <?= htmlspecialchars($category['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>

                        </div>

                        <div>
                            <label for="productTags" class="block text-sm font-medium text-gray-700 mb-1">Tags</label>
                            <input type="text" id="productTags" name="tags" placeholder="Enter tags separated by commas" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                            <p class="text-xs text-gray-500 mt-1">Separate tags with commas</p>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end space-x-4 mt-8 pt-6 border-t border-gray-200">
                    <button type="button" id="cancelBtn" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                        Cancel
                    </button>
                    <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-orange-600 transition-colors">
                        Save Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>