<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banking Application</title>
</head>
<body>

<h1>Banking Application</h1>

<!-- Buttons for displaying information -->
<button onclick="location.href='?action=display_customers'">Display Customer Information</button>
<button onclick="location.href='?action=display_accounts'">Display Account Information</button>

<!-- Form to insert customer information -->
<h2>Insert Customer Information</h2>
<form method="POST" action="?action=insert_customer">
    <label for="cname">Customer Name:</label>
    <input type="text" id="cname" name="cname" required>
    <input type="submit" value="Add Customer">
</form>

<!-- Form to insert account information -->
<h2>Insert Account Information</h2>
<form method="POST" action="?action=insert_account">
    <label for="atype">Account Type (S for Savings, C for Current):</label>
    <input type="text" id="atype" name="atype" maxlength="1" required>
    
    <label for="balance">Balance:</label>
    <input type="number" id="balance" name="balance" required>

    <label for="cid">Customer ID:</label>
    <input type="number" id="cid" name="cid" required>

    <input type="submit" value="Add Account">
</form>

<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db1";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handling different actions
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    if ($action == 'insert_customer' && $_SERVER["REQUEST_METHOD"] == "POST") {
        // Insert customer information
        $cname = $_POST['cname'];
        $stmt = $conn->prepare("INSERT INTO CUSTOMER (CNAME) VALUES (?)");
        $stmt->bind_param("s", $cname);
        if ($stmt->execute()) {
            echo "<p>Customer added successfully!</p>";
        } else {
            echo "<p>Error adding customer: " . $stmt->error . "</p>";
        }
        $stmt->close();
    }

    if ($action == 'insert_account' && $_SERVER["REQUEST_METHOD"] == "POST") {
        // Insert account information
        $atype = $_POST['atype'];
        $balance = $_POST['balance'];
        $cid = $_POST['cid'];

        // Validate account type
        if ($atype != 'S' && $atype != 'C') {
            echo "<p>Invalid account type. Use 'S' for Savings or 'C' for Current.</p>";
        } else {
            $stmt = $conn->prepare("INSERT INTO ACCOUNT (ATYPE, BALANCE, CID) VALUES (?, ?, ?)");
            $stmt->bind_param("sdi", $atype, $balance, $cid);
            if ($stmt->execute()) {
                echo "<p>Account added successfully!</p>";
            } else {
                echo "<p>Error adding account: " . $stmt->error . "</p>";
            }
            $stmt->close();
        }
    }

    if ($action == 'display_customers') {
        // Display customer information
        $result = $conn->query("SELECT * FROM CUSTOMER");
        if ($result->num_rows > 0) {
            echo "<h2>Customer Information</h2><table border='1'><tr><th>CID</th><th>CNAME</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>{$row['CID']}</td><td>{$row['CNAME']}</td></tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No customers found.</p>";
        }
    }

    if ($action == 'display_accounts') {
        // Display account information
        $result = $conn->query("SELECT * FROM ACCOUNT");
        if ($result->num_rows > 0) {
            echo "<h2>Account Information</h2><table border='1'><tr><th>ANO</th><th>ATYPE</th><th>BALANCE</th><th>CID</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>{$row['ANO']}</td><td>{$row['ATYPE']}</td><td>{$row['BALANCE']}</td><td>{$row['CID']}</td></tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No accounts found.</p>";
        }
    }
}

// Close the database connection
$conn->close();
?>

</body>
</html>
