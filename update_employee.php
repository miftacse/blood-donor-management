<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Update Employee</title>
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

label {
  display: block;
  margin-bottom: 5px;
}

input[type="text"],
input[type="date"],
select,
textarea {
  width: 100%;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
  margin-bottom: 10px;
  box-sizing: border-box;
}

button {
  display: block;
  width: 100%;
  padding: 10px;
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  box-sizing: border-box;
}

button:hover {
  background-color: #0056b3;
}
</style>
</head>
<body>
  <div class="container">
    <h1>Update Employee</h1>
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

    // Check if Employee ID is provided in the URL
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $query = "SELECT * FROM employees WHERE EmployeeID = $id";
      $result = mysqli_query($conn, $query);
      $row = mysqli_fetch_assoc($result);
      if (!$row) {
        echo "<p>Employee not found.</p>";
      } else {
        // Handle form submission
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $fullName = $_POST['fullName'];
          $dateOfBirth = $_POST['dateOfBirth'];
          $gender = $_POST['gender'];
          $contactInfo = $_POST['contactInfo'];
          $address = $_POST['address'];
          $role = $_POST['role'];
          $department = $_POST['department'];
          $shiftSchedule = $_POST['shiftSchedule'];
          $trainingAndCertification = $_POST['trainingAndCertification'];
          $performanceEvaluation = $_POST['performanceEvaluation'];
          $leaveHistory = $_POST['leaveHistory'];
          $salary = $_POST['salary'];

          // Update query
          $updateQuery = "UPDATE employees SET FullName='$fullName', DateOfBirth='$dateOfBirth', Gender='$gender', ContactInfo='$contactInfo', Address='$address', Role='$role', Department='$department', ShiftSchedule='$shiftSchedule', TrainingAndCertification='$trainingAndCertification', PerformanceEvaluation='$performanceEvaluation', LeaveHistory='$leaveHistory', Salary='$salary' WHERE EmployeeID=$id";

          if (mysqli_query($conn, $updateQuery)) {
            echo "<p>Employee updated successfully.</p>";
          } else {
            echo "Error updating employee: " . mysqli_error($conn);
          }
        }

        // Display form with existing data
        ?>
        <form method="post">
          <label for="fullName">Full Name:</label>
          <input type="text" id="fullName" name="fullName" value="<?php echo $row['FullName']; ?>" required>

          <label for="dateOfBirth">Date of Birth:</label>
          <input type="date" id="dateOfBirth" name="dateOfBirth" value="<?php echo $row['DateOfBirth']; ?>" required>

          <label for="gender">Gender:</label>
          <select id="gender" name="gender" required>
            <option value="Male" <?php if ($row['Gender'] == 'Male') echo 'selected'; ?>>Male</option>
            <option value="Female" <?php if ($row['Gender'] == 'Female') echo 'selected'; ?>>Female</option>
            <option value="Other" <?php if ($row['Gender'] == 'Other') echo 'selected'; ?>>Other</option>
          </select>

          <label for="contactInfo">Contact Info:</label>
          <input type="text" id="contactInfo" name="contactInfo" value="<?php echo $row['ContactInfo']; ?>" required>

          <label for="address">Address:</label>
          <textarea id="address" name="address" required><?php echo $row['Address']; ?></textarea>

          <label for="role">Role:</label>
          <input type="text" id="role" name="role" value="<?php echo $row['Role']; ?>" required>

          <label for="department">Department:</label>
          <input type="text" id="department" name="department" value="<?php echo $row['Department']; ?>" required>

          <label for="shiftSchedule">Shift Schedule:</label>
          <input type="text" id="shiftSchedule" name="shiftSchedule" value="<?php echo $row['ShiftSchedule']; ?>" required>

          <label for="trainingAndCertification">Training and Certification:</label>
          <textarea id="trainingAndCertification" name="trainingAndCertification" required><?php echo $row['TrainingAndCertification']; ?></textarea>

          <label for="performanceEvaluation">Performance Evaluation:</label>
          <textarea id="performanceEvaluation" name="performanceEvaluation" required><?php echo $row['PerformanceEvaluation']; ?></textarea>

          <label for="leaveHistory">Leave History:</label>
          <textarea id="leaveHistory" name="leaveHistory" required><?php echo $row['LeaveHistory']; ?></textarea>

          <label for="salary">Salary:</label>
          <input type="number" id="salary" name="salary" value="<?php echo $row['Salary']; ?>" required>

          <button type="submit">Update Employee</button>
        </form>
        <?php
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
