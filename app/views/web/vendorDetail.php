<?php

  $dir = realpath(__DIR__);
  $vendorId = htmlspecialchars($_GET['vendorId']);
  include($dir.'/../../models/users.php');
  include($dir.'/../../models/product/products.php');
  $role = 'vendor';
  $products = [];
  $vendor = [];
  try{
    $row = User::query()
      -> select('*') 
      -> where('username', $vendorId)
      -> first();

    if(!empty($row)){
      $vendor = [
        'id' => $row['id'],
        'name' => $row['username'],
        'logo' => $row['profileImg'],
        'location' => 'San Francisco, CA',
        'description' => 'Premium audio products crafted for professionals and audiophiles alike.',
        'rating' => 4.6,
        'reviews' => 243,
        'productCount' => 30,
        'joinedDate' => $row['reg_date']
      ];

      $result = Product::query()
        -> select('*') 
        -> where('username', $row['username'])
        -> getWithPagination();

      $data = $result['data'];
      foreach($data as $row) {
        $products[] = [
          'id' => $row['id'],
          'name' => $row['product_name'],
          'image' => $row['img_url'],
          'vendorId' => 0,
          'vendorName' => $row['username'],
          'discount' => 20,
          'rating' => 4.3,
          'reviews' => 87,
          'price' => $row['price'],
          'originalPrice' => 99.99
        ];
      }
    }
  }catch(Exception $e){
    echo $e -> getMessage();
  }
  
  $path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
  $result = explode('/', $path);
  $breadcrumbs = [];
  foreach($result as $res){
    if($res !== 'apps' && $res !== 'public' && $res !== ''){
      $breadcrumbs[] =['label' => $res, 'url' => '/'.$res];
    }
  };

  // if(!isset($vendor)) {
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
      <a href="#" class="text-gray-600 hover:text-primary">Vendors</a>
      <i data-lucide="chevron-right" class="h-4 w-4 text-gray-400"></i>
      <span class="text-gray-900">John's Electronics</span>
    </div>
  </div>
</nav>

<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
  <div id="storefront-page" class="page-content">
    <!-- Store Header -->
    <div class="bg-gradient-to-r from-primary to-orange-400 rounded-lg p-8 mb-8 text-white">
      <div class="flex items-center space-x-6">
        <img class="h-20 w-20 rounded-full border-4 border-white" src="https://images.pexels.com/photos/220453/pexels-photo-220453.jpeg?auto=compress&cs=tinysrgb&w=80&h=80&dpr=2" alt="Store Logo">
        <div>
          <h1 class="text-3xl font-bold">John's Electronics</h1>
          <p class="text-orange-100 mt-2">Premium electronics and gadgets for tech enthusiasts</p>
          <div class="flex items-center mt-3 space-x-4">
            <div class="flex items-center">
              <i data-lucide="star" class="w-4 h-4 fill-current"></i>
              <span class="ml-1">4.8 (124 reviews)</span>
            </div>
            <div class="flex items-center">
              <i data-lucide="map-pin" class="w-4 h-4"></i>
              <span class="ml-1">New York, NY</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Store Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
      <div class="bg-white rounded-lg shadow p-6 text-center">
        <i data-lucide="package" class="w-8 h-8 text-primary mx-auto mb-2"></i>
        <p class="text-2xl font-bold text-gray-900">24</p>
        <p class="text-sm text-gray-500">Products</p>
      </div>
      <div class="bg-white rounded-lg shadow p-6 text-center">
        <i data-lucide="users" class="w-8 h-8 text-accent mx-auto mb-2"></i>
        <p class="text-2xl font-bold text-gray-900">1.2k</p>
        <p class="text-sm text-gray-500">Followers</p>
      </div>
      <div class="bg-white rounded-lg shadow p-6 text-center">
        <i data-lucide="shopping-bag" class="w-8 h-8 text-blue-500 mx-auto mb-2"></i>
        <p class="text-2xl font-bold text-gray-900">156</p>
        <p class="text-sm text-gray-500">Sales</p>
      </div>
      <div class="bg-white rounded-lg shadow p-6 text-center">
        <i data-lucide="calendar" class="w-8 h-8 text-purple-500 mx-auto mb-2"></i>
        <p class="text-2xl font-bold text-gray-900">2019</p>
        <p class="text-sm text-gray-500">Since</p>
      </div>
    </div>

    <!-- Products Grid -->
    <div class="mb-8">
      <h2 class="text-2xl font-bold text-gray-900 mb-6">Our Products</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition-shadow">
          <img class="w-full h-48 object-cover" src="https://images.pexels.com/photos/788946/pexels-photo-788946.jpeg?auto=compress&cs=tinysrgb&w=300&h=200&dpr=2" alt="iPhone 13 Pro">
          <div class="p-4">
            <h3 class="font-medium text-gray-900">iPhone 13 Pro</h3>
            <p class="text-sm text-gray-500 mt-1">Latest Apple smartphone</p>
            <div class="flex items-center justify-between mt-3">
              <span class="text-lg font-bold text-primary">$999</span>
              <div class="flex items-center">
                <i data-lucide="star" class="w-4 h-4 fill-current text-yellow-400"></i>
                <span class="text-sm text-gray-500 ml-1">4.9</span>
              </div>
            </div>
          </div>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition-shadow">
          <img class="w-full h-48 object-cover" src="https://images.pexels.com/photos/205421/pexels-photo-205421.jpeg?auto=compress&cs=tinysrgb&w=300&h=200&dpr=2" alt="MacBook Air">
          <div class="p-4">
            <h3 class="font-medium text-gray-900">MacBook Air</h3>
            <p class="text-sm text-gray-500 mt-1">Lightweight laptop</p>
            <div class="flex items-center justify-between mt-3">
              <span class="text-lg font-bold text-primary">$1,299</span>
              <div class="flex items-center">
                <i data-lucide="star" class="w-4 h-4 fill-current text-yellow-400"></i>
                <span class="text-sm text-gray-500 ml-1">4.7</span>
              </div>
            </div>
          </div>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition-shadow">
          <img class="w-full h-48 object-cover" src="https://images.pexels.com/photos/1649771/pexels-photo-1649771.jpeg?auto=compress&cs=tinysrgb&w=300&h=200&dpr=2" alt="AirPods Pro">
          <div class="p-4">
            <h3 class="font-medium text-gray-900">AirPods Pro</h3>
            <p class="text-sm text-gray-500 mt-1">Wireless earbuds</p>
            <div class="flex items-center justify-between mt-3">
              <span class="text-lg font-bold text-primary">$249</span>
              <div class="flex items-center">
                <i data-lucide="star" class="w-4 h-4 fill-current text-yellow-400"></i>
                <span class="text-sm text-gray-500 ml-1">4.8</span>
              </div>
            </div>
          </div>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition-shadow">
          <img class="w-full h-48 object-cover" src="https://images.pexels.com/photos/356056/pexels-photo-356056.jpeg?auto=compress&cs=tinysrgb&w=300&h=200&dpr=2" alt="iPad Pro">
          <div class="p-4">
            <h3 class="font-medium text-gray-900">iPad Pro</h3>
            <p class="text-sm text-gray-500 mt-1">Professional tablet</p>
            <div class="flex items-center justify-between mt-3">
              <span class="text-lg font-bold text-primary">$799</span>
              <div class="flex items-center">
                <i data-lucide="star" class="w-4 h-4 fill-current text-yellow-400"></i>
                <span class="text-sm text-gray-500 ml-1">4.6</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Reviews Section -->
    <div class="bg-white rounded-lg shadow p-6">
      <h3 class="text-lg font-medium text-gray-900 mb-6">Customer Reviews</h3>
      <div class="space-y-6">
        <div class="border-b border-gray-200 pb-6">
          <div class="flex items-start space-x-4">
            <img class="h-10 w-10 rounded-full" src="https://images.pexels.com/photos/1239291/pexels-photo-1239291.jpeg?auto=compress&cs=tinysrgb&w=40&h=40&dpr=2" alt="Customer">
            <div class="flex-1">
              <div class="flex items-center space-x-2">
                <h4 class="font-medium text-gray-900">Sarah Johnson</h4>
                <div class="flex items-center">
                  <i data-lucide="star" class="w-4 h-4 fill-current text-yellow-400"></i>
                  <i data-lucide="star" class="w-4 h-4 fill-current text-yellow-400"></i>
                  <i data-lucide="star" class="w-4 h-4 fill-current text-yellow-400"></i>
                  <i data-lucide="star" class="w-4 h-4 fill-current text-yellow-400"></i>
                  <i data-lucide="star" class="w-4 h-4 fill-current text-yellow-400"></i>
                </div>
              </div>
              <p class="text-gray-600 mt-2">Excellent service and fast shipping! The iPhone arrived in perfect condition and exactly as described. Highly recommend this seller.</p>
              <p class="text-sm text-gray-500 mt-2">March 12, 2024</p>
            </div>
          </div>
        </div>

        <div class="border-b border-gray-200 pb-6">
          <div class="flex items-start space-x-4">
            <img class="h-10 w-10 rounded-full" src="https://images.pexels.com/photos/1222271/pexels-photo-1222271.jpeg?auto=compress&cs=tinysrgb&w=40&h=40&dpr=2" alt="Customer">
            <div class="flex-1">
              <div class="flex items-center space-x-2">
                <h4 class="font-medium text-gray-900">Mike Chen</h4>
                <div class="flex items-center">
                  <i data-lucide="star" class="w-4 h-4 fill-current text-yellow-400"></i>
                  <i data-lucide="star" class="w-4 h-4 fill-current text-yellow-400"></i>
                  <i data-lucide="star" class="w-4 h-4 fill-current text-yellow-400"></i>
                  <i data-lucide="star" class="w-4 h-4 fill-current text-yellow-400"></i>
                  <i data-lucide="star" class="w-4 h-4 text-gray-300"></i>
                </div>
              </div>
              <p class="text-gray-600 mt-2">Great MacBook at a competitive price. The seller was very responsive to my questions and the laptop works perfectly.</p>
              <p class="text-sm text-gray-500 mt-2">March 8, 2024</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>