<?php
if(isset($_POST['submit'])){
        echo '<pre>';
        print_r($_FILES);
        echo '</pre>';
        }
?>
<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01//EN' 'http://www.w3.org/TR/html4/strict.dtd'>
<html>

<head>
 <title>Music Vids</title>
</head>

<body>
 <form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
 Section: <input type="text" name="section"><br />
 <input type="hidden" id="MAX_FILE_SIZE" name="MAX_FILE_SIZE" value="102400000" />
 <input type="file" id="userfile" name="userfile" /><br />
 <input type="hidden" id="action" name="action" value="upload" />
 <input type="submit" value="Submit" name="submit"/>
 </form>
</body>
</html>
