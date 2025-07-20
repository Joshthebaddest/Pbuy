<?php
    $categories = [
      [ 'name' => 'Electronics', 'count' => 1247, 'icon' => 'smartphone' ],
      [ 'name' => 'Fashion', 'count' => 892, 'icon' => 'shirt' ],
      [ 'name' => 'Home & Garden', 'count' => 634, 'icon' => 'home' ],
      [ 'name' => 'Sports', 'count' => 456, 'icon' => 'activity' ],
      [ 'name' => 'Books', 'count' => 321, 'icon' => 'book' ],
      [ 'name' => 'Toys', 'count' => 234, 'icon' => 'gift' ]
    ];

    $tags = ['trending', 'bestseller', 'new-arrival', 'sale', 'premium', 'eco-friendly', 'limited-edition', 'popular'];
?>

<div class="space-y-6">
    <!-- Header with actions -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h3 class="text-lg font-semibold text-gray-900">Categories & Tags</h3>
            <p class="text-gray-600">Manage product categories and tags</p>
        </div>
        <button class="bg-gradient-to-br from-orange-500 to-orange-600 text-white px-6 py-3 rounded-lg font-semibold transition duration-200 ease-in-out inline-flex items-center justify-center gap-2 border-0 cursor-pointer no-underline" id="add-category">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            <span>Add Category</span>
        </button>
    </div>

    <!-- Categories Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach($categories as $category): ?>
       <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
                <button class="text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                    </svg>
                </button>
            </div>
            <h4 class="text-lg font-semibold text-gray-900 mb-2"><?= $category['name'] ?></h4>
            <p class="text-gray-600"><?= $category['count'] ?> products</p>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Tags Section -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="p-6 border-b border-gray-200 flex items-center justify-between">
            <h4 class="text-lg font-semibold text-gray-900">Popular Tags</h4>
            <button class="bg-gray-200 text-gray-700 px-6 py-3 rounded-lg font-semibold transition duration-200 ease-in-out inline-flex items-center justify-center gap-2 border-0 cursor-pointer no-underline" id="add-tag">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                <span>Add Tag</span>
            </button>
        </div>
        <div class="p-6">
            <div class="flex flex-wrap gap-2">
                <?php foreach($tags as $tag): ?>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-gray-100 text-gray-700 hover:bg-gray-200 cursor-pointer">
                    <?= $tag ?> 
                    <button class="ml-2 text-gray-400 hover:text-red-500">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </span>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<!-- category Modal -->
<div id="add-category-modal" class="modal-overlay fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-xl p-6 w-full max-w-md mx-4">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Add New Category</h3>
            <button class="modal-close text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <form action="/pbuy/public/dashboard/categories?action=add-category" method="POST" class="modal-form space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Category Name</label>
                <input type="text" name="name" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-transparent">
            </div>
            <div>

            </div>
            <div class="flex justify-end space-x-3 pt-4">
                <button type="button" class="modal-close px-4 py-2 text-gray-600 hover:text-gray-800">Cancel</button>
                <button type="submit" class="bg-gradient-to-br from-orange-500 to-orange-600 text-white px-6 py-3 rounded-lg font-semibold">Add Category</button>
            </div>
        </form>
    </div>
</div>

<!-- Tag Modal -->
<div id="add-tag-modal" class="modal-overlay fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-xl p-6 w-full max-w-md mx-4">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Add New Tag</h3>
            <button class="modal-close text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <form action="/pbuy/public/dashboard/categories?action=add-tag" method="POST" class="modal-form space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tag Name</label>
                <input type="text" name="name" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-transparent">
            </div>
            <div class="flex justify-end space-x-3 pt-4">
                <button type="button" class="modal-close px-4 py-2 text-gray-600 hover:text-gray-800">Cancel</button>
                <button type="submit" class="bg-gradient-to-br from-orange-500 to-orange-600 text-white px-6 py-3 rounded-lg font-semibold">Add Tag</button>
            </div>
        </form>
    </div>
</div>


<script>
    document.getElementById('add-category').addEventListener('click', function() {
        document.getElementById('add-category-modal').classList.remove('hidden');
    });
    document.getElementById('add-tag').addEventListener('click', function() {
        document.getElementById('add-tag-modal').classList.remove('hidden');
    });
    Array.from(document.getElementsByClassName('modal-close')).forEach(function(element) {
        element.addEventListener('click', function() {
            element.closest('.modal-overlay').classList.add('hidden');
        });
    });
</script>

