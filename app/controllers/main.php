<?php
class main extends controller
{

    public function index()
    {
        if (!$this->sessionManager->isLogged()){helper::redirect('/login');die();}
        $nodes = $this->model('nodeModel')->getNodes();
        $serinolist = [];
        //$pool = $this->model('nodeModel')->getTagPool();
        foreach ($nodes as $key => $node) { 
            array_push($serinolist,$node['nodeSerialNumber']);
        }
       
        $this->render("site/header");
        $this->render("site/sidebar");
        $this->render("/home",['nodes' => $nodes]); 
        $this->render("site/footer",['serinolist' => $serinolist]);
    }
    public function register(){
        $this->render("login/register");

    }
}