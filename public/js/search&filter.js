// Sample product data
const sampleProducts = [
  {
    id: 1,
    name: "Wireless Bluetooth Earbuds",
    brand: "Apple",
    category: "electronics",
    price: 179.99,
    originalPrice: 199.99,
    rating: 4.5,
    reviews: 1247,
    image: "https://images.pexels.com/photos/3780681/pexels-photo-3780681.jpeg?auto=compress&cs=tinysrgb&w=400",
    vendor: "TechStore Pro",
    tags: ["wireless", "bluetooth", "earbuds", "apple"],
    inStock: true,
    onSale: true,
    trending: true
  },
  {
    id: 2,
    name: "Summer Casual T-Shirt",
    brand: "Nike",
    category: "fashion",
    price: 29.99,
    rating: 4.2,
    reviews: 856,
    image: "https://images.pexels.com/photos/1040945/pexels-photo-1040945.jpeg?auto=compress&cs=tinysrgb&w=400",
    vendor: "Fashion Hub",
    tags: ["summer", "casual", "t-shirt", "nike"],
    inStock: true,
    onSale: false,
    trending: true
  },
  {
    id: 3,
    name: "Smart Home Security Camera",
    brand: "Samsung",
    category: "electronics",
    price: 149.99,
    rating: 4.7,
    reviews: 2103,
    image: "https://images.pexels.com/photos/430208/pexels-photo-430208.jpeg?auto=compress&cs=tinysrgb&w=400",
    vendor: "Smart Living",
    tags: ["smart home", "security", "camera", "samsung"],
    inStock: true,
    onSale: false,
    trending: false
  },
  {
    id: 4,
    name: "Yoga Mat Premium",
    brand: "Adidas",
    category: "sports",
    price: 49.99,
    originalPrice: 69.99,
    rating: 4.4,
    reviews: 634,
    image: "https://images.pexels.com/photos/4056723/pexels-photo-4056723.jpeg?auto=compress&cs=tinysrgb&w=400",
    vendor: "Fitness World",
    tags: ["yoga", "fitness", "mat", "adidas"],
    inStock: true,
    onSale: true,
    trending: false
  },
  {
    id: 5,
    name: "Modern Table Lamp",
    brand: "IKEA",
    category: "home",
    price: 79.99,
    rating: 4.1,
    reviews: 423,
    image: "https://images.pexels.com/photos/1112598/pexels-photo-1112598.jpeg?auto=compress&cs=tinysrgb&w=400",
    vendor: "Home Decor Plus",
    tags: ["home decor", "lamp", "modern", "lighting"],
    inStock: false,
    onSale: false,
    trending: false
  },
  {
    id: 6,
    name: "Gaming Mechanical Keyboard",
    brand: "Razer",
    category: "electronics",
    price: 129.99,
    rating: 4.6,
    reviews: 1876,
    image: "https://images.pexels.com/photos/2115256/pexels-photo-2115256.jpeg?auto=compress&cs=tinysrgb&w=400",
    vendor: "Gaming Central",
    tags: ["gaming", "keyboard", "mechanical", "razer"],
    inStock: true,
    onSale: false,
    trending: true
  }
];

let filteredProducts = [...sampleProducts];
let currentFilters = {
  categories: [],
  brands: [],
  priceRange: null,
  rating: [],
  availability: [],
  searchQuery: ''
};

// Initialize the application
document.addEventListener('DOMContentLoaded', function() {
  // Initialize Lucide icons
  lucide.createIcons();
  
  // Load initial products
  renderProducts(filteredProducts);
  renderPopularItems();
  
  // Set up event listeners
  setupEventListeners();
});

function setupEventListeners() {
  // Global search
  const searchInput = document.getElementById('globalSearch');
  const searchButton = searchInput.nextElementSibling.querySelector('button');
  
  searchInput.addEventListener('input', debounce(handleSearch, 300));
  searchButton.addEventListener('click', () => handleSearch());
  searchInput.addEventListener('keypress', (e) => {
    if (e.key === 'Enter') handleSearch();
  });
  
  // Filter checkboxes
  document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
    checkbox.addEventListener('change', handleFilterChange);
  });
  
  // Price range radio buttons
  document.querySelectorAll('input[name="priceRange"]').forEach(radio => {
    radio.addEventListener('change', handleFilterChange);
  });
  
  // Sort dropdown
  document.querySelector('select').addEventListener('change', handleSort);
  
  // Clear filters button
  document.querySelector('aside button').addEventListener('click', clearAllFilters);
  
  // Trending tags
  document.querySelectorAll('.px-3.py-1').forEach(tag => {
    tag.addEventListener('click', (e) => {
      const tagText = e.target.textContent.trim();
      searchInput.value = tagText;
      handleSearch();
    });
  });
}

function handleSearch() {
  const searchQuery = document.getElementById('globalSearch').value.toLowerCase().trim();
  currentFilters.searchQuery = searchQuery;
  applyFilters();
}

function handleFilterChange(e) {
  const filterType = e.target.closest('div').previousElementSibling.textContent.toLowerCase();
  const value = e.target.value;
  const isChecked = e.target.checked;
  
  switch(filterType) {
    case 'category':
      updateArrayFilter(currentFilters.categories, value, isChecked);
      break;
    case 'brand':
      updateArrayFilter(currentFilters.brands, value, isChecked);
      break;
    case 'rating':
      updateArrayFilter(currentFilters.rating, value, isChecked);
      break;
    case 'availability':
      updateArrayFilter(currentFilters.availability, value, isChecked);
      break;
  }
  
  if (e.target.name === 'priceRange') {
    currentFilters.priceRange = isChecked ? value : null;
  }
  
  applyFilters();
}

function updateArrayFilter(filterArray, value, isChecked) {
  if (isChecked) {
    if (!filterArray.includes(value)) {
      filterArray.push(value);
    }
  } else {
    const index = filterArray.indexOf(value);
    if (index > -1) {
      filterArray.splice(index, 1);
    }
  }
}

function applyFilters() {
  filteredProducts = sampleProducts.filter(product => {
    // Search query filter
    if (currentFilters.searchQuery) {
      const searchLower = currentFilters.searchQuery.toLowerCase();
      const matchesSearch = 
        product.name.toLowerCase().includes(searchLower) ||
        product.brand.toLowerCase().includes(searchLower) ||
        product.category.toLowerCase().includes(searchLower) ||
        product.tags.some(tag => tag.toLowerCase().includes(searchLower));
      
      if (!matchesSearch) return false;
    }
    
    // Category filter
    if (currentFilters.categories.length > 0) {
      if (!currentFilters.categories.includes(product.category)) return false;
    }
    
    // Brand filter
    if (currentFilters.brands.length > 0) {
      if (!currentFilters.brands.includes(product.brand.toLowerCase())) return false;
    }
    
    // Price range filter
    if (currentFilters.priceRange) {
      const [min, max] = currentFilters.priceRange.split('-').map(p => p === '+' ? Infinity : parseInt(p));
      if (max === undefined) {
        if (product.price < min) return false;
      } else {
        if (product.price < min || product.price > max) return false;
      }
    }
    
    // Rating filter
    if (currentFilters.rating.length > 0) {
      const hasMatchingRating = currentFilters.rating.some(rating => {
        const minRating = parseInt(rating.replace('+', ''));
        return product.rating >= minRating;
      });
      if (!hasMatchingRating) return false;
    }
    
    // Availability filter
    if (currentFilters.availability.length > 0) {
      if (currentFilters.availability.includes('in-stock') && !product.inStock) return false;
      if (currentFilters.availability.includes('on-sale') && !product.onSale) return false;
    }
    
    return true;
  });
  
  renderProducts(filteredProducts);
  updateResultsCount();
}

function handleSort(e) {
  const sortBy = e.target.value;
  
  switch(sortBy) {
    case 'relevance':
      // Keep original order for relevance
      filteredProducts = [...filteredProducts];
      break;
    case 'latest':
      filteredProducts.sort((a, b) => b.id - a.id);
      break;
    case 'price-low':
      filteredProducts.sort((a, b) => a.price - b.price);
      break;
    case 'price-high':
      filteredProducts.sort((a, b) => b.price - a.price);
      break;
    case 'rating':
      filteredProducts.sort((a, b) => b.rating - a.rating);
      break;
  }
  
  renderProducts(filteredProducts);
}

function renderProducts(products) {
  const productGrid = document.getElementById('productGrid');
  
  if (products.length === 0) {
    productGrid.innerHTML = `
      <div class="col-span-full text-center py-12">
        <i data-lucide="search-x" class="h-16 w-16 text-gray-400 mx-auto mb-4"></i>
        <h3 class="text-lg font-medium text-gray-900 mb-2">No products found</h3>
        <p class="text-gray-500">Try adjusting your filters or search terms</p>
      </div>
    `;
    lucide.createIcons();
    return;
  }
  
  productGrid.innerHTML = products.map(product => `
    <div class="product-card bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg transition-all duration-300">
      <div class="relative">
        <img src="${product.image}" alt="${product.name}" class="w-full h-48 object-cover">
        ${product.onSale ? '<span class="absolute top-2 left-2 sale-badge text-white text-xs px-2 py-1 rounded-full">Sale</span>' : ''}
        ${product.trending ? '<span class="absolute top-2 right-2 bg-primary text-white text-xs px-2 py-1 rounded-full">Trending</span>' : ''}
        <button class="absolute top-2 right-2 ${product.trending ? 'top-10' : ''} p-2 bg-white rounded-full shadow-md hover:bg-gray-50 transition-colors">
          <i data-lucide="heart" class="h-4 w-4 text-gray-400"></i>
        </button>
      </div>
      
      <div class="p-4">
        <div class="flex items-center justify-between mb-2">
          <span class="text-xs text-gray-500 uppercase tracking-wide">${product.brand}</span>
          <span class="text-xs text-gray-500">${product.vendor}</span>
        </div>
        
        <h3 class="font-medium text-text mb-2 line-clamp-2">${product.name}</h3>
        
        <div class="flex items-center mb-2">
          <div class="flex text-yellow-400">
            ${generateStars(product.rating)}
          </div>
          <span class="ml-1 text-sm text-gray-500">(${product.reviews})</span>
        </div>
        
        <div class="flex items-center justify-between">
          <div class="flex items-center space-x-2">
            <span class="text-lg font-bold text-text">$${product.price}</span>
            ${product.originalPrice ? `<span class="text-sm text-gray-500 line-through">$${product.originalPrice}</span>` : ''}
          </div>
          <span class="text-xs ${product.inStock ? 'text-accent' : 'text-red-500'}">${product.inStock ? 'In Stock' : 'Out of Stock'}</span>
        </div>
        
        <button class="w-full mt-3 bg-primary text-white py-2 px-4 rounded-lg hover:bg-orange-600 transition-colors font-medium ${!product.inStock ? 'opacity-50 cursor-not-allowed' : ''}" ${!product.inStock ? 'disabled' : ''}>
          ${product.inStock ? 'Add to Cart' : 'Out of Stock'}
        </button>
      </div>
    </div>
  `).join('');
  
  lucide.createIcons();
}

function renderPopularItems() {
  const popularItems = sampleProducts.filter(product => product.trending).slice(0, 4);
  const popularGrid = document.getElementById('popularItems');
  
  popularGrid.innerHTML = popularItems.map(product => `
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg transition-all duration-300">
      <div class="relative">
        <img src="${product.image}" alt="${product.name}" class="w-full h-32 object-cover">
        <span class="absolute top-2 right-2 bg-primary text-white text-xs px-2 py-1 rounded-full">Popular</span>
      </div>
      <div class="p-3">
        <h4 class="font-medium text-sm text-text mb-1">${product.name}</h4>
        <div class="flex items-center justify-between">
          <span class="text-primary font-bold">$${product.price}</span>
          <div class="flex text-yellow-400">
            ${generateStars(product.rating, 'h-3 w-3')}
          </div>
        </div>
      </div>
    </div>
  `).join('');
}

function generateStars(rating, size = 'h-4 w-4') {
  const fullStars = Math.floor(rating);
  const hasHalfStar = rating % 1 !== 0;
  const emptyStars = 5 - fullStars - (hasHalfStar ? 1 : 0);
  
  let stars = '';
  
  // Full stars
  for (let i = 0; i < fullStars; i++) {
    stars += `<i data-lucide="star" class="${size} fill-current"></i>`;
  }
  
  // Half star
  if (hasHalfStar) {
    stars += `<i data-lucide="star" class="${size} fill-current opacity-50"></i>`;
  }
  
  // Empty stars
  for (let i = 0; i < emptyStars; i++) {
    stars += `<i data-lucide="star" class="${size} text-gray-300"></i>`;
  }
  
  return stars;
}

function updateResultsCount() {
  const countElement = document.querySelector('main h2 + p');
  countElement.textContent = `Showing ${filteredProducts.length} products`;
}

function clearAllFilters() {
  // Reset filter state
  currentFilters = {
    categories: [],
    brands: [],
    priceRange: null,
    rating: [],
    availability: [],
    searchQuery: ''
  };
  
  // Clear form inputs
  document.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = false);
  document.querySelectorAll('input[type="radio"]').forEach(radio => radio.checked = false);
  document.querySelectorAll('input[type="number"]').forEach(input => input.value = '');
  document.getElementById('globalSearch').value = '';
  
  // Reset products
  filteredProducts = [...sampleProducts];
  renderProducts(filteredProducts);
  updateResultsCount();
}

// Utility function for debouncing search
function debounce(func, wait) {
  let timeout;
  return function executedFunction(...args) {
    const later = () => {
      clearTimeout(timeout);
      func(...args);
    };
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
  };
}

// Add some interactive features
document.addEventListener('click', function(e) {
  // Handle product card clicks
  if (e.target.closest('.product-card')) {
    const productCard = e.target.closest('.product-card');
    if (!e.target.closest('button')) {
      // Navigate to product detail (placeholder)
      console.log('Navigate to product detail');
    }
  }
  
  // Handle tag clicks
  if (e.target.classList.contains('px-3')) {
    e.target.classList.add('bg-primary', 'text-white');
    setTimeout(() => {
      e.target.classList.remove('bg-primary', 'text-white');
    }, 200);
  }
});

console.log('E-commerce Search & Filter Platform loaded successfully!');