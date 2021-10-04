<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lab dashboard</title>
    <link href="../../css/dashboard.css" rel="stylesheet" type="text/css">
</head>
<body>

    <div class="header">
        <h1>Lab user dashboard</h1>
    
    </div>


    <div class="getTests">
        <h1>Enter date for tests </h1>
<<<<<<< HEAD:forms/lab/labdashboard.php
        <form method="post" action="../../includes/getTests.php" name="labtests">
            <input type="text" name="date"  placeholder="Desired date (year-month-day)" id="date" required />
=======
        <form method="post" action="../../includes/lab_getTests.php" name="labtests">
            <input type="date" name="date"  placeholder="Desired date (year-month-day)" id="date" required />
>>>>>>> 75dda9b7ecf4e13942bf7e1f319d1a987677f347:forms/lab/lab_dashboard.php
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
        <tr>
            <td>A</td>
            <td>B</td>
            <td>C</td>
            <td>D</td>
            <td>E</td>
        <tr>

    </table>


 

</body>
</html>