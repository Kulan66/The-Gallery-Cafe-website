document.addEventListener('DOMContentLoaded', () => {
    // Get the form element
    const addUserForm = document.getElementById('add-user-form');

    // Add form submission event listener
    addUserForm.addEventListener('submit', (event) => {
        // Get form values
        const username = document.getElementById('username').value.trim();
        const password = document.getElementById('password').value.trim();
        const userType = document.getElementById('user_type').value;

        // Validate form values
        if (!username || !password) {
            // Prevent form submission
            event.preventDefault();
            alert('Please fill in both the username and password fields.');
            return;
        }

        // You can add more validation here if needed
        // For example, check if the username already exists, or password strength

        // If everything is okay, you can allow the form to be submitted
    });

    // Add a click event listener for the "Add User" button
    const addUserButton = document.querySelector('.cta-button');
    if (addUserButton) {
        addUserButton.addEventListener('click', () => {
            // Simple confirmation message
            if (confirm('Are you sure you want to add this user?')) {
                addUserForm.submit(); // Submit the form
            }
        });
    }

    // Form input validation messages
    const usernameInput = document.getElementById('username');
    const passwordInput = document.getElementById('password');

    usernameInput.addEventListener('input', () => {
        // Check for empty username
        if (usernameInput.value.trim() === '') {
            usernameInput.setCustomValidity('Username cannot be empty.');
        } else {
            usernameInput.setCustomValidity('');
        }
    });

    passwordInput.addEventListener('input', () => {
        // Check for empty password
        if (passwordInput.value.trim() === '') {
            passwordInput.setCustomValidity('Password cannot be empty.');
        } else {
            passwordInput.setCustomValidity('');
        }
    });

    // Optional: Dynamic User Type Message
    const userTypeSelect = document.getElementById('user_type');
    userTypeSelect.addEventListener('change', () => {
        const userType = userTypeSelect.value;
        alert(`Selected User Type: ${userType}`);
    });

    // Optional: Adding placeholder text for better user experience
    if (usernameInput) {
        usernameInput.placeholder = 'Enter username here';
    }
    if (passwordInput) {
        passwordInput.placeholder = 'Enter password here';
    }

    // Adding a basic AJAX request example
    // Uncomment and modify the URL to fetch user data if required
    /*
    fetch('https://example.com/api/get-users')
        .then(response => response.json())
        .then(data => {
            console.log('User data:', data);
        })
        .catch(error => {
            console.error('Error fetching user data:', error);
        });
    */
});
