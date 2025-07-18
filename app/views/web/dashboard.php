<main class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Sidebar Navigation -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="flex items-center space-x-4 mb-6">
                        <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center">
                            <i data-lucide="user" class="h-8 w-8 text-white"></i>
                        </div>
                        <div>
                            <h2 class="font-semibold">John Doe</h2>
                            <p class="text-sm text-gray-600">john.doe@email.com</p>
                        </div>
                    </div>
                    
                    <nav class="space-y-2">
                        <a href="#" class="profile-nav-item active flex items-center space-x-3 p-3 rounded-lg bg-primary bg-opacity-10 text-primary" onclick="showSection('profile')">
                            <i data-lucide="user" class="h-5 w-5"></i>
                            <span>Profile Info</span>
                        </a>
                        <a href="#" class="profile-nav-item flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-100 transition-colors" onclick="showSection('orders')">
                            <i data-lucide="package" class="h-5 w-5"></i>
                            <span>Order History</span>
                        </a>
                        <a href="#" class="profile-nav-item flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-100 transition-colors" onclick="showSection('addresses')">
                            <i data-lucide="map-pin" class="h-5 w-5"></i>
                            <span>Addresses</span>
                        </a>
                        <a href="#" class="profile-nav-item flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-100 transition-colors" onclick="showSection('wishlist')">
                            <i data-lucide="heart" class="h-5 w-5"></i>
                            <span>Wishlist</span>
                        </a>
                        <a href="#" class="profile-nav-item flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-100 transition-colors" onclick="showSection('reviews')">
                            <i data-lucide="star" class="h-5 w-5"></i>
                            <span>My Reviews</span>
                        </a>
                        <a href="#" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-100 transition-colors text-red-600">
                            <i data-lucide="log-out" class="h-5 w-5"></i>
                            <span>Logout</span>
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="lg:col-span-3">
                <!-- Profile Info Section -->
                <div id="profile-section" class="profile-section">
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h1 class="text-2xl font-bold mb-6">Profile Information</h1>
                        
                        <form class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                                    <input type="text" value="John" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                                    <input type="text" value="Doe" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                                <input type="email" value="john.doe@email.com" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                                <input type="tel" value="+1 (555) 123-4567" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                                <input type="date" value="1990-01-15" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                            </div>
                            
                            <div class="flex justify-end space-x-4">
                                <button type="button" class="px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                                    Cancel
                                </button>
                                <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-orange-600 transition-colors">
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Order History Section -->
                <div id="orders-section" class="profile-section hidden">
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h1 class="text-2xl font-bold mb-6">Order History</h1>
                        
                        <div class="space-y-4">
                            <!-- Order Item 1 -->
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex items-center justify-between mb-4">
                                    <div>
                                        <h3 class="font-semibold">Order #12345</h3>
                                        <p class="text-sm text-gray-600">Placed on January 15, 2025</p>
                                    </div>
                                    <div class="text-right">
                                        <div class="font-semibold text-primary">$79.99</div>
                                        <span class="inline-block bg-accent text-white px-2 py-1 rounded-full text-xs">Delivered</span>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <img src="https://images.pexels.com/photos/788946/pexels-photo-788946.jpeg?auto=compress&cs=tinysrgb&w=100" 
                                            alt="Wireless Headphones" class="w-16 h-16 object-cover rounded-lg">
                                    <div class="flex-1">
                                        <h4 class="font-medium">Wireless Bluetooth Headphones</h4>
                                        <p class="text-sm text-gray-600">TechVendor Store</p>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                                            Track Order
                                        </button>
                                        <button class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-orange-600 transition-colors">
                                            Buy Again
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Order Item 2 -->
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex items-center justify-between mb-4">
                                    <div>
                                        <h3 class="font-semibold">Order #12344</h3>
                                        <p class="text-sm text-gray-600">Placed on January 10, 2025</p>
                                    </div>
                                    <div class="text-right">
                                        <div class="font-semibold text-primary">$49.98</div>
                                        <span class="inline-block bg-yellow-500 text-white px-2 py-1 rounded-full text-xs">In Transit</span>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <img src="https://images.pexels.com/photos/1464625/pexels-photo-1464625.jpeg?auto=compress&cs=tinysrgb&w=100" 
                                            alt="Cotton T-Shirt" class="w-16 h-16 object-cover rounded-lg">
                                    <div class="flex-1">
                                        <h4 class="font-medium">Premium Cotton T-Shirt (2x)</h4>
                                        <p class="text-sm text-gray-600">Fashion Hub</p>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                                            Track Order
                                        </button>
                                        <button class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-orange-600 transition-colors">
                                            Buy Again
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Addresses Section -->
                <div id="addresses-section" class="profile-section hidden">
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h1 class="text-2xl font-bold">Shipping Addresses</h1>
                            <button class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-orange-600 transition-colors">
                                Add New Address
                            </button>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Address 1 -->
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex items-start justify-between mb-3">
                                    <div>
                                        <h3 class="font-semibold">Home</h3>
                                        <span class="inline-block bg-primary text-white px-2 py-1 rounded-full text-xs">Default</span>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button class="text-gray-600 hover:text-primary transition-colors">
                                            <i data-lucide="edit" class="h-4 w-4"></i>
                                        </button>
                                        <button class="text-gray-600 hover:text-red-500 transition-colors">
                                            <i data-lucide="trash-2" class="h-4 w-4"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="text-gray-600 text-sm">
                                    <p>John Doe</p>
                                    <p>123 Main Street</p>
                                    <p>Apartment 4B</p>
                                    <p>New York, NY 10001</p>
                                    <p>United States</p>
                                    <p class="mt-2">+1 (555) 123-4567</p>
                                </div>
                            </div>

                            <!-- Address 2 -->
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex items-start justify-between mb-3">
                                    <div>
                                        <h3 class="font-semibold">Office</h3>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button class="text-gray-600 hover:text-primary transition-colors">
                                            <i data-lucide="edit" class="h-4 w-4"></i>
                                        </button>
                                        <button class="text-gray-600 hover:text-red-500 transition-colors">
                                            <i data-lucide="trash-2" class="h-4 w-4"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="text-gray-600 text-sm">
                                    <p>John Doe</p>
                                    <p>456 Business Ave</p>
                                    <p>Suite 200</p>
                                    <p>New York, NY 10002</p>
                                    <p>United States</p>
                                    <p class="mt-2">+1 (555) 987-6543</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Wishlist Section -->
                <div id="wishlist-section" class="profile-section hidden">
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h1 class="text-2xl font-bold mb-6">My Wishlist</h1>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            <!-- Wishlist Item 1 -->
                            <div class="border border-gray-200 rounded-lg overflow-hidden">
                                <div class="relative">
                                    <img src="https://images.pexels.com/photos/1649771/pexels-photo-1649771.jpeg?auto=compress&cs=tinysrgb&w=300" 
                                            alt="Smart Watch" class="w-full h-48 object-cover">
                                    <button class="absolute top-3 right-3 p-2 bg-white rounded-full shadow-md text-red-500">
                                        <i data-lucide="heart" class="h-4 w-4 fill-current"></i>
                                    </button>
                                </div>
                                <div class="p-4">
                                    <h3 class="font-semibold mb-2">Smart Fitness Watch</h3>
                                    <p class="text-sm text-gray-600 mb-2">GadgetWorld</p>
                                    <div class="flex items-center justify-between">
                                        <span class="font-bold text-primary">$199.99</span>
                                        <button class="bg-primary text-white px-3 py-1 rounded text-sm hover:bg-orange-600 transition-colors">
                                            Add to Cart
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Wishlist Item 2 -->
                            <div class="border border-gray-200 rounded-lg overflow-hidden">
                                <div class="relative">
                                    <img src="https://images.pexels.com/photos/1667088/pexels-photo-1667088.jpeg?auto=compress&cs=tinysrgb&w=300" 
                                            alt="Coffee Maker" class="w-full h-48 object-cover">
                                    <button class="absolute top-3 right-3 p-2 bg-white rounded-full shadow-md text-red-500">
                                        <i data-lucide="heart" class="h-4 w-4 fill-current"></i>
                                    </button>
                                </div>
                                <div class="p-4">
                                    <h3 class="font-semibold mb-2">Premium Coffee Maker</h3>
                                    <p class="text-sm text-gray-600 mb-2">HomeEssentials</p>
                                    <div class="flex items-center justify-between">
                                        <span class="font-bold text-primary">$149.99</span>
                                        <button class="bg-primary text-white px-3 py-1 rounded text-sm hover:bg-orange-600 transition-colors">
                                            Add to Cart
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reviews Section -->
                <div id="reviews-section" class="profile-section hidden">
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h1 class="text-2xl font-bold mb-6">My Reviews</h1>
                        
                        <div class="space-y-6">
                            <!-- Review 1 -->
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex items-start space-x-4">
                                    <img src="https://images.pexels.com/photos/788946/pexels-photo-788946.jpeg?auto=compress&cs=tinysrgb&w=100" 
                                            alt="Wireless Headphones" class="w-16 h-16 object-cover rounded-lg">
                                    <div class="flex-1">
                                        <h3 class="font-semibold mb-1">Wireless Bluetooth Headphones</h3>
                                        <div class="flex items-center space-x-2 mb-2">
                                            <div class="flex text-yellow-400">
                                                <i data-lucide="star" class="h-4 w-4 fill-current"></i>
                                                <i data-lucide="star" class="h-4 w-4 fill-current"></i>
                                                <i data-lucide="star" class="h-4 w-4 fill-current"></i>
                                                <i data-lucide="star" class="h-4 w-4 fill-current"></i>
                                                <i data-lucide="star" class="h-4 w-4 fill-current"></i>
                                            </div>
                                            <span class="text-sm text-gray-600">January 16, 2025</span>
                                        </div>
                                        <p class="text-gray-600 mb-3">
                                            Excellent sound quality and comfortable to wear for long periods. The noise cancellation works really well. 
                                            Highly recommended for anyone looking for premium headphones.
                                        </p>
                                        <div class="flex space-x-4 text-sm">
                                            <button class="text-primary hover:underline">Edit Review</button>
                                            <button class="text-gray-600 hover:text-red-500">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Review 2 -->
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex items-start space-x-4">
                                    <img src="https://images.pexels.com/photos/1464625/pexels-photo-1464625.jpeg?auto=compress&cs=tinysrgb&w=100" 
                                            alt="Cotton T-Shirt" class="w-16 h-16 object-cover rounded-lg">
                                    <div class="flex-1">
                                        <h3 class="font-semibold mb-1">Premium Cotton T-Shirt</h3>
                                        <div class="flex items-center space-x-2 mb-2">
                                            <div class="flex text-yellow-400">
                                                <i data-lucide="star" class="h-4 w-4 fill-current"></i>
                                                <i data-lucide="star" class="h-4 w-4 fill-current"></i>
                                                <i data-lucide="star" class="h-4 w-4 fill-current"></i>
                                                <i data-lucide="star" class="h-4 w-4 fill-current"></i>
                                                <i data-lucide="star" class="h-4 w-4"></i>
                                            </div>
                                            <span class="text-sm text-gray-600">January 12, 2025</span>
                                        </div>
                                        <p class="text-gray-600 mb-3">
                                            Good quality cotton and fits well. The color is exactly as shown in the pictures. 
                                            Will definitely order more colors.
                                        </p>
                                        <div class="flex space-x-4 text-sm">
                                            <button class="text-primary hover:underline">Edit Review</button>
                                            <button class="text-gray-600 hover:text-red-500">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>