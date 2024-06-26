<!--
Prepared by: Sorfina
This file handle booking form submission
CSRF token is generated and validated to prevent CSRF attacks (Prepared by: Nadirah)
-->

<?php
session_start();
include '../session_handler.php';
require_once '../csrf.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Booking Form | Cuti-Cuti Melaka</title>
    <link rel="stylesheet" type="text/css" href="../booking/styless.css">
    <script src="../homepage/index.js"></script>
</head>
<body>
    <div id="header"></div>
    <section style="background-image: url(../img/sungai.jpg); background-repeat: no-repeat; background-size: 100%; height: 600px;" data-section="menu">
        <div class="container">
          <div class="row">
            <div class="col-md-12 text-center">
                <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            </div>
          </div>
        </div>
    </section>

    <h1>Booking Form</h1>
    <div class="tagline">
        <p>"Book your trip with us, and enjoy your holiday to the fullest"</p>
    </div>

    <div class="wrapper">
        <div class="header">
            <ul>
                <li class="active form_1_progessbar">
                    <div>
                        <p>1</p>
                    </div>
                </li>
                <li class="form_2_progessbar">
                    <div>
                        <p>2</p>
                    </div>
                </li>
                <li class="form_3_progessbar">
                    <div>
                        <p>3</p>
                    </div>
                </li>
            </ul>
        </div>

        <div class="header_title">
            <ul>
                <li class="progessbar_1_title"><p>Customer Details</p></li>
                <li class="progessbar_2_title"><p>Travel Details</p></li>
                <li class="progessbar_3_title"><p>Payment Details</p></li>
            </ul>
        </div>
        <div class="form_wrap">
            <form method="post" action="bookingform.php" enctype="multipart/form-data">
                <div class="form_1 data_info">
                    <div class="form_container">
                        <div class="input_wrap">
                            <label for="name">Name</label>
                            <input type="text" class="input" id="name" name="name" pattern="[a-zA-Z\s]+" placeholder="Full name as in passport" required>
                        </div>
                        <div class="input_wrap">
                            <label for="email">Email</label>
                            <input type="email" class="input" id="email" name="email" pattern="[a-z0-9._%+-]+@[a-z]+\.[a-z]{2,}$" placeholder="MyName@example.com" required>
                        </div>
                        <div class="input_wrap">
                            <label for="phoneno">Phone Number</label>
                            <input type="text" class="input" id="phoneno" name="phoneno" pattern="\d{3}-\d{3}-\d{4}" placeholder="010-203-5690" required>
                        </div>
                    </div>
                </div>
                <div class="form_2 data_info" style="display: none;">
                    <div class="form_container">
                        <div class="input_wrap">
                            <label for="travellers">Number of Travelers?</label>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="adultTraveler">Adults</label><br>
                                    <input type="number" id="adultTraveler" name="adultTraveler" placeholder="How many adults?">
                                </div>
                                <div class="form-group">
                                    <label for="childTraveler">Children</label><br>
                                    <input type="number" id="childTraveler" name="childTraveler" placeholder="How many child?">
                                </div>
                            </div>
                            <br>    
                        </div>
                        <div class="input_wrap">
                            <label for="destination">Where would you like to travel?</label>
                            <select class="input" id="destination" name="destination">
                                <option value="Taming Sari Tower">Taming Sari Tower</option>
                                <option value="Klebang Beach">Klebang Beach</option>
                                <option value="A Famosa Water Park">A Famosa Water Park</option>
                                <option value="Dutch Square">Dutch Square</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form_3 data_info" style="display: none;">
                    <div class="form_container">
                        <div class="input_wrap">
                            <label for="totalAmount">Total Amount</label>
                            <span id="totalAmount"></span>
                            <input type="hidden" id="totalAmount" name="totalAmount">
                        </div>
                        <div class="input_wrap">
                            <label>What kind of payment arrangement you prefer?</label><br>
                            <input type="radio" id="internetbanking" name="payMethod" value="internetbanking">
                            <label for="internetbanking" class="container3">Internet Banking</label><br>
                            <input type="radio" id="creditcard" name="payMethod" value="creditcard">
                            <label for="creditcard" class="container3">Credit Card</label>
                        </div>
                        <div id="onlineBankingList" class="input_wrap" style="display: none;">
                            <label for="bank">Select Bank</label><br>
                            <select id="bank" name="bank">
                                <option value="maybank">Maybank</option>
                                <option value="cimb">CIMB Bank</option>
                                <option value="publicbank">Public Bank</option>
                                <option value="rhb">RHB Bank</option>
                                <option value="hongleong">Hong Leong Bank</option>
                                <option value="ambank">AmBank</option>
                                <option value="bankislam">Bank Islam</option>
                                <option value="affinbank">Affin Bank</option>
                                <option value="bankrakyat">Bank Rakyat</option>
                                <option value="alliancebank">Alliance Bank</option>
                                <option value="uob">UOB Malaysia</option>
                                <option value="standardchartered">Standard Chartered Malaysia</option>
                                <option value="hsbc">HSBC Malaysia</option>
                                <option value="ocbc">OCBC Bank</option>
                            </select>
                        </div>
                        <div id="creditCardInfo" class="input_wrap" style="display: none;">
                            <label for="cardNumber">Card Number</label><br>
                            <input type="text" id="cardNumber" name="cardNumber"" placeholder="e.g., 1234567812345678" ><br><br>
                            <label for="cardName">Card Holder Name</label><br>
                            <input type="text" id="cardName" name="cardName"  placeholder="e.g., John Doe" ><br><br>
                            <label for="expiryDate">Expiry Date</label><br>
                            <input type="text" id="expiryDate" name="expiryDate"  placeholder="MM/YY" ><br><br>
                            <label for="cvv">CVV</label><br>
                            <input type="text" id="cvv" name="cvv" placeholder="e.g., 123"><br><br>
                        </div>
                    </div>
                </div>
                <div class="btns_wrap">
                    <div class="common_btns form_1_btns">
                        <button type="button" class="btn_next">Next</button>
                    </div>
                    <div class="common_btns form_2_btns" style="display: none;">
                        <button type="button" class="btn_back">Back</button>
                        <button type="button" class="btn_next">Next</button>
                    </div>
                    <div class="common_btns form_3_btns" style="display: none;">
                        <button type="button" class="btn_back">Back</button>
                        <button type="submit" class="btn_submit">Submit</button>
                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <script type="text/javascript" src="scripts.js"></script>
</body>
<div id="footer"></div>
</html>
