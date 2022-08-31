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
    public function updateNodeIpBySerialNumber($serialNumber,$localip){
        $_SERVER["REMOTE_ADDR"];
        $query = $this->db->prepare('update node set externalp = "'.$_SERVER["REMOTE_ADDR"].'", localIp = "'.$localip.'" where nodeSerialNumber = '.$serialNumber.'');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
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
    public function saveNodeValue($serialNumber,$di1,$di2,$do1,$sicaklik,$nem){
        $query = $this->db->prepare("replace into readtags (serialNumber,tagName,tagValue) values 
        ($serialNumber,'di1',$di1),
        ($serialNumber,'di2',$di2),
        ($serialNumber,'do1',$do1),
        ($serialNumber,'sicaklik',$sicaklik),
        ($serialNumber,'nem',$nem)");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}