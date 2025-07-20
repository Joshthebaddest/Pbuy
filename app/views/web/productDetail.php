<?php
  require_once __DIR__ .'/../../../config/globalConfig.php';
  require_once __DIR__ . '/../../models/product/products.php';
  require_once __DIR__ . '/../../models/product/product_images.php';
  require_once __DIR__ . '/../../controllers/cartController.php';
  $productId = htmlspecialchars($_GET['productId']);
  try{
    // $row = Product::query()
    //  ->select('*')
    //  ->where('id', $productId)
    //  ->first();
    // $product = [
    //   'id' => $row['id'],
    //   'name' => $row['product_name'],
    //   'image' => $row['img_url'],
    //   'vendorId' => 0,
    //   'vendorName' => $row['username'],
    //   'description' => $row['description'],
    //   'discount' => 20,
    //   'rating' => 4.3,
    //   'reviews' => 87,
    //   'price' => $row['price'],
    //   'tags' => ['no', 'no'],
    //   'originalPrice' => 99.99,
    //   'inStock' => $row['quantity']
    // ];
    
    $product = [
      'id' => 101,
      'name' => 'Wireless Bluetooth Headphones',
      'image' => 'https://example.com/images/headphones.jpg',
      'vendorId' => 0,
      'vendorName' => 'techguru23',
      'description' => 'High-quality wireless Bluetooth headphones with noise cancellation and 20-hour battery life.',
      'discount' => 20,
      'rating' => 4.3,
      'reviews' => 87,
      'price' => 79.99,
      'tags' => ['electronics', 'audio'],
      'originalPrice' => 99.99,
      'inStock' => 42
    ];

    $data = ProductImage::query()
     ->select('*')
     ->where('product_id', $productId)
     ->get();
    if($data){
      foreach($data as $row){
        $product_images[] = [
          'id' => $row['id'],
          'url' => $row['img_url'],
          'is_main' => $row['is_main']
        ];
      }
    }


  }catch(Exception $e){
    $e -> getMessage();
  }
  // if(!isset($product)) {
  //   require_once __DIR__ . '/../../../public/404.html';
  //   exit();
  // }
?>

<!-- Breadcrumb -->
<nav class="bg-gray-50 py-3">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center space-x-2 text-sm">
      <a href="index.html" class="text-gray-600 hover:text-primary">Home</a>
      <i data-lucide="chevron-right" class="h-4 w-4 text-gray-400"></i>
      <a href="#" class="text-gray-600 hover:text-primary">Electronics</a>
      <i data-lucide="chevron-right" class="h-4 w-4 text-gray-400"></i>
      <span class="text-gray-900">Wireless Bluetooth Headphones</span>
    </div>
  </div>
</nav>

<main class="py-8">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
          <!-- Product Images -->
          <div class="space-y-4">
              <div class="aspect-square bg-gray-100 rounded-lg overflow-hidden">
                  <img id="mainImage" src="https://images.pexels.com/photos/788946/pexels-photo-788946.jpeg?auto=compress&cs=tinysrgb&w=600" 
                        alt="Wireless Headphones" class="w-full h-full object-cover">
              </div>
              <div class="grid grid-cols-4 gap-4">
                  <button class="aspect-square bg-gray-100 rounded-lg overflow-hidden border-2 border-primary" onclick="changeImage(this)">
                      <img src="https://images.pexels.com/photos/788946/pexels-photo-788946.jpeg?auto=compress&cs=tinysrgb&w=200" 
                            alt="View 1" class="w-full h-full object-cover">
                  </button>
                  <button class="aspect-square bg-gray-100 rounded-lg overflow-hidden border-2 border-transparent hover:border-primary transition-colors" onclick="changeImage(this)">
                      <img src="https://images.pexels.com/photos/3394650/pexels-photo-3394650.jpeg?auto=compress&cs=tinysrgb&w=200" 
                            alt="View 2" class="w-full h-full object-cover">
                  </button>
                  <button class="aspect-square bg-gray-100 rounded-lg overflow-hidden border-2 border-transparent hover:border-primary transition-colors" onclick="changeImage(this)">
                      <img src="https://images.pexels.com/photos/1649771/pexels-photo-1649771.jpeg?auto=compress&cs=tinysrgb&w=200" 
                            alt="View 3" class="w-full h-full object-cover">
                  </button>
                  <button class="aspect-square bg-gray-100 rounded-lg overflow-hidden border-2 border-transparent hover:border-primary transition-colors" onclick="changeImage(this)">
                      <img src="https://images.pexels.com/photos/205926/pexels-photo-205926.jpeg?auto=compress&cs=tinysrgb&w=200" 
                            alt="View 4" class="w-full h-full object-cover">
                  </button>
              </div>
          </div>

          <!-- Product Info -->
          <div class="space-y-6">
              <div>
                  <h1 class="text-3xl font-bold mb-2">Wireless Bluetooth Headphones</h1>
                  <p class="text-gray-600">Premium noise-cancelling headphones with superior sound quality</p>
              </div>

              <!-- Vendor Info -->
              <div class="flex items-center space-x-4 p-4 bg-gray-50 rounded-lg">
                  <div class="w-12 h-12 bg-primary rounded-full flex items-center justify-center">
                      <i data-lucide="store" class="h-6 w-6 text-white"></i>
                  </div>
                  <div>
                      <h3 class="font-semibold">TechVendor Store</h3>
                      <div class="flex items-center space-x-2 text-sm text-gray-600">
                          <div class="flex text-yellow-400">
                              <i data-lucide="star" class="h-4 w-4 fill-current"></i>
                              <i data-lucide="star" class="h-4 w-4 fill-current"></i>
                              <i data-lucide="star" class="h-4 w-4 fill-current"></i>
                              <i data-lucide="star" class="h-4 w-4 fill-current"></i>
                              <i data-lucide="star" class="h-4 w-4"></i>
                          </div>
                          <span>4.2 (1,234 reviews)</span>
                      </div>
                  </div>
                  <button class="ml-auto bg-white border border-gray-300 px-4 py-2 rounded-lg hover:bg-gray-50 transition-colors">
                      Visit Store
                  </button>
              </div>

              <!-- Rating -->
              <div class="flex items-center space-x-4">
                  <div class="flex text-yellow-400">
                      <i data-lucide="star" class="h-5 w-5 fill-current"></i>
                      <i data-lucide="star" class="h-5 w-5 fill-current"></i>
                      <i data-lucide="star" class="h-5 w-5 fill-current"></i>
                      <i data-lucide="star" class="h-5 w-5 fill-current"></i>
                      <i data-lucide="star" class="h-5 w-5"></i>
                  </div>
                  <span class="text-gray-600">4.0 out of 5 (124 reviews)</span>
              </div>

              <!-- Price -->
              <div class="flex items-center space-x-4">
                  <span class="text-3xl font-bold text-primary">$79.99</span>
                  <span class="text-xl text-gray-500 line-through">$99.99</span>
                  <span class="bg-accent text-white px-3 py-1 rounded-full text-sm font-semibold">20% OFF</span>
              </div>

              <!-- Color Variants -->
              <div>
                  <h3 class="font-semibold mb-3">Color</h3>
                  <div class="flex space-x-3">
                      <button class="w-10 h-10 bg-black rounded-full border-2 border-primary shadow-md"></button>
                      <button class="w-10 h-10 bg-white rounded-full border-2 border-gray-300 hover:border-primary transition-colors shadow-md"></button>
                      <button class="w-10 h-10 bg-blue-500 rounded-full border-2 border-gray-300 hover:border-primary transition-colors shadow-md"></button>
                      <button class="w-10 h-10 bg-red-500 rounded-full border-2 border-gray-300 hover:border-primary transition-colors shadow-md"></button>
                  </div>
              </div>

              <!-- Size/Type Variants -->
              <div>
                  <h3 class="font-semibold mb-3">Type</h3>
                  <div class="flex space-x-3">
                      <button class="px-4 py-2 border-2 border-primary bg-primary text-white rounded-lg font-medium">Over-ear</button>
                      <button class="px-4 py-2 border-2 border-gray-300 text-gray-700 rounded-lg font-medium hover:border-primary transition-colors">On-ear</button>
                      <button class="px-4 py-2 border-2 border-gray-300 text-gray-700 rounded-lg font-medium hover:border-primary transition-colors">In-ear</button>
                  </div>
              </div>

              <!-- Quantity -->
              <div>
                  <h3 class="font-semibold mb-3">Quantity</h3>
                  <div class="flex items-center space-x-4">
                      <div class="flex items-center border border-gray-300 rounded-lg">
                          <button class="p-2 hover:bg-gray-100 transition-colors" onclick="decreaseQuantity()">
                              <i data-lucide="minus" class="h-4 w-4"></i>
                          </button>
                          <span id="quantity" class="px-4 py-2 font-medium">1</span>
                          <button class="p-2 hover:bg-gray-100 transition-colors" onclick="increaseQuantity()">
                              <i data-lucide="plus" class="h-4 w-4"></i>
                          </button>
                      </div>
                      <span class="text-gray-600">23 items available</span>
                  </div>
              </div>

              <!-- Action Buttons -->
              <div class="flex space-x-4">
                  <button class="flex-1 bg-primary text-white py-3 px-6 rounded-lg font-semibold hover:bg-orange-600 transition-colors flex items-center justify-center space-x-2">
                      <i data-lucide="shopping-cart" class="h-5 w-5"></i>
                      <span>Add to Cart</span>
                  </button>
                  <button class="flex-1 bg-accent text-white py-3 px-6 rounded-lg font-semibold hover:bg-emerald-600 transition-colors">
                      Buy Now
                  </button>
                  <button class="p-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                      <i data-lucide="heart" class="h-5 w-5 text-gray-600"></i>
                  </button>
              </div>

              <!-- Product Features -->
              <div class="border-t pt-6">
                  <h3 class="font-semibold mb-4">Key Features</h3>
                  <ul class="space-y-2 text-gray-600">
                      <li class="flex items-center space-x-2">
                          <i data-lucide="check" class="h-4 w-4 text-accent"></i>
                          <span>Active Noise Cancellation</span>
                      </li>
                      <li class="flex items-center space-x-2">
                          <i data-lucide="check" class="h-4 w-4 text-accent"></i>
                          <span>30-hour battery life</span>
                      </li>
                      <li class="flex items-center space-x-2">
                          <i data-lucide="check" class="h-4 w-4 text-accent"></i>
                          <span>Bluetooth 5.0 connectivity</span>
                      </li>
                      <li class="flex items-center space-x-2">
                          <i data-lucide="check" class="h-4 w-4 text-accent"></i>
                          <span>Premium leather ear cushions</span>
                      </li>
                  </ul>
              </div>
          </div>
      </div>

      <!-- Product Tabs -->
      <div class="mt-16">
          <div class="border-b border-gray-200">
              <nav class="flex space-x-8">
                  <button class="tab-button active py-4 px-1 border-b-2 border-primary text-primary font-medium" onclick="showTab('description')">
                      Description
                  </button>
                  <button class="tab-button py-4 px-1 border-b-2 border-transparent text-gray-500 hover:text-gray-700 font-medium" onclick="showTab('reviews')">
                      Reviews (124)
                  </button>
                  <button class="tab-button py-4 px-1 border-b-2 border-transparent text-gray-500 hover:text-gray-700 font-medium" onclick="showTab('shipping')">
                      Shipping & Returns
                  </button>
              </nav>
          </div>

          <!-- Tab Content -->
          <div class="py-8">
              <div id="description" class="tab-content">
                  <div class="prose max-w-none">
                      <h3 class="text-xl font-semibold mb-4">Product Description</h3>
                      <p class="text-gray-600 mb-4">
                          Experience premium audio quality with our Wireless Bluetooth Headphones. Featuring advanced noise-cancellation technology, 
                          these headphones deliver crystal-clear sound while blocking out unwanted ambient noise.
                      </p>
                      <p class="text-gray-600 mb-4">
                          With up to 30 hours of battery life and quick-charge capability, you can enjoy uninterrupted music throughout your day. 
                          The comfortable over-ear design with premium leather cushions ensures long-lasting comfort during extended listening sessions.
                      </p>
                      <h4 class="font-semibold mb-2">Specifications:</h4>
                      <ul class="list-disc list-inside text-gray-600 space-y-1">
                          <li>Driver Size: 40mm</li>
                          <li>Frequency Response: 20Hz - 20kHz</li>
                          <li>Impedance: 32 ohms</li>
                          <li>Battery Life: Up to 30 hours</li>
                          <li>Charging Time: 2 hours</li>
                          <li>Weight: 250g</li>
                      </ul>
                  </div>
              </div>

              <div id="reviews" class="tab-content hidden">
                  <div class="space-y-6">
                      <div class="flex items-center justify-between">
                          <h3 class="text-xl font-semibold">Customer Reviews</h3>
                          <button class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-orange-600 transition-colors">
                              Write a Review
                          </button>
                      </div>
                      
                      <!-- Review Summary -->
                      <div class="bg-gray-50 p-6 rounded-lg">
                          <div class="flex items-center space-x-4 mb-4">
                              <span class="text-3xl font-bold">4.0</span>
                              <div>
                                  <div class="flex text-yellow-400 mb-1">
                                      <i data-lucide="star" class="h-5 w-5 fill-current"></i>
                                      <i data-lucide="star" class="h-5 w-5 fill-current"></i>
                                      <i data-lucide="star" class="h-5 w-5 fill-current"></i>
                                      <i data-lucide="star" class="h-5 w-5 fill-current"></i>
                                      <i data-lucide="star" class="h-5 w-5"></i>
                                  </div>
                                  <p class="text-gray-600">Based on 124 reviews</p>
                              </div>
                          </div>
                          <div class="space-y-2">
                              <div class="flex items-center space-x-2">
                                  <span class="text-sm w-8">5★</span>
                                  <div class="flex-1 bg-gray-200 rounded-full h-2">
                                      <div class="bg-yellow-400 h-2 rounded-full" style="width: 60%"></div>
                                  </div>
                                  <span class="text-sm text-gray-600">74</span>
                              </div>
                              <div class="flex items-center space-x-2">
                                  <span class="text-sm w-8">4★</span>
                                  <div class="flex-1 bg-gray-200 rounded-full h-2">
                                      <div class="bg-yellow-400 h-2 rounded-full" style="width: 25%"></div>
                                  </div>
                                  <span class="text-sm text-gray-600">31</span>
                              </div>
                              <div class="flex items-center space-x-2">
                                  <span class="text-sm w-8">3★</span>
                                  <div class="flex-1 bg-gray-200 rounded-full h-2">
                                      <div class="bg-yellow-400 h-2 rounded-full" style="width: 10%"></div>
                                  </div>
                                  <span class="text-sm text-gray-600">12</span>
                              </div>
                              <div class="flex items-center space-x-2">
                                  <span class="text-sm w-8">2★</span>
                                  <div class="flex-1 bg-gray-200 rounded-full h-2">
                                      <div class="bg-yellow-400 h-2 rounded-full" style="width: 3%"></div>
                                  </div>
                                  <span class="text-sm text-gray-600">4</span>
                              </div>
                              <div class="flex items-center space-x-2">
                                  <span class="text-sm w-8">1★</span>
                                  <div class="flex-1 bg-gray-200 rounded-full h-2">
                                      <div class="bg-yellow-400 h-2 rounded-full" style="width: 2%"></div>
                                  </div>
                                  <span class="text-sm text-gray-600">3</span>
                              </div>
                          </div>
                      </div>

                      <!-- Individual Reviews -->
                      <div class="space-y-6">
                          <div class="border-b border-gray-200 pb-6">
                              <div class="flex items-start space-x-4">
                                  <div class="w-10 h-10 bg-primary rounded-full flex items-center justify-center">
                                      <span class="text-white font-semibold">JD</span>
                                  </div>
                                  <div class="flex-1">
                                      <div class="flex items-center space-x-2 mb-2">
                                          <h4 class="font-semibold">John Doe</h4>
                                          <div class="flex text-yellow-400">
                                              <i data-lucide="star" class="h-4 w-4 fill-current"></i>
                                              <i data-lucide="star" class="h-4 w-4 fill-current"></i>
                                              <i data-lucide="star" class="h-4 w-4 fill-current"></i>
                                              <i data-lucide="star" class="h-4 w-4 fill-current"></i>
                                              <i data-lucide="star" class="h-4 w-4 fill-current"></i>
                                          </div>
                                          <span class="text-sm text-gray-500">2 days ago</span>
                                      </div>
                                      <p class="text-gray-600 mb-2">
                                          Excellent sound quality and comfortable to wear for long periods. The noise cancellation works really well.
                                      </p>
                                      <div class="flex items-center space-x-4 text-sm text-gray-500">
                                          <button class="hover:text-primary transition-colors">Helpful (12)</button>
                                          <button class="hover:text-primary transition-colors">Reply</button>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>

              <div id="shipping" class="tab-content hidden">
                  <div class="space-y-6">
                      <div>
                          <h3 class="text-xl font-semibold mb-4">Shipping Information</h3>
                          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                              <div class="space-y-4">
                                  <div class="flex items-center space-x-3">
                                      <i data-lucide="truck" class="h-5 w-5 text-primary"></i>
                                      <div>
                                          <h4 class="font-semibold">Free Standard Shipping</h4>
                                          <p class="text-gray-600 text-sm">5-7 business days</p>
                                      </div>
                                  </div>
                                  <div class="flex items-center space-x-3">
                                      <i data-lucide="zap" class="h-5 w-5 text-accent"></i>
                                      <div>
                                          <h4 class="font-semibold">Express Shipping</h4>
                                          <p class="text-gray-600 text-sm">2-3 business days - $9.99</p>
                                      </div>
                                  </div>
                                  <div class="flex items-center space-x-3">
                                      <i data-lucide="clock" class="h-5 w-5 text-primary"></i>
                                      <div>
                                          <h4 class="font-semibold">Next Day Delivery</h4>
                                          <p class="text-gray-600 text-sm">Order by 2 PM - $19.99</p>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      
                      <div>
                          <h3 class="text-xl font-semibold mb-4">Returns & Exchanges</h3>
                          <div class="space-y-3 text-gray-600">
                              <p>• 30-day return policy</p>
                              <p>• Free returns on all orders</p>
                              <p>• Items must be in original condition</p>
                              <p>• Refunds processed within 5-7 business days</p>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</main>