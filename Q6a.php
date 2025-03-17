<?php
$conn=mysqli_connect("localhost","root","","api_cat");
$query=mysqli_query($conn, "select* from products");
if(mysqli_num_rows($query)){
    $result=array();
while($table_output=mysqli_fetch_assoc($query)){
    $result[]=$table_output;
}
header('Content-Type: application/json');
echo json_encode($result);
}
?>
