<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register new Test</title>
    <link href="../../css/dashboard.css" rel="stylesheet" type="text/css">
</head>
<body>

	<div class="header">
        <h1>Register new Test</h1>
    
    </div>
	
	<div><a href="employee_dashboard.php">Home</a></div>
    <br>

    <div class="employee_register">
        <h1>submit new test</h1>
        <form method="post" action="../../includes/submit_test.php" name="submit_test">
			<input type="text" name="ssn" placeholder="social security #" pattern="[0-9]+" required>
			<input type="text" name="serial" placeholder="serial #" pattern="[0-9]+" required>
            <input type="submit" name="submit_test" value="Submit">
        </form>
    </div>


</body>
</html>