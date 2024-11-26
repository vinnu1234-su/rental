<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "sports_store");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch products for the cars category
$category = "fridge";
$sql = "SELECT * FROM appliances WHERE category = '$category' ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rentals</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #000;
            color: #fff;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #1a1a1a;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.5);
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #ffcc00;
        }

        .header {
            text-align: center;
            padding: 50px 20px;
            background-color: #1a1a1a;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 36px;
            margin: 10px 0;
            color: #ffcc00;
        }

        .header p {
            font-size: 18px;
            color: #ccc;
        }

        .grid-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 50px;
            padding: 50px;
        }

        .product-card {
            background-color: #1a1a1a;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .product-card:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(255, 204, 0, 0.7);
        }

        .product-card img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .product-card h3 {
            margin: 10px 0;
            color: #ffcc00;
        }

        .product-card p {
            font-size: 14px;
            color: #ccc;
        }

        .add-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #ffcc00;
            color: #000;
            border: none;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            font-size: 24px;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            display: flex;
            justify-content: center;
            align-items: center;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .add-button:hover {
            background-color: #e6b800;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
            transform: scale(1.1);
        }

        .footer {
            background-color: #1a1a1a;
            color: #fff;
            padding: 20px;
            text-align: center;
            margin-top: 40px;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.5);
        }

        .footer p {
            font-size: 16px;
        }

        .footer .services {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px;
        }

        .footer .services div {
            text-align: center;
        }

        .footer .contact-details {
            font-size: 14px;
        }

        .footer .contact-details a {
            color: #ffcc00;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="logo">LOGO</div>
    </div>
    <div class="header">
        <h1>Welcome to the Vehicle Rentals</h1>
        <p>Your one-stop destination for renting Cars!</p>
    </div>
    <div class="grid-container">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="product-card">
                    <img src="<?php echo htmlspecialchars($row['image_path']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">
                    <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                    <p><?php echo htmlspecialchars($row['description']); ?></p>
                    <p>Price: <?php echo number_format($row['price'], 2); ?> per day</p>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No appliances available in this category yet.</p>
        <?php endif; ?>
    </div>
    <a href="add-appliances.html" class="add-button">+</a>
    <div class="footer">
        <div class="services">
            <div>
                <h3>Services</h3>
                <p><a href="furniture.html" style="text-decoration: none; color: inherit;">Furniture Rentals</a></p>
                <p><a href="electronics.html" style="text-decoration: none; color: inherit;">Electronics Rentals</a></p>
                <p><a href="vehicles.html" style="text-decoration: none; color: inherit;">Vehicle Rentals</a></p>
                <p><a href="sports.html" style="text-decoration: none; color: inherit;">Sports Equipment Rentals</a></p>
                <p><a href="fitness.html" style="text-decoration: none; color: inherit;">Fitness Rentals</a></p>
            </div>
            <div>
                <h3>Contact</h3>
                <p><a href="mailto:vinuthnakumarmaxzen08.com" style="text-decoration: none; color: inherit;">Email: vinuthnakumarmaxzen08.com</a></p>
                <p><a href="tel:+919014908994" style="text-decoration: none; color: inherit;">Phone: +91 9014908994</a></p>
            </div>
        </div>
        <div class="contact-details">
            <p>&copy; 2024 Rental Hub. All Rights Reserved.</p>
        </div>
    </div>
</body>
</html>

<?php $conn->close(); ?>
