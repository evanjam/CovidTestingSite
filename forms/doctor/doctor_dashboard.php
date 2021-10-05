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
        <h1>Doctor dashboard</h1>
    
    </div>
	
	<div><a href="doctor_dashboard.php">Home</a></div>
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
            <th>UID</th>
            <th>Serial #</th>
            <th>Test Date</th>
            <th>Result</th>
            <th>is_signed</th>
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
                            echo "<td>{$row[1]}</td>";
                            echo "<td>{$row[2]}</td>";
                            echo "<td>{$row[3]}</td>";
                            echo "<td>{$row[4]}</td>";
                            echo '<form action="doctor_dashboard.php" method="post">';
                            echo '<td><input type="number" name="result" placeholder="result" id="result" pattern="[0-1]"/></td>';
                            echo "<td>{$row[5]}</td>";
                            echo '<td><input type="number" name="is_signed" placeholder="is_signed" id="is_signed" pattern="[0-1]"/></td>';
                            echo '<td><input type="submit" name="submit" value="submit"></td>';
                            echo '<td><input type="number" name="tid" placeholder="Enter TID" id="tid" pattern="[0-1]"/></td>';
                            echo "<td>The TID is {$row[0]}</td>";
                            echo '</form>';
                            echo '</tr>';
                        }
                    } else {
                        echo 'There were no tests on that date.';
                        
                    }
                }
                if (isset($_POST['submit'])) { //checks if the submit button was pressed
                    $result = $_POST['result']; //saves variables from the user's input
                    $is_signed = $_POST['is_signed'];
                    $tid = $_POST['tid'];
                    
                    $update_result = "UPDATE `test_sample` SET `result` = '$result', `is_signed` = '$is_signed' WHERE `test_sample`.`TID` = $tid;"; //prepares sql statement to check if username already exists
                    $result = $connect->query($update_result); //runs $select_user as a query and stores the result in $result

                    if($connect->query($update_result) == TRUE) { //evan's query function, up for discussion on which to use
                        echo "Result has been updated";
                        header('Refresh: 1;URL=doctor_dashboard.php');
                    } else 
                        echo "insertion failed for some reason. try again.";
                    $connect->close();
                }
        ?>

    </table>
</body>
</html>