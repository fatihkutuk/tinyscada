<?php
class nodes extends controller
{

    public function index()
    {
        if (!$this->sessionManager->isLogged()) {
            helper::redirect('/login');
            die();
        }
        $this->render("site/header");
        $this->render("site/sidebar");
        $this->render("nodes/index");
        $this->render("site/footer");
    }
    public function getTagValues()
    {

        if (!$this->sessionManager->isLogged()) {
            helper::redirect('/login');
            die();
        }
        $tagValues = $this->model('nodeModel')->getTagValues($_GET['serialnolist']);
        echo json_encode($tagValues);
    }
    public function setBoolValues(){
        if($_POST){
            
            $this->model('nodeModel')->setBoolValues($_POST['serialNumber'],$_POST['tagName'],$_POST['tagValue']);
        }
    }
    public function saveNodeValue()
    {
        if ($_POST) {

            $node = $this->model('nodeModel')->getNodeById($_POST['serialNumber']);
            if (!$node) {
                echo json_encode(false);
                die();
            } else {
                $this->model('nodeModel')->updateNodeIpBySerialNumber($_POST['serialNumber'], $_POST['localip']);
                $this->model('nodeModel')->saveNodeValue($_POST['serialNumber'], $_POST['di1'], $_POST['di2'], $_POST['do1'], $_POST['sicaklik'], $_POST['nem']);
                echo json_encode(true);
            }
        }
    }
    public function tagsForWrite(){
        if ($_POST) {

            $node = $this->model('nodeModel')->getNodeById($_POST['serialNumber']);
            if (!$node) {
                echo json_encode(false);
                die();
            } else {
               $res = $this->model('nodeModel')->tagsForWrite($_POST['serialNumber'], $_POST['tagName']);
               $this->model('nodeModel')->deletAfterRead($_POST['serialNumber'], $_POST['tagName']);
               echo json_encode($res,JSON_NUMERIC_CHECK);
            }
        }
    }
}
