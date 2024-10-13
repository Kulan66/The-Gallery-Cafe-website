// register.js

// Function to validate form input
function validateForm(event) {
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    const errorMessages = [];

    if (username.length < 5) {
        errorMessages.push("Username must be at least 5 characters long.");
    }

    if (password.length < 8) {
        errorMessages.push("Password must be at least 8 characters long.");
    }

    if (errorMessages.length > 0) {
        event.preventDefault();
        displayErrors(errorMessages);
    }
}

// Function to display error messages
function displayErrors(errors) {
    const errorDiv = document.getElementById('error-messages');
    errorDiv.innerHTML = '';
    errors.forEach(error => {
        const p = document.createElement('p');
        p.textContent = error;
        errorDiv.appendChild(p);
    });
}

// Function to toggle password visibility
function togglePasswordVisibility() {
    const passwordInput = document.getElementById('password');
    const toggleButton = document.getElementById('toggle-password');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleButton.textContent = 'Hide password';
    } else {
        passwordInput.type = 'password';
        toggleButton.textContent = 'Show password';
    }
}

// Add event listeners
document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('form');
    form.addEventListener('submit', validateForm);

    const toggleButton = document.createElement('button');
    toggleButton.type = 'button';
    toggleButton.id = 'toggle-password';
    toggleButton.textContent = 'Show password';
    toggleButton.addEventListener('click', togglePasswordVisibility);
    document.getElementById('password').parentNode.appendChild(toggleButton);
});
