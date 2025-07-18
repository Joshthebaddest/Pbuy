    <!-- Main Content -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex gap-8">
        <!-- Sidebar Filters -->
        <aside class="w-80 flex-shrink-0">
          <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <h2 class="text-lg font-semibold text-text mb-6">Filters</h2>
            
            <!-- Category Filter -->
            <div class="mb-6">
              <h3 class="text-sm font-medium text-text mb-3">Category</h3>
              <div class="space-y-2">
                <label class="flex items-center">
                  <input type="checkbox" class="rounded border-gray-300 text-primary focus:ring-primary" value="electronics">
                  <span class="ml-2 text-sm text-gray-600">Electronics</span>
                  <span class="ml-auto text-xs text-gray-400">(245)</span>
                </label>
                <label class="flex items-center">
                  <input type="checkbox" class="rounded border-gray-300 text-primary focus:ring-primary" value="fashion">
                  <span class="ml-2 text-sm text-gray-600">Fashion</span>
                  <span class="ml-auto text-xs text-gray-400">(189)</span>
                </label>
                <label class="flex items-center">
                  <input type="checkbox" class="rounded border-gray-300 text-primary focus:ring-primary" value="home">
                  <span class="ml-2 text-sm text-gray-600">Home & Garden</span>
                  <span class="ml-auto text-xs text-gray-400">(156)</span>
                </label>
                <label class="flex items-center">
                  <input type="checkbox" class="rounded border-gray-300 text-primary focus:ring-primary" value="sports">
                  <span class="ml-2 text-sm text-gray-600">Sports</span>
                  <span class="ml-auto text-xs text-gray-400">(98)</span>
                </label>
              </div>
            </div>

            <!-- Brand Filter -->
            <div class="mb-6">
              <h3 class="text-sm font-medium text-text mb-3">Brand</h3>
              <div class="space-y-2">
                <label class="flex items-center">
                  <input type="checkbox" class="rounded border-gray-300 text-primary focus:ring-primary" value="apple">
                  <span class="ml-2 text-sm text-gray-600">Apple</span>
                  <span class="ml-auto text-xs text-gray-400">(45)</span>
                </label>
                <label class="flex items-center">
                  <input type="checkbox" class="rounded border-gray-300 text-primary focus:ring-primary" value="samsung">
                  <span class="ml-2 text-sm text-gray-600">Samsung</span>
                  <span class="ml-auto text-xs text-gray-400">(38)</span>
                </label>
                <label class="flex items-center">
                  <input type="checkbox" class="rounded border-gray-300 text-primary focus:ring-primary" value="nike">
                  <span class="ml-2 text-sm text-gray-600">Nike</span>
                  <span class="ml-auto text-xs text-gray-400">(67)</span>
                </label>
                <label class="flex items-center">
                  <input type="checkbox" class="rounded border-gray-300 text-primary focus:ring-primary" value="adidas">
                  <span class="ml-2 text-sm text-gray-600">Adidas</span>
                  <span class="ml-auto text-xs text-gray-400">(52)</span>
                </label>
              </div>
            </div>

            <!-- Price Range -->
            <div class="mb-6">
              <h3 class="text-sm font-medium text-text mb-3">Price Range</h3>
              <div class="space-y-3">
                <div class="flex items-center space-x-2">
                  <input type="number" placeholder="Min" class="w-20 px-2 py-1 border border-gray-300 rounded text-sm">
                  <span class="text-gray-400">-</span>
                  <input type="number" placeholder="Max" class="w-20 px-2 py-1 border border-gray-300 rounded text-sm">
                </div>
                <div class="space-y-2">
                  <label class="flex items-center">
                    <input type="radio" name="priceRange" class="text-primary focus:ring-primary" value="0-50">
                    <span class="ml-2 text-sm text-gray-600">Under $50</span>
                  </label>
                  <label class="flex items-center">
                    <input type="radio" name="priceRange" class="text-primary focus:ring-primary" value="50-100">
                    <span class="ml-2 text-sm text-gray-600">$50 - $100</span>
                  </label>
                  <label class="flex items-center">
                    <input type="radio" name="priceRange" class="text-primary focus:ring-primary" value="100-500">
                    <span class="ml-2 text-sm text-gray-600">$100 - $500</span>
                  </label>
                  <label class="flex items-center">
                    <input type="radio" name="priceRange" class="text-primary focus:ring-primary" value="500+">
                    <span class="ml-2 text-sm text-gray-600">$500+</span>
                  </label>
                </div>
              </div>
            </div>

            <!-- Rating Filter -->
            <div class="mb-6">
              <h3 class="text-sm font-medium text-text mb-3">Rating</h3>
              <div class="space-y-2">
                <label class="flex items-center">
                  <input type="checkbox" class="rounded border-gray-300 text-primary focus:ring-primary" value="4+">
                  <span class="ml-2 flex items-center">
                    <div class="flex text-yellow-400">
                      <i data-lucide="star" class="h-4 w-4 fill-current"></i>
                      <i data-lucide="star" class="h-4 w-4 fill-current"></i>
                      <i data-lucide="star" class="h-4 w-4 fill-current"></i>
                      <i data-lucide="star" class="h-4 w-4 fill-current"></i>
                    </div>
                    <span class="ml-1 text-sm text-gray-600">& Up</span>
                  </span>
                </label>
                <label class="flex items-center">
                  <input type="checkbox" class="rounded border-gray-300 text-primary focus:ring-primary" value="3+">
                  <span class="ml-2 flex items-center">
                    <div class="flex text-yellow-400">
                      <i data-lucide="star" class="h-4 w-4 fill-current"></i>
                      <i data-lucide="star" class="h-4 w-4 fill-current"></i>
                      <i data-lucide="star" class="h-4 w-4 fill-current"></i>
                    </div>
                    <span class="ml-1 text-sm text-gray-600">& Up</span>
                  </span>
                </label>
              </div>
            </div>

            <!-- Availability -->
            <div class="mb-6">
              <h3 class="text-sm font-medium text-text mb-3">Availability</h3>
              <div class="space-y-2">
                <label class="flex items-center">
                  <input type="checkbox" class="rounded border-gray-300 text-primary focus:ring-primary" value="in-stock">
                  <span class="ml-2 text-sm text-gray-600">In Stock</span>
                </label>
                <label class="flex items-center">
                  <input type="checkbox" class="rounded border-gray-300 text-primary focus:ring-primary" value="on-sale">
                  <span class="ml-2 text-sm text-gray-600">On Sale</span>
                </label>
              </div>
            </div>

            <!-- Clear Filters -->
            <button class="w-full py-2 px-4 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">
              Clear All Filters
            </button>
          </div>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1">
          <!-- Search Results Header -->
          <div class="flex items-center justify-between mb-6">
            <div>
              <h2 class="text-2xl font-bold text-text">Search Results</h2>
              <p class="text-gray-600 mt-1">Showing 1,247 products</p>
            </div>
            
            <!-- Sort Options -->
            <div class="flex items-center space-x-4">
              <span class="text-sm text-gray-600">Sort by:</span>
              <select class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                <option value="relevance">Relevance</option>
                <option value="latest">Latest</option>
                <option value="price-low">Price: Low to High</option>
                <option value="price-high">Price: High to Low</option>
                <option value="rating">Highest Rated</option>
              </select>
            </div>
          </div>

          <!-- Trending Tags -->
          <div class="mb-6">
            <h3 class="text-sm font-medium text-text mb-3">Trending Tags</h3>
            <div class="flex flex-wrap gap-2">
              <span class="px-3 py-1 bg-primary/10 text-primary rounded-full text-sm cursor-pointer hover:bg-primary/20 transition-colors">wireless earbuds</span>
              <span class="px-3 py-1 bg-accent/10 text-accent rounded-full text-sm cursor-pointer hover:bg-accent/20 transition-colors">summer fashion</span>
              <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm cursor-pointer hover:bg-gray-200 transition-colors">home decor</span>
              <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm cursor-pointer hover:bg-gray-200 transition-colors">fitness gear</span>
              <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm cursor-pointer hover:bg-gray-200 transition-colors">smartphone</span>
            </div>
          </div>

          <!-- Product Grid -->
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="productGrid">
            <!-- Products will be dynamically loaded here -->
          </div>

          <!-- Load More -->
          <div class="text-center mt-12">
            <button class="bg-primary text-white px-8 py-3 rounded-lg hover:bg-orange-600 transition-colors font-medium">
              Load More Products
            </button>
          </div>
        </main>
    </div>
</div>

    <!-- Popular Items Section -->
<section class="bg-gray-50 py-16 mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-text mb-4">Popular Items</h2>
            <p class="text-gray-600">Discover what's trending in our marketplace</p>
        </div>
    
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6" id="popularItems">
            <!-- Popular items will be loaded here -->
        </div>
    </div>
</section>