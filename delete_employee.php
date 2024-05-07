<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Delete Employee</title>
<style>
/* CSS styles here */
body {
  font-family: Arial, sans-serif;
}

.container {
  max-width: 600px;
  margin: 20px auto;
  padding: 20px;
  background-color: #fff;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
  text-align: center;
  margin-bottom: 20px;
}

button {
  display: block;
  width: 100%;
  padding: 10px;
  background-color: #dc3545; /* Red color for delete button */
  color: #fff;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  box-sizing: border-box;
}

button:hover {
  background-color: #c82333; /* Darker red color on hover */
}
</style>
</head>
<body>
  <div class="container">
    <h1>Delete Employee</h1>
    <?php
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bloodbank";

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }

    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $query = "SELECT * FROM employees WHERE EmployeeID = $id";
      $result = mysqli_query($conn, $query);
      $row = mysqli_fetch_assoc($result);
      if ($row) {
        ?>
        <p>Are you sure you want to delete the following employee?</p>
        <p><strong>Employee ID:</strong> <?php echo $row['EmployeeID']; ?></p>
        <p><strong>Full Name:</strong> <?php echo $row['FullName']; ?></p>
        <p><strong>Date of Birth:</strong> <?php echo $row['DateOfBirth']; ?></p>
        <!-- Display other employee details as needed -->

        <form method="post">
          <input type="hidden" name="id" value="<?php echo $id; ?>">
          <button type="submit" name="delete">Delete Employee</button>
        </form>
        <?php
        if (isset($_POST['delete'])) {
          // Delete employee if delete button is clicked
          $deleteQuery = "DELETE FROM employees WHERE EmployeeID = $id";
          if (mysqli_query($conn, $deleteQuery)) {
            echo "<p>Employee deleted successfully.</p>";
          } else {
            echo "Error deleting employee: " . mysqli_error($conn);
          }
        }
      } else {
        echo "<p>Employee not found.</p>";
      }
    } else {
      echo "<p>Employee ID not provided.</p>";
    }

    // Close database connection
    mysqli_close($conn);
    ?>
  </div>
</body>
</html>
