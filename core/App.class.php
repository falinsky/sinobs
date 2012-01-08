<?php

class App extends BaseApplication
{
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
        } else {
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
                       //TODO: Notify success
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

           echo "<h1>Login page</h1>";

           if(isset($error) && (count($error)>0)) {
               foreach($error as $e){
                    echo "<span style='color:#ff0000'>".$e."</span><br/>";
               }
           }

           echo "<form action='/' method='POST'>
                    <input type='hidden' name='action' value='login'/>
                    <label for='login'>Login:</label>
                    <input id='login' type='text' name='params[user][login]'";

           if(isset($params["user"]["login"])) {
               echo "value='".$params["user"]["login"]."'";
           }
           echo "   />";

           if(isset($error["login"])) {
               echo "<span style='color:#ff0000'>".$error["login"]."</span>";
           }

           echo "   <br/>
                    <label for='pass'>Pass:</label>&nbsp;&nbsp;
                    <input id='pass' type='password' name='params[user][pass]'";

           if(isset($params["user"]["pass"])) {
               echo "value='".$params["user"]["pass"]."'";
           }
           echo "   />";

           if(isset($error["pass"])) {
               echo "<span style='color:#ff0000'>".$error["pass"]."</span>";
           }

           echo "   <br/>
                    <input type='submit'/>
                </form>";

        }
    }

    public function actionLogout($params=null){
        $_SESSION["user"]=null;
        header("Location: /");
    }
}