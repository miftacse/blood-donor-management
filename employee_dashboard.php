<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management Dashboard</title>
    <style>
        /* CSS styles here */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 960px;
            margin: 20px auto;
        }

        h1 {
            text-align: center;
        }

        .btn-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
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

        .btn-action {
            margin-right: 5px;
        }

        .btn-update {
            background-color: #28a745; /* Green color for update button */
        }

        .btn-delete {
            background-color: #dc3545; /* Red color for delete button */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Employee Management Dashboard</h1>
        <div class="btn-container">
            <a href="http://localhost/project/employee.php" class="btn">Add Employee</a>
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Employee ID</th>
                        <th>Full Name</th>
                        <th>Date of Birth</th>
                        <th>Gender</th>
                        <th>Contact Info</th>
                        <th>Role</th>
                        <th>Department</th>
                        <th>Salary</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
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

                    // Query to fetch employee data
                    $query = "SELECT * FROM employees";
                    $result = mysqli_query($conn, $query);

                    // Display data in table rows
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>{$row['EmployeeID']}</td>";
                            echo "<td>{$row['FullName']}</td>";
                            echo "<td>{$row['DateOfBirth']}</td>";
                            echo "<td>{$row['Gender']}</td>";
                            echo "<td>{$row['ContactInfo']}</td>";
                            echo "<td>{$row['Role']}</td>";
                            echo "<td>{$row['Department']}</td>";
                            echo "<td>{$row['Salary']}</td>";
                            echo "<td>";
                            echo "<a href='update_employee.php?id={$row['EmployeeID']}' class='btn btn-action btn-update'>Update</a>";
                            echo "<a href='delete_employee.php?id={$row['EmployeeID']}' class='btn btn-action btn-delete'>Delete</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='9'>No employees found</td></tr>";
                    }

                    // Close database connection
                    mysqli_close($conn);
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
