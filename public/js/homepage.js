// User dropdown functionality
document.addEventListener('DOMContentLoaded', function() {
  // Mobile menu functionality
  const mobileMenuButton = document.getElementById('mobileMenuButton');
  const mobileMenu = document.getElementById('mobileMenu');
  
  if (mobileMenuButton && mobileMenu) {
    mobileMenuButton.addEventListener('click', function(e) {
      e.stopPropagation();
      mobileMenu.classList.toggle('hidden');
      
      // Toggle hamburger icon
      const icon = mobileMenuButton.querySelector('i');
      if (mobileMenu.classList.contains('hidden')) {
        icon.setAttribute('data-lucide', 'menu');
      } else {
        icon?.setAttribute('data-lucide', 'x');
      }
      lucide.createIcons();
    });

    // Close mobile menu when clicking outside
    document.addEventListener('click', function(e) {
      if (!mobileMenuButton.contains(e.target) && !mobileMenu.contains(e.target)) {
        mobileMenu.classList.add('hidden');
        const icon = mobileMenuButton.querySelector('i');
        icon.setAttribute('data-lucide', 'menu');
        lucide.createIcons();
      }
    });
  }

  // Mobile filter and sort buttons
  const mobileFiltersButton = document.getElementById('mobileFiltersButton');
  const mobileSortButton = document.getElementById('mobileSortButton');
  
  if (mobileFiltersButton) {
    mobileFiltersButton.addEventListener('click', function() {
      document.getElementById('filtersButton').click();
      mobileMenu.classList.add('hidden');
    });
  }
  
  if (mobileSortButton) {
    mobileSortButton.addEventListener('click', function() {
      document.getElementById('sortButton').click();
      mobileMenu.classList.add('hidden');
    });
  }

  const userMenuButton = document.getElementById('userMenuButton');
  const userDropdown = document.getElementById('userDropdown');
  
  if (userMenuButton && userDropdown) {
    userMenuButton.addEventListener('click', function(e) {
      e.stopPropagation();
      userDropdown.classList.toggle('hidden');
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
      if (!userMenuButton.contains(e.target) && !userDropdown.contains(e.target)) {
        userDropdown.classList.add('hidden');
      }
    });
  }

  // Categories button functionality (placeholder)
  const categoriesButton = document.getElementById('categoriesButton');
  if (categoriesButton) {
    categoriesButton.addEventListener('click', function() {
      console.log('Categories clicked - implement categories dropdown');
    });
  }

  // Filter modal functionality
  const filtersButton = document.getElementById('filtersButton');
  const filterModal = document.getElementById('filterModal');
  const closeFilterModal = document.getElementById('closeFilterModal');
  const cancelFilter = document.getElementById('cancelFilter');
  const clearFilters = document.getElementById('clearFilters');
  const applyFilters = document.getElementById('applyFilters');

  if (filtersButton && filterModal) {
    filtersButton.addEventListener('click', function() {
      filterModal.classList.remove('hidden');
      document.body.style.overflow = 'hidden';
    });

    function closeFilterModalHandler() {
      filterModal.classList.add('hidden');
      document.body.style.overflow = 'auto';
    }

    closeFilterModal.addEventListener('click', closeFilterModalHandler);
    cancelFilter.addEventListener('click', closeFilterModalHandler);

    // Close modal when clicking outside
    filterModal.addEventListener('click', function(e) {
      if (e.target === filterModal) {
        closeFilterModalHandler();
      }
    });

    // Clear all filters
    clearFilters.addEventListener('click', function() {
      const form = filterModal.querySelector('.p-6');
      const inputs = form.querySelectorAll('input[type="checkbox"], input[type="radio"], input[type="number"]');
      inputs.forEach(input => {
        if (input.type === 'checkbox' || input.type === 'radio') {
          input.checked = false;
        } else {
          input.value = '';
        }
      });
      showNotification('All filters cleared', 'info');
    });

    // Apply filters
    applyFilters.addEventListener('click', function() {
      const filterData = collectFilterData();
      console.log('Applied filters:', filterData);
      showNotification('Filters applied successfully!', 'success');
      closeFilterModalHandler();
      // Here you would typically update the product display
    });
  }

  // Sort modal functionality
  const sortButton = document.getElementById('sortButton');
  const sortModal = document.getElementById('sortModal');
  const closeSortModal = document.getElementById('closeSortModal');
  const cancelSort = document.getElementById('cancelSort');
  const applySort = document.getElementById('applySort');

  if (sortButton && sortModal) {
    sortButton.addEventListener('click', function() {
      sortModal.classList.remove('hidden');
      document.body.style.overflow = 'hidden';
    });

    function closeSortModalHandler() {
      sortModal.classList.add('hidden');
      document.body.style.overflow = 'auto';
    }

    closeSortModal.addEventListener('click', closeSortModalHandler);
    cancelSort.addEventListener('click', closeSortModalHandler);

    // Close modal when clicking outside
    sortModal.addEventListener('click', function(e) {
      if (e.target === sortModal) {
        closeSortModalHandler();
      }
    });

    // Apply sort
    applySort.addEventListener('click', function() {
      const selectedSort = document.querySelector('input[name="sortOption"]:checked');
      if (selectedSort) {
        console.log('Applied sort:', selectedSort.value);
        showNotification(`Sorted by: ${getSortLabel(selectedSort.value)}`, 'success');
        closeSortModalHandler();
        // Here you would typically update the product display
      }
    });
  }
  // Search functionality (placeholder)
  const searchInput = document.querySelector('input[type="text"]');
  if (searchInput) {
    searchInput.addEventListener('keypress', function(e) {
      if (e.key === 'Enter') {
        console.log('Search for:', this.value);
        // Implement search functionality
      }
    });
  }

  // Cart functionality (placeholder)
  const cartButton = document.querySelector('[data-lucide="shopping-cart"]').parentElement;
  if (cartButton) {
    cartButton.addEventListener('click', function() {
      console.log('Cart clicked - implement cart functionality');
    });
  }

  // Newsletter subscription
  const newsletterForm = document.querySelector('footer input[type="email"]').parentElement;
  const newsletterButton = newsletterForm.querySelector('button');
  const newsletterInput = newsletterForm.querySelector('input');
  
  if (newsletterButton && newsletterInput) {
    newsletterButton.addEventListener('click', function() {
      const email = newsletterInput.value.trim();
      if (email && isValidEmail(email)) {
        console.log('Newsletter subscription for:', email);
        newsletterInput.value = '';
        // Show success message
        showNotification('Successfully subscribed to newsletter!', 'success');
      } else {
        showNotification('Please enter a valid email address', 'error');
      }
    });

    newsletterInput.addEventListener('keypress', function(e) {
      if (e.key === 'Enter') {
        newsletterButton.click();
      }
    });
  }

  // Add to cart functionality for sample products
  const allButtons = document.querySelectorAll('button');
  const addToCartButtons = Array.from(allButtons).filter(button => 
    button.textContent.includes('Add to Cart')
  );
  addToCartButtons.forEach(button => {
    button.addEventListener('click', function() {
      console.log('Product added to cart');
      showNotification('Product added to cart!', 'success');
      updateCartCount();
    });
  });
});

// Utility functions
function collectFilterData() {
  const filterData = {
    priceRange: {
      min: document.getElementById('minPrice').value,
      max: document.getElementById('maxPrice').value,
      preset: document.querySelector('input[name="priceRange"]:checked')?.value
    },
    categories: Array.from(document.querySelectorAll('input[type="checkbox"][value]'))
      .filter(cb => cb.checked && ['electronics', 'fashion', 'home-garden', 'sports', 'books', 'gaming'].includes(cb.value))
      .map(cb => cb.value),
    brands: Array.from(document.querySelectorAll('input[type="checkbox"][value]'))
      .filter(cb => cb.checked && ['apple', 'samsung', 'nike', 'adidas', 'sony'].includes(cb.value))
      .map(cb => cb.value),
    rating: document.querySelector('input[name="rating"]:checked')?.value,
    availability: Array.from(document.querySelectorAll('input[type="checkbox"][value]'))
      .filter(cb => cb.checked && ['in-stock', 'free-shipping', 'on-sale'].includes(cb.value))
      .map(cb => cb.value),
    vendors: Array.from(document.querySelectorAll('input[type="checkbox"][value]'))
      .filter(cb => cb.checked && ['techworld', 'fashionhub', 'homedecor', 'sportszone'].includes(cb.value))
      .map(cb => cb.value)
  };
  return filterData;
}

function getSortLabel(sortValue) {
  const sortLabels = {
    'relevance': 'Most Relevant',
    'price-low': 'Price: Low to High',
    'price-high': 'Price: High to Low',
    'rating': 'Customer Rating',
    'newest': 'Newest First',
    'bestseller': 'Best Sellers',
    'discount': 'Highest Discount'
  };
  return sortLabels[sortValue] || 'Most Relevant';
}

function isValidEmail(email) {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
}

function showNotification(message, type = 'info') {
  // Create notification element
  const notification = document.createElement('div');
  notification.className = `fixed top-4 right-4 z-50 px-6 py-3 rounded-lg shadow-lg transition-all duration-300 transform translate-x-full`;
  
  // Set colors based on type
  switch(type) {
    case 'success':
      notification.className += ' bg-accent text-white';
      break;
    case 'error':
      notification.className += ' bg-red-500 text-white';
      break;
    default:
      notification.className += ' bg-primary text-white';
  }
  
  notification.textContent = message;
  document.body.appendChild(notification);
  
  // Animate in
  setTimeout(() => {
    notification.classList.remove('translate-x-full');
  }, 100);
  
  // Remove after 3 seconds
  setTimeout(() => {
    notification.classList.add('translate-x-full');
    setTimeout(() => {
      document.body.removeChild(notification);
    }, 300);
  }, 3000);
}

function updateCartCount() {
  const cartBadge = document.querySelector('[data-lucide="shopping-cart"]').parentElement.querySelector('span');
  if (cartBadge) {
    const currentCount = parseInt(cartBadge.textContent) || 0;
    cartBadge.textContent = currentCount + 1;
  }
}

// Smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function (e) {
    e.preventDefault();
    const target = document.querySelector(this.getAttribute('href'));
    if (target) {
      target.scrollIntoView({
        behavior: 'smooth',
        block: 'start'
      });
    }
  });
});

// Mobile responsiveness helpers
function handleMobileMenu() {
  // This will be implemented when we add mobile menu functionality
  console.log('Mobile menu functionality to be implemented');
}

// Initialize everything when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
  // Re-initialize Lucide icons after any dynamic content changes
  lucide.createIcons();
  
  console.log('MarketHub E-commerce Platform initialized');
});