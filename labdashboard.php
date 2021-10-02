<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lab dashboard</title>
    <link href="css/labdashboard.css" rel="stylesheet" type="text/css">
</head>
<body>

    <div class="header">
        <h1>Lab user dashboard</h1>
    
    </div>


    <div class="getTests">
        <h1>Enter date for tests </h1>
        <form method="post" action="includes/getTests.php" name="labtests">
            <input type="date" name="date"  placeholder="Desired date (year-month-day)" id="username" required />
            <input type="submit" name="Get desired tests" value="recieve">
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