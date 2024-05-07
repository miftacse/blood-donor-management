<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Blood Request Management</title>
    
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
        <h1>Blood Request Management</h1>
        
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="requestingFacility">Requesting Facility:</label>
            <input type="text" id="requestingFacility" name="requestingFacility" required>

            <label for="patientName">Patient Name:</label>
            <input type="text" id="patientName" name="patientName" required>

            <label for="medicalRecordNumber">Medical Record Number:</label>
            <input type="text" id="medicalRecordNumber" name="medicalRecordNumber" required>
            <label for="bloodType">Blood Type:</label>
                <select id="bloodType" name="bloodType">
                <option value="">Select</option>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
                </select>


            <label for="quantity">Quantity (ml):</label>
            <input type="number" id="quantity" name="quantity" step="0.01" required>

            <label for="urgencyLevel">Urgency Level:</label>
            <select id="urgencyLevel" name="urgencyLevel" required>
                <option value="Low">Low</option>
                <option value="Medium">Medium</option>
                <option value="High">High</option>
            </select>

            <label for="requestedDateTime">Requested Date and Time:</label>
            <input type="datetime-local" id="requestedDateTime" name="requestedDateTime" required>

            <label for="status">Status:</label>
            <select id="status" name="status" required>
                <option value="Pending">Pending</option>
                <option value="In Progress">In Progress</option>
                <option value="Fulfilled">Fulfilled</option>
                <option value="Canceled">Canceled</option>
            </select>

            <label for="inventoryCheckResult">Inventory Check Result:</label>
            <select id="inventoryCheckResult" name="inventoryCheckResult" required>
                <option value="Available">Available</option>
                <option value="Insufficient">Insufficient</option>
                <option value="Out of Stock">Out of Stock</option>
            </select>

            <label for="assignedStaff">Assigned Staff:</label>
            <input type="number" id="assignedStaff" name="assignedStaff">

            <label for="deliveryDetails">Delivery Details:</label>
            <textarea id="deliveryDetails" name="deliveryDetails"></textarea>

            <label for="comments">Comments:</label>
            <textarea id="comments" name="comments"></textarea>

            <button type="submit">Submit Request</button>
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
        $requestingFacility = $conn->real_escape_string($_POST['requestingFacility']);
        $patientName = $conn->real_escape_string($_POST['patientName']);
        $medicalRecordNumber = $conn->real_escape_string($_POST['medicalRecordNumber']);
        $bloodType = $conn->real_escape_string($_POST['bloodType']);
        $quantity = $conn->real_escape_string($_POST['quantity']);
        $urgencyLevel = $conn->real_escape_string($_POST['urgencyLevel']);
        $requestedDateTime = $conn->real_escape_string($_POST['requestedDateTime']);
        $status = $conn->real_escape_string($_POST['status']);
        $inventoryCheckResult = $conn->real_escape_string($_POST['inventoryCheckResult']);
        $assignedStaff = $conn->real_escape_string($_POST['assignedStaff']);
        $deliveryDetails = $conn->real_escape_string($_POST['deliveryDetails']);
        $comments = $conn->real_escape_string($_POST['comments']);

        
        $sql = "INSERT INTO BloodRequests (RequestingFacility, PatientName, MedicalRecordNumber, BloodType, Quantity, UrgencyLevel, RequestedDateTime, Status, InventoryCheckResult, AssignedStaff, DeliveryDetails, Comments) 
                VALUES ('$requestingFacility', '$patientName', '$medicalRecordNumber', '$bloodType', '$quantity', '$urgencyLevel', '$requestedDateTime', '$status', '$inventoryCheckResult', '$assignedStaff', '$deliveryDetails', '$comments')";

        if ($conn->query($sql) === TRUE) {
            echo "<div class='container'><p>Request submitted successfully.</p></div>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
        
    }
    ?>
</body>

</html>