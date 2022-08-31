<?php 

class nodeModel extends model {
    public function getNodes(){
        $query = $this->db->prepare('select * from node where userId = '.$_SESSION["id"].' ');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getNodeById($serialNumber){
        $query = $this->db->prepare('select * from node where nodeSerialNumber = '.$serialNumber.'');
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    public function getTagPool(){
        $query = $this->db->prepare('select * from tagpool');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getTagValues($serialNoList){
        $query = $this->db->prepare("CALL `getReadTafs`('$serialNoList')");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public function saveNodeValue($serialNumber,$tagName,$tagValue){
        $query = $this->db->prepare("replace into readtags (serialNumber,tagName,tagValue) values ($serialNumber,'$tagName',$tagValue)");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}