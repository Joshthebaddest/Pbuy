<?php 
    require_once __DIR__ . '/../../models/category.php';
    $categories = Category::query()->select('*')->get();
?>

<!-- Product Modal -->
<div id="productModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h3 id="modalTitle" class="text-lg font-semibold text-gray-900">Add New Product</h3>
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
                            <label for="productName" class="block text-sm font-medium text-gray-700 mb-1">Product Name *</label>
                            <input type="text" id="productName" name="product_name" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                        </div>

                        <div>
                            <label for="productDescription" class="block text-sm font-medium text-gray-700 mb-1">Description *</label>
                            <textarea id="productDescription" name="description" rows="4" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"></textarea>
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
                <div class="mb-10 mt-6">
                    <h4 class="text-md font-semibold text-gray-900 mb-4">Product Images</h4>
                    <div class="flex">    
                        <?php foreach(range(0, 4) as $num):?> 
                            <div class="relative w-36 h-36 mr-5">
                                <!-- Profile Image -->
                                <img
                                    id="profileImg"
                                    src="<?= !empty($images['img_url_'.$num]) ? $images['img_url_'.$num] : 'https://placehold.co/300x200?text=Upload+Image' ?>"
                                    alt=""
                                    class="img-prev w-full h-full object-cover border border-gray-300"
                                />
                                <?php if (!empty($errors['img_url_'.$num])): ?>
                                    <span class="text-red-600 text-xs"><?= htmlspecialchars($errors["img_url_".$num]) ?></span>
                                <?php endif; ?>

                                <!-- Overlay -->
                                <label for="fileInput_<?= $num ?>" class="absolute inset-0 bg-black bg-opacity-50 flex flex-col items-center justify-center opacity-0 hover:opacity-100 transition-opacity cursor-pointer">
                                    <svg class="w-6 h-6 text-white mb-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.276A2 2 0 0122 9.618V18a2 2 0 01-2 2H4a2 2 0 01-2-2V6a2 2 0 012-2h5l2-2h4l2 2h5a2 2 0 012 2v3.618a2 2 0 01-2.447 1.894L15 10z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15l-4-4m0 0l4-4m-4 4h16" />
                                    </svg>
                                    <span class="text-white text-xs font-semibold">Add Photo</span>
                                </label>

                                <input type="file" class="hidden imgInput" id="fileInput_<?= $num ?>" name="img_url_<?= $num ?>" accept="image/*">
                    
                                <!-- Hidden field to retain existing image URL if no new file is selected -->
                                <input type="hidden" name="img_url_<?= $num ?>" value="<?= !empty($images['img_url_'.$num]) ? htmlspecialchars($images['img_url_'.$num]) : '' ?>">
                            </div>
                        <?php endforeach ;?>
                        <?php if (!empty($errors['images'])): ?>
                            <span class="text-red-600 text-xs"><?= htmlspecialchars($errors["images"]) ?></span>
                        <?php endif; ?>
                    </div>
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
