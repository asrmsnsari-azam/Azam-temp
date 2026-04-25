// Student Registration Form Validation

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('registrationForm');
    
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        
        // Clear previous errors
        clearErrors();
        
        let isValid = true;
        
        // Name validation
        const name = document.getElementById('name');
        if (name.value.trim() === '') {
            showError(name, 'Name is required');
            isValid = false;
        } else if (name.value.trim().length < 3) {
            showError(name, 'Name must be at least 3 characters');
            isValid = false;
        }
        
        // Email validation
        const email = document.getElementById('email');
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email.value.trim() === '') {
            showError(email, 'Email is required');
            isValid = false;
        } else if (!emailRegex.test(email.value.trim())) {
            showError(email, 'Please enter a valid email address');
            isValid = false;
        }
        
        // Password validation
        const password = document.getElementById('password');
        if (password.value === '') {
            showError(password, 'Password is required');
            isValid = false;
        } else if (password.value.length < 6) {
            showError(password, 'Password must be at least 6 characters');
            isValid = false;
        }
        
        // Confirm Password validation
        const confirmPassword = document.getElementById('confirmPassword');
        if (confirmPassword.value === '') {
            showError(confirmPassword, 'Please confirm your password');
            isValid = false;
        } else if (confirmPassword.value !== password.value) {
            showError(confirmPassword, 'Passwords do not match');
            isValid = false;
        }
        
        // Gender validation
        const gender = document.querySelector('input[name="gender"]:checked');
        if (!gender) {
            showError(document.querySelector('.gender-group'), 'Please select a gender');
            isValid = false;
        }
        
        // Country validation
        const country = document.getElementById('country');
        if (country.value === '') {
            showError(country, 'Please select a country');
            isValid = false;
        }
        
        // Date of Birth validation
        const dob = document.getElementById('dob');
        if (dob.value === '') {
            showError(dob, 'Date of Birth is required');
            isValid = false;
        } else {
            const dobDate = new Date(dob.value);
            const today = new Date();
            if (dobDate >= today) {
                showError(dob, 'Please enter a valid date of birth');
                isValid = false;
            }
        }
        
        // Picture validation
        const picture = document.getElementById('picture');
        if (picture.value === '') {
            showError(picture, 'Please upload a picture');
            isValid = false;
        } else {
            const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
            if (!allowedTypes.includes(picture.files[0].type)) {
                showError(picture, 'Only JPG, PNG, and GIF files are allowed');
                isValid = false;
            }
            const maxSize = 2 * 1024 * 1024; // 2MB
            if (picture.files[0].size > maxSize) {
                showError(picture, 'File size must be less than 2MB');
                isValid = false;
            }
        }
        
        if (isValid) {
            // Show success alert
            alert('Registration Successful! Your data will be saved to the database.');
            // Submit the form
            form.submit();
        }
    });
    
    // Real-time validation on input
    const inputs = form.querySelectorAll('input, select');
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            const errorDiv = document.getElementById(input.id + 'Error');
            if (errorDiv) {
                errorDiv.classList.remove('show');
                input.classList.remove('input-error');
            }
        });
    });
});

function showError(element, message) {
    if (!element) return;
    
    // For gender group special case
    if (element.classList && element.classList.contains('gender-group')) {
        const errorDiv = document.getElementById('genderError');
        if (errorDiv) {
            errorDiv.textContent = message;
            errorDiv.classList.add('show');
        }
        return;
    }
    
    element.classList.add('input-error');
    const errorDiv = document.getElementById(element.id + 'Error');
    if (errorDiv) {
        errorDiv.textContent = message;
        errorDiv.classList.add('show');
    }
}

function clearErrors() {
    // Remove error classes from inputs
    const inputs = document.querySelectorAll('.input-error');
    inputs.forEach(input => input.classList.remove('input-error'));
    
    // Hide all error messages
    const errors = document.querySelectorAll('.error-message');
    errors.forEach(error => {
        error.classList.remove('show');
        error.textContent = '';
    });
}

