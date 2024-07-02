<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $uid = $_SESSION['userid'];

    // Database connection
    $con = new mysqli("localhost", "root", "", "tamoor-ecom"); // Update with your DB credentials

    // Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    // Get cart details
    $sql1 = "SELECT * FROM cart WHERE user_id='$uid'";
    $result1 = mysqli_query($con, $sql1);

    $order_total = 0;
    $items = [];

    if (mysqli_num_rows($result1) > 0) {
        while ($row = mysqli_fetch_array($result1)) {
            $order_total += $row['price'] * $row['qty'];
            $items[] = [
                'name' => $row['product_title'],
                'quantity' => $row['qty'],
                'price' => $row['price']
            ];
        }
    }

    // Dummy payment gateway integration
    $return_url = 'http://localhost/tamoor-ecom/tamoor/payment_success.php';
    $cancel_url = 'http://localhost/tamoor-ecom/tamoor/cancel.php';
    $notify_url = 'http://localhost/tamoor-ecom/tamoor/payment_success.php';

    // Simulate a successful response from the payment gateway
    $response_data = [
        'status' => 'success',
        'payment_url' => 'http://localhost/tamoor-ecom/tamoor/payment_success.php'
    ];

    if ($response_data['status'] == 'success') {
        $payment_url = $response_data['payment_url'];
        header('Location: ' . $payment_url);
        exit;
    } else {
        echo 'Payment initiation failed. Please try again.';
    }
}
?>
