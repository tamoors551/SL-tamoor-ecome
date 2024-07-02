<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: index.php");
    exit();
}

// Dummy data for simulation (replace these with actual Easypaisa return parameters in a real integration)
$trx_id = isset($_GET['tx']) ? $_GET['tx'] : uniqid();
$p_st = isset($_GET['st']) ? $_GET['st'] : 'Completed';
$amt = isset($_GET['amt']) ? $_GET['amt'] : $_COOKIE["ta"];
$cm_user_id = isset($_GET['cm']) ? $_GET['cm'] : $_SESSION['userid'];
$cc = isset($_GET['cc']) ? $_GET['cc'] : 'PK';

if ($amt == $_COOKIE["ta"] && $p_st == "Completed") {
    include_once("db.php");
    $sql = "SELECT p_id, product_title, price, qty FROM cart WHERE user_id='$cm_user_id'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $product_id[] = $row['p_id'];
            $qty[] = $row['qty'];
            $p_name[] = $row['product_title'];
            $p_price[] = $row['price'];
        }

        for ($i = 0; $i < count($product_id); $i++) {
            $sql_customer_order = "INSERT INTO customer_order(uid, pid, p_name, p_price, p_qty, p_status, trx_id) 
                                   VALUES ('$cm_user_id', '".$product_id[$i]."', '".$p_name[$i]."', '".$p_price[$i]."', '".$qty[$i]."', '".$p_st."', '".$trx_id."')";
            $result1 = mysqli_query($con, $sql_customer_order);
        }

        // Insert data into received_payment table
        $sql_payment = "INSERT INTO received_payment (uid, pid, amount, trx_id) VALUES ('$cm_user_id', '".$product_id[0]."', '$amt', '$trx_id')";
        $result_payment = mysqli_query($con, $sql_payment);

        $sql2 = "DELETE FROM cart WHERE user_id = '$cm_user_id'";
        $result2 = mysqli_query($con, $sql2);

        if ($result2) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success - Tamoor</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/1a40f3df8b.js" crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Tamoor</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" 
    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="profile.php">
            <i class="fas fa-home" style="font-size: larger;"></i> Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="#">
            <i class="fab fa-algolia" style="font-size: larger;"></i> Products</a>
        </li>
      </ul>
    </div>
</nav>
<br/><br/><br/>
<div class="container">
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header bg-primary text-white"><h5>Thank You</h5></div>
         <div class="card-body">
            <p class="card-text">Hello, <?php echo $_SESSION['name']; ?>. Your Payment Process is successfully Completed.
                 Your Transaction ID is <?php echo $trx_id; ?>. You can continue your shopping.</p><br/>
                <a href="index.php" class="btn btn-success">Continue Shopping</a>
         </div>
      </div>
    </div>
  </div>
</div>
<script src="jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script src="index.js"></script>
</body>
</html>
<?php
        } // end of if($result2) ---- data deleted from cart
    } // end of if(mysqli_num_rows($result) > 0) statement
    else {
        header("Location: index.php");
        exit();
    }
} // end of isset cookie['ta'] && p-st == Completed
else {
    header("Location: index.php");
    exit();
}
?>
