<?php
class userModel extends model
{
    public function getSistemId($id)
    {
        $query = $this->db->prepare('select * from uyeler where id= ?');
        $query->execute(array($id));
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    public function create($name,$surname,$password,$email,$tel,$hash)
    {
        $query = $this->db->prepare("insert into user(name,surname,email,tel,password,confirmHash)VALUES (?,?,?,?,?,?)");
        $insert = $query->execute(array($name,$surname,$email,$tel,$password,$hash));
        if($insert)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function getUserByAuthCode($confirmHash){
        $query = $this->db->prepare("select * from user where confirmHash = ?");
        $query->execute(array($confirmHash));
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    public function confirmAcount($authenticationCode){
        $query = $this->db->prepare("update user set isActive = 1 where confirmHash = ?");
        $query->execute(array($authenticationCode));
        return true;
    }
    public function isExist($tel,$email){
        $query = $this->db->prepare("select * from user where email = ? or tel = ?");
        $query->execute(array($email,$tel));
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    public function getData($id)
    {
        $query = $this->db->prepare("select * from uyeler where id = ?");
        $query->execute(array($id));
        return $query->fetch(PDO::FETCH_ASSOC);
    }
}