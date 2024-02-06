<?php 
include "koneksi.php";
session_start();
if(isset($_POST['login'])){
    $user = $_POST['user'];
    $pass = $_post['pass'];

    if($user!="" && $pass!=""){
        $mysql=mysqli_query($koneksi, "SELECT * FROM admin WHERE user='user' and pass='$pass'");
        if(data = mysqli_fetch_array($mysql)){
            $_SESSSION['user']=$data['user'];
            $_SESSION['pass']=$data['pass'];
            header('location:dasboard.php');
        }else{
            ?>
            <div class="alert alert-demger" role="alert">
                <span class="glyphicon glyphcion-exclamation-sign" aria-hidden="true"></span>
                <?php $error="";?> username atau password salah 
        </div><?php
        }
    } else } ?>