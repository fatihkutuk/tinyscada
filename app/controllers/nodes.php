<?php
class nodes extends controller
{

    public function index()
    {
        if (!$this->sessionManager->isLogged()){helper::redirect('/login');die();}
        $this->render("site/header");
        $this->render("site/sidebar");
        $this->render("nodes/index");
        $this->render("site/footer");
    }
    public function getTagValues(){
        
        if (!$this->sessionManager->isLogged()){helper::redirect('/login');die();}
        $tagValues = $this->model('nodeModel')->getTagValues($_GET['serialnolist']);
        echo json_encode($tagValues);
    }
    public function saveNodeValue(){
        if($_GET){
            $node = $this->model('nodeModel')->getNodeById($_GET['serialNumber']);
            if(!$node){
                echo json_encode(false);
                die();
            }else{
                $this->model('nodeModel')->saveNodeValue($_GET['serialNumber'],$_GET['tagName'],$_GET['tagValue']);
            }
            
        }
    }
}