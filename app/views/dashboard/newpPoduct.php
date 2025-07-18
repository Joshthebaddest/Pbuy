<!-- Product Modal -->
<div id="productModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h3 id="modalTitle" class="text-lg font-semibold text-gray-900">Add New Product</h3>
                    <button id="closeModal" class="text-gray-400 hover:text-gray-600">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                </div>
            </div>
            <form id="productForm" class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Basic Information -->
                    <div class="space-y-4">
                        <h4 class="text-md font-semibold text-gray-900">Basic Information</h4>
                        
                        <div>
                            <label for="productName" class="block text-sm font-medium text-gray-700 mb-1">Product Name *</label>
                            <input type="text" id="productName" name="name" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                        </div>

                        <div>
                            <label for="productDescription" class="block text-sm font-medium text-gray-700 mb-1">Description *</label>
                            <textarea id="productDescription" name="description" rows="4" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"></textarea>
                        </div>

                        <div>
                            <label for="productCategory" class="block text-sm font-medium text-gray-700 mb-1">Category *</label>
                            <select id="productCategory" name="category" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                                <option value="">Select Category</option>
                                <option value="Electronics">Electronics</option>
                                <option value="Clothing">Clothing</option>
                                <option value="Home & Garden">Home & Garden</option>
                                <option value="Sports">Sports</option>
                                <option value="Books">Books</option>
                            </select>
                        </div>

                        <div>
                            <label for="productTags" class="block text-sm font-medium text-gray-700 mb-1">Tags</label>
                            <input type="text" id="productTags" name="tags" placeholder="Enter tags separated by commas" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                            <p class="text-xs text-gray-500 mt-1">Separate tags with commas</p>
                        </div>
                    </div>

                    <!-- Pricing & Inventory -->
                    <div class="space-y-4">
                        <h4 class="text-md font-semibold text-gray-900">Pricing & Inventory</h4>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="productPrice" class="block text-sm font-medium text-gray-700 mb-1">Price *</label>
                                <input type="number" id="productPrice" name="price" step="0.01" min="0" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                            </div>
                            <div>
                                <label for="productDiscount" class="block text-sm font-medium text-gray-700 mb-1">Discount (%)</label>
                                <input type="number" id="productDiscount" name="discount" min="0" max="100" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                            </div>
                        </div>

                        <div>
                            <label for="productStock" class="block text-sm font-medium text-gray-700 mb-1">Stock Quantity *</label>
                            <input type="number" id="productStock" name="stock" min="0" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                        </div>

                        <div class="flex items-center space-x-4">
                            <label class="flex items-center">
                                <input type="checkbox" id="isFeatured" name="isFeatured" class="rounded border-gray-300 text-primary focus:ring-primary">
                                <span class="ml-2 text-sm text-gray-700">Featured Product</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Images Section -->
                <div class="mt-6">
                    <h4 class="text-md font-semibold text-gray-900 mb-4">Product Images</h4>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                        <i data-lucide="upload" class="w-12 h-12 text-gray-400 mx-auto mb-4"></i>
                        <p class="text-gray-600 mb-2">Click to upload images or drag and drop</p>
                        <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                        <input type="file" id="productImages" multiple accept="image/*" class="hidden">
                        <button type="button" onclick="document.getElementById('productImages').click()" class="mt-4 bg-primary text-white px-4 py-2 rounded-lg hover:bg-orange-600 transition-colors">
                            Choose Files
                        </button>
                    </div>
                    <div id="imagePreview" class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-4"></div>
                </div>

                <!-- Variants Section -->
                <div class="mt-6">
                    <div class="flex justify-between items-center mb-4">
                        <h4 class="text-md font-semibold text-gray-900">Product Variants</h4>
                        <button type="button" id="addVariantBtn" class="bg-accent text-white px-3 py-1 rounded-lg hover:bg-emerald-600 transition-colors text-sm flex items-center space-x-1">
                            <i data-lucide="plus" class="w-4 h-4"></i>
                            <span>Add Variant</span>
                        </button>
                    </div>
                    <div id="variantsContainer" class="space-y-4">
                        <!-- Variants will be dynamically added here -->
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