// Profile page functionality

document.addEventListener('DOMContentLoaded', function() {
    lucide.createIcons();
    initializeProfile();
    loadUserData();
});

function initializeProfile() {
    initializeNavigation();
    initializeProfileForm();
    initializeAddressManagement();
    loadOrderHistory();
    loadWishlist();
    loadUserReviews();
}

// Profile navigation
function initializeNavigation() {
    const navItems = document.querySelectorAll('.profile-nav-item');
    
    navItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Get section name from onclick attribute or data attribute
            const onclick = this.getAttribute('onclick');
            if (onclick) {
                const sectionName = onclick.match(/'([^']+)'/)?.[1];
                if (sectionName) {
                    showSection(sectionName);
                }
            }
        });
    });
    
    // Make showSection globally available
    window.showSection = showSection;
}

function showSection(sectionName) {
    // Hide all sections
    const sections = document.querySelectorAll('.profile-section');
    sections.forEach(section => {
        section.classList.add('hidden');
    });
    
    // Show selected section
    const targetSection = document.getElementById(sectionName + '-section');
    if (targetSection) {
        targetSection.classList.remove('hidden');
    }
    
    // Update navigation active state
    const navItems = document.querySelectorAll('.profile-nav-item');
    navItems.forEach(item => {
        item.classList.remove('active', 'bg-primary', 'bg-opacity-10', 'text-primary');
        item.classList.add('hover:bg-gray-100');
    });
    
    // Add active state to current nav item
    const activeNavItem = document.querySelector(`[onclick*="${sectionName}"]`);
    if (activeNavItem) {
        activeNavItem.classList.add('active', 'bg-primary', 'bg-opacity-10', 'text-primary');
        activeNavItem.classList.remove('hover:bg-gray-100');
    }
    
    // Load section-specific data
    switch(sectionName) {
        case 'orders':
            loadOrderHistory();
            break;
        case 'wishlist':
            loadWishlist();
            break;
        case 'reviews':
            loadUserReviews();
            break;
        case 'addresses':
            loadAddresses();
            break;
    }
}

// Profile form functionality
function initializeProfileForm() {
    const profileForm = document.querySelector('#profile-section form');
    
    if (profileForm) {
        profileForm.addEventListener('submit', function(e) {
            e.preventDefault();
            saveProfileData();
        });
        
        // Add real-time validation
        const inputs = profileForm.querySelectorAll('input');
        inputs.forEach(input => {
            input.addEventListener('blur', validateInput);
            input.addEventListener('input', clearValidationError);
        });
    }
}

function validateInput(e) {
    const input = e.target;
    const value = input.value.trim();
    let isValid = true;
    let errorMessage = '';
    
    // Remove existing error styling
    input.classList.remove('border-red-500');
    const existingError = input.parentNode.querySelector('.error-message');
    if (existingError) {
        existingError.remove();
    }
    
    // Validate based on input type
    switch(input.type) {
        case 'email':
            if (value && !MarketHub.validateEmail(value)) {
                isValid = false;
                errorMessage = 'Please enter a valid email address';
            }
            break;
        case 'tel':
            if (value && !MarketHub.validatePhone(value)) {
                isValid = false;
                errorMessage = 'Please enter a valid phone number';
            }
            break;
        default:
            if (input.hasAttribute('required') && !MarketHub.validateRequired(value)) {
                isValid = false;
                errorMessage = 'This field is required';
            }
    }
    
    if (!isValid) {
        showInputError(input, errorMessage);
    }
    
    return isValid;
}

function showInputError(input, message) {
    input.classList.add('border-red-500');
    
    const errorDiv = document.createElement('div');
    errorDiv.className = 'error-message text-red-500 text-sm mt-1';
    errorDiv.textContent = message;
    
    input.parentNode.appendChild(errorDiv);
}

function clearValidationError(e) {
    const input = e.target;
    input.classList.remove('border-red-500');
    
    const errorMessage = input.parentNode.querySelector('.error-message');
    if (errorMessage) {
        errorMessage.remove();
    }
}

function saveProfileData() {
    const form = document.querySelector('#profile-section form');
    const formData = new FormData(form);
    
    // Validate all inputs
    const inputs = form.querySelectorAll('input[required]');
    let isValid = true;
    
    inputs.forEach(input => {
        if (!validateInput({ target: input })) {
            isValid = false;
        }
    });
    
    if (!isValid) {
        MarketHub.showNotification('Please fix the errors before saving', 'error');
        return;
    }
    
    // Collect form data
    const profileData = {
        firstName: formData.get('firstName') || form.querySelector('input[value="John"]').value,
        lastName: formData.get('lastName') || form.querySelector('input[value="Doe"]').value,
        email: formData.get('email') || form.querySelector('input[value="john.doe@email.com"]').value,
        phone: formData.get('phone') || form.querySelector('input[value="+1 (555) 123-4567"]').value,
        dateOfBirth: formData.get('dateOfBirth') || form.querySelector('input[value="1990-01-15"]').value
    };
    
    // Save to localStorage (in real app, this would be sent to server)
    MarketHub.saveToLocalStorage('userProfile', profileData);
    
    // Show success message
    MarketHub.showNotification('Profile updated successfully!', 'success');
    
    // Update header display name
    updateHeaderUserName(profileData.firstName + ' ' + profileData.lastName);
}

function loadUserData() {
    const savedProfile = MarketHub.getFromLocalStorage('userProfile');
    
    if (savedProfile) {
        // Populate form fields
        const form = document.querySelector('#profile-section form');
        if (form) {
            const inputs = form.querySelectorAll('input');
            inputs.forEach(input => {
                const fieldName = input.name || getFieldNameFromValue(input);
                if (fieldName && savedProfile[fieldName]) {
                    input.value = savedProfile[fieldName];
                }
            });
        }
        
        // Update sidebar user info
        updateSidebarUserInfo(savedProfile);
        updateHeaderUserName(savedProfile.firstName + ' ' + savedProfile.lastName);
    }
}

function getFieldNameFromValue(input) {
    const value = input.value;
    if (value === 'John') return 'firstName';
    if (value === 'Doe') return 'lastName';
    if (value === 'john.doe@email.com') return 'email';
    if (value === '+1 (555) 123-4567') return 'phone';
    if (value === '1990-01-15') return 'dateOfBirth';
    return null;
}

function updateSidebarUserInfo(profileData) {
    const nameElement = document.querySelector('.flex.items-center.space-x-4 h2');
    const emailElement = document.querySelector('.flex.items-center.space-x-4 p');
    
    if (nameElement) {
        nameElement.textContent = `${profileData.firstName} ${profileData.lastName}`;
    }
    
    if (emailElement) {
        emailElement.textContent = profileData.email;
    }
}

function updateHeaderUserName(fullName) {
    const headerNameElement = document.querySelector('header .hidden.md\\:block');
    if (headerNameElement) {
        headerNameElement.textContent = fullName;
    }
}

// Order history functionality
function loadOrderHistory() {
    // Mock order data (in real app, this would come from API)
    const orders = [
        {
            id: '12345',
            date: '2025-01-15',
            total: 79.99,
            status: 'Delivered',
            items: [
                {
                    name: 'Wireless Bluetooth Headphones',
                    vendor: 'TechVendor Store',
                    image: 'https://images.pexels.com/photos/788946/pexels-photo-788946.jpeg?auto=compress&cs=tinysrgb&w=100',
                    quantity: 1
                }
            ]
        },
        {
            id: '12344',
            date: '2025-01-10',
            total: 49.98,
            status: 'In Transit',
            items: [
                {
                    name: 'Premium Cotton T-Shirt',
                    vendor: 'Fashion Hub',
                    image: 'https://images.pexels.com/photos/1464625/pexels-photo-1464625.jpeg?auto=compress&cs=tinysrgb&w=100',
                    quantity: 2
                }
            ]
        }
    ];
    
    // Save to localStorage for consistency
    MarketHub.saveToLocalStorage('orderHistory', orders);
    
    displayOrderHistory(orders);
}

function displayOrderHistory(orders) {
    const ordersContainer = document.querySelector('#orders-section .space-y-4');
    
    if (!ordersContainer) return;
    
    // Clear existing orders except the title
    const existingOrders = ordersContainer.querySelectorAll('.border');
    existingOrders.forEach(order => order.remove());
    
    orders.forEach(order => {
        const orderElement = createOrderElement(order);
        ordersContainer.appendChild(orderElement);
    });
}

function createOrderElement(order) {
    const orderDiv = document.createElement('div');
    orderDiv.className = 'border border-gray-200 rounded-lg p-4';
    
    const statusColor = getStatusColor(order.status);
    
    orderDiv.innerHTML = `
        <div class="flex items-center justify-between mb-4">
            <div>
                <h3 class="font-semibold">Order #${order.id}</h3>
                <p class="text-sm text-gray-600">Placed on ${MarketHub.formatDate(order.date)}</p>
            </div>
            <div class="text-right">
                <div class="font-semibold text-primary">${MarketHub.formatPrice(order.total)}</div>
                <span class="inline-block ${statusColor} text-white px-2 py-1 rounded-full text-xs">${order.status}</span>
            </div>
        </div>
        ${order.items.map(item => `
            <div class="flex items-center space-x-4">
                <img src="${item.image}" alt="${item.name}" class="w-16 h-16 object-cover rounded-lg">
                <div class="flex-1">
                    <h4 class="font-medium">${item.name}${item.quantity > 1 ? ` (${item.quantity}x)` : ''}</h4>
                    <p class="text-sm text-gray-600">${item.vendor}</p>
                </div>
                <div class="flex space-x-2">
                    <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors" onclick="trackOrder('${order.id}')">
                        Track Order
                    </button>
                    <button class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-orange-600 transition-colors" onclick="buyAgain('${order.id}')">
                        Buy Again
                    </button>
                </div>
            </div>
        `).join('')}
    `;
    
    return orderDiv;
}

function getStatusColor(status) {
    const colors = {
        'Delivered': 'bg-green-500',
        'In Transit': 'bg-yellow-500',
        'Processing': 'bg-blue-500',
        'Cancelled': 'bg-red-500'
    };
    return colors[status] || 'bg-gray-500';
}

// Address management
function initializeAddressManagement() {
    // Add event listeners for address actions
    window.editAddress = editAddress;
    window.deleteAddress = deleteAddress;
    window.setDefaultAddress = setDefaultAddress;
}

function loadAddresses() {
    // Mock address data
    const addresses = [
        {
            id: 1,
            label: 'Home',
            isDefault: true,
            name: 'John Doe',
            street: '123 Main Street',
            apartment: 'Apartment 4B',
            city: 'New York',
            state: 'NY',
            zipCode: '10001',
            country: 'United States',
            phone: '+1 (555) 123-4567'
        },
        {
            id: 2,
            label: 'Office',
            isDefault: false,
            name: 'John Doe',
            street: '456 Business Ave',
            apartment: 'Suite 200',
            city: 'New York',
            state: 'NY',
            zipCode: '10002',
            country: 'United States',
            phone: '+1 (555) 987-6543'
        }
    ];
    
    MarketHub.saveToLocalStorage('userAddresses', addresses);
}

function editAddress(addressId) {
    MarketHub.showNotification('Edit address functionality would open here', 'info');
}

function deleteAddress(addressId) {
    if (confirm('Are you sure you want to delete this address?')) {
        MarketHub.showNotification('Address deleted', 'success');
    }
}

function setDefaultAddress(addressId) {
    MarketHub.showNotification('Default address updated', 'success');
}

// Wishlist functionality
function loadWishlist() {
    const wishlistIds = MarketHub.getFromLocalStorage('wishlist') || [];
    
    // Mock wishlist items (in real app, you'd fetch full product data)
    const wishlistItems = [
        {
            id: 'product-2',
            name: 'Smart Fitness Watch',
            vendor: 'GadgetWorld',
            price: 199.99,
            image: 'https://images.pexels.com/photos/1649771/pexels-photo-1649771.jpeg?auto=compress&cs=tinysrgb&w=300'
        },
        {
            id: 'product-3',
            name: 'Premium Coffee Maker',
            vendor: 'HomeEssentials',
            price: 149.99,
            image: 'https://images.pexels.com/photos/1667088/pexels-photo-1667088.jpeg?auto=compress&cs=tinysrgb&w=300'
        }
    ];
    
    displayWishlist(wishlistItems);
}

function displayWishlist(items) {
    const wishlistContainer = document.querySelector('#wishlist-section .grid');
    
    if (!wishlistContainer) return;
    
    // Clear existing items
    wishlistContainer.innerHTML = '';
    
    if (items.length === 0) {
        wishlistContainer.innerHTML = `
            <div class="col-span-full text-center py-12">
                <div class="text-6xl mb-4">💝</div>
                <h3 class="text-xl font-semibold mb-2">Your wishlist is empty</h3>
                <p class="text-gray-600 mb-4">Save items you love for later</p>
                <a href="index.html" class="bg-primary text-white px-6 py-3 rounded-lg hover:bg-orange-600 transition-colors inline-block">
                    Start Shopping
                </a>
            </div>
        `;
        return;
    }
    
    items.forEach(item => {
        const itemElement = createWishlistItemElement(item);
        wishlistContainer.appendChild(itemElement);
    });
}

function createWishlistItemElement(item) {
    const itemDiv = document.createElement('div');
    itemDiv.className = 'border border-gray-200 rounded-lg overflow-hidden';
    
    itemDiv.innerHTML = `
        <div class="relative">
            <img src="${item.image}" alt="${item.name}" class="w-full h-48 object-cover">
            <button class="absolute top-3 right-3 p-2 bg-white rounded-full shadow-md text-red-500" onclick="removeFromWishlist('${item.id}')">
                <i data-lucide="heart" class="h-4 w-4 fill-current"></i>
            </button>
        </div>
        <div class="p-4">
            <h3 class="font-semibold mb-2">${item.name}</h3>
            <p class="text-sm text-gray-600 mb-2">${item.vendor}</p>
            <div class="flex items-center justify-between">
                <span class="font-bold text-primary">${MarketHub.formatPrice(item.price)}</span>
                <button class="bg-primary text-white px-3 py-1 rounded text-sm hover:bg-orange-600 transition-colors" onclick="addToCartFromWishlist('${item.id}')">
                    Add to Cart
                </button>
            </div>
        </div>
    `;
    
    // Re-initialize Lucide icons
    setTimeout(() => lucide.createIcons(), 0);
    
    return itemDiv;
}

// User reviews functionality
function loadUserReviews() {
    // Mock review data
    const reviews = [
        {
            id: 1,
            productName: 'Wireless Bluetooth Headphones',
            productImage: 'https://images.pexels.com/photos/788946/pexels-photo-788946.jpeg?auto=compress&cs=tinysrgb&w=100',
            rating: 5,
            date: '2025-01-16',
            comment: 'Excellent sound quality and comfortable to wear for long periods. The noise cancellation works really well. Highly recommended for anyone looking for premium headphones.'
        },
        {
            id: 2,
            productName: 'Premium Cotton T-Shirt',
            productImage: 'https://images.pexels.com/photos/1464625/pexels-photo-1464625.jpeg?auto=compress&cs=tinysrgb&w=100',
            rating: 4,
            date: '2025-01-12',
            comment: 'Good quality cotton and fits well. The color is exactly as shown in the pictures. Will definitely order more colors.'
        }
    ];
    
    displayUserReviews(reviews);
}

function displayUserReviews(reviews) {
    const reviewsContainer = document.querySelector('#reviews-section .space-y-6');
    
    if (!reviewsContainer) return;
    
    // Clear existing reviews except the header
    const existingReviews = reviewsContainer.querySelectorAll('.border');
    existingReviews.forEach(review => review.remove());
    
    reviews.forEach(review => {
        const reviewElement = createReviewElement(review);
        reviewsContainer.appendChild(reviewElement);
    });
}

function createReviewElement(review) {
    const reviewDiv = document.createElement('div');
    reviewDiv.className = 'border border-gray-200 rounded-lg p-4';
    
    const stars = Array.from({length: 5}, (_, i) => 
        `<i data-lucide="star" class="h-4 w-4 ${i < review.rating ? 'fill-current' : ''} text-yellow-400"></i>`
    ).join('');
    
    reviewDiv.innerHTML = `
        <div class="flex items-start space-x-4">
            <img src="${review.productImage}" alt="${review.productName}" class="w-16 h-16 object-cover rounded-lg">
            <div class="flex-1">
                <h3 class="font-semibold mb-1">${review.productName}</h3>
                <div class="flex items-center space-x-2 mb-2">
                    <div class="flex text-yellow-400">
                        ${stars}
                    </div>
                    <span class="text-sm text-gray-600">${MarketHub.formatDate(review.date)}</span>
                </div>
                <p class="text-gray-600 mb-3">${review.comment}</p>
                <div class="flex space-x-4 text-sm">
                    <button class="text-primary hover:underline" onclick="editReview(${review.id})">Edit Review</button>
                    <button class="text-gray-600 hover:text-red-500" onclick="deleteReview(${review.id})">Delete</button>
                </div>
            </div>
        </div>
    `;
    
    // Re-initialize Lucide icons
    setTimeout(() => lucide.createIcons(), 0);
    
    return reviewDiv;
}

// Global functions for various actions
window.trackOrder = function(orderId) {
    MarketHub.showNotification(`Tracking order #${orderId}`, 'info');
};

window.buyAgain = function(orderId) {
    MarketHub.showNotification('Items added to cart!', 'success');
};

window.removeFromWishlist = function(productId) {
    let wishlist = MarketHub.getFromLocalStorage('wishlist') || [];
    wishlist = wishlist.filter(id => id !== productId);
    MarketHub.saveToLocalStorage('wishlist', wishlist);
    
    MarketHub.showNotification('Removed from wishlist', 'info');
    loadWishlist(); // Refresh the display
};

window.addToCartFromWishlist = function(productId) {
    MarketHub.showNotification('Added to cart!', 'success');
    // Here you would add the actual add to cart logic
};

window.editReview = function(reviewId) {
    MarketHub.showNotification('Edit review functionality would open here', 'info');
};

window.deleteReview = function(reviewId) {
    if (confirm('Are you sure you want to delete this review?')) {
        MarketHub.showNotification('Review deleted', 'success');
        loadUserReviews(); // Refresh the display
    }
};