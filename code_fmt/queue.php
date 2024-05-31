<?php
// WARNING: NO ERROR CHEKING, for demo only
$userid = $_POST['userid'];
$projectid = $_POST['projectid'];
$srcfile = $_FILES['srcfile']['name'];
$tmpfile = $_FILES['srcfile']['tmp_name'];
$target_dir = "./files/$userid/$projectid";
mkdir($target_dir, 0700, true);
$target_file = "$target_dir/$srcfile";
move_uploaded_file($tmpfile, $target_file);
$sql = "INSERT INTO srcfiles VALUES ('$userid', '$projectid', '$srcfile', 'N');";
$dbh = new PDO('sqlite:./db/filedb.db');
if ($dbh->exec($sql)) {
  $msg = "$userid/$projectid/$srcfile successfully queued";
} else {
  $msg = "Somthing wrong queuing $userid/$projectid/$srcfile";
}
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
  <p><?=$sql?></p>
  <p><?=$msg?></p>
  
  <button onclick="window.location='show.php?userid=<?=$userid?>&projectid=<?=$projectid?>';">Show Project Files</button>
  <button onclick="window.location='index.html';">Back</button>
</body>
</html>
