<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Blood Requests Dashboard</title>
<style>
/* CSS styles here */
body {
  font-family: Arial, sans-serif;
}

.container {
  max-width: 960px;
  margin: 20px auto;
}

h1 {
  text-align: center;
}

.table-container {
  overflow-x: auto;
}

table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
}

table th, table td {
  padding: 10px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

table th {
  background-color: #f4f4f4;
}

table tr:hover {
  background-color: #f9f9f9;
}
.btn-container {
  text-align: center;
  margin-top: 20px;
}

.btn {
  display: inline-block;
  padding: 10px 20px;
  background-color: #007bff;
  color: #fff;
  text-decoration: none;
  border-radius: 5px;
}
</style>
</head>
<body>
  <div class="container">
    <h1>Blood Requests Dashboard</h1>
    <div class="btn-container">
      <a href="http://localhost/project/bloodrequest.php" class="btn">Add Blood Request</a>
    </div>
    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>Request ID</th>
            <th>Requesting Facility</th>
            <th>Patient Name</th>
            <th>Medical Record Number</th>
            <th>Blood Type</th>
            <th>Quantity</th>
            <th>Urgency Level</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $servername = "localhost";
          $username = "root";
          $password = "";
          $dbname = "bloodbank";

          // Create connection
          $conn = new mysqli($servername, $username, $password, $dbname);

          // Check connection
          if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          }

          // Query to fetch blood requests data
          $query = "SELECT * FROM bloodrequests";
          $result = $conn->query($query);

          // Display data in table rows
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo "<tr>";
              echo "<td>{$row['RequestID']}</td>";
              echo "<td>{$row['RequestingFacility']}</td>";
              echo "<td>{$row['PatientName']}</td>";
              echo "<td>{$row['MedicalRecordNumber']}</td>";
              echo "<td>{$row['BloodType']}</td>";
              echo "<td>{$row['Quantity']}</td>";
              echo "<td>{$row['UrgencyLevel']}</td>";
              echo "<td>{$row['Status']}</td>";
              echo "</tr>";
            }
          } else {
            echo "<tr><td colspan='8'>No blood requests found</td></tr>";
          }

          // Close connection
          $conn->close();
          ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
