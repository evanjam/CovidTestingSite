<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor dashboard</title>
    <link href="../../css/dashboard.css" rel="stylesheet" type="text/css">
</head>
<body>

    <div class="header">
        <h1>Patient dashboard</h1>
    
    </div>
	
	<div><a href="patient_dashboard.php">Home</a></div>
    <br>


    <div class="getTests">
        <h1>Enter date for tests </h1>
        <form method="post" action="" name="labtests">
            <input type="date" name="date"  placeholder="Desired date" id="date" required />
            <input type="submit" name="labtests" value="Search">
        </form>
    </div>


    <table class="desiredResults" id="desiredResults">
        <tr>
            <th>Test Date</th>
            <th>Result</th>
        <tr>

            <?php
                include('../../includes/connect.php'); 
	
                if (isset($_POST['labtests'])) {
                    $date = $_POST['date'];
            
                    $query_date = "SELECT * FROM `test_sample` WHERE `test_date` = '$date'"; //returns rows that have the desired date
                    $result = $connect->query($query_date); //saves resultng data
                    
                    if($result->num_rows > 0) {
             
                        while(($row = $result->fetch_row())!==null) {
                            echo '<tr>';
                            echo "<td>{$row[3]}</td>";
                            echo "<td>{$row[4]}</td>";
                            echo '</tr>';
                        }
                    } else {
                        echo 'There were no tests on that date.';
                        
                }
            }
        ?>

    </table>
</body>
</html>