<?php
// Database connection settings
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'sports_store';

// Create database connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ensure the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Directory to store uploaded images
    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Retrieve form data
    $productName = $conn->real_escape_string($_POST['product-name']);
    $productDescription = $conn->real_escape_string($_POST['product-description']);
    $productPrice = (float)$_POST['product-price'];
    $productCategory = $conn->real_escape_string($_POST['product-category']); // Dynamic category
    $additionalDetails = $conn->real_escape_string($_POST['additional-details']);

    // Handle file upload
    if (isset($_FILES['product-image']) && $_FILES['product-image']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['product-image']['tmp_name'];
        $fileName = basename($_FILES['product-image']['name']);
        $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
        $newFileName = uniqid('product_', true) . '.' . $fileExt; // Unique file name
        $uploadPath = $uploadDir . $newFileName;

        if (move_uploaded_file($fileTmpPath, $uploadPath)) {
            // Save product details to the vehicles table
            $sql = "INSERT INTO vehicles (name, description, price, category, image_path, additional_details) 
                    VALUES ('$productName', '$productDescription', $productPrice, '$productCategory', '$uploadPath', '$additionalDetails')";

            if ($conn->query($sql) === TRUE) {
                echo "<h1>Product Added Successfully!</h1>";
                echo "<a href='{$productCategory}.php' style='color: #ffcc00;'>Go to {$productCategory} Page</a><br>";
                echo "<a href='add-vehicles.html' style='color: #ffcc00;'>Add Another Product</a>";
            } else {
                echo "<h1>Error saving product: " . $conn->error . "</h1>";
            }
        } else {
            echo "<h1>Error uploading file. Please try again.</h1>";
        }
    } else {
        echo "<h1>Error: Please upload a valid image file.</h1>";
    }
} else {
    echo "<h1>Invalid request method!</h1>";
}

$conn->close();
?>


