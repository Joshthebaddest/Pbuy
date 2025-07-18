<?php 
    require_once __DIR__ . '/../../../config/globalConfig.php';
    require_once __DIR__ . '/../../controllers/cartController.php';
    require_once __DIR__ . '/../../models/products.php';
    $items = [];
    foreach($carts as $key => $value){
        $product = Product::query()
            ->select('id', 'product_name', 'img_url', 'quantity', 'price', 'username')
            ->where('id', $key)
            ->first();
        $items [] = [
            'id' => $product['id'],
            'image' => $product['img_url'],
            'name' => $product['product_name'],
            'quantity' => $value,
            'vendorName' => $product['username'],
            'price' => $product['price']
        ];
    }

    $items = [
    [
        'id' => 101,
        'name' => 'Wireless Mouse',
        'price' => 25.99,
        'quantity' => 2,
        // 'image' => 'images/mouse.jpg',
        'vendorName' => "josiah",
    ],
    [
        'id' => 205,
        'name' => 'Bluetooth Headphones',
        'price' => 59.99,
        'quantity' => 1,
        // 'image' => 'images/headphones.jpg',
        'vendorName' => "josiah",
    ],
    [
        'id' => 309,
        'name' => 'USB-C Charger',
        'price' => 18.50,
        'quantity' => 3,
        // 'image' => 'images/charger.jpg',
        'vendorName' => "josiah",
    ]
];


    // Calculate total
    $total = array_reduce($items, function($carry, $item) {
        return $carry + ($item['price'] * $item['quantity']);
    }, 0);
?>

<!-- Breadcrumb -->
<nav class="bg-white py-3 border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center space-x-2 text-sm">
            <a href="index.html" class="text-gray-600 hover:text-primary">Home</a>
            <i data-lucide="chevron-right" class="h-4 w-4 text-gray-400"></i>
            <span class="text-gray-900">Shopping Cart</span>
        </div>
    </div>
</nav>

<?php if (empty($items)): ?>
  <div class="container mx-auto px-4 py-16">
    <div class="text-center">
        <i data-lucide="shopping-bag" class="h-24 w-24 text-gray-300 mx-auto mb-4"></i>
        <h1 class="text-2xl font-bold mb-2">Your cart is empty</h1>
        <p class="text-gray-600 mb-8">Add some products to get started!</p>
        <a href="<?= BASE_PATH ?>products" class="bg-primary text-white px-8 py-3 rounded-lg font-semibold hover:shadow-lg transition-colors">
            Continue Shopping
        </a>
    </div>
  </div>
<?php endif; ?>

<?php if (!empty($items)): ?>
    <main class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold mb-8">Shopping Cart</h1>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Cart Items -->
                <div class="lg:col-span-2 space-y-4">
                    <?php foreach ($items as $item): ?>
                        <div class="bg-white rounded-lg shadow-sm p-6">
                            <div class="flex items-center space-x-4">
                                <img 
                                    src="<?php echo $item['image'] ?? "https://images.pexels.com/photos/788946/pexels-photo-788946.jpeg?auto=compress&cs=tinysrgb&w=150"?>"
                                    alt="<?php echo htmlspecialchars($item['name']); ?>" 
                                    class="w-20 h-20 object-cover rounded-lg"
                                >
                                <div class="flex-1">
                                    <h3 class="font-semibold mb-1"><?php echo htmlspecialchars($item['name']); ?></h3>
                                    <p class="text-sm text-gray-600 mb-2">by <?php echo htmlspecialchars($item['vendorName']); ?></p>
                                    <div class="flex items-center space-x-4 text-sm text-gray-600">
                                        <span>Color: Black</span>
                                        <span>Type: Over-ear</span>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <div class="flex items-center border border-gray-300 rounded-lg">
                                        <form method="POST" action="">
                                            <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                                            <input type="hidden" name="type" value="decrement">
                                            <button name="submit" value="decrease" class="p-2 hover:bg-gray-100 transition-colors" <?php if ($item['quantity'] <= 1) echo 'disabled'; ?>>
                                                <i data-lucide="minus" class="w-4 h-4"></i>
                                            </button>
                                        </form>

                                        <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1" class="w-16 text-center border rounded" form="update-form-<?php echo $item['id']; ?>">

                                        <form method="POST" action="">
                                            <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                                            <input type="hidden" name="type" value="increment">
                                            <button name="submit" value="increase" class="p-2 hover:bg-gray-100 transition-colors">
                                                <i data-lucide="plus" class="w-4 h-4"></i>
                                            </button>
                                        </form>
                                    </div>

                                    <div class="text-right">
                                        <div class="font-semibold text-primary">$<?php echo number_format($item['price'], 2); ?></div>
                                        <div class="text-sm text-gray-500 line-through">$99.99</div>
                                    </div>
                                    <form method="POST" action="">
                                        <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                                        <input type="hidden" name="type" value="delete">
                                        <button type="submit" class="p-2 text-gray-400 hover:text-red-500 transition-colors">
                                            <i data-lucide="trash-2" class="w-5 h-5"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <!-- Continue Shopping -->
                    <div class="flex justify-between items-center pt-4">
                        <a href="index.html" class="flex items-center space-x-2 text-primary hover:underline">
                            <i data-lucide="arrow-left" class="h-4 w-4"></i>
                            <span>Continue Shopping</span>
                        </a>
                        <button class="text-gray-600 hover:text-red-500 transition-colors">
                            Clear Cart
                        </button>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-sm p-6 sticky top-24">
                        <h2 class="text-xl font-semibold mb-6">Order Summary</h2>
                        
                        <div class="space-y-4 mb-6">
                            <div class="flex justify-between">
                                <span>Subtotal (3 items)</span>
                                <span>$<?php echo number_format($total, 2); ?></span>
                            </div>
                            <div class="flex justify-between">
                                <span>Shipping</span>
                                <span class="text-accent">Free</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Tax</span>
                                <span>$<?php echo number_format($total * 0.08, 2); ?></span>
                            </div>
                            <div class="border-t pt-4">
                                <div class="flex justify-between font-semibold text-lg">
                                    <span>Total</span>
                                    <span class="text-primary">$<?php echo number_format($total * 1.08, 2); ?></span>
                                </div>
                            </div>
                        </div>

                        <!-- Promo Code -->
                        <div class="mb-6">
                            <div class="flex space-x-2">
                                <input type="text" placeholder="Promo code" 
                                        class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                                <button class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition-colors">
                                    Apply
                                </button>
                            </div>
                        </div>

                        <!-- Checkout Button -->
                        <button class="w-full bg-primary text-white py-3 rounded-lg font-semibold hover:bg-orange-600 transition-colors mb-4">
                            Proceed to Checkout
                        </button>

                        <!-- Payment Methods -->
                        <div class="text-center">
                            <p class="text-sm text-gray-600 mb-3">We accept</p>
                            <div class="flex justify-center space-x-3">
                                <div class="w-10 h-6 bg-blue-600 rounded text-white text-xs flex items-center justify-center font-bold">VISA</div>
                                <div class="w-10 h-6 bg-red-500 rounded text-white text-xs flex items-center justify-center font-bold">MC</div>
                                <div class="w-10 h-6 bg-blue-500 rounded text-white text-xs flex items-center justify-center font-bold">AMEX</div>
                                <div class="w-10 h-6 bg-yellow-400 rounded text-black text-xs flex items-center justify-center font-bold">PP</div>
                            </div>
                        </div>

                        <!-- Security Badge -->
                        <div class="mt-6 text-center">
                            <div class="flex items-center justify-center space-x-2 text-sm text-gray-600">
                                <i data-lucide="shield-check" class="h-4 w-4 text-accent"></i>
                                <span>Secure checkout</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Recently Viewed -->
            <section class="mt-16">
                <h2 class="text-2xl font-bold mb-6">You might also like</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Product suggestions would go here -->
                    <div class="bg-white rounded-lg shadow-sm p-4 text-center">
                        <div class="text-4xl mb-2">📱</div>
                        <h3 class="font-semibold mb-2">Related Products</h3>
                        <p class="text-gray-600 text-sm">Discover more items you might like</p>
                    </div>
                </div>
            </section>
    </div>
<?php endif; ?>