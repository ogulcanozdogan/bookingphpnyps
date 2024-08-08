document.addEventListener('DOMContentLoaded', function () {
    const dateInputs = document.querySelectorAll('input[type="date"]');
    const textInputs = document.querySelectorAll('.text-only');
    const numberInputs = document.querySelectorAll('.number-allowed');
    const phoneInputs = document.querySelectorAll('.phone-only');
    const form = document.getElementById('registration-form');

    // Set minimum date to today
    const today = new Date().toISOString().split('T')[0];
    dateInputs.forEach(input => {
        input.setAttribute('min', today);
        input.addEventListener('focus', function () {
            input.showPicker();
        });
    });

    // Add validation for text-only inputs
    textInputs.forEach(input => {
        input.addEventListener('input', function () {
            input.value = input.value.replace(/[^a-zA-Z\s]/g, '');
        });
    });

    // Add validation for number-allowed inputs
    numberInputs.forEach(input => {
        input.addEventListener('input', function () {
            input.value = input.value.replace(/[^a-zA-Z0-9\s]/g, '');
        });
    });

    // Add validation for phone-only inputs
    phoneInputs.forEach(input => {
        input.addEventListener('input', function () {
            input.value = input.value.replace(/[^0-9]/g, '');
        });
    });

    // Form submit event
    form.addEventListener('submit', function (event) {
        let isValid = true;
        textInputs.forEach(input => {
            if (!/^[a-zA-Z\s]+$/.test(input.value)) {
                isValid = false;
                input.classList.add('invalid');
            } else {
                input.classList.remove('invalid');
            }
        });
        numberInputs.forEach(input => {
            if (!/^[a-zA-Z0-9\s]+$/.test(input.value)) {
                isValid = false;
                input.classList.add('invalid');
            } else {
                input.classList.remove('invalid');
            }
        });
        phoneInputs.forEach(input => {
            if (!/^\d+$/.test(input.value)) {
                isValid = false;
                input.classList.add('invalid');
            } else {
                input.classList.remove('invalid');
            }
        });

        if (!isValid) {
            event.preventDefault();
            alert('Please correct the errors in the form.');
        }
    });

    // File upload validation
    document.getElementById('driverLicenseFile').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const maxSize = 10 * 1024 * 1024; // 10MB
            if (file.size > maxSize) {
                alert('File size exceeds 10MB limit.');
                event.target.value = ''; // Clear the file input
                return;
            }

            const validImageTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            if (!validImageTypes.includes(file.type)) {
                alert('Only image files (JPEG, PNG, GIF, WebP) are allowed.');
                event.target.value = ''; // Clear the file input
            }
        }
    });

    // Update declaration text
    function updateDeclaration() {
        const firstName = document.getElementById('driverFirstName').value;
        const lastName = document.getElementById('driverLastName').value;
        document.getElementById('declaration-text').textContent = `I, ${firstName} ${lastName}, declare that:`;
    }

    // Call updateDeclaration on input change
    document.getElementById('driverFirstName').addEventListener('input', updateDeclaration);
    document.getElementById('driverLastName').addEventListener('input', updateDeclaration);
});
