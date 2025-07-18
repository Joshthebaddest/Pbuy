// Initialize Lucide icons
lucide.createIcons();

// Modal management
const modal = document.getElementById('registrationModal');
const successModal = document.getElementById('successMessage');

// Step management
let currentStep = 1;
const totalSteps = 2;

// Vendor registration form handler
document.addEventListener('DOMContentLoaded', function() {
    const vendorForm = document.getElementById('vendorForm');
    
    // Initialize step navigation
    initializeStepNavigation();
    
    // Initialize modal functionality
    initializeModal();

    // Form validation and submission
    vendorForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Get form data
        const formData = new FormData(vendorForm);
        const vendorData = {
            vendorId: formData.get('vendorId'),
            storeName: formData.get('storeName'),
            logo: formData.get('logo') || '',
            banner: formData.get('banner') || '',
            about: formData.get('about'),
            contactEmail: formData.get('contactEmail'),
            phoneNumber: formData.get('phoneNumber'),
            address: formData.get('address'),
            createdAt: new Date().toISOString(),
            updatedAt: new Date().toISOString()
        };

        // Validate required fields
        if (!vendorData.vendorId || !vendorData.storeName || !vendorData.about || 
            !vendorData.contactEmail || !vendorData.phoneNumber || !vendorData.address) {
            showNotification('Please fill in all required fields.', 'error');
            return;
        }

        // Validate email format
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(vendorData.contactEmail)) {
            showNotification('Please enter a valid email address.', 'error');
            return;
        }

        // Validate URLs if provided
        if (vendorData.logo && !isValidUrl(vendorData.logo)) {
            showNotification('Please enter a valid logo URL.', 'error');
            return;
        }

        if (vendorData.banner && !isValidUrl(vendorData.banner)) {
            showNotification('Please enter a valid banner URL.', 'error');
            return;
        }

        // Simulate form submission
        submitVendorRegistration(vendorData);
    });

    // Save draft functionality
    const saveDraftBtn = document.getElementById('saveDraftBtn');
    saveDraftBtn.addEventListener('click', function() {
        const formData = new FormData(vendorForm);
        const draftData = Object.fromEntries(formData.entries());
        
        // Save to localStorage
        localStorage.setItem('vendorDraft', JSON.stringify(draftData));
        showNotification('Draft saved successfully!', 'success');
    });

    // Load draft on page load
    loadDraft();

    // Real-time validation
    setupRealTimeValidation();
});

// Initialize step navigation
function initializeStepNavigation() {
    const nextStep1Btn = document.getElementById('nextStep1');
    const prevStep2Btn = document.getElementById('prevStep2');
    
    nextStep1Btn.addEventListener('click', function() {
        if (validateStep1()) {
            goToStep(2);
        }
    });
    
    prevStep2Btn.addEventListener('click', function() {
        goToStep(1);
    });
}

// Navigate to specific step
function goToStep(step) {
    // Hide all steps
    document.querySelectorAll('.step-content').forEach(stepContent => {
        stepContent.classList.add('hidden');
    });
    
    // Show target step
    document.getElementById(`step${step}`).classList.remove('hidden');
    
    // Update progress
    updateProgress(step);
    
    // Update review section if going to step 2
    if (step === 2) {
        updateReviewSection();
    }
    
    currentStep = step;
}

// Update progress indicators
function updateProgress(step) {
    const currentStepSpan = document.getElementById('currentStep');
    const progressBar = document.getElementById('progressBar');
    const step1Indicator = document.getElementById('step1Indicator');
    const step2Indicator = document.getElementById('step2Indicator');
    
    currentStepSpan.textContent = step;
    
    if (step === 1) {
        progressBar.style.width = '50%';
        step1Indicator.className = 'w-8 h-8 bg-white rounded-full flex items-center justify-center';
        step1Indicator.innerHTML = '<span class="text-primary font-semibold text-sm">1</span>';
        step2Indicator.className = 'w-8 h-8 bg-orange-300 rounded-full flex items-center justify-center';
        step2Indicator.innerHTML = '<span class="text-white font-semibold text-sm">2</span>';
    } else if (step === 2) {
        progressBar.style.width = '100%';
        step1Indicator.className = 'w-8 h-8 bg-accent rounded-full flex items-center justify-center';
        step1Indicator.innerHTML = '<i data-lucide="check" class="w-4 h-4 text-white"></i>';
        step2Indicator.className = 'w-8 h-8 bg-white rounded-full flex items-center justify-center';
        step2Indicator.innerHTML = '<span class="text-primary font-semibold text-sm">2</span>';
        
        // Re-initialize icons for the check mark
        lucide.createIcons();
    }
}

// Validate Step 1
function validateStep1() {
    const requiredFields = [
        'storeName',
        'vendorId', 
        'about',
        'contactEmail',
        'phoneNumber',
        'address'
    ];
    
    let isValid = true;
    
    requiredFields.forEach(fieldName => {
        const field = document.querySelector(`[name="${fieldName}"]`);
        if (!validateField(field)) {
            isValid = false;
        }
    });
    
    if (!isValid) {
        showNotification('Please fill in all required fields correctly before continuing.', 'error');
    }
    
    return isValid;
}

// Update review section
function updateReviewSection() {
    const reviewSection = document.getElementById('reviewSection');
    const formData = new FormData(document.getElementById('vendorForm'));
    
    const reviewHTML = `
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h4 class="font-semibold text-text mb-3">Store Information</h4>
                <div class="space-y-2 text-sm">
                    <div><span class="text-gray-600">Store Name:</span> <span class="font-medium">${formData.get('storeName') || 'Not provided'}</span></div>
                    <div><span class="text-gray-600">Vendor ID:</span> <span class="font-medium">${formData.get('vendorId') || 'Not provided'}</span></div>
                    <div><span class="text-gray-600">About:</span> <span class="font-medium">${(formData.get('about') || 'Not provided').substring(0, 100)}${formData.get('about') && formData.get('about').length > 100 ? '...' : ''}</span></div>
                </div>
            </div>
            
            <div>
                <h4 class="font-semibold text-text mb-3">Contact Information</h4>
                <div class="space-y-2 text-sm">
                    <div><span class="text-gray-600">Email:</span> <span class="font-medium">${formData.get('contactEmail') || 'Not provided'}</span></div>
                    <div><span class="text-gray-600">Phone:</span> <span class="font-medium">${formData.get('phoneNumber') || 'Not provided'}</span></div>
                    <div><span class="text-gray-600">Address:</span> <span class="font-medium">${(formData.get('address') || 'Not provided').substring(0, 50)}${formData.get('address') && formData.get('address').length > 50 ? '...' : ''}</span></div>
                </div>
            </div>
        </div>
        
        <div class="border-t border-gray-200 pt-4 mt-4">
            <h4 class="font-semibold text-text mb-3">Visual Assets</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
                <div><span class="text-gray-600">Logo URL:</span> <span class="font-medium">${formData.get('logo') || 'Not provided'}</span></div>
                <div><span class="text-gray-600">Banner URL:</span> <span class="font-medium">${formData.get('banner') || 'Not provided'}</span></div>
            </div>
        </div>
        
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mt-4">
            <div class="flex items-start space-x-3">
                <i data-lucide="info" class="w-5 h-5 text-blue-600 mt-0.5"></i>
                <div class="text-sm text-blue-800">
                    <p class="font-medium">Review your information</p>
                    <p>Please review all the information above. You can go back to make changes or proceed with registration.</p>
                </div>
            </div>
        </div>
    `;
    
    reviewSection.innerHTML = reviewHTML;
    lucide.createIcons();
}
// Submit vendor registration
function submitVendorRegistration(vendorData) {
    // Show loading state
    const submitBtn = document.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i data-lucide="loader-2" class="w-5 h-5 animate-spin"></i><span>Registering...</span>';
    submitBtn.disabled = true;

    // Simulate API call
    setTimeout(() => {
        // In a real application, you would send this data to your backend
        console.log('Vendor Registration Data:', vendorData);
        
        // Show success message
        modal.classList.add('hidden');
        successModal.classList.remove('hidden');
        
        // Clear draft
        localStorage.removeItem('vendorDraft');

        // Reset button
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
        
        showNotification('Registration submitted successfully!', 'success');
    }, 2000);
}

// Initialize modal functionality
function initializeModal() {
    const openButtons = document.querySelectorAll('#openRegistrationModal, #openRegistrationModal2');
    const closeButton = document.getElementById('closeModal');
    const closeSuccessButton = document.getElementById('closeSuccessMessage');
    
    // Open modal
    openButtons.forEach(button => {
        button.addEventListener('click', function() {
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        });
    });
    
    // Close modal
    closeButton.addEventListener('click', closeModal);
    closeSuccessButton.addEventListener('click', closeSuccessModal);
    
    // Close modal when clicking outside
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeModal();
        }
    });
    
    successModal.addEventListener('click', function(e) {
        if (e.target === successModal) {
            closeSuccessModal();
        }
    });
    
    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            if (!modal.classList.contains('hidden')) {
                closeModal();
            }
            if (!successModal.classList.contains('hidden')) {
                closeSuccessModal();
            }
        }
    });
}

// Close modal functions
function closeModal() {
    modal.classList.add('hidden');
    document.body.style.overflow = '';
}

function closeSuccessModal() {
    successModal.classList.add('hidden');
    document.body.style.overflow = '';
}

// Load draft from localStorage
function loadDraft() {
    const draft = localStorage.getItem('vendorDraft');
    if (draft) {
        try {
            const draftData = JSON.parse(draft);
            Object.keys(draftData).forEach(key => {
                const field = document.querySelector(`[name="${key}"]`);
                if (field) {
                    if (field.type === 'checkbox') {
                        field.checked = draftData[key] === 'on';
                    } else {
                        field.value = draftData[key];
                    }
                }
            });
            showNotification('Draft loaded successfully!', 'info');
        } catch (error) {
            console.error('Error loading draft:', error);
        }
    }
}

// Real-time validation
function setupRealTimeValidation() {
    const requiredFields = document.querySelectorAll('input[required], textarea[required]');
    
    requiredFields.forEach(field => {
        field.addEventListener('blur', function() {
            validateField(this);
        });
        
        field.addEventListener('input', function() {
            // Remove error styling on input
            this.classList.remove('border-red-500', 'ring-red-500');
            const errorMsg = this.parentNode.querySelector('.error-message');
            if (errorMsg) {
                errorMsg.remove();
            }
        });
    });
}

// Validate individual field
function validateField(field) {
    const value = field.value.trim();
    let isValid = true;
    let errorMessage = '';

    // Remove existing error styling
    field.classList.remove('border-red-500', 'ring-red-500');
    const existingError = field.parentNode.querySelector('.error-message');
    if (existingError) {
        existingError.remove();
    }

    // Check if required field is empty
    if (field.hasAttribute('required') && !value) {
        isValid = false;
        errorMessage = 'This field is required.';
    }

    // Email validation
    if (field.type === 'email' && value) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(value)) {
            isValid = false;
            errorMessage = 'Please enter a valid email address.';
        }
    }

    // URL validation
    if (field.type === 'url' && value) {
        if (!isValidUrl(value)) {
            isValid = false;
            errorMessage = 'Please enter a valid URL.';
        }
    }

    // Phone validation
    if (field.type === 'tel' && value) {
        const phoneRegex = /^[\+]?[1-9][\d]{0,15}$/;
        if (!phoneRegex.test(value.replace(/[\s\-\(\)]/g, ''))) {
            isValid = false;
            errorMessage = 'Please enter a valid phone number.';
        }
    }

    if (!isValid) {
        field.classList.add('border-red-500', 'ring-red-500');
        const errorDiv = document.createElement('p');
        errorDiv.className = 'error-message text-red-500 text-xs mt-1';
        errorDiv.textContent = errorMessage;
        field.parentNode.appendChild(errorDiv);
    }

    return isValid;
}

// Utility function to validate URLs
function isValidUrl(string) {
    try {
        new URL(string);
        return true;
    } catch (_) {
        return false;
    }
}

// Show notification
function showNotification(message, type = 'info') {
    // Remove existing notifications
    const existingNotifications = document.querySelectorAll('.notification');
    existingNotifications.forEach(notification => notification.remove());

    const notification = document.createElement('div');
    notification.className = `notification fixed top-4 right-4 px-6 py-4 rounded-lg shadow-lg z-50 max-w-sm transform transition-all duration-300 translate-x-full`;
    
    const colors = {
        success: 'bg-green-500 text-white',
        error: 'bg-red-500 text-white',
        info: 'bg-blue-500 text-white',
        warning: 'bg-yellow-500 text-white'
    };
    
    notification.className += ` ${colors[type] || colors.info}`;
    
    const icons = {
        success: 'check-circle',
        error: 'x-circle',
        info: 'info',
        warning: 'alert-triangle'
    };
    
    notification.innerHTML = `
        <div class="flex items-center space-x-3">
            <i data-lucide="${icons[type] || icons.info}" class="w-5 h-5"></i>
            <span>${message}</span>
            <button onclick="this.parentElement.parentElement.remove()" class="ml-2 hover:opacity-75">
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>
        </div>
    `;
    
    document.body.appendChild(notification);
    lucide.createIcons();
    
    // Animate in
    setTimeout(() => {
        notification.classList.remove('translate-x-full');
    }, 100);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        notification.classList.add('translate-x-full');
        setTimeout(() => {
            if (notification.parentNode) {
                notification.remove();
            }
        }, 300);
    }, 5000);
}

// Auto-save draft every 30 seconds
setInterval(() => {
    const formData = new FormData(document.getElementById('vendorForm'));
    const draftData = Object.fromEntries(formData.entries());
    
    // Only save if there's some data
    if (Object.values(draftData).some(value => value.trim() !== '')) {
        localStorage.setItem('vendorDraft', JSON.stringify(draftData));
    }
}, 30000);

// Handle form reset
function resetForm() {
    document.getElementById('vendorForm').reset();
    localStorage.removeItem('vendorDraft');
    showNotification('Form reset successfully!', 'info');
}