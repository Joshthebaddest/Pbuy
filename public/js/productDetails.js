// Product detail page functionality

document.addEventListener('DOMContentLoaded', function() {
    lucide.createIcons();
    initializeProductDetail();
});

function initializeProductDetail() {
    initializeImageGallery();
    initializeQuantityControls();
    initializeProductTabs();
    initializeVariantSelection();
    initializeAddToCart();
}

// Image gallery functionality
function initializeImageGallery() {
    const thumbnails = document.querySelectorAll('[onclick*="changeImage"]');
    thumbnails.forEach(thumbnail => {
        thumbnail.addEventListener('click', function() {
            // Remove active class from all thumbnails
            thumbnails.forEach(t => t.classList.remove('border-primary'));
            thumbnails.forEach(t => t.classList.add('border-transparent', 'hover:border-primary'));
            
            // Add active class to clicked thumbnail
            this.classList.remove('border-transparent', 'hover:border-primary');
            this.classList.add('border-primary');
        });
    });
}

function changeImage(thumbnail) {
    const mainImage = document.getElementById('mainImage');
    const newSrc = thumbnail.querySelector('img').src.replace('w=200', 'w=600');
    
    // Add fade effect
    mainImage.style.opacity = '0.5';
    
    setTimeout(() => {
        mainImage.src = newSrc;
        mainImage.style.opacity = '1';
    }, 150);
}

// Quantity controls
function initializeQuantityControls() {
    const quantityElement = document.getElementById('quantity');
    if (quantityElement) {
        // Ensure quantity doesn't go below 1
        const decreaseBtn = document.querySelector('[onclick="decreaseQuantity()"]');
        const increaseBtn = document.querySelector('[onclick="increaseQuantity()"]');
        
        if (decreaseBtn) {
            decreaseBtn.addEventListener('click', function(e) {
                e.preventDefault();
                decreaseQuantity();
            });
        }
        
        if (increaseBtn) {
            increaseBtn.addEventListener('click', function(e) {
                e.preventDefault();
                increaseQuantity();
            });
        }
    }
}

function decreaseQuantity() {
    const quantityElement = document.getElementById('quantity');
    let currentQuantity = parseInt(quantityElement.textContent);
    
    if (currentQuantity > 1) {
        quantityElement.textContent = currentQuantity - 1;
        updateTotalPrice();
    }
}

function increaseQuantity() {
    const quantityElement = document.getElementById('quantity');
    let currentQuantity = parseInt(quantityElement.textContent);
    const maxQuantity = 23; // Available stock
    
    if (currentQuantity < maxQuantity) {
        quantityElement.textContent = currentQuantity + 1;
        updateTotalPrice();
    } else {
        MarketHub.showNotification('Maximum quantity available is ' + maxQuantity, 'warning');
    }
}

function updateTotalPrice() {
    // This would update the total price based on quantity
    // For now, we'll just show a notification
    const quantity = document.getElementById('quantity').textContent;
    console.log('Quantity updated to:', quantity);
}

// Product tabs functionality
function initializeProductTabs() {
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');
    
    tabButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const tabName = this.getAttribute('onclick').match(/'([^']+)'/)[1];
            showTab(tabName);
        });
    });
}

function showTab(tabName) {
    // Hide all tab contents
    const tabContents = document.querySelectorAll('.tab-content');
    tabContents.forEach(content => {
        content.classList.add('hidden');
    });
    
    // Remove active class from all tab buttons
    const tabButtons = document.querySelectorAll('.tab-button');
    tabButtons.forEach(button => {
        button.classList.remove('active', 'border-primary', 'text-primary');
        button.classList.add('border-transparent', 'text-gray-500');
    });
    
    // Show selected tab content
    const selectedContent = document.getElementById(tabName + '-section') || document.getElementById(tabName);
    if (selectedContent) {
        selectedContent.classList.remove('hidden');
    }
    
    // Add active class to clicked tab button
    const activeButton = document.querySelector(`[onclick*="${tabName}"]`);
    if (activeButton) {
        activeButton.classList.add('active', 'border-primary', 'text-primary');
        activeButton.classList.remove('border-transparent', 'text-gray-500');
    }
}

// Variant selection functionality
function initializeVariantSelection() {
    initializeColorVariants();
    initializeSizeVariants();
}

function initializeColorVariants() {
    const colorButtons = document.querySelectorAll('[class*="rounded-full"][class*="w-10"][class*="h-10"]');
    colorButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active state from all color buttons
            colorButtons.forEach(btn => {
                btn.classList.remove('border-primary');
                btn.classList.add('border-gray-300', 'hover:border-primary');
            });
            
            // Add active state to clicked button
            this.classList.remove('border-gray-300', 'hover:border-primary');
            this.classList.add('border-primary');
            
            // Update product info based on selected color
            updateProductVariant('color', this.className);
        });
    });
}

function initializeSizeVariants() {
    const sizeButtons = document.querySelectorAll('[class*="px-4"][class*="py-2"][class*="border-2"]');
    sizeButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active state from all size buttons
            sizeButtons.forEach(btn => {
                btn.classList.remove('border-primary', 'bg-primary', 'text-white');
                btn.classList.add('border-gray-300', 'text-gray-700', 'hover:border-primary');
            });
            
            // Add active state to clicked button
            this.classList.remove('border-gray-300', 'text-gray-700', 'hover:border-primary');
            this.classList.add('border-primary', 'bg-primary', 'text-white');
            
            // Update product info based on selected size
            updateProductVariant('size', this.textContent);
        });
    });
}

function updateProductVariant(type, value) {
    console.log(`Selected ${type}:`, value);
    // Here you would update the product information, price, availability, etc.
    // based on the selected variant
}

// Add to cart functionality
function initializeAddToCart() {
    const addToCartBtn = document.querySelector('[class*="bg-primary"][class*="Add to Cart"]');
    const buyNowBtn = document.querySelector('[class*="bg-accent"]');
    const wishlistBtn = document.querySelector('[data-lucide="heart"]').closest('button');
    
    if (addToCartBtn) {
        addToCartBtn.addEventListener('click', addToCart);
    }
    
    if (buyNowBtn) {
        buyNowBtn.addEventListener('click', buyNow);
    }
    
    if (wishlistBtn) {
        wishlistBtn.addEventListener('click', toggleWishlist);
    }
}

function addToCart() {
    const quantity = parseInt(document.getElementById('quantity').textContent);
    const selectedColor = getSelectedVariant('color');
    const selectedSize = getSelectedVariant('size');
    
    const product = {
        id: 'product-1', // This would come from the product data
        name: 'Wireless Bluetooth Headphones',
        price: 79.99,
        quantity: quantity,
        color: selectedColor,
        size: selectedSize,
        image: document.getElementById('mainImage').src,
        vendor: 'TechVendor Store'
    };
    
    // Get existing cart or create new one
    let cart = MarketHub.getFromLocalStorage('cart') || [];
    
    // Check if product already exists in cart
    const existingProductIndex = cart.findIndex(item => 
        item.id === product.id && 
        item.color === product.color && 
        item.size === product.size
    );
    
    if (existingProductIndex > -1) {
        // Update quantity if product exists
        cart[existingProductIndex].quantity += quantity;
    } else {
        // Add new product to cart
        cart.push(product);
    }
    
    // Save updated cart
    MarketHub.saveToLocalStorage('cart', cart);
    
    // Update cart count in header
    updateCartCount();
    
    // Show success notification
    MarketHub.showNotification('Product added to cart!', 'success');
    
    // Add visual feedback
    const button = event.target;
    const originalText = button.textContent;
    button.textContent = 'Added!';
    button.classList.add('bg-green-500');
    button.classList.remove('bg-primary');
    
    setTimeout(() => {
        button.textContent = originalText;
        button.classList.remove('bg-green-500');
        button.classList.add('bg-primary');
    }, 2000);
}

function buyNow() {
    // First add to cart
    addToCart();
    
    // Then redirect to checkout
    setTimeout(() => {
        window.location.href = 'checkout.html';
    }, 500);
}

function toggleWishlist() {
    const heartIcon = this.querySelector('[data-lucide="heart"]');
    const isInWishlist = heartIcon.classList.contains('fill-current');
    
    if (isInWishlist) {
        // Remove from wishlist
        heartIcon.classList.remove('fill-current', 'text-red-500');
        heartIcon.classList.add('text-gray-600');
        MarketHub.showNotification('Removed from wishlist', 'info');
    } else {
        // Add to wishlist
        heartIcon.classList.add('fill-current', 'text-red-500');
        heartIcon.classList.remove('text-gray-600');
        MarketHub.showNotification('Added to wishlist!', 'success');
    }
    
    // Here you would also update the wishlist in localStorage or send to server
    updateWishlist(isInWishlist);
}

function getSelectedVariant(type) {
    if (type === 'color') {
        const activeColorBtn = document.querySelector('[class*="rounded-full"][class*="border-primary"]');
        if (activeColorBtn) {
            // Extract color from class names
            if (activeColorBtn.classList.contains('bg-black')) return 'Black';
            if (activeColorBtn.classList.contains('bg-white')) return 'White';
            if (activeColorBtn.classList.contains('bg-blue-500')) return 'Blue';
            if (activeColorBtn.classList.contains('bg-red-500')) return 'Red';
        }
    } else if (type === 'size') {
        const activeSizeBtn = document.querySelector('[class*="bg-primary"][class*="text-white"]');
        return activeSizeBtn ? activeSizeBtn.textContent : null;
    }
    return null;
}

function updateCartCount() {
    const cart = MarketHub.getFromLocalStorage('cart') || [];
    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
    
    const cartCountElement = document.querySelector('[data-lucide="shopping-cart"]').nextElementSibling;
    if (cartCountElement) {
        cartCountElement.textContent = totalItems;
    }
}

function updateWishlist(remove = false) {
    let wishlist = MarketHub.getFromLocalStorage('wishlist') || [];
    const productId = 'product-1'; // This would come from the product data
    
    if (remove) {
        wishlist = wishlist.filter(id => id !== productId);
    } else {
        if (!wishlist.includes(productId)) {
            wishlist.push(productId);
        }
    }
    
    MarketHub.saveToLocalStorage('wishlist', wishlist);
    
    // Update wishlist count in header
    const wishlistCountElement = document.querySelector('[data-lucide="heart"]').nextElementSibling;
    if (wishlistCountElement) {
        wishlistCountElement.textContent = wishlist.length;
    }
}

// Initialize cart count on page load
document.addEventListener('DOMContentLoaded', function() {
    updateCartCount();
    
    // Initialize wishlist state
    const wishlist = MarketHub.getFromLocalStorage('wishlist') || [];
    const productId = 'product-1';
    
    if (wishlist.includes(productId)) {
        const heartIcon = document.querySelector('[data-lucide="heart"]');
        if (heartIcon) {
            heartIcon.classList.add('fill-current', 'text-red-500');
            heartIcon.classList.remove('text-gray-600');
        }
    }
});