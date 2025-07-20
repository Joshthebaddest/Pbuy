<?php
require_once __DIR__ . '/../../../config/globalConfig.php';
  // Dummy products array
  $products = [
      [
      "id" => 1,
      "name" => "Wireless Bluetooth Headphones",
      "price" => 59.99,
      "image" => "https://via.placeholder.com/300x200?text=Headphones",
      "rating" => 4.5
      ],
      [
      "id" => 2,
      "name" => "Smart Watch Series 7",
      "price" => 129.99,
      "image" => "https://via.placeholder.com/300x200?text=Smart+Watch",
      "rating" => 4.7
      ],
      [
      "id" => 3,
      "name" => "Laptop Backpack",
      "price" => 39.95,
      "image" => "https://via.placeholder.com/300x200?text=Backpack",
      "rating" => 4.3
      ],
      [
      "id" => 4,
      "name" => "4K Action Camera",
      "price" => 89.00,
      "image" => "https://via.placeholder.com/300x200?text=Camera",
      "rating" => 4.6
      ],
      [
      "id" => 5,
      "name" => "Portable Bluetooth Speaker",
      "price" => 25.50,
      "image" => "https://via.placeholder.com/300x200?text=Speaker",
      "rating" => 4.1
      ],
      [
      "id" => 6,
      "name" => "Gaming Mouse RGB",
      "price" => 19.99,
      "image" => "https://via.placeholder.com/300x200?text=Mouse",
      "rating" => 4.4
      ],
      [
      "id" => 7,
      "name" => "Wireless Charger Stand",
      "price" => 34.99,
      "image" => "https://via.placeholder.com/300x200?text=Wireless+Charger",
      "rating" => 4.2
      ],
      [
      "id" => 8,
      "name" => "Noise Cancelling Earbuds",
      "price" => 79.99,
      "image" => "https://via.placeholder.com/300x200?text=Earbuds",
      "rating" => 4.8
      ],
  ];

  // Function to print star ratings with half stars and empty stars
  function renderStars($rating) {
      $fullStars = floor($rating);
      $halfStar = ($rating - $fullStars) >= 0.5;
      $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);

      $starsHtml = '<span class="text-yellow-400" aria-label="Rating: ' . $rating . ' out of 5 stars">';
      for ($i = 0; $i < $fullStars; $i++) {
          $starsHtml .= "&#9733;"; // solid star ★
      }
      if ($halfStar) {
          $starsHtml .= "&#189;"; // half star approx (½)
      }
      for ($i = 0; $i < $emptyStars; $i++) {
          $starsHtml .= "&#9734;"; // empty star ☆
      }
      $starsHtml .= "</span>";
      return $starsHtml;
  }

$products = [
  [
    'id' => 101,
    'name' => 'Wireless Noise-Cancelling Headphones',
    'image' => '/images/products/headphones.jpg',
    'vendorId' => 42,
    'vendorName' => 'SoundGear',
    'discount' => 20,
    'rating' => 4.3,
    'reviews' => 87,
    'price' => 79.99,
    'originalPrice' => 99.99
  ],
  [
    'id' => 102,
    'name' => 'Smartwatch Pro Series 6',
    'image' => '/images/products/smartwatch.jpg',
    'vendorId' => 45,
    'vendorName' => 'WristTech',
    'discount' => 15,
    'rating' => 4.7,
    'reviews' => 145,
    'price' => 169.99,
    'originalPrice' => 199.99
  ],
  [
    'id' => 103,
    'name' => 'Portable Bluetooth Speaker',
    'image' => '/images/products/speaker.jpg',
    'vendorId' => 43,
    'vendorName' => 'AudioMax',
    'discount' => 10,
    'rating' => 4.0,
    'reviews' => 63,
    'price' => 45.00,
    'originalPrice' => 49.99
  ],
  [
    'id' => 104,
    'name' => 'Gaming Mouse RGB Ultra',
    'image' => '/images/products/mouse.jpg',
    'vendorId' => 48,
    'vendorName' => 'ClickPro',
    'discount' => null,
    'rating' => 3.8,
    'reviews' => 28,
    'price' => 34.99,
    'originalPrice' => null
  ]
];
$vendors = [
  [
    'id' => 42,
    'name' => 'SoundGear',
    'logo' => '/images/vendors/soundgear-logo.png',
    'location' => 'San Francisco, CA',
    'description' => 'Premium audio products crafted for professionals and audiophiles alike.',
    'rating' => 4.6,
    'reviews' => 243,
    'productCount' => 18
  ],
  [
    'id' => 42,
    'name' => 'SoundGear',
    'logo' => '/images/vendors/soundgear-logo.png',
    'location' => 'San Francisco, CA',
    'description' => 'Premium audio products crafted for professionals and audiophiles alike.',
    'rating' => 4.6,
    'reviews' => 243,
    'productCount' => 18
  ],
  [
    'id' => 42,
    'name' => 'SoundGear',
    'logo' => '/images/vendors/soundgear-logo.png',
    'location' => 'San Francisco, CA',
    'description' => 'Premium audio products crafted for professionals and audiophiles alike.',
    'rating' => 4.6,
    'reviews' => 243,
    'productCount' => 18
  ],
  [
    'id' => 42,
    'name' => 'SoundGear',
    'logo' => '/images/vendors/soundgear-logo.png',
    'location' => 'San Francisco, CA',
    'description' => 'Premium audio products crafted for professionals and audiophiles alike.',
    'rating' => 4.6,
    'reviews' => 243,
    'productCount' => 18
  ],
  [
    'id' => 42,
    'name' => 'SoundGear',
    'logo' => '/images/vendors/soundgear-logo.png',
    'location' => 'San Francisco, CA',
    'description' => 'Premium audio products crafted for professionals and audiophiles alike.',
    'rating' => 4.6,
    'reviews' => 243,
    'productCount' => 18
  ]
]

?>


<div>
  <!-- Hero Banner -->
    <section class="bg-gradient-to-r from-primary to-orange-400 text-white py-20">
      <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl md:text-6xl font-bold mb-6">Discover Amazing Products</h1>
        <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto opacity-90">
          Shop from multiple trusted vendors all in one place. Find everything you need with the best prices and
          quality.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
          <a href="<?= BASE_PATH ?>products" class="bg-white text-primary px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
            Start Shopping
          </a>
          <a href="<?= BASE_PATH ?>products" class="bg-transparent text-white px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 hover:text-primary transition-colors">
            Browse Vendors
          </a>
        </div>
      </div>
    </section>



    <?php include __DIR__ . '/components/home/categoryGrid.php' ?>

    <?php include __DIR__ . '/components/home/dealSelection.php' ?>
  <!-- Main Content with Sidebar and Products -->
    <section class="py-16 bg-gray-50">
      <div class="container mx-auto px-4">
        <div class="text-center mb-12">
          <h2 class="text-3xl font-bold mb-4">Featured Vendors</h2>
          <p class="text-gray-600 max-w-2xl mx-auto">
            Discover amazing products from our trusted vendor partners
          </p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <?php foreach ($vendors as $vendor): ?>
          <div class="hover:shadow-lg transition-shadow duration-200 border rounded-lg overflow-hidden bg-white">
            <div class="p-6">
              <div class="flex items-center space-x-4 mb-4">
                <img
                  src="<?php echo $vendor['logo'] ?? '/placeholder.svg'; ?>"
                  alt="<?php echo htmlspecialchars($vendor['name']); ?>"
                  width="60"
                  height="60"
                  class="rounded-full"
                />
                <div class="flex-1">
                  <a href="/vendors/<?php echo $vendor['id']; ?>">
                    <h3 class="font-semibold text-lg hover:text-blue-600 transition-colors">
                      <?php echo htmlspecialchars($vendor['name']); ?>
                    </h3>
                  </a>
                  <div class="flex items-center text-sm text-gray-600">
                    <i data-lucide="map-pin" class="w-3 h-3 mr-1"></i>
                    <?php echo htmlspecialchars($vendor['location']); ?>
                  </div>
                </div>
              </div>

              <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                <?php echo htmlspecialchars($vendor['description']); ?>
              </p>

              <div class="flex items-center justify-between">
                <div class="flex items-center">
                  <i data-lucide="star" class="w-4 h-4 text-yellow-400 fill-current mr-1"></i>
                  <span class="text-sm font-medium"><?php echo $vendor['rating']; ?></span>
                  <span class="text-sm text-gray-500 ml-1">(<?php echo $vendor['reviews']; ?>)</span>
                </div>
                <span class="bg-gray-100 text-gray-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                  <?php echo $vendor['productCount']; ?> products
                </span>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <section class="py-16">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-12">
          <h3 class="text-3xl font-bold">Featured Products</h3>
          <a href="/products" class="text-primary font-semibold hover:underline">View All</a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
          <?php foreach ($products as $product): ?>
            <div class="product-card bg-white rounded-lg shadow-sm hover:shadow-lg transition-shadow overflow-hidden">
              <div class="relative">
                <a href="<?php echo BASE_PATH; ?>products/<?php echo $product['name']; ?>">
                  <img 
                    src="<?php echo $product['image'] ?? '/placeholder.svg'; ?>"
                    alt="<?php echo htmlspecialchars($product['name']); ?>"
                    class="w-full h-48 object-cover"
                  >
                </a>
                <button class="absolute top-3 right-3 p-2 bg-white rounded-full shadow-md hover:bg-gray-100 transition-colors">
                  <i data-lucide="heart" class="h-4 w-4 text-gray-600"></i>
                </button>
                <span class="absolute top-3 left-3 bg-accent text-white px-2 py-1 text-xs font-semibold rounded">New</span>
              </div>
              <div class="p-4">
                <a href="<?php echo BASE_PATH; ?>products/<?php echo $product['name']; ?>" class="font-semibold mb-2 hover:text-primary transition-colors block"><?php echo($product['name']); ?></a>
                <p class="text-sm text-gray-600 mb-2"><?php echo($product['vendorName']); ?></p>
                <div class="flex items-center mb-2">
                    <div class="flex text-yellow-400">
                      <i data-lucide="star" class="h-4 w-4 fill-current"></i>
                      <i data-lucide="star" class="h-4 w-4 fill-current"></i>
                      <i data-lucide="star" class="h-4 w-4 fill-current"></i>
                      <i data-lucide="star" class="h-4 w-4 fill-current"></i>
                      <i data-lucide="star" class="h-4 w-4"></i>
                    </div>
                    <span class="text-sm text-gray-600 ml-2">(124)</span>
                </div>
                <div class="flex items-center justify-between">
                  <div>
                    <span class="text-lg font-bold text-primary">$<?php echo number_format($product['price'], 2); ?></span>
                    <?php if (!empty($product['originalPrice'])): ?>
                      <span class="text-sm text-gray-500 line-through ml-2">$<?php echo number_format($product['originalPrice'], 2); ?></span>
                    <?php endif; ?>
                  </div>
                  <button class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-orange-600 transition-colors" onclick="addToCartQuick('product-1')">
                    Add to Cart
                  </button>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <section class="py-16">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-12">
          <h3 class="text-3xl font-bold">Recently Viewed</h3>
          <a href="/products" class="text-primary font-semibold hover:underline">View All</a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
          <!-- Product Grid Placeholder -->
          <?php foreach ($products as $product): ?>
                        <div class="product-card bg-white rounded-lg shadow-sm hover:shadow-lg transition-shadow overflow-hidden">
              <div class="relative">
                <a href="product-detail.html">
                  <img 
                    src="<?php echo $product['image'] ?? '/placeholder.svg'; ?>"
                    alt="<?php echo htmlspecialchars($product['name']); ?>"
                    class="w-full h-48 object-cover"
                  >
                </a>
                <button class="absolute top-3 right-3 p-2 bg-white rounded-full shadow-md hover:bg-gray-100 transition-colors">
                  <i data-lucide="heart" class="h-4 w-4 text-gray-600"></i>
                </button>
                <span class="absolute top-3 left-3 bg-accent text-white px-2 py-1 text-xs font-semibold rounded">New</span>
              </div>
              <div class="p-4">
                <a href="product-detail.html" class="font-semibold mb-2 hover:text-primary transition-colors block"><?php echo($product['name']); ?></a>
                <p class="text-sm text-gray-600 mb-2"><?php echo($product['vendorName']); ?></p>
                <div class="flex items-center mb-2">
                    <div class="flex text-yellow-400">
                      <i data-lucide="star" class="h-4 w-4 fill-current"></i>
                      <i data-lucide="star" class="h-4 w-4 fill-current"></i>
                      <i data-lucide="star" class="h-4 w-4 fill-current"></i>
                      <i data-lucide="star" class="h-4 w-4 fill-current"></i>
                      <i data-lucide="star" class="h-4 w-4"></i>
                    </div>
                    <span class="text-sm text-gray-600 ml-2">(124)</span>
                </div>
                <div class="flex items-center justify-between">
                  <div>
                    <span class="text-lg font-bold text-primary">$<?php echo number_format($product['price'], 2); ?></span>
                    <?php if (!empty($product['originalPrice'])): ?>
                      <span class="text-sm text-gray-500 line-through ml-2">$<?php echo number_format($product['originalPrice'], 2); ?></span>
                    <?php endif; ?>
                  </div>
                  <button class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-orange-600 transition-colors" onclick="addToCartQuick('product-1')">
                    Add to Cart
                  </button>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <section class="bg-gradient-to-r from-primary to-orange-400 rounded-lg p-8 text-white">
      <div class="max-w-2xl mx-auto text-center">
        <div class="flex justify-center mb-4">
          <div class="bg-white/20 p-3 rounded-full">
            <i data-lucide="mail" class="h-8 w-8"></i>
          </div>
        </div>

        <h2 class="text-3xl font-bold mb-4">Stay in the Loop</h2>
        <p class="text-xl mb-8 opacity-95">
          Get exclusive deals, new arrivals, and insider updates delivered straight to your inbox.
        </p>

        <form class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
          <input
            type="email"
            placeholder="Enter your email address"
            value=""
            class="flex-1 bg-white text-gray-900 rounded-lg px-2"
            required
          />
          <a href="<?= BASE_PATH ?>products" class="bg-white text-primary px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
            Subscribe
          </a>
        </form>

        <div class="flex items-center justify-center mt-6 text-sm opacity-75">
          <i data-lucide="gift" class="h-4 w-4 mr-2"></i>
          <span>Get 10% off your first order when you subscribe!</span>
        </div>
      </div>
    </section>    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
 

</div>