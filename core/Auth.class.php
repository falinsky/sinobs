<?php

class Auth
{
    public static function authenticate($login,$pass){
        $db = Db::getInstance();
        $dbh = $db->prepare("SELECT * FROM users WHERE login = ?");
        $dbh->execute(array($login));
        $dbh->setFetchMode(PDO::FETCH_OBJ);
        $user = $dbh->fetch();
        if($user&&(md5($pass)==$user->pass)) {
            return $user;
        } else {
            return false;
        }
    }
}
