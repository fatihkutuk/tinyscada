<?php
class loginModel extends model
{
    public function control($userMail,$userPassword)
    {
        $query = $this->db->prepare("select * from user where email = ? and password = ? ");
        $res = $query->execute(array($userMail,$userPassword));
        return $query->fetch();
    }


}
