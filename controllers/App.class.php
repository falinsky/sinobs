<?php

class App extends BaseApplication
{
    public function preRun(){
        $this->observable = Observable::getInstance();
        $this->observable->addObserver(new FileLogger(), Observable::EVENT_LOGIN_FAILURE);
        $this->observable->addObserver(new FileLogger(), Observable::EVENT_LOGIN_SUCCESS);
        $this->observable->addObserver(new DbLogger(), Observable::EVENT_LOGIN_SUCCESS);
    }

    public function actionIndex($params=null){
        if(isset($_SESSION["user"])){
            echo "You are logged in as \"".$_SESSION["user"]["login"]."\". <a href='/?action=logout'>Logout</a>";
        } else {
            echo "<a href='/?action=login'  style='float:left;'>Login</a>";
        }
    }

    public function actionLogin($params=null){
        if(isset($_SESSION["user"])){
            header("Location: /");
        }
        if(isset($_SESSION["user"])){
            header("Location: /");
        }
        if(isset($params["user"]) && isset($params["user"]["login"]) && isset($params["user"]["pass"])){
           $error = array();
           $login = trim(htmlspecialchars(stripslashes($params["user"]["login"])));
           if(strlen($login)==0){
               $error["login"]="Login is not valid";
               $params["user"]["login"]=null;
           }
           $pass = trim(htmlspecialchars(stripslashes($params["user"]["pass"])));
           if(strlen($pass)==0){
               $error["pass"]="Pass is not valid";
               $params["user"]["pass"]=null;
           }
           if(count($error)==0){
               $user=Auth::authenticate($login,$pass);
               if(!is_null($user)){
                   $_SESSION["user"] = $user;

                   $this->observable->notify(Observable::EVENT_LOGIN_SUCCESS, $user);

                   header("Location: /");
               } else {
                   $error["no-such-user"] = "Wrong login/pass pair";
                   $params["user"]=null;
                   //TODO: Notify failure

               }
           } else {
               //TODO: Notify failure
           }
        }

        if(isset($_SESSION["user"])){
            header("Location: /");
        }

        echo "<h1>Login page</h1>";

        if(isset($error) && (count($error)>0)) {
           $data = array();
           $data["login"] = isset($login)?$login:"";
           $this->observable->notify(Observable::EVENT_LOGIN_FAILURE, $data);

           foreach($error as $e){
                echo "<span style='color:#ff0000'>".$e."</span><br/>";
           }
        }

        if(isset($_SESSION["user"])){
            header("Location: /");
        }

        require(TEMPLATE_DIR."/app/loginForm.php");

    }


    public function actionLogout($params=null){
        $_SESSION["user"]=null;
        header("Location: /");
    }
}