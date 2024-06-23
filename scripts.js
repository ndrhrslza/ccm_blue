var form_1 = document.querySelector(".form_1");
var form_2 = document.querySelector(".form_2");
var form_3 = document.querySelector(".form_3");

var form_1_btns = document.querySelector(".form_1_btns");
var form_2_btns = document.querySelector(".form_2_btns");
var form_3_btns = document.querySelector(".form_3_btns");

var form_1_next_btn = document.querySelector(".form_1_btns .btn_next");
var form_2_back_btn = document.querySelector(".form_2_btns .btn_back");
var form_2_next_btn = document.querySelector(".form_2_btns .btn_next");
var form_3_back_btn = document.querySelector(".form_3_btns .btn_back");

var form_2_progessbar = document.querySelector(".form_2_progessbar");
var form_3_progessbar = document.querySelector(".form_3_progessbar");

var btn_submit = document.querySelector(".btn_submit");

form_1_next_btn.addEventListener("click", function() {
    if (validateForm1()) {
        form_1.style.display = "none";
        form_2.style.display = "block";
        form_1_btns.style.display = "none";
        form_2_btns.style.display = "flex";
        form_2_progessbar.classList.add("active");
    }
});

form_2_back_btn.addEventListener("click", function() {
    form_1.style.display = "block";
    form_2.style.display = "none";
    form_1_btns.style.display = "flex";
    form_2_btns.style.display = "none";
    form_2_progessbar.classList.remove("active");
});

form_2_next_btn.addEventListener("click", function() {
    if (validateForm2()) {
        form_2.style.display = "none";
        form_3.style.display = "block";
        form_3_btns.style.display = "flex";
        form_2_btns.style.display = "none";
        form_3_progessbar.classList.add("active");
    }
});

form_3_back_btn.addEventListener("click", function() {
    form_2.style.display = "block";
    form_3.style.display = "none";
    form_3_btns.style.display = "none";
    form_2_btns.style.display = "flex";
    form_3_progessbar.classList.remove("active");
});

// btn_submit.addEventListener("click", function(event) {
//     if (!validateForm3()) {
//         event.preventDefault();  
//     } else {
//         submitted_Message();
//     }
// });
btn_submit.addEventListener("click", function(event) {
    // Prevent the default form submission
    event.preventDefault();

    // Validate the form using validateForm3 function
    if (validateForm3()) {
        // Serialize form data
        const formData = new FormData(document.querySelector('form'));

        // Send form data to booking.php using fetch API
        fetch('booking.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text();
        })
        .then(data => {
            // Handle success response from booking.php
            console.log('Form data submitted successfully:', data);
            // Optionally redirect to a success page or perform other actions
        })
        .catch(error => {
            console.error('There was a problem with form submission:', error);
            // Handle errors or display error messages to the user
        });
    } else {
        // Form validation failed, handle accordingly
        console.log('Form validation failed');
    }
});


function submitted_Message() {
    alert("Your booking form has been submitted to Cuti cuti Melaka. We will contact you shortly.");
}

function validateForm1() {
    var name = document.getElementById('name').value;
    var email = document.getElementById('email').value;
    var phoneno = document.getElementById('phoneno').value;

    if (name === "" || email === "" || phoneno === "") {
        alert("Please fill out all fields in Customer Details.");
        return false;
    }
    return true;
}

function validateForm2() {
    var destination = document.getElementById('destination').value;
    var adultTraveler = document.getElementById('adultTraveler').value;
    var childTraveler = document.getElementById('childTraveler').value;
    var totalAmount = document.getElementById('totalAmount');

    if (destination === "" || adultTraveler === "" || childTraveler === "") {
        alert("Please fill out all fields in Travel Details.");
        return false;
    }

    const prices = {
        "Taming Sari Tower": {
          adult: 13.40,
          child: 4.60
        },
        "Klebang Beach": {
          adult: 15.70,
          child: 5.50
        },
        "A Famosa Water Park": {
          adult: 12.80,
          child: 4.40
        },
        "Dutch Square": {
          adult: 11.60,
          child: 3.90
        }
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
    var payMethod = document.querySelector('input[name="payMethod"]:checked');

    if (!payMethod ) {
        alert("Please fill out all fields in Payment Details.");
        return false;
    }

    if (payMethod.value === "internetbanking") {
        var bank = document.getElementById('bank').value;
        if (bank === "") {
            alert("Please select a bank.");
            return false;
        }
    } else if (payMethod.value === "creditcard") {
        var cardNumber = document.getElementById('cardNumber').value;
        var cardName = document.getElementById('cardName').value;
        var expiryDate = document.getElementById('expiryDate').value;
        var cvv = document.getElementById('cvv').value;

        if (cardNumber === "" || cardName === "" || expiryDate === "" || cvv === "") {
            alert("Please fill out all credit card information.");
            return false;
        }
    }
    return true;
}


document.addEventListener("DOMContentLoaded", function() {
   

    document.getElementById('internetbanking').addEventListener('change', function() {
        document.getElementById('onlineBankingList').style.display = 'block';
        document.getElementById('creditCardInfo').style.display = 'none';
    });
    
    document.getElementById('creditcard').addEventListener('change', function() {
        document.getElementById('onlineBankingList').style.display = 'none';
        document.getElementById('creditCardInfo').style.display = 'block';
    });
    
    
});