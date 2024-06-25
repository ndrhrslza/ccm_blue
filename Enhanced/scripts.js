
// // document.addEventListener("DOMContentLoaded", function() {
// //     // Form sections
// //     const form1 = document.querySelector('.form_1');
// //     const form2 = document.querySelector('.form_2');
// //     const form3 = document.querySelector('.form_3');
    
// //     // Buttons containers
// //     const form1Btns = document.querySelector('.form_1_btns');
// //     const form2Btns = document.querySelector('.form_2_btns');
// //     const form3Btns = document.querySelector('.form_3_btns');

// //     // Navigation buttons
// //     const next1 = document.querySelector('.form_1_btns .btn_next');
// //     const next2 = document.querySelector('.form_2_btns .btn_next');
// //     const back2 = document.querySelector('.form_2_btns .btn_back');
// //     const back3 = document.querySelector('.form_3_btns .btn_back');
// //     const submitBtn = document.querySelector('.btn_submit');

// //     // Debugging statements
// //     console.log("Page loaded and script running");

// //     // Event listeners for navigation buttons
// //     next1.addEventListener('click', function() {
// //         console.log("Next button 1 clicked");
// //         if (validateForm1()) {
// //             console.log("Form 1 validated");
// //             showForm(form2, form1Btns, form2Btns);
// //         }
// //     });

// //     next2.addEventListener('click', function() {
// //         console.log("Next button 2 clicked");
// //         if (validateForm2()) {
// //             console.log("Form 2 validated");
// //             showForm(form3, form2Btns, form3Btns);
// //         }
// //     });

// //     back2.addEventListener('click', function() {
// //         console.log("Back button 2 clicked");
// //         showForm(form1, form2Btns, form1Btns);
// //     });

// //     back3.addEventListener('click', function() {
// //         console.log("Back button 3 clicked");
// //         showForm(form2, form3Btns, form2Btns);
// //     });

// //     // Form submission handling
// //     submitBtn.addEventListener('click', function(event) {
// //         console.log("Submit button clicked");
// //         if (validateForm3()) {
// //             alert('Form submitted successfully!');
// //             console.log("Form 3 validated and message displayed");
// //         } else {
// //             event.preventDefault();
// //             console.log("Form 3 validation failed");
// //         }
// //     });

// //     // Helper function to show/hide forms and buttons
// //     function showForm(formToShow, currentBtns, nextBtns) {
// //         form1.style.display = 'none';
// //         form2.style.display = 'none';
// //         form3.style.display = 'none';
// //         formToShow.style.display = 'block';

// //         form1Btns.style.display = 'none';
// //         form2Btns.style.display = 'none';
// //         form3Btns.style.display = 'none';
// //         nextBtns.style.display = 'flex';

// //         console.log("Form shown: ", formToShow);
// //         console.log("Buttons shown: ", nextBtns);
// //     }

// //     // Validation functions (simplified for clarity)
// //     function validateForm1() {
// //         const name = document.getElementById('name').value.trim();
// //         const email = document.getElementById('email').value.trim();
// //         const phoneno = document.getElementById('phoneno').value.trim();

// //         if (name === '' || email === '' || phoneno === '') {
// //             alert('Please fill out all fields in Step 1');
// //             return false;
// //         }

// //         const namePattern = /^[a-zA-Z\s]+$/;
// //         if (!namePattern.test(name)) {
// //             alert('Invalid name format');
// //             return false;
// //         }

// //         const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
// //         if (!emailPattern.test(email)) {
// //             alert('Invalid email format');
// //             return false;
// //         }

// //         const phonePattern = /^\d{3}-\d{3}-\d{4}$/;
// //         if (!phonePattern.test(phoneno)) {
// //             alert('Invalid phone number format');
// //             return false;
// //         }

// //         return true;
// //     }

// //     function validateForm2() {
// //         const adultTraveler = document.getElementById('adultTraveler').value.trim();
// //         const childTraveler = document.getElementById('childTraveler').value.trim();
// //         const destination = document.getElementById('destination').value.trim();
    
// //         if (adultTraveler === '' || childTraveler === '' || destination === '') {
// //             alert('Please fill out all fields in Step 2');
// //             return false;
// //         }
    
// //         if (parseInt(adultTraveler) <= 0) {
// //             alert('Number of adult travelers must be at least 1');
// //             return false;
// //         }
    
// //         if (parseInt(childTraveler) < 0) {
// //             alert('Number of child travelers cannot be negative');
// //             return false;
// //         }
    
// //         const prices = {
// //             "Taming Sari Tower": { adult: 13.40, child: 4.60 },
// //             "Klebang Beach": { adult: 15.70, child: 5.50 },
// //             "A Famosa Water Park": { adult: 12.80, child: 4.40 },
// //             "Dutch Square": { adult: 11.60, child: 3.90 }
// //         };
    
// //         const numAdults = parseInt(adultTraveler, 10);
// //         const numChildren = parseInt(childTraveler, 10);
// //         const price = prices[destination];
    
// //         const totalAmountSpan = document.getElementById('totalAmount');
// //         const totalAmountInput = document.querySelector('input[name="totalAmount"]');
    
// //         if (price) {
// //             const total = numAdults * price.adult + numChildren * price.child;
// //             console.log("Total Amount:", total);
// //             totalAmountSpan.innerHTML = `RM ${total.toFixed(2)}`;
// //             totalAmountInput.value = total.toFixed(2); // Update the hidden input
// //         } else {
// //             alert("Please select a destination.");
// //             return false;
// //         }
    
// //         return true;
// //     }
    

// //     function validateForm3() {
// //         const payMethod = document.querySelector('input[name="payMethod"]:checked');

// //         if (!payMethod) {
// //             alert('Please select a payment method');
// //             return false;
// //         }

// //         if (payMethod.value === 'internetbanking') {
// //             const bank = document.getElementById('bank').value.trim();
// //             if (bank === '') {
// //                 alert('Please select a bank');
// //                 return false;
// //             }
// //         } else if (payMethod.value === 'creditcard') {
// //             const cardNumber = document.getElementById('cardNumber').value.trim();
// //             const cardName = document.getElementById('cardName').value.trim();
// //             const expiryDate = document.getElementById('expiryDate').value.trim();
// //             const cvv = document.getElementById('cvv').value.trim();

// //             if (cardNumber === '' || cardName === '' || expiryDate === '' || cvv === '') {
// //                 alert('Please fill out all credit card details');
// //                 return false;
// //             }

// //             const cardNumberPattern = /^\d{16}$/;
// //             if (!cardNumberPattern.test(cardNumber)) {
// //                 alert('Invalid card number format');
// //                 return false;
// //             }

// //             const cardNamePattern = /^[a-zA-Z\s]+$/;
// //             if (!cardNamePattern.test(cardName)) {
// //                 alert('Invalid card holder name format');
// //                 return false;
// //             }

// //             const expiryDatePattern = /^(0[1-9]|1[0-2])\/?([0-9]{2})$/;
// //             if (!expiryDatePattern.test(expiryDate)) {
// //                 alert('Invalid expiry date format');
// //                 return false;
// //             }

// //             const cvvPattern = /^\d{3,4}$/;
// //             if (!cvvPattern.test(cvv)) {
// //                 alert('Invalid CVV format');
// //                 return false;
// //             }
// //         }

// //         return true;
// //     }

// //      // Show or hide payment method details based on selection
// //      document.querySelectorAll('input[name="payMethod"]').forEach((input) => {
// //         input.addEventListener('change', function() {
// //             const onlineBankingList = document.getElementById('onlineBankingList');
// //             const creditCardInfo = document.getElementById('creditCardInfo');

// //             if (this.value === 'internetbanking') {
// //                 onlineBankingList.style.display = 'block';
// //                 creditCardInfo.style.display = 'none';
// //             } else if (this.value === 'creditcard') {
// //                 onlineBankingList.style.display = 'none';
// //                 creditCardInfo.style.display = 'block';
// //             }
// //         });
// //     });
// // });

// document.addEventListener("DOMContentLoaded", function() {
//     const form1 = document.querySelector('.form_1');
//     const form2 = document.querySelector('.form_2');
//     const form3 = document.querySelector('.form_3');
//     const form1Btns = document.querySelector('.form_1_btns');
//     const form2Btns = document.querySelector('.form_2_btns');
//     const form3Btns = document.querySelector('.form_3_btns');
//     const next1 = document.querySelector('.form_1_btns .btn_next');
//     const next2 = document.querySelector('.form_2_btns .btn_next');
//     const back2 = document.querySelector('.form_2_btns .btn_back');
//     const back3 = document.querySelector('.form_3_btns .btn_back');
//     const submitBtn = document.querySelector('.btn_submit');

//     console.log("Page loaded and script running");

//     // Function to check login status
//     function checkLoginStatus() {
//         // Simulated isLoggedIn check (replace with AJAX call to PHP if needed)
//         const isLoggedIn = <?php echo isset($_SESSION['logged_in']) && $_SESSION['logged_in'] ? 'true' : 'false'; ?>;

//         return isLoggedIn;
//     }

//     // Event listeners for navigation buttons
//     next1.addEventListener('click', function() {
//         console.log("Next button 1 clicked");
//         if (checkLoginStatus()) {
//             console.log("User is logged in");
//             if (validateForm1()) {
//                 console.log("Form 1 validated");
//                 showForm(form2, form1Btns, form2Btns);
//             }
//         } else {
//             console.log("User is not logged in");
//             alert('You must be logged in to proceed.');
//             // Redirect to login page or handle as needed
//             window.location.href = 'login.html'; // Replace with your login page URL
//         }
//     });

//     next2.addEventListener('click', function() {
//         console.log("Next button 2 clicked");
//         if (checkLoginStatus()) {
//             console.log("User is logged in");
//             if (validateForm2()) {
//                 console.log("Form 2 validated");
//                 showForm(form3, form2Btns, form3Btns);
//             }
//         } else {
//             console.log("User is not logged in");
//             alert('You must be logged in to proceed.');
//             // Redirect to login page or handle as needed
//             window.location.href = 'login.html'; // Replace with your login page URL
//         }
//     });

//     back2.addEventListener('click', function() {
//         console.log("Back button 2 clicked");
//         showForm(form1, form2Btns, form1Btns);
//     });

//     back3.addEventListener('click', function() {
//         console.log("Back button 3 clicked");
//         showForm(form2, form3Btns, form2Btns);
//     });

//     submitBtn.addEventListener('click', function(event) {
//         console.log("Submit button clicked");
//         if (validateForm3()) {
//             alert('Form submitted successfully!');
//             console.log("Form 3 validated and message displayed");
//         } else {
//             event.preventDefault();
//             console.log("Form 3 validation failed");
//         }
//     });

//     // Helper function to show/hide forms and buttons
//     function showForm(formToShow, currentBtns, nextBtns) {
//         form1.style.display = 'none';
//         form2.style.display = 'none';
//         form3.style.display = 'none';
//         formToShow.style.display = 'block';

//         form1Btns.style.display = 'none';
//         form2Btns.style.display = 'none';
//         form3Btns.style.display = 'none';
//         nextBtns.style.display = 'flex';

//         console.log("Form shown: ", formToShow);
//         console.log("Buttons shown: ", nextBtns);
//     }

//     // Validation functions (simplified for clarity)
//     function validateForm1() {
//         const name = document.getElementById('name').value.trim();
//         const email = document.getElementById('email').value.trim();
//         const phoneno = document.getElementById('phoneno').value.trim();

//         if (name === '' || email === '' || phoneno === '') {
//             alert('Please fill out all fields in Step 1');
//             return false;
//         }

//         const namePattern = /^[a-zA-Z\s]+$/;
//         if (!namePattern.test(name)) {
//             alert('Invalid name format');
//             return false;
//         }

//         const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
//         if (!emailPattern.test(email)) {
//             alert('Invalid email format');
//             return false;
//         }

//         const phonePattern = /^\d{3}-\d{3}-\d{4}$/;
//         if (!phonePattern.test(phoneno)) {
//             alert('Invalid phone number format');
//             return false;
//         }

//         return true;
//     }

//     function validateForm2() {
//         const adultTraveler = document.getElementById('adultTraveler').value.trim();
//         const childTraveler = document.getElementById('childTraveler').value.trim();
//         const destination = document.getElementById('destination').value.trim();

//         if (adultTraveler === '' || childTraveler === '' || destination === '') {
//             alert('Please fill out all fields in Step 2');
//             return false;
//         }

//         if (parseInt(adultTraveler) <= 0) {
//             alert('Number of adult travelers must be at least 1');
//             return false;
//         }

//         if (parseInt(childTraveler) < 0) {
//             alert('Number of child travelers cannot be negative');
//             return false;
//         }

//         const prices = {
//             "Taming Sari Tower": { adult: 13.40, child: 4.60 },
//             "Klebang Beach": { adult: 15.70, child: 5.50 },
//             "A Famosa Water Park": { adult: 12.80, child: 4.40 },
//             "Dutch Square": { adult: 11.60, child: 3.90 }
//         };

//         const numAdults = parseInt(adultTraveler, 10);
//         const numChildren = parseInt(childTraveler, 10);
//         const price = prices[destination];

//         const totalAmountSpan = document.getElementById('totalAmount');
//         const totalAmountInput = document.querySelector('input[name="totalAmount"]');

//         if (price) {
//             const total = numAdults * price.adult + numChildren * price.child;
//             console.log("Total Amount:", total);
//             totalAmountSpan.innerHTML = `RM ${total.toFixed(2)}`;
//             totalAmountInput.value = total.toFixed(2); // Update the hidden input
//         } else {
//             alert("Please select a destination.");
//             return false;
//         }

//         return true;
//     }

//     function validateForm3() {
//         const payMethod = document.querySelector('input[name="payMethod"]:checked');

//         if (!payMethod) {
//             alert('Please select a payment method');
//             return false;
//         }

//         if (payMethod.value === 'internetbanking') {
//             const bank = document.getElementById('bank').value.trim();
//             if (bank === '') {
//                 alert('Please select a bank');
//                 return false;
//             }
//         } else if (payMethod.value === 'creditcard') {
//             const cardNumber = document.getElementById('cardNumber').value.trim();
//             const cardName = document.getElementById('cardName').value.trim();
//             const expiryDate = document.getElementById('expiryDate').value.trim();
//             const cvv = document.getElementById('cvv').value.trim();

//             if (cardNumber === '' || cardName === '' || expiryDate === '' || cvv === '') {
//                 alert('Please fill out all credit card details');
//                 return false;
//             }

//             const cardNumberPattern = /^\d{16}$/;
//             if (!cardNumberPattern.test(cardNumber)) {
//                 alert('Invalid card number format');
//                 return false;
//             }

//             const cardNamePattern = /^[a-zA-Z\s]+$/;
//             if (!cardNamePattern.test(cardName)) {
//                 alert('Invalid card holder name format');
//                 return false;
//             }

//             const expiryDatePattern = /^(0[1-9]|1[0-2])\/?([0-9]{2})$/;
//             if (!expiryDatePattern.test(expiryDate)) {
//                 alert('Invalid expiry date format');
//                 return false;
//             }

//             const cvvPattern = /^\d{3,4}$/;
//             if (!cvvPattern.test(cvv)) {
//                 alert('Invalid CVV format');
//                 return false;
//             }
//         }

//         return true;
//     }

//     // Show or hide payment method details based on selection
//     document.querySelectorAll('input[name="payMethod"]').forEach((input) => {
//         input.addEventListener('change', function() {
//             const onlineBankingList = document.getElementById('onlineBankingList');
//             const creditCardInfo = document.getElementById('creditCardInfo');

//             if (this.value === 'internetbanking') {
//                 onlineBankingList.style.display = 'block';
//                 creditCardInfo.style.display = 'none';
//             } else if (this.value === 'creditcard') {
//                 onlineBankingList.style.display = 'none';
//                 creditCardInfo.style.display = 'block';
//             }
//         });
//     });
// });

document.addEventListener("DOMContentLoaded", function() {
    const form1 = document.querySelector('.form_1');
    const form2 = document.querySelector('.form_2');
    const form3 = document.querySelector('.form_3');
    const form1Btns = document.querySelector('.form_1_btns');
    const form2Btns = document.querySelector('.form_2_btns');
    const form3Btns = document.querySelector('.form_3_btns');
    const next1 = document.querySelector('.form_1_btns .btn_next');
    const next2 = document.querySelector('.form_2_btns .btn_next');
    const back2 = document.querySelector('.form_2_btns .btn_back');
    const back3 = document.querySelector('.form_3_btns .btn_back');
    const submitBtn = document.querySelector('.btn_submit');

    console.log("Page loaded and script running");

    // Function to check login status via AJAX
    function checkLoginStatus(callback) {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', 'login_status.php', true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                callback(response.isLoggedIn);
            } else {
                console.error('Failed to check login status');
                callback(false);
            }
        };
        xhr.send();
    }

    // Event listeners for navigation buttons
    next1.addEventListener('click', function() {
        console.log("Next button 1 clicked");
        checkLoginStatus(function(isLoggedIn) {
            if (isLoggedIn) {
                console.log("User is logged in");
                if (validateForm1()) {
                    console.log("Form 1 validated");
                    showForm(form2, form1Btns, form2Btns);
                }
            } else {
                console.log("User is not logged in");
                alert('You must be logged in to proceed.');
                // window.location.href = 'login.php'; 
            }
        });
    });

    next2.addEventListener('click', function() {
        console.log("Next button 2 clicked");
        checkLoginStatus(function(isLoggedIn) {
            if (isLoggedIn) {
                console.log("User is logged in");
                if (validateForm2()) {
                    console.log("Form 2 validated");
                    showForm(form3, form2Btns, form3Btns);
                }
            } else {
                console.log("User is not logged in");
                alert('You must be logged in to proceed.');
                // window.location.href = 'login.php'; 
            }
        });
    });

    back2.addEventListener('click', function() {
        console.log("Back button 2 clicked");
        showForm(form1, form2Btns, form1Btns);
    });

    back3.addEventListener('click', function() {
        console.log("Back button 3 clicked");
        showForm(form2, form3Btns, form2Btns);
    });

    submitBtn.addEventListener('click', function(event) {
        console.log("Submit button clicked");
        if (validateForm3()) {
            alert('Form submitted successfully!');
            console.log("Form 3 validated and message displayed");
        } else {
            event.preventDefault();
            console.log("Form 3 validation failed");
        }
    });

    // Helper function to show/hide forms and buttons
    function showForm(formToShow, currentBtns, nextBtns) {
        form1.style.display = 'none';
        form2.style.display = 'none';
        form3.style.display = 'none';
        formToShow.style.display = 'block';

        form1Btns.style.display = 'none';
        form2Btns.style.display = 'none';
        form3Btns.style.display = 'none';
        nextBtns.style.display = 'flex';

        console.log("Form shown: ", formToShow);
        console.log("Buttons shown: ", nextBtns);
    }

    // Validation functions (simplified for clarity)
    function validateForm1() {
        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const phoneno = document.getElementById('phoneno').value.trim();

        if (name === '' || email === '' || phoneno === '') {
            alert('Please fill out all fields in Step 1');
            return false;
        }

        const namePattern = /^[a-zA-Z\s]+$/;
        if (!namePattern.test(name)) {
            alert('Invalid name format');
            return false;
        }

        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            alert('Invalid email format');
            return false;
        }

        const phonePattern = /^\d{3}-\d{3}-\d{4}$/;
        if (!phonePattern.test(phoneno)) {
            alert('Invalid phone number format');
            return false;
        }

        return true;
    }

    function validateForm2() {
        const adultTraveler = document.getElementById('adultTraveler').value.trim();
        const childTraveler = document.getElementById('childTraveler').value.trim();
        const destination = document.getElementById('destination').value.trim();

        if (adultTraveler === '' || childTraveler === '' || destination === '') {
            alert('Please fill out all fields in Step 2');
            return false;
        }

        if (parseInt(adultTraveler) <= 0) {
            alert('Number of adult travelers must be at least 1');
            return false;
        }

        if (parseInt(childTraveler) < 0) {
            alert('Number of child travelers cannot be negative');
            return false;
        }

        const prices = {
            "Taming Sari Tower": { adult: 13.40, child: 4.60 },
            "Klebang Beach": { adult: 15.70, child: 5.50 },
            "A Famosa Water Park": { adult: 12.80, child: 4.40 },
            "Dutch Square": { adult: 11.60, child: 3.90 }
        };

        const numAdults = parseInt(adultTraveler, 10);
        const numChildren = parseInt(childTraveler, 10);
        const price = prices[destination];

        const totalAmountSpan = document.getElementById('totalAmount');
        const totalAmountInput = document.querySelector('input[name="totalAmount"]');

        if (price) {
            const total = numAdults * price.adult + numChildren * price.child;
            console.log("Total Amount:", total);
            totalAmountSpan.innerHTML = `RM ${total.toFixed(2)}`;
            totalAmountInput.value = total.toFixed(2); // Update the hidden input
        } else {
            alert("Please select a destination.");
            return false;
        }

        return true;
    }

    function validateForm3() {
        const payMethod = document.querySelector('input[name="payMethod"]:checked');

        if (!payMethod) {
            alert('Please select a payment method');
            return false;
        }

        if (payMethod.value === 'internetbanking') {
            const bank = document.getElementById('bank').value.trim();
            if (bank === '') {
                alert('Please select a bank');
                return false;
            }
        } else if (payMethod.value === 'creditcard') {
            const cardNumber = document.getElementById('cardNumber').value.trim();
            const cardName = document.getElementById('cardName').value.trim();
            const expiryDate = document.getElementById('expiryDate').value.trim();
            const cvv = document.getElementById('cvv').value.trim();

            if (cardNumber === '' || cardName === '' || expiryDate === '' || cvv === '') {
                alert('Please fill out all credit card details');
                return false;
            }

            const cardNumberPattern = /^\d{16}$/;
            if (!cardNumberPattern.test(cardNumber)) {
                alert('Invalid card number format');
                return false;
            }

            const cardNamePattern = /^[a-zA-Z\s]+$/;
            if (!cardNamePattern.test(cardName)) {
                alert('Invalid card holder name format');
                return false;
            }

            const expiryDatePattern = /^(0[1-9]|1[0-2])\/?([0-9]{2})$/;
            if (!expiryDatePattern.test(expiryDate)) {
                alert('Invalid expiry date format');
                return false;
            }

            const cvvPattern = /^\d{3,4}$/;
            if (!cvvPattern.test(cvv)) {
                alert('Invalid CVV format');
                return false;
            }
        }

        return true;
    }

        document.querySelectorAll('input[name="payMethod"]').forEach((input) => {
        input.addEventListener('change', function() {
            const onlineBankingList = document.getElementById('onlineBankingList');
            const creditCardInfo = document.getElementById('creditCardInfo');

            if (this.value === 'internetbanking') {
                onlineBankingList.style.display = 'block';
                creditCardInfo.style.display = 'none';
            } else if (this.value === 'creditcard') {
                onlineBankingList.style.display = 'none';
                creditCardInfo.style.display = 'block';
            }
        });
    });
});

