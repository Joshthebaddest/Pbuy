<?php
    require_once __DIR__ .'/../../utils/cartFunc.php';
    require_once __DIR__ . '/../../controllers/searchController.php';
    $user = isset($_SESSION['user']) ?? null;
    $cart = new CartManager($user); 
    $carts = $cart -> getCart();
    $count = count($carts);
?>

<div className="flex flex-col min-h-screen">   
  <!-- Header -->
    <div class="bg-gray-900 text-white text-sm">
        <div class="container mx-auto px-4 py-2">
            <div class="flex justify-between items-center">
            <!-- Left Side: Delivery Location -->
            <div class="flex items-center space-x-4">
                <div class="flex items-center">
                    <i data-lucide="map-pin" class="h-4 w-4 mr-1"></i>
                    <span>Deliver to Lagos 10001</span>
                </div>
            </div>

            <!-- Right Side: Links -->
            <div class="hidden md:flex items-center space-x-4">
                <a href="/help" class="hover:text-gray-300">Customer Service</a>
                <a href="<?php echo BASE_PATH; ?>store/register" class="hover:text-gray-300">Sell on MarketPlace</a>
                <a href="/track" class="hover:text-gray-300">Track Your Order</a>
            </div>
            </div>
        </div>
    </div>

    <header class="bg-white shadow-md sticky top-0 z-50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Top Header -->
        <div class="flex items-center justify-between h-16">
          <!-- Logo -->
          <div class="flex-shrink-0">
            <a href="<?php echo BASE_PATH; ?>" class="flex items-center space-x-2">
              <div class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center">
                <i data-lucide="shopping-bag" class="w-5 h-5 text-white"></i>
              </div>
              <span class="text-xl font-bold text-text">PBUY</span>
            </a>
          </div>

          <!-- Mobile Menu Button -->
          <button class="lg:hidden p-2 text-text hover:text-primary transition-colors duration-200" id="mobileMenuButton">
            <i data-lucide="menu" class="w-6 h-6"></i>
          </button>

          <!-- Search Bar -->
          <div class="hidden lg:flex flex-1 max-w-2xl mx-8">
            <div class="relative w-full">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i data-lucide="search" class="w-5 h-5 text-gray-400"></i>
              </div>
              <input
                type="text"
                placeholder="Search products, stores, categories..."
                class="block w-full pl-10 pr-12 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all duration-200"
              />
              <div class="absolute inset-y-0 right-0 flex items-center pr-2">
                <button class="bg-primary hover:bg-orange-600 text-white px-4 py-2 rounded-r-lg transition-colors duration-200">
                  <i data-lucide="search" class="w-4 h-4"></i>
                </button>
              </div>
            </div>
          </div>

          <!-- Right Side Icons -->
          <div class="hidden lg:flex items-center space-x-4">
            <button class="p-2 text-gray-600 hover:text-primary transition-colors relative">
              <i data-lucide="heart" class="h-6 w-6"></i>
              <span class="absolute -top-1 -right-1 bg-primary text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span>
            </button>

            <!-- Cart -->
            <button class="relative p-2 text-text hover:text-primary transition-colors duration-200">
              <i data-lucide="shopping-cart" class="w-6 h-6"></i>
              <span class="absolute -top-1 -right-1 bg-accent text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">3</span>
            </button>

            <!-- User Menu -->
            <div class="relative">
              <button href="profile.html" class="flex items-center space-x-2 p-2 rounded-lg hover:bg-gray-100 transition-colors" id="userMenuButton">
                <div class="w-8 h-8 <?php echo isset($_SESSION['user']) ? 'bg-primary' : 'bg-gray-300'; ?> rounded-full flex items-center justify-center">
                  <i data-lucide="user" class="h-5 w-5 <?php echo isset($_SESSION['user']) ? 'text-white' : 'text-gray-400'; ?>"></i>
                </div>
                <?php if(isset($_SESSION['user'])): ?>
                  <span class="hidden md:block text-sm font-medium"><?php echo $_SESSION['user']; ?></span>
                <?php endif; ?>
                <i data-lucide="chevron-down" class="h-4 w-4 <?php echo isset($_SESSION['user']) ? 'text-gray-400' : ''; ?>"></i>
              </button>
              
              <!-- Dropdown Menu -->
              <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 hidden" id="userDropdown">
                <div class="py-1">
                  <?php if(!isset($_SESSION['user'])): ?>
                    <a href="<?php echo BASE_PATH; ?>auth/login" class="block px-4 py-2 text-sm text-text hover:bg-gray-50 transition-colors duration-200">
                      <i data-lucide="log-in" class="w-4 h-4 inline mr-2"></i>
                      Login
                    </a>
                    <a href="<?php echo BASE_PATH; ?>auth/signup" class="block px-4 py-2 text-sm text-text hover:bg-gray-50 transition-colors duration-200">
                      <i data-lucide="user-plus" class="w-4 h-4 inline mr-2"></i>
                    Sign Up
                  </a>
                  <?php endif; ?>
                  <hr class="my-1">
                  <a href="#" class="block px-4 py-2 text-sm text-text hover:bg-gray-50 transition-colors duration-200">
                    <i data-lucide="layout-dashboard" class="w-4 h-4 inline mr-2"></i>
                    Dashboard
                  </a>
                  <a href="#" class="block px-4 py-2 text-sm text-text hover:bg-gray-50 transition-colors duration-200">
                    <i data-lucide="package" class="w-4 h-4 inline mr-2"></i>
                    Orders
                  </a>
                  <a href="#" class="block px-4 py-2 text-sm text-text hover:bg-gray-50 transition-colors duration-200">
                    <i data-lucide="settings" class="w-4 h-4 inline mr-2"></i>
                    Settings
                  </a>
                  <hr class="my-1">
                  <?php if(isset($_SESSION['user'])): ?>
                    <a href="<?php echo BASE_PATH; ?>auth/logout" class="block px-4 py-2 text-sm text-text hover:bg-red-500 hover:text-gray-100 transition-colors duration-200">
                      <i data-lucide="log-out" class="w-4 h-4 inline mr-2"></i>
                      Logout
                    </a>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <?php
          $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); 
          if($path === BASE_PATH): 
        ?>
        <!-- Secondary Navigation -->
        <div class="hidden lg:block border-t border-gray-200">
          <div class="flex items-center justify-between py-3">
            <!-- Categories -->
            <div class="flex items-center space-x-6">
              <button class="flex items-center space-x-1 text-text hover:text-primary transition-colors duration-200" id="categoriesButton">
                <i data-lucide="menu" class="w-4 h-4"></i>
                <span class="font-medium">Categories</span>
              </button>
              <a href="#" class="text-text hover:text-primary transition-colors duration-200">Electronics</a>
              <a href="#" class="text-text hover:text-primary transition-colors duration-200">Fashion</a>
              <a href="#" class="text-text hover:text-primary transition-colors duration-200">Home & Garden</a>
              <a href="#" class="text-text hover:text-primary transition-colors duration-200">Sports</a>
            </div>

            <!-- Filters & Sort -->
            <div class="flex items-center space-x-4">
              <button class="flex items-center space-x-1 text-sm text-text hover:text-primary transition-colors duration-200" id="filtersButton">
                <i data-lucide="filter" class="w-4 h-4"></i>
                <span>Filters</span>
              </button>
              <button class="flex items-center space-x-1 text-sm text-text hover:text-primary transition-colors duration-200" id="sortButton">
                <i data-lucide="arrow-up-down" class="w-4 h-4"></i>
                <span>Sort</span>
              </button>
            </div>
          </div>
        </div>
        <?php endif; ?>

        <!-- Mobile Menu -->
        <div class="lg:hidden border-t border-gray-200 hidden" id="mobileMenu">
          <div class="px-4 py-3 space-y-3">
            <!-- Mobile Search -->
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i data-lucide="search" class="w-5 h-5 text-gray-400"></i>
              </div>
              <input
                type="text"
                placeholder="Search products..."
                class="block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent outline-none"
              />
            </div>

            <!-- Mobile Navigation Links -->
            <div class="flex flex-col space-y-2">
              <a href="#" class="flex items-center space-x-2 py-2 text-text hover:text-primary transition-colors duration-200">
                <i data-lucide="smartphone" class="w-4 h-4"></i>
                <span>Electronics</span>
              </a>
              <a href="#" class="flex items-center space-x-2 py-2 text-text hover:text-primary transition-colors duration-200">
                <i data-lucide="shirt" class="w-4 h-4"></i>
                <span>Fashion</span>
              </a>
              <a href="#" class="flex items-center space-x-2 py-2 text-text hover:text-primary transition-colors duration-200">
                <i data-lucide="home" class="w-4 h-4"></i>
                <span>Home & Garden</span>
              </a>
              <a href="#" class="flex items-center space-x-2 py-2 text-text hover:text-primary transition-colors duration-200">
                <i data-lucide="dumbbell" class="w-4 h-4"></i>
                <span>Sports</span>
              </a>
            </div>

            <!-- Mobile Actions -->
            <div class="flex items-center justify-between pt-3 border-t border-gray-200">
              <button class="flex items-center space-x-2 text-text hover:text-primary transition-colors duration-200">
                <i data-lucide="shopping-cart" class="w-5 h-5"></i>
                <span>Cart (3)</span>
              </button>
              <button class="flex items-center space-x-2 text-text hover:text-primary transition-colors duration-200">
                <i data-lucide="user" class="w-5 h-5"></i>
                <span>Account</span>
              </button>
            </div>

            <!-- Mobile Filter & Sort -->
            <div class="flex items-center space-x-4 pt-3 border-t border-gray-200">
              <button class="flex items-center space-x-1 text-sm text-text hover:text-primary transition-colors duration-200" id="mobileFiltersButton">
                <i data-lucide="filter" class="w-4 h-4"></i>
                <span>Filters</span>
              </button>
              <button class="flex items-center space-x-1 text-sm text-text hover:text-primary transition-colors duration-200" id="mobileSortButton">
                <i data-lucide="arrow-up-down" class="w-4 h-4"></i>
                <span>Sort</span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </header>

    <main className="flex-1">
        <?php echo $content; ?>
    </main>

    <footer class="bg-gray-50 border-t border-gray-200">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
          <!-- Company Info -->
          <div>
            <div class="flex items-center space-x-2 mb-4">
              <div class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center">
                <i data-lucide="shopping-bag" class="w-5 h-5 text-white"></i>
              </div>
              <span class="text-xl font-bold text-text">PBUY</span>
            </div>
            <p class="text-gray-600 mb-4">Your trusted multivendor marketplace for quality products from verified sellers worldwide.</p>
            <div class="flex space-x-4">
              <a href="#" class="text-gray-400 hover:text-primary transition-colors duration-200">
                <i data-lucide="facebook" class="w-5 h-5"></i>
              </a>
              <a href="#" class="text-gray-400 hover:text-primary transition-colors duration-200">
                <i data-lucide="twitter" class="w-5 h-5"></i>
              </a>
              <a href="#" class="text-gray-400 hover:text-primary transition-colors duration-200">
                <i data-lucide="instagram" class="w-5 h-5"></i>
              </a>
            </div>
          </div>

          <!-- Quick Links -->
          <div>
            <h3 class="text-lg font-semibold text-text mb-4">Quick Links</h3>
            <ul class="space-y-2">
              <li><a href="#" class="text-gray-600 hover:text-primary transition-colors duration-200">About Us</a></li>
              <li><a href="#" class="text-gray-600 hover:text-primary transition-colors duration-200">Contact</a></li>
              <li><a href="#" class="text-gray-600 hover:text-primary transition-colors duration-200">FAQ</a></li>
              <li><a href="<?php echo BASE_PATH; ?>store/register" class="text-gray-600 hover:text-primary transition-colors duration-200">Become a Vendor</a></li>
              <li><a href="#" class="text-gray-600 hover:text-primary transition-colors duration-200">Affiliate Program</a></li>
            </ul>
          </div>

          <!-- Policies -->
          <div>
            <h3 class="text-lg font-semibold text-text mb-4">Policies</h3>
            <ul class="space-y-2">
              <li><a href="#" class="text-gray-600 hover:text-primary transition-colors duration-200">Privacy Policy</a></li>
              <li><a href="#" class="text-gray-600 hover:text-primary transition-colors duration-200">Terms of Service</a></li>
              <li><a href="#" class="text-gray-600 hover:text-primary transition-colors duration-200">Return Policy</a></li>
              <li><a href="#" class="text-gray-600 hover:text-primary transition-colors duration-200">Shipping Info</a></li>
              <li><a href="#" class="text-gray-600 hover:text-primary transition-colors duration-200">Payment Security</a></li>
            </ul>
          </div>

          <!-- Newsletter -->
          <div>
            <h3 class="text-lg font-semibold text-text mb-4">Newsletter</h3>
            <p class="text-gray-600 mb-4">Subscribe to get updates on new products and exclusive offers.</p>
            <div class="flex">
              <input
                type="email"
                placeholder="Enter your email"
                class="flex-1 px-3 py-2 border border-gray-300 rounded-l-md focus:ring-2 focus:ring-primary focus:border-transparent outline-none"
              />
              <button class="bg-primary hover:bg-orange-600 text-white px-4 py-2 rounded-r-md transition-colors duration-200">
                <i data-lucide="send" class="w-4 h-4"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Bottom Footer -->
        <div class="border-t border-gray-200 mt-8 pt-8 flex flex-col md:flex-row justify-between items-center">
          <p class="text-gray-600 text-sm">© 2025 PBUY. All rights reserved.</p>
          <div class="flex items-center space-x-4 mt-4 md:mt-0">
            <img src="https://via.placeholder.com/40x25/10B981/FFFFFF?text=VISA" alt="Visa" class="h-6">
            <img src="https://via.placeholder.com/40x25/F97316/FFFFFF?text=MC" alt="Mastercard" class="h-6">
            <img src="https://via.placeholder.com/40x25/374151/FFFFFF?text=PP" alt="PayPal" class="h-6">
          </div>
        </div>
      </div>
    </footer>
</div>