<?php
// session_start();
// Link database connection
require_once('../Connect.php');

if (isset($_POST['submit'])) {
    $Branch = mysqli_real_escape_string($conp, $_POST['hospital']);
    $Cat = mysqli_real_escape_string($conp, $_POST['cat']);
    $INV = mysqli_real_escape_string($conp, $_POST['invoice']);
    $Name = mysqli_real_escape_string($conp, $_POST['name']);
    $Ammount = mysqli_real_escape_string($conp, $_POST['amount']);
    $PayerN = mysqli_real_escape_string($conp, $_POST['payername']);
    $PayerNIC = mysqli_real_escape_string($conp, $_POST['payernic']);
    $Phone = mysqli_real_escape_string($conp, $_POST['phone']);
    $Email = mysqli_real_escape_string($conp, $_POST['email']);


    // Insert new record
    $Insert = "INSERT INTO billpayments 
                (branch, payment_category, invoice_no, patient_name, bill_amount, payer_name, payer_nic, phone_number, email) 
               VALUES 
                (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conp, $Insert);
    mysqli_stmt_bind_param($stmt, 'sssssssss', $Branch, $Cat, $INV, $Name, $Ammount, $PayerN, $PayerNIC, $Phone, $Email);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Payment Successful!');</script>";
        echo "<script>window.location.href='BillPayments.php';</script>";
    } else {
        echo "<script>alert('Payment Failed: " . mysqli_error($conp) . "');</script>";
        echo "<script>window.location.href='BillPayments.php';</script>";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill Payments</title>
    <link rel="stylesheet" href="css/BillPayments.css">
</head>
<body>
    
<?php
include 'Component/Header.php';
?>

<!-- Bill Payments head Section -->
<section class="BillPayments">
    <div class="content">
        <div class="text-content">
            <h1>Bill Payments</h1>
            <span>Home / <b>Bill Payments</b></span>
        </div>
        <div class="image-content">
            <img src="../src/18.jpg" alt="About Us Image">
        </div>
    </div>
</section>

    <!-- Payment Information -->

<form action="" method="POST">

    <div class="payment">
        <h2>Payment Information</h2>
        <div class="form-row">
            <div class="form-group">
                <select id="hospital" name="hospital" required>
                    <option value="" disabled selected>Select Your Hospital</option>
                    <option value="Kandy">Kandy</option>
                    <option value="Colombo">Colombo</option>
                    <option value="Kurunegala">Kurunegala</option>
                </select>
            </div>

            <div class="form-group">

                <select id="cat" name="cat" required>
                    <option value="" disabled selected>Select the Payment Category</option>
                    <option value="Final Bill">Final Bill</option>
                    <option value="General Receipt">General Receipt</option>
                    <option value="Inpatient Receipt">Inpatient Receipt</option>
                    <option value="Lab Receipt">Lab Receipt</option>
                    <option value="Pharmacy Bill">Pharmacy Bill</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="invoice">Invoice No.</label>
            <input type="text" id="invoice" name="invoice" placeholder="Enter Invoice No" required>
        </div>

        <div class="form-group">
            <label for="name">Patient's Name</label>
            <input type="text" id="name" name="name" placeholder="Enter Patient's Name" required>
        </div>

        <div class="form-group">
            <label for="amount">Bill Amount (LKR)</label>
            <input type="number" id="amount" name="amount" min="1" placeholder="Enter Bill Amount" required>
        </div>
    </div>

    <!-- Payer Information -->
    <div class="bill">
        <h2>Payer Information</h2>
        <div class="form-group">
            <label for="payername">Payer Name</label>
            <input type="text" id="payername" name="payername" placeholder="Enter Payer's Name" required>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="payernic">NIC</label>
                <input type="text" id="payernic" name="payernic" placeholder="Enter NIC" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone No.</label>
                <input type="tel" id="phone" name="phone" placeholder="Enter Phone Number" required pattern="[0-9]{10}" title="Please enter a 10-digit phone number">
            </div>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter Email" required>
        </div>

        <div class="form-group">
            <label for="cardNumber">Card Number</label>
            <input type="text" id="cardNumber" name="cardNumber" placeholder="Enter 16-Digit Card Number" required pattern="[0-9]{16}" title="Please enter a 16-digit card number">
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="expiryDate">Expiration Date</label>
                <input type="text" id="expiryDate" name="expiryDate" placeholder="MM/YY" required pattern="^(0[1-9]|1[0-2])\/[0-9]{2}$" title="Enter date in MM/YY format">
            </div>

            <div class="form-group">
                <label for="cvv">CVV</label>
                <input type="password" id="cvv" name="cvv" placeholder="Enter CVV" required pattern="[0-9]{3}" title="Enter a 3-digit CVV">
            </div>
        </div>

        <button type="submit" name="submit">Pay Now</button>
    </div>
</form>


<?php
include 'Component/Footer.php';
?>

</body>
</html>


