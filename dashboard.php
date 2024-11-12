<?php
// Include the database configuration
include 'db_config.php';

// Get the email parameter from the URL
if (isset($_GET['email'])) {
    $email = $_GET['email'];

    // Query to fetch student data based on the email
    $sql = "SELECT * FROM students WHERE bmail = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);

    // Check if any result is found
    if ($stmt->rowCount() > 0) {
        // Fetch student data
        $student = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        // If no record found, redirect to login
        echo "<script>alert('No data found for this email.'); window.location.href = 'index.html';</script>";
        exit;
    }
} else {
    // If no email parameter, redirect to login page
    echo "<script>window.location.href = 'index.html';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            padding: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .dashboard-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
            width: 70%;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 32px;
            color: #333;
        }

        .student-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-top: 20px;
        }

        .student-box {
            background-color: #f9f9f9;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .student-box:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        }

        .student-box h3 {
            margin-top: 0;
            font-size: 24px;
            color: #333;
        }

        .student-box p {
            font-size: 18px;
            color: #555;
            margin: 5px 0;
        }

        .student-box .label {
            font-weight: bold;
            color: #333;
        }

        /* Aligning the name, roll number, and email in one box */
        .student-info .info-box {
            grid-column: span 2;
            display: flex;
            justify-content: space-between;
            padding: 20px;
            background-color: #e9ecef;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .info-box div {
            flex: 1;
            text-align: center;
            font-size: 18px;
        }

        .info-box div h3 {
            font-size: 20px;
            color: #333;
        }

        .info-box div p {
            font-size: 16px;
            color: #555;
        }

        .cgpa-box {
            grid-column: span 2;
            background-color: #f4f6f9;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .cgpa-box h3 {
            font-size: 36px;
            color: #2c3e50;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="dashboard-container">
            <h1>Student Dashboard</h1>
            <div class="student-info">
                <!-- Info Box for Name, Roll No, and Email -->
                <div class="student-box info-box">
                    <div>
                        <h3>Name</h3>
                        <p><?php echo htmlspecialchars($student['name']); ?></p>
                    </div>
                    <div>
                        <h3>Roll No</h3>
                        <p><?php echo htmlspecialchars($student['rollno']); ?></p>
                    </div>
                    <div>
                        <h3>Email</h3>
                        <p><?php echo htmlspecialchars($student['bmail']); ?></p>
                    </div>
                </div>

                <!-- CGPA Box -->
                <div class="cgpa-box">
                    <h3>CGPA: <?php echo htmlspecialchars($student['cgpa']); ?>/10</h3>
                </div>

                <!-- Other Information Boxes -->
                <div class="student-box">
                    <h3>Year</h3>
                    <p><?php echo htmlspecialchars($student['year']); ?></p>
                </div>
                <div class="student-box">
                    <h3>PS Level</h3>
                    <p><?php echo htmlspecialchars($student['pslevel']); ?></p>
                </div>
                <div class="student-box">
                    <h3>Lab</h3>
                    <p><?php echo htmlspecialchars($student['lab']); ?></p>
                </div>
                <div class="student-box">
                    <h3>PR</h3>
                    <p><?php echo htmlspecialchars($student['pr']); ?></p>
                </div>
                <div class="student-box">
                    <h3>FR</h3>
                    <p><?php echo htmlspecialchars($student['fr']); ?></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
