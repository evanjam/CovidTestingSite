<?php
//Contains the functions for login.php
class Login{

    //Successful login function
    public function success_Login(){
        echo '
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>test login/register page</title>
                <link href="../css/login.css" rel="stylesheet" type="text/css">
            </head>
            <body>

                <div class="login">
                    <h1>CTS Testing</h1>
                    <form method="post" action="includes/login.php" name="login">
                        <input type="text" name="username" pattern="[a-zA-Z0-9]+" placeholder="login" id="username" required />
                        <input type="password" name="password" placeholder="password" required>
                        <input type="submit" name="login" value="login" disabled>
                    </form>
                    <hr>
                    <div class="message">Credentials match, Logging in..</div>
                    <div class="message">(Log created)</div>
                    <hr>
                </div>

            </body>
            </html>';
    }

    //Wrong credential function
    public function wrong_Credentials(){
        echo '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>test login/register page</title>
            <link href="../css/login.css" rel="stylesheet" type="text/css">
        </head>
        <body>

            <div class="login">
                <h1>CTS Testing</h1>
                <form method="post" action="includes/login.php" name="login">
                    <input type="text" name="username" pattern="[a-zA-Z0-9]+" placeholder="login" id="username" required />
                    <input type="password" name="password" placeholder="password" required>
                    <input type="submit" name="login" value="login" disabled>
                </form>
                <hr>
                <div class="message">Credentials do not match, Try again</div> <!--password verify fails -->
                <div class="message">(Log created)</div>
                <hr>
            </div>

        </body>
        </html>';
    }

    //User does not exist function
    public function user_Not_Exist(){
        echo '
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>test login/register page</title>
                <link href="../css/login.css" rel="stylesheet" type="text/css">
            </head>
            <body>

                <div class="login">
                    <h1>CTS Testing</h1>
                    <form method="post" action="includes/login.php" name="login">
                        <input type="text" name="username" pattern="[a-zA-Z0-9]+" placeholder="login" id="username" required />
                        <input type="password" name="password" placeholder="password" required>
                        <input type="submit" name="login" value="login" disabled>
                    </form>
                    <hr>
                    <div class="message">Credentials do not match, Try again</div> <!--user does not exist-->
                    <div class="message">(No log created)</div>
                    <hr>
                </div>

            </body>
            </html>';
    }
}



?>