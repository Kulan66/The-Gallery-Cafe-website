document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('form');
    form.addEventListener('submit', (event) => {
        const email = form.querySelector('#email').value;
        const cardNumber = form.querySelector('#card-number').value;
        const cardExpiry = form.querySelector('#card-expiry').value;
        const cardCvc = form.querySelector('#card-cvc').value;

        if (!validateEmail(email)) {
            alert('Please enter a valid email address.');
            event.preventDefault();
        } else if (!validateCardNumber(cardNumber)) {
            alert('Please enter a valid card number.');
            event.preventDefault();
        } else if (!validateCardExpiry(cardExpiry)) {
            alert('Please enter a valid expiration date.');
            event.preventDefault();
        } else if (!validateCardCvc(cardCvc)) {
            alert('Please enter a valid CVC code.');
            event.preventDefault();
        }
    });

    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }

    function validateCardNumber(number) {
        const re = /^\d{16}$/;
        return re.test(number);
    }

    function validateCardExpiry(expiry) {
        const [year, month] = expiry.split('-').map(Number);
        const today = new Date();
        const currentYear = today.getFullYear();
        const currentMonth = today.getMonth() + 1;

        if (year < currentYear || (year === currentYear && month < currentMonth)) {
            return false;
        }
        return true;
    }

    function validateCardCvc(cvc) {
        const re = /^\d{3}$/;
        return re.test(cvc);
    }
});
