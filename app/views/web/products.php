  <style>
    input[type="range"]::-webkit-slider-thumb {
      -webkit-appearance: none;
      height: 20px;
      width: 20px;
      border-radius: 9999px;
      background: #3b82f6;
      cursor: pointer;
      pointer-events: all;
      position: relative;
      top: 50%;
      transform: translateY(-50%);
    }

    input[type="range"]::-moz-range-thumb {
      height: 20px;
      width: 20px;
      border-radius: 9999px;
      background: #3b82f6;
      cursor: pointer;
      pointer-events: all;
    }

    input[type="range"]::-ms-thumb {
      height: 20px;
      width: 20px;
      border-radius: 9999px;
      background: #3b82f6;
      cursor: pointer;
      pointer-events: all;
    }
  </style>

  <!-- Main Content Area -->
    <div class="flex-1 flex">
      <!-- Sidebar -->
      <aside class="w-64 bg-white shadow-sm border-r border-gray-200 hidden lg:block">
        <div class="p-6">
          <!-- Categories -->
          <div class="mb-8">
            <h3 class="text-lg font-semibold text-text mb-4">Categories</h3>
            <ul class="space-y-2">
              <li><a href="#" class="flex items-center space-x-2 text-text hover:text-primary transition-colors duration-200">
                <i data-lucide="smartphone" class="w-4 h-4"></i>
                <span>Electronics</span>
              </a></li>
              <li><a href="#" class="flex items-center space-x-2 text-text hover:text-primary transition-colors duration-200">
                <i data-lucide="shirt" class="w-4 h-4"></i>
                <span>Fashion</span>
              </a></li>
              <li><a href="#" class="flex items-center space-x-2 text-text hover:text-primary transition-colors duration-200">
                <i data-lucide="home" class="w-4 h-4"></i>
                <span>Home & Garden</span>
              </a></li>
              <li><a href="#" class="flex items-center space-x-2 text-text hover:text-primary transition-colors duration-200">
                <i data-lucide="dumbbell" class="w-4 h-4"></i>
                <span>Sports & Fitness</span>
              </a></li>
              <li><a href="#" class="flex items-center space-x-2 text-text hover:text-primary transition-colors duration-200">
                <i data-lucide="book" class="w-4 h-4"></i>
                <span>Books</span>
              </a></li>
              <li><a href="#" class="flex items-center space-x-2 text-text hover:text-primary transition-colors duration-200">
                <i data-lucide="gamepad-2" class="w-4 h-4"></i>
                <span>Gaming</span>
              </a></li>
            </ul>
          </div>

          <!-- Featured Stores -->
          <div class="mb-8">
            <h3 class="text-lg font-semibold text-text mb-4">Featured Stores</h3>
            <div class="space-y-3">
              <div class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center">
                  <i data-lucide="store" class="w-4 h-4 text-white"></i>
                </div>
                <div>
                  <p class="text-sm font-medium text-text">TechWorld</p>
                  <p class="text-xs text-gray-500">Electronics</p>
                </div>
              </div>
              <div class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                <div class="w-8 h-8 bg-accent rounded-full flex items-center justify-center">
                  <i data-lucide="store" class="w-4 h-4 text-white"></i>
                </div>
                <div>
                  <p class="text-sm font-medium text-text">FashionHub</p>
                  <p class="text-xs text-gray-500">Clothing</p>
                </div>
              </div>
              <div class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center">
                  <i data-lucide="store" class="w-4 h-4 text-white"></i>
                </div>
                <div>
                  <p class="text-sm font-medium text-text">HomeDecor</p>
                  <p class="text-xs text-gray-500">Home & Garden</p>
                </div>
              </div>
            </div>
          </div>

          <!-- Featured Products -->
          <div>
            <h3 class="text-lg font-semibold text-text mb-4">Featured Products</h3>
            <div class="space-y-3">
              <div class="border border-gray-200 rounded-lg p-3 hover:shadow-md transition-shadow duration-200">
                <div class="w-full h-20 bg-gray-100 rounded-md mb-2"></div>
                <p class="text-sm font-medium text-text">Wireless Headphones</p>
                <p class="text-sm text-primary font-semibold">$99.99</p>
              </div>
              <div class="border border-gray-200 rounded-lg p-3 hover:shadow-md transition-shadow duration-200">
                <div class="w-full h-20 bg-gray-100 rounded-md mb-2"></div>
                <p class="text-sm font-medium text-text">Smart Watch</p>
                <p class="text-sm text-primary font-semibold">$199.99</p>
              </div>
            </div>
          </div>
        </div>
      </aside>

      <!-- Main Content -->
      <main class="flex-1 p-6">
        <div class="max-w-6xl mx-auto">
          <h1 class="text-3xl font-bold text-text mb-6">Welcome to PBUY</h1>
          <p class="text-lg text-gray-600 mb-8">Discover amazing products from thousands of vendors worldwide</p>
          
          <!-- Placeholder for main content -->
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <!-- Product cards will go here -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-200">
              <div class="w-full h-48 bg-gray-200"></div>
              <div class="p-4">
                <h3 class="font-semibold text-text mb-2">Sample Product</h3>
                <p class="text-gray-600 text-sm mb-2">Product description goes here...</p>
                <div class="flex items-center justify-between">
                  <span class="text-primary font-bold">$29.99</span>
                  <button class="bg-primary hover:bg-orange-600 text-white px-3 py-1 rounded-md text-sm transition-colors duration-200">
                    Add to Cart
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>

  <script>
    const minRange = document.getElementById('minRange');
    const maxRange = document.getElementById('maxRange');
    const minValue = document.getElementById('minValue');
    const maxValue = document.getElementById('maxValue');
    const rangeFill = document.getElementById('rangeFill');

    const minGap = 50;
    const max = 1000;

    function updateSlider() {
      let min = parseInt(minRange.value);
      let maxVal = parseInt(maxRange.value);

      // Prevent overlap
      if (maxVal - min < minGap) {
        if (event.target === minRange) {
          minRange.value = maxVal - minGap;
          min = parseInt(minRange.value);
        } else {
          maxRange.value = min + minGap;
          maxVal = parseInt(maxRange.value);
        }
      }

      minValue.textContent = min;
      maxValue.textContent = maxVal;

      // Update filled track
      const percentMin = (min / max) * 100;
      const percentMax = (maxVal / max) * 100;

      rangeFill.style.left = percentMin + '%';
      rangeFill.style.width = (percentMax - percentMin) + '%';
    }

    minRange.addEventListener('input', updateSlider);
    maxRange.addEventListener('input', updateSlider);

    // Initial set
    updateSlider();
  </script>

  