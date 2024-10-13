document.addEventListener('DOMContentLoaded', function () {
    const loginForm = document.querySelector('form');
    const usernameInput = document.getElementById('username');
    const passwordInput = document.getElementById('password');

    loginForm.addEventListener('submit', function (event) {
        let valid = true;

        // Clear previous error messages
        clearErrors();

        // Check if username is empty
        if (usernameInput.value.trim() === '') {
            showError(usernameInput, 'Username is required');
            valid = false;
        }

        // Check if password is empty
        if (passwordInput.value.trim() === '') {
            showError(passwordInput, 'Password is required');
            valid = false;
        }

        // If the form is invalid, prevent submission
        if (!valid) {
            event.preventDefault();
        }
    });

    function showError(input, message) {
        const errorPopup = document.createElement('div');
        errorPopup.className = 'error-popup';
        errorPopup.innerText = message;
        
        document.body.appendChild(errorPopup);
        
        // Position the popup near the input field
        const rect = input.getBoundingClientRect();
        errorPopup.style.top = `${rect.top + window.scrollY + rect.height}px`;
        errorPopup.style.left = `${rect.left + window.scrollX}px`;

        setTimeout(() => {
            errorPopup.remove();
        }, 3000); // Remove the popup after 3 seconds
    }

    function clearErrors() {
        const errorPopups = document.querySelectorAll('.error-popup');
        errorPopups.forEach(popup => popup.remove());
    }
});
