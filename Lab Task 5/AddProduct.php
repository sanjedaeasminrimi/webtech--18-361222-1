<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
   
<fieldset style="width: 300PX;">
 <form action="controller/Product.php" method="POST" enctype="multipart/form-data">
    <legend>ADD PRODUCT</legend>
  <label for="name">Name:</label><br>
  <input type="text" id="name" name="name"><br>
  <label for="buyinprice">Buying Price</label><br>
  <input type="text" id="buyinprice" name="buyinprice"><br>
  <label for="sellingprice">Selling Price</label><br>
  <input type="text" id="sellingprice" name="sellingprice"><br> <br>
 
  <input type="checkbox" name="display" <?php if(isset($remindMe) && $display=="display") echo "checked";?> value="display">Display
  <br><br>
        
  <input type="submit" name = "Save" value="Save"> 
</form> 
</fieldset>

</body>
</html>

