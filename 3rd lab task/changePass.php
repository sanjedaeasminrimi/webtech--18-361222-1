<!DOCTYPE html>
<html>
<head>
<title>Password Change</title>

</head>
<body>
<form>


   <?php
   $currentPassword=$newPassword=$rnpassword="";
   $currentPasswordErr=$newPasswordErr=$rnpasswordErr="";

   if($_SERVER["REQUEST_METHOD"] == "POST")
   {
     if (empty($_POST["currentPassword"])) {
       $currentPasswordErr = "Current Password is required";
     }
     else {
      $currentPassword = test_input($_POST["currentPassword"]);

       if (strcmp($currentPassword,"XAmPP@@5")) {
          $currentPasswordErr = "Incorrent Password";
        }

        }

        if (empty($_POST["newPassword"])) {
          $newPasswordErr = "New Password is required";
        }
        else {
         $newPassword = test_input($_POST["newPassword"]);

          if (!strcmp($newPassword,"XAmPP@@5")) {
             $newPasswordErr = "Current and New Password can not be same.";
           }

           }

           if (empty($_POST["rnpassword"])) {
             $rnpasswordErr = "Retype New Password is required";
           }
           else {
            $rnpassword = test_input($_POST["rnpassword"]);

             if (strcmp($npassword,$rnpassword)) {
                $rnpasswordErr = "Retype password and New Password need to be same.";
              }

              }
     }





   function test_input($data) {
     $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
     return $data;
   }

     ?>

<fieldset style="width:500px;">
   <legend><b>LOGIN</b></legend> 
Current Password: 
<input type="text" name="currentPassword" value="<?php echo $currentPassword;?>">
        <span class="error">* <?php echo $currentPasswordErr;?></span>
        <br><br>
        <span style="color:green">New Password:</span>
        <input type="text" name="newPassword" value="<?php echo $newPassword;?>">
        <span class="error">* <?php echo $newPasswordErr;?></span>
        <br><br>
        <span style="color:Red">Retype New Password:</span>
        <input type="text" name="rnpassword" value="<?php echo $rnpassword;?>">
        <span class="error">* <?php echo $rnpasswordErr;?></span>
        <br><br>
        <input type="submit" name="submit" value="Submit">
        <br><br>

        
 </fieldset> 
</form>
</body>
</html>