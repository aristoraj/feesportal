<?php

require('config.php');
session_start();
//db connection
$conn = mysqli_connect($host, $username, $password, $dbname);

require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

$success = true;

$error = "Payment Failed";

if (empty($_POST['razorpay_payment_id']) === false)
{
    $api = new Api($keyId, $keySecret);

    try
    {
        // Please note that the razorpay order ID must
        // come from a trusted source (session here, but
        // could be database or something else)
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);
    }
    catch(SignatureVerificationError $e)
    {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}

if ($success === true)
{
    $razorpay_order_id = $_SESSION['razorpay_order_id'];
    $razorpay_payment_id = $_POST['razorpay_payment_id'];
    $customername = $_SESSION['customername'];
    $email = $_SESSION['email'];
    $contactno = $_SESSION['contactno'];
    $price = $_SESSION['price'];
    $sql = "INSERT INTO `fees` (`name`, `rollno`, `department`, `amount`) VALUES
    ('$customername', '$email','$contactno', '$price')";
    $sql = "INSERT INTO `orders` (`order_id`, `razorpay_payment_id`, `status`, `rollno`, `amount`) VALUES ('$razorpay_order_id', '$razorpay_payment_id', 'success', '$email', '$price')";
    if(mysqli_query($conn, $sql)){
        echo "";
    }

    $html = "<p>Your payment was successful</p>
             <p>Payment ID: {$_POST['razorpay_payment_id']}</p>";

    
}
else
{
    $html = "<p>Your payment failed</p>
             <p>{$error}</p>";
}
if ($success === true)
{
    $razorpay_order_id = $_SESSION['razorpay_order_id'];
    $razorpay_payment_id = $_POST['razorpay_payment_id'];
    $customername = $_SESSION['customername'];
    $email = $_SESSION['email'];
    $contactno = $_SESSION['contactno'];
    $price = $_SESSION['price'];
    $sql = "INSERT INTO `fees` (`name`, `rollno`, `department`, `amount`) VALUES
    ('$customername', '$email','$contactno', '$price')";
    if(mysqli_query($conn, $sql)){
        echo "";
    }

    $html = "<p>Your payment was successful</p>
             <p>Payment ID: {$_POST['razorpay_payment_id']}</p>";

    
}
else
{
    $html = "<p>Your payment failed</p>
             <p>{$error}</p>";
}

echo $html;
