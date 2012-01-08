<?php

class App extends BaseApplication
{
    public function actionIndex($params=null){
        if(isset($_SESSION["user"])){
            echo "You are logged in as ".$_SESSION["user"]["name"]."<a href='/?action=logout' style='float:right;'>Logout</a>";
        } else {
            echo "<a href='/?action=login'  style='float:right;'>Login</a>";
        }
        //var_dump(Auth::authenticate("test","1"));
    }

    public function actionLogin($params=null){
        if(isset($_SESSION["user"])){
            header("Location: /");
        } else {
            echo "Login page";
        }
    }
}
