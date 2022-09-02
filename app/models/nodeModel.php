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

        $query = $this->db->prepare("replace into readtags (serialNumber,tagName,tagValue) values ($serialNumber,'di1',$di1),($serialNumber,'di2',$di2),
        ($serialNumber,'do1',$do1);");
        $query2 = $this->db->prepare("replace into readtags (serialNumber,tagName,tagValue) values ($serialNumber,'sicaklik',$sicaklik);");
        $query3 = $this->db->prepare("replace into readtags (serialNumber,tagName,tagValue) values ($serialNumber,'nem',$nem);");
        $query->execute(); $query2->execute(); $query3->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public function tagsForWrite($serialNumber,$tagName){
        $query = $this->db->prepare("select * from writedtags where serialNumber = ".$serialNumber." and tagName = '".$tagName."' ");
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    public function deletAfterRead($serialNumber,$tagName){
        $query = $this->db->prepare("delete  from writedtags where serialNumber = ".$serialNumber." and tagName = '".$tagName."' ");
        $query->execute();
    }
    public function setBoolValues($serino,$tagName,$tagValue){
        $query = $this->db->prepare("replace into writedtags (serialNumber,tagName,tagValue) values ($serino,'$tagName',$tagValue)");
        $query->execute();
        //exit(var_dump($query));
        if($query){
            return true;
        }
    }
}