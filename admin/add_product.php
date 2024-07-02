<?php
session_start();
include('db.php');

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form submission to add product to database
    $product_cat_id = $_POST['product_cat_id'];
    $product_brand_id = $_POST['product_brand_id'];
    $product_title = mysqli_real_escape_string($conn, $_POST['product_title']);
    $product_price = $_POST['product_price'];
    $product_desc = mysqli_real_escape_string($conn, $_POST['product_desc']);
    $product_keywords = mysqli_real_escape_string($conn, $_POST['product_keywords']);

    // Image upload handling
    $targetDir = __DIR__ . "/img/";
    $targetFile = $targetDir . basename($_FILES["product_image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if file is an actual image or fake image
    $check = getimagesize($_FILES["product_image"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($targetFile)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["product_image"]["size"] > 50000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow only certain file formats
    $allowedFormats = ["jpg", "jpeg", "png", "gif"];
    if (!in_array($imageFileType, $allowedFormats)) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $targetFile)) {
            // File uploaded successfully, now insert data into database
            $product_image = mysqli_real_escape_string($conn, $targetFile);

            $sql = "INSERT INTO products (product_cat_id, product_brand_id, product_title, product_price, product_desc, product_keywords, product_image)
                    VALUES ('$product_cat_id', '$product_brand_id', '$product_title', '$product_price', '$product_desc', '$product_keywords', '$product_image')";

            if ($conn->query($sql) === TRUE) {
                echo '<div class="alert alert-success" role="alert">New product added successfully!</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">Error: ' . $sql . '<br>' . $conn->error . '</div>';
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
            echo "Error: " . $_FILES["product_image"]["error"]; // Output PHP's file upload error code
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Add New Product</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">

        <div class="container mt-4">
        <h2>Add New Product</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="product_cat_id" class="form-label">Category ID:</label>
                <input type="text" id="product_cat_id" name="product_cat_id" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="product_brand_id" class="form-label">Brand ID:</label>
                <input type="text" id="product_brand_id" name="product_brand_id" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="product_title" class="form-label">Product Title:</label>
                <input type="text" id="product_title" name="product_title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="product_price" class="form-label">Product Price:</label>
                <input type="text" id="product_price" name="product_price" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="product_desc" class="form-label">Product Description:</label>
                <textarea id="product_desc" name="product_desc" class="form-control" rows="4"></textarea>
            </div>

            <div class="mb-3">
                <label for="product_keywords" class="form-label">Product Keywords:</label>
                <input type="text" id="product_keywords" name="product_keywords" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="product_image" class="form-label">Product Image:</label>
                <input type="file" id="product_image" name="product_image" class="form-control" accept="image/*" required>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Add Product</button>
        </form>

        <p class="mt-3"><a href="manage_products.php" class="btn btn-secondary">Back to Manage Products</a></p>
        <p><a href="admin_dashboard.php" class="btn btn-secondary">Back to Admin Panel</a></p>
    </div>

            <!-- Your form inputs here -->
        </form>
    </div>

    <!-- Bootstrap JS (optional if you don't need JS features) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <!-- Bootstrap JS (optional if you don't need JS features) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
