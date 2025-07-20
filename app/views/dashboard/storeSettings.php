<div id="settings-page" class="page-content">
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-900">Store Settings</h2>
        <p class="mt-2 text-gray-600">Manage your store information and preferences.</p>
    </div>

    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Store Information</h3>
        </div>
        <div class="p-6 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Store Name</label>
                    <input type="text" value="John's Electronics" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Contact Email</label>
                    <input type="email" value="john@electronics.com" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Store Banner</label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                    <div class="space-y-1 text-center">
                        <i data-lucide="upload" class="mx-auto h-12 w-12 text-gray-400"></i>
                        <div class="flex text-sm text-gray-600">
                            <label class="relative cursor-pointer bg-white rounded-md font-medium text-primary hover:text-orange-600">
                                <span>Upload a file</span>
                                <input type="file" class="sr-only">
                            </label>
                            <p class="pl-1">or drag and drop</p>
                        </div>
                        <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">About Your Store</label>
                <textarea rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary" placeholder="Tell customers about your store...">We specialize in high-quality electronics and gadgets. Our mission is to provide the latest technology at competitive prices with excellent customer service.</textarea>
            </div>

            <div class="flex justify-end">
                <button class="px-6 py-2 bg-primary text-white rounded-md hover:bg-orange-600 transition-colors">
                    Save Changes
                </button>
            </div>
        </div>
    </div>
</div>