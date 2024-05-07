<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
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
        input[type="number"],
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
        <h1>Add Employee</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="fullName">Full Name:</label>
            <input type="text" id="fullName" name="fullName" required>

            <label for="dateOfBirth">Date of Birth:</label>
            <input type="date" id="dateOfBirth" name="dateOfBirth" required>

            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>

            <label for="contactInfo">Contact Info:</label>
            <input type="text" id="contactInfo" name="contactInfo" required>

            <label for="address">Address:</label>
            <textarea id="address" name="address" required></textarea>

            <label for="role">Role:</label>
            <input type="text" id="role" name="role" required>

            <label for="department">Department:</label>
            <input type="text" id="department" name="department" required>

            <label for="shiftSchedule">Shift Schedule:</label>
            <input type="text" id="shiftSchedule" name="shiftSchedule" required>

            <label for="trainingAndCertification">Training and Certification:</label>
            <textarea id="trainingAndCertification" name="trainingAndCertification" required></textarea>

            <label for="performanceEvaluation">Performance Evaluation:</label>
            <textarea id="performanceEvaluation" name="performanceEvaluation" required></textarea>

            <label for="leaveHistory">Leave History:</label>
            <textarea id="leaveHistory" name="leaveHistory" required></textarea>

            <label for="salary">Salary:</label>
            <input type="number" id="salary" name="salary" required>

            <button type="submit">Add Employee</button>
        </form>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Handle form submission
        // This is where you would process the form data and insert it into the database
        // For example, you could use the mysqli functions to connect to the database and execute an INSERT query
        // Make sure to adjust the database connection details and INSERT query according to your setup
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "bloodbank";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Escape user inputs for security
        $fullName = $conn->real_escape_string($_POST['fullName']);
        $dateOfBirth = $conn->real_escape_string($_POST['dateOfBirth']);
        $gender = $conn->real_escape_string($_POST['gender']);
        $contactInfo = $conn->real_escape_string($_POST['contactInfo']);
        $address = $conn->real_escape_string($_POST['address']);
        $role = $conn->real_escape_string($_POST['role']);
        $department = $conn->real_escape_string($_POST['department']);
        $shiftSchedule = $conn->real_escape_string($_POST['shiftSchedule']);
        $trainingAndCertification = $conn->real_escape_string($_POST['trainingAndCertification']);
        $performanceEvaluation = $conn->real_escape_string($_POST['performanceEvaluation']);
        $leaveHistory = $conn->real_escape_string($_POST['leaveHistory']);
        $salary = $conn->real_escape_string($_POST['salary']);

        // Attempt insert query execution
        $sql = "INSERT INTO Employees (FullName, DateOfBirth, Gender, ContactInfo, Address, Role, Department, ShiftSchedule, TrainingAndCertification, PerformanceEvaluation, LeaveHistory, Salary) 
                VALUES ('$fullName', '$dateOfBirth', '$gender', '$contactInfo', '$address', '$role', '$department', '$shiftSchedule', '$trainingAndCertification', '$performanceEvaluation', '$leaveHistory', '$salary')";

        if ($conn->query($sql) === TRUE) {
            echo "<div class='container'><p>Employee added successfully.</p></div>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
    ?>
</body>
</html>