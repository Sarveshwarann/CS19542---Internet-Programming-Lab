<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db1"; // Change this to your database name


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to insert new employee details
if (isset($_POST['insert'])) {
    $empid = $_POST['empid'];
    $ename = $_POST['ename'];
    $desig = $_POST['desig'];
    $dept = $_POST['dept'];
    $doj = $_POST['doj'];
    $salary = $_POST['salary'];

    $sql = "INSERT INTO EMPDETAILS (EMPID, ENAME, DESIG, DEPT, DOJ, SALARY)
            VALUES ('$empid', '$ename', '$desig', '$dept', '$doj', '$salary')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Function to update employee details
if (isset($_POST['update'])) {
    $empid = $_POST['empid'];
    $ename = $_POST['ename'];
    $desig = $_POST['desig'];
    $dept = $_POST['dept'];
    $doj = $_POST['doj'];
    $salary = $_POST['salary'];

    $sql = "UPDATE EMPDETAILS SET ENAME='$ename', DESIG='$desig', DEPT='$dept', DOJ='$doj', SALARY='$salary' WHERE EMPID='$empid'";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Function to display employee data
$employees = null;
if (isset($_POST['retrieve'])) {
    $employees = $conn->query("SELECT * FROM EMPDETAILS");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Employee Details</title>
</head>
<body>

<h1>Insert New Employee</h1>
<form method="POST" action="">
    EmpID: <input type="text" name="empid" required><br><br>
    Name: <input type="text" name="ename" required><br><br>
    Designation: <input type="text" name="desig" required><br><br>
    Department: <input type="text" name="dept" required><br><br>
    Date of Joining: <input type="date" name="doj" required><br><br>
    Salary: <input type="number" name="salary" required><br><br>
    <input type="submit" name="insert" value="Insert Employee">
</form>

<h1>Update Employee Details</h1>
<form method="POST" action="">
    EmpID (To Update): <input type="text" name="empid" required><br><br>
    Name: <input type="text" name="ename" required><br><br>
    Designation: <input type="text" name="desig" required><br><br>
    Department: <input type="text" name="dept" required><br><br>
    Date of Joining: <input type="date" name="doj" required><br><br>
    Salary: <input type="number" name="salary" required><br><br>
    <input type="submit" name="update" value="Update Employee">
</form>

<h1>Retrieve Employee Details</h1>
<form method="POST" action="">
    <input type="submit" name="retrieve" value="Retrieve Employee Details">
</form>

<?php
if ($employees && $employees->num_rows > 0) {
    echo "<h1>Employee Details</h1>";
    echo "<table border='1'>
            <tr>
                <th>EmpID</th>
                <th>Name</th>
                <th>Designation</th>
                <th>Department</th>
                <th>Date of Joining</th>
                <th>Salary</th>
            </tr>";
    while ($row = $employees->fetch_assoc()) {
        echo "<tr>
                <td>{$row['EMPID']}</td>
                <td>{$row['ENAME']}</td>
                <td>{$row['DESIG']}</td>
                <td>{$row['DEPT']}</td>
                <td>{$row['DOJ']}</td>
                <td>{$row['SALARY']}</td>
            </tr>";
    }
    echo "</table>";
} elseif ($employees && $employees->num_rows === 0) {
    echo "<p>No employee data found.</p>";
}
?>

</body>
</html>

<?php
$conn->close();
?>
