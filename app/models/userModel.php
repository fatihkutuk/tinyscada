<?php
class userModel extends model
{
    public function getSistemId($id)
    {
        $query = $this->db->prepare('select * from uyeler where id= ?');
        $query->execute(array($id));
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    public function create($sistemId,$name,$email,$password,$permission)
    {
        $query = $this->db->prepare("insert into uyeler(sistem_uye_id,name,email,password,permission)VALUES (?,?,?,?,?)");
        $insert = $query->execute(array($sistemId,$name,$email,$password,$permission));
        if($insert)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function getData($id)
    {
        $query = $this->db->prepare("select * from uyeler where id = ?");
        $query->execute(array($id));
        return $query->fetch(PDO::FETCH_ASSOC);
    }
}