<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timetable</title>
    <style>
body {
  background-color: #f8f8f8  ;
  padding-top:2px;
  color:#000000;
  background-image: url('bg2.jpg'); 
  background-attachment: fixed; 
  width:100%;     
}
.container {
    max-width: 800px;
    margin: 20px auto;
    padding: 30px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}
.containerResult{
    display:flex;
}
.h1-head{
    text-align:center;
}

.h1-info
{
    font-size: 20px;
    font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    color: #333;
    margin: 10px 0; 
    padding-left: 40px; 
    text-align: left;  
}
.h1-value{
    font-size: 20px;
    margin: 10px 0; 
    font-family:'Times New Roman', Times, serif;
    color: #022060;
    padding-left: 40px; 
    font-weight:bolder;
    font-size:x-large;
}
table {
    width: 50%;
    border-collapse: collapse;
    margin-bottom: 20px;
    margin:30px;
    margin: 30px auto; 
}

table, th, td {
    border: 1px solid #ccc;
}

th, td {
    padding: 12px;
    text-align: left;
}

th {
    background-color: #00ccff;
    color: #fff;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

.h1-result {
    margin-top: 20px;
    color:#022060;
    font-weight:bolder;
    font-size:x-large;
    text-align: center;
}

</style>
<body>
    <main>
<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$db_users = "user_data";
$db_marks = "marks";

// Create connection
$conn_users = new mysqli($servername, $username, $password, $db_users);
$conn_marks = new mysqli($servername, $username, $password, $db_marks);

// Check connection
if ($conn_users->connect_error || $conn_marks->connect_error) {
    die("Connection failed: " . $conn_users->connect_error);
}

// Function to validate user credentials
function authenticate($conn, $username, $password) {
    $stmt = $conn->prepare("SELECT * FROM users_data WHERE username=? AND password=?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

// Function to fetch marks for a specific semester
function fetch_marks($conn, $semester, $username) {
    $stmt = $conn->prepare("SELECT * FROM $semester WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}
function calculate_sgpa($grades, $credits) {
    // Check if the input arrays have the same length
    if(count($grades) !== count($credits)) {
        return "Error: Arrays have different lengths";
    }

    $total_credits = array_sum($credits);
    
    // Check for division by zero error
    if($total_credits == 0) {
        return "Error: Total credits cannot be zero";
    }

    $total_weighted_grade_points = 0;

    for ($i = 0; $i < count($grades); $i++) {
        $grade_point = 0;
        switch ($grades[$i]) {
            case 'A+':
                $grade_point = 10;
                break;
            case 'A':
                $grade_point = 9;
                break;
            case 'B':
                $grade_point = 8;
                break;
            case 'C':
                $grade_point = 7;
                break;
            case 'D':
                $grade_point = 6;
                break;
            case 'F':
            case 'COMPLE':
            case 'ABSENT':
                $grade_point = 0;
                break;     
            default:
                $grade_point = 0;
                break;      
        }
        $total_weighted_grade_points += $grade_point * $credits[$i];
    }

    return $total_weighted_grade_points / $total_credits;
}


// Main login logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $semester = $_POST["semester"];

    // Authenticate user
    $user = authenticate($conn_users, $username, $password);

    if ($user) {
    echo "<h1 class='h1-head'>RESULT</h1>";
    // Display username and selected semester
    echo "<div class='containerResult'>";
    echo "<h1 class='h1-info'>ROLLNO  : </h1>";
    echo "<h1 class='h1-value'> " . $username . "</h1>";
    echo "</div>";
    echo "<div class='containerResult'>";
    echo "<h1 class='h1-info'>SEM   :   </h1>";
    echo "<h1 class='h1-value'>   " . $semester . "</h1>";
    echo "</div>";

    
        // Fetch marks for selected semester
        $marks = fetch_marks($conn_marks, $semester, $username);

        if ($marks) {
            // Display marks in table format
            echo "<table border='2'>";
            echo "<tr><th>Subject Name</th><th>Grade</th></tr>";
            foreach ($marks as $row) {
                echo "<tr><td>" . $row["Subname"] . "</td><td>" . $row["Grade"] . "</td></tr>";

                $grades[] = $row['Grade'];
                $credits[] = $row['Credits'];
            }
            echo "</table>";
            $sgpa = calculate_sgpa($grades, $credits);
            $percentage = ($sgpa * 10)-7.5;
            echo "<h1 class='h1-result'>SGPA: " . number_format($sgpa, 2) . "</h1>";
            echo "<h1 class='h1-result'>PERCENTAGE: " . number_format($percentage, 2) . "</h1>";
        } else {
            echo "No marks found for this semester.";
        }
    } else {
        echo "Invalid username or password.";
    }
}

// Close connections
$conn_users->close();
$conn_marks->close();
?>

</main>

</body>
</html>
