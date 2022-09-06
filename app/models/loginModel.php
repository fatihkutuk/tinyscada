<?php
class loginModel extends model
{
    public function control($userMail,$userPassword)
    {
        $query = $this->db->prepare("select * from user where email = ? and password = ? and isActive = 1");
        $res = $query->execute(array($userMail,$userPassword));
        return $query->fetch();
    }


}
