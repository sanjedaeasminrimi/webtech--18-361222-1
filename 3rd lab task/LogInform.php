<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>

    <?php
        $name = $pass = "";
        $nameErr= $passErr= "";

        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            
            $name=$_POST['name'];

            if(strlen($_POST['name'])<2)
            {
                $nameErr="Username can not be less than 2 characters";
            }
            else if (!preg_match('/[0-9A-Za-z_.-]$/',$name))
            {
                $nameErr = "Only alpha numeric characters, period, dash or 
                underscore allowed";
            }
            else 
            {
                $nameErr="";
            }
            $pass = $_POST['pass'];

            
            if (strlen($pass)<8)
            {
                $passErr="Password must not be less than eight characters";
            }
            else if (!preg_match("/.*[@#$%]/",$pass))
            {
                $passErr="Password must contain at least one of the special characters (@, #, $,
                %)";
            }
        }
        ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <fieldset style="width:500px;">
   <legend><b>CHANGE PASSWORD</b></legend> 
        User Name: <input type="text" name="name" value="<?php echo $name; ?>"> <?php echo $nameErr; ?>
        <br><br>
        Password: <input type="pass" name="pass" value="<?php echo $pass; ?>"> <?php echo $passErr; ?>
        <br><br>
        <input type="checkbox" name="remember" id="remember"> Remember Me
        <br><br>
        <input type="submit" value="Submit">
        <a href="">Forgot Password?</a>
        </fieldset> 

    </form>

</body>
</html>
