

document.addEventListener("DOMContentLoaded", function() {

    const customAlert = document.getElementById('customAlert');
    const customAlertText = document.getElementById('customAlertText');
    const closeAlert = document.getElementById('closeAlert');

    function showAlert(message) {
        customAlertText.textContent = message;
        customAlert.style.display = 'block';
        customAlert.classList.remove('hidden');
    }

    function hideAlert() {
        customAlert.style.display = 'none';
    }

    closeAlert.addEventListener('click', hideAlert);



    const form = document.querySelector('form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        let isValid = true;

        // Validation for Name on Card
        const nameOnCard = form.elements['name_on_card'].value.trim();
        if (nameOnCard === '') {
            showAlert('Please enter the name on the card.');
            isValid = false;
            return;
        }

        // Validation for Card Number
        const cardNumber = form.elements['card_number'].value.trim();
        if (cardNumber === '') {
            showAlert('Please enter the card number.');
            isValid = false;
            return;
        } else if (!/^\d{16}$/.test(cardNumber)) {
            showAlert('Card number must be 16-digit.');
            isValid = false;
            return;
        }

        // Validation for Security Code (CVV)
        const securityCode = form.elements['security_code'].value.trim();
        if (securityCode === '') {
            showAlert('Please enter the security code (CVV).');
            isValid = false;
        } else if (!/^\d{3}$/.test(securityCode)) {
            showAlert('Security code (CVV) must be 3-digit.');
            isValid = false;
        }

        if (isValid) {
            form.submit();
        }
    });
});
