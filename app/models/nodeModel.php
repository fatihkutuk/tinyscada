<?php 

class nodeModel extends model {
    public function getNodes(){
        $query = $this->db->prepare('select * from node');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getTagPool(){
        $query = $this->db->prepare('select * from tagpool');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    
}