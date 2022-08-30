<?php
class sessionManager  extends model
{

    static function createSession($array = [])
    {
        foreach ($array as $key => $value)
        {
            $_SESSION[$key] = helper::cleaner($value);
        }
    }

    static function deleteSession($key)
    {
        unset($_SESSION[$key]);
    }

    static function allSessionDelete()
    {
        session_destroy();
    }

    public function isLogged()
    {
        if(isset($_SESSION['name']) and isset($_SESSION['id']))
        {
            return true;
        }
        else
        {
            return false;
        }
    }


}