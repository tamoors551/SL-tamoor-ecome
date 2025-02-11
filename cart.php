<?php
include "db.php";
//session_start();

/*if(!isset($_SESSION['userid'])){
   header("Location:index.php");
}*/

?>

<!--Project definataion-SHOPPING CART APP using AJAX,JQUERY,PHP,MYSQLI-->
<!--I HAVE USED BOOTSTRAP FOR FRONT END-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tamoor</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/1a40f3df8b.js" crossorigin="anonymous"></script>

</head>
<body>
<!-----------------------------------navbar start here----------------------------------------->

<nav class="navbar navbar-expand-lg navbar-dark bg-dark" >
    <a class="navbar-brand" href="#" >Tamoor</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" 
    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">

        <li class="nav-item active">
          <a class="nav-link" href="profile.php" >
            <i class="fas fa-home " style="font-size: larger;"></i>  Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="profile.php" >
            <i class="fab fa-algolia" style="font-size: larger;"></i>  Products</a>
        </li>
      </ul>
     
    </div>
  </nav>
<br/><br/><br/>
<!-----------------------------------navbar ends here------------------------------------------>

<!---------------------------cart page ---product list page starts here---------------------------->

<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div id="cart_msg"><!---cart message here----></div>
                <div class="card">
                    <div class="card-header text-white bg-primary">
                        <h5>Cart Products</h5>
                    </div>
                    <div class="card-body">

                        <div class="row">   
                            <div class="col-md-2"><b>Action</b></div>
                            <div class="col-md-2"><b>Product Image</b></div>
                            <div class="col-md-2"><b>Product Name</b></div>
                            <div class="col-md-2"><b>Product Price</b></div>
                            <div class="col-md-2"><b>Quantity</b></div>
                            <div class="col-md-2"><b>Total</b></div>
                        </div>
                        <br/>
                     <div id="cart_product_list"></div>           
        <!--<div class="row">
            <div class="col-md-2">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                    <button type="button" class="btn btn-primary"><i class="fas fa-check-square"></i></button>
                </div>
            </div>

            
            <div class="col-md-2">Product Image</div>
            <div class="col-md-2">Product Name</div>
            <div class="col-md-2"><input type="text" class="form-control" value='5000' disabled></div>
            <div class="col-md-2"><input type="number" class="form-control" value='1' ></div>
            <div class="col-md-2"><input type="text" class="form-control" value='5000' disabled></div>

        
        </div>-->

      <!--<div class='row'>
            <div class='col-md-8'></div>
             <div class='col-md-4'>
                <b>Total : $total_amt</b> 
             </div>
            </div>
          </div>-->


                </div>
            </div>
          </div>
      </div>
   </div>
</div>







<!---------------------------cart page ---product list page ends here---------------------------->

<!-------------------------CODE TO ENABLE BOOTSTRAP------------------------------------------>
<script src="jquery-3.5.1.min.js"></script>
<!--<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>-->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

<script src="index.js"></script>


</body>
</html>