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

table {
  float: inline-start;
}

table, td, th {
  /* Add background pattern */
  background-image: url('pattern.png'); /* Replace 'pattern.png' with your pattern image */
  background-color: #f3f3f3;
  border: 1px solid black;
  border-collapse: collapse;
  text-align: center;
  padding: 15px;
  margin-top: 80px;
  margin-left: 240px;
}

.caption {
  font-weight: 900;
  font-size: xx-large;
  margin: 20px;
}

.row-lunch {
  font-weight: bold;
}

    </style>
</head>
<body>
    <main>
<?php
// Assuming you have timetable data stored in an array
// Replace this with your actual timetable data retrieval logic

// Example timetable data
$timetableData = [
    'IT' => [
        'II' => [
            '1' => [
            'MON' => ['MEFA', 'JAVA', 'UML', 'PSE', 'UML LAB', 'APTITUDE'],
            'TUE' => ['STAT WITH R', 'FOSS', 'AT&CD', 'MEFA', 'FOSS LAB', 'APTITUDE'],
            'WED' => ['MEFA', 'STAT WITH R', 'JAVA','AT&CD', 'STAT WITH R LAB', 'PSE'],
            'THU' => ['JAVA PROGRAMMING LAB','MEFA', 'PSE', 'MONGO DB', 'JAVA'],
            'FRI' => ['FOSS', 'JAVA', 'MONGO DB','AT&CD', 'PSE', 'MONGO DB LAB'],
            'SAT' => ['JAVA', 'MEFA', 'AT&CD','PSE', 'CODING', 'AT&CD'],
        ],
        '2' => [
            'MON' => ['MEFA', 'JAVA', 'UML', 'PSE', 'UML LAB', 'APTITUDE'],
            'TUE' => ['STAT WITH R', 'FOSS', 'AT&CD', 'MEFA', 'FOSS LAB', 'APTITUDE'],
            'WED' => ['MEFA', 'STAT WITH R', 'JAVA','AT&CD', 'STAT WITH R LAB', 'PSE'],
            'THU' => ['JAVA PROGRAMMING LAB','MEFA', 'PSE', 'MONGO DB', 'JAVA'],
            'FRI' => ['FOSS', 'JAVA', 'MONGO DB','AT&CD', 'PSE', 'MONGO DB LAB'],
            'SAT' => ['JAVA', 'MEFA', 'AT&CD','PSE', 'CODING', 'AT&CD'],
        ],
        '3' => [
            'MON' => ['MEFA', 'JAVA', 'UML', 'PSE', 'UML LAB', 'APTITUDE'],
            'TUE' => ['STAT WITH R', 'FOSS', 'AT&CD', 'MEFA', 'FOSS LAB', 'APTITUDE'],
            'WED' => ['MEFA', 'STAT WITH R', 'JAVA','AT&CD', 'STAT WITH R LAB', 'PSE'],
            'THU' => ['JAVA PROGRAMMING LAB','MEFA', 'PSE', 'MONGO DB', 'JAVA'],
            'FRI' => ['FOSS', 'JAVA', 'MONGO DB','AT&CD', 'PSE', 'MONGO DB LAB'],
            'SAT' => ['JAVA', 'MEFA', 'AT&CD','PSE', 'CODING', 'AT&CD'],
        ],
    ],
],

    'CSE' => [
        'II' => [
            '1' => [
                'MON' => ['JAVA', 'DBMS', 'MEFA', 'FLAT','DBMS','APT'],
                'TUE' => ['P&S', 'FLAT', 'JAVA', 'FLAT','P&S','APT'],
                'WED' => ['P&S', 'DBMS', 'FLAT','JAVA', 'JAVA LAB','MEFA'],
                'THU' => ['DBMS LAB','JAVA', 'P&S', 'CODING', 'JAVA'],
                'FRI' => ['MEFA', 'JAVA', 'DBMS','P&S', 'FLAT', 'SOC LAB'],
                'SAT' => ['JAVA', 'FLAT', 'DBMS','P&S', 'R-LAB', 'AT&CD'],
            ],
        '2' => [
                'MON' => ['DBMS', 'APT', 'JAVA', 'MEFA', 'JAVA','JAVA LAB'],
                'TUE' => ['JAVA', 'APT', 'FLAT', 'DBMS', 'R LAB', 'R LAB'],
                'WED' => ['P&S', 'JAVA', 'DBMS','FLAT', 'P&S', 'DBMS'],
                'THU' => ['CODING','P&S', 'MEFA', 'FLAT', 'DBMS'],
                'FRI' => ['FLAT', 'JAVA', 'FLAT','P&S', 'DBMS', 'DBMS LAB'],
                'SAT' => ['P&S', 'MEFA', 'DBMS','SOC', 'SOC LAB', 'FLAT'],

        ],
        '3' => [
                'MON' => ['DBMS', 'P&S', 'MEFA', 'R LAB', 'R LAB','FLAT'],
                'TUE' => ['FLAT', 'JAVA', 'DBMS', 'SOC', 'SOC LAB', 'P&S'],
                'WED' => ['FLAT', 'APT', 'JAVA','DBMS', 'MEFA', 'FLAT'],
                'THU' => ['DBMS LAB','JAVA','APT', 'FLAT', 'FLAT','P&S'],
                'FRI' => ['FLAT', 'MEFA', 'DBMS','P&S', 'JAVA', 'MEFA'],
                'SAT' => ['JAVA', 'MEFA', 'FLAT','P&S', 'CODING', 'FLAT'],

            // Timetable for class 3 of branch 1 in semester I
        ],
      ]   
    ],
    // Add more branches as needed
];

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all form fields are set
    if(isset($_POST['branch']) && isset($_POST['semester']) && isset($_POST['classno'])) {
        // Get selected options
        $branch = $_POST['branch'];
        $semester = $_POST['semester'];
        $classno = $_POST['classno'];

        // Check if selected options exist in timetable data
        if(isset($timetableData[$branch][$semester][$classno])) {
            // Retrieve timetable data based on selected options
            $selectedTimetable = $timetableData[$branch][$semester][$classno];
        } else {
            // Handle error if selected options do not exist in timetable data
            echo "Timetable data not found for the selected options.";
            exit;
        }
    } else {
        // Handle error if any form field is missing
        echo "All form fields are required.";
        exit;
    }
} else {
    // Handle error if form is not submitted
    echo "Form data not submitted.";
    exit;
}
?>
    <div class="container">
    <table>
            <caption class="caption">
                <i class="fa-solid fa-clock fa-sm"></i>  TIME TABLE
            </caption>
            <thead>
                <tr>
                    <th>Day/HOUR</th>
                    <th>09:00-10:00<br>I</th>
                    <th>10:00-10:55<br>II</th>
                    <th>10:55-11:50<br>III</th>
                    <th>   </th>
                    <th>12:45-01:40<br>IV</th>
                    <th>01:40-02:30<br>V</th>
                    <th>02:30-03:20<br>VI</th>
                    <th>03:20-04:10<br>VII</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>MON</td>
                    <td><?php echo $selectedTimetable['MON'][0]; ?></td>
                    <td><?php echo $selectedTimetable['MON'][1]; ?></td>
                    <td><?php echo $selectedTimetable['MON'][2]; ?></td>
                    <td rowspan="6" class="row-lunch">LUNCH</td>
                    <td><?php echo $selectedTimetable['MON'][3]; ?></td>
                    <td colspan="2"><?php echo $selectedTimetable['MON'][4]; ?></td>
                    <td><?php echo $selectedTimetable['MON'][5]; ?></td>
                </tr>
                <tr>
                    <td>TUE</td>
                    <td><?php echo $selectedTimetable['TUE'][0]; ?></td>
                    <td><?php echo $selectedTimetable['TUE'][1]; ?></td>
                    <td><?php echo $selectedTimetable['TUE'][2]; ?></td>
                    <td><?php echo $selectedTimetable['TUE'][3]; ?></td>
                    <td colspan="2"><?php echo $selectedTimetable['TUE'][4]; ?></td>
                    <td><?php echo $selectedTimetable['TUE'][5]; ?></td>
                </tr>
                <tr>
                    <td>WED</td>
                    <td><?php echo $selectedTimetable['WED'][0]; ?></td>
                    <td><?php echo $selectedTimetable['WED'][1]; ?></td>
                    <td><?php echo $selectedTimetable['WED'][2]; ?></td>
                    <td><?php echo $selectedTimetable['WED'][3]; ?></td>
                    <td colspan="2"><?php echo $selectedTimetable['WED'][4]; ?></td>
                    <td><?php echo $selectedTimetable['WED'][5]; ?></td>
                </tr>
                <tr>
                    <td>THU</td>
                    <td colspan="3"><?php echo $selectedTimetable['THU'][0]; ?></td>
                    <td><?php echo $selectedTimetable['THU'][1]; ?></td>
                    <td><?php echo $selectedTimetable['THU'][2]; ?></td>
                    <td><?php echo $selectedTimetable['THU'][3]; ?></td>
                    <td><?php echo $selectedTimetable['THU'][4]; ?></td>
                </tr>
                <tr>
                    <td>FRI</td>
                    <td><?php echo $selectedTimetable['FRI'][0]; ?></td>
                    <td><?php echo $selectedTimetable['FRI'][1]; ?></td>
                    <td><?php echo $selectedTimetable['FRI'][2]; ?></td>
                    <td><?php echo $selectedTimetable['FRI'][3]; ?></td>
                    <td><?php echo $selectedTimetable['FRI'][4]; ?></td>
                    <td colspan="2"><?php echo $selectedTimetable['FRI'][5]; ?></td>
                </tr>
                <tr>
                    <td>SAT</td>
                    <td><?php echo $selectedTimetable['SAT'][0]; ?></td>
                    <td><?php echo $selectedTimetable['SAT'][1]; ?></td>
                    <td><?php echo $selectedTimetable['SAT'][2]; ?></td>
                    <td><?php echo $selectedTimetable['SAT'][3]; ?></td>
                    <td colspan="2"><?php echo $selectedTimetable['SAT'][4]; ?></td>
                    <td><?php echo $selectedTimetable['SAT'][5]; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</main>

</body>
</html>
