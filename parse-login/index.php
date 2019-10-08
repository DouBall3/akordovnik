<?php
session_start();
if(!isset($_POST['username']) || !isset($_POST['password'])){
header('Location: /login/');
exit();
}
$username = htmlspecialchars($_POST['username']);
$password = hash("sha256", htmlspecialchars($_POST['password']));

$conn = new mysqli("localhost", "texter", "your_secret_password", "texty");
if($conn->connect_error) {
 die("Connect failed: ". $conn->connect_error);
}
$result = $conn->query("SELECT username FROM users WHERE binary (username='$username' OR email='$username') AND password='$password'");
if(!empty($user = mysqli_fetch_row($result)[0])){
$_SESSION['login'] = true;
$_SESSION['username'] = $user;
$conn->query("UPDATE users SET lastlogin=NOW() WHERE username='$username'");
if(isset($_POST['loginCookie'])){
if($_POST['loginCookie'])
{
$params = session_get_cookie_params();
setcookie(session_name(), $_COOKIE[session_name()], time() + 60*60*24*30, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
}
}
header("Location: ".$_SESSION['uri']);
exit();
}
else header("Location: /login/?nopw");
?>
