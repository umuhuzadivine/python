<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>MY information</title>
</head>
<body>
<form action="" method="POST">
  <input type="text" name="search">
  <button type="submit" name="search_student">search</button>
</form>

<?php
if(isset($_POST['search_student'])){
    $reg=$_POST['search'];
    $url="http://localhost/API_app/etide_cat/STUDENTS.JSON";
    $json_data=file_get_contents($url);
    $data=json_decode($json_data, true);

    foreach($data as $res){
        if($res['st_regno'] === $reg){
            echo '<table border="2">';
            echo '<th colspan="2">MY INFORMATION FROM JSON FILE</th>';
            echo '<tr><td>REG.NO:</td><td>'.$res['st_regno'].'</td></tr>';
            echo '<tr><td>NAMES</td><td>'.$res['st_names'].'</td></tr>';
            echo '<tr><td>DEPARTMENT</td><td>'.$res['st_dept'].'</td></tr>';
            echo '<tr><td>CLASS</td><td>'.$res['st_class'].'</td></tr>';
            echo '</table>';
            break;
        }}}
?>
</body>
</html>
