<?php
class nodes extends controller
{

    public function index()
    {
        if (!$this->sessionManager->isLogged()) {
            helper::redirect('/login');
            die();
        }
        $nodes =  $this->model('nodeModel')->getNodes();
        $this->render("site/header");
        $this->render("site/sidebar");
        $this->render("nodes/index", ["nodes" => $nodes]);
        $this->render("site/footer");
    }
    public function add()
    {
        if (!$this->sessionManager->isLogged()) {
            helper::redirect('/login');
            die();
        }
        $this->render("site/header");
        $this->render("site/sidebar");
        $this->render("nodes/add");
        $this->render("site/footer");
    }
    public function update($serialNumber)
    {
        if (!$this->sessionManager->isLogged()) {
            helper::redirect('/login');
            die();
        }
        $node = $this->model('nodeModel')->getNodeById($serialNumber);
        $this->render("site/header");
        $this->render("site/sidebar");
        $this->render("nodes/update", ['node' => $node]);
        $this->render("site/footer");
    }
    public function settings($serialNumber)
    {
        if (!$this->sessionManager->isLogged()) {
            helper::redirect('/login');
            die();
        }
        $node = $this->model('nodeModel')->getNodeById($serialNumber);
        $settings = $this->model('nodeModel')->getSettningsBySerialNumber($serialNumber);
        $this->render("site/header");
        $this->render("site/sidebar");
        $this->render("nodes/settings", ['node' => $node, 'settings' => $settings]);
        $this->render("site/footer");
    }
    public function setTags()
    {
        if ($_POST) {
            $title = $_POST['title'];
            $birim = $_POST['birim'];
            $tagName = $_POST['tagName'];
            $serialNumber = $_POST['serialNumber'];
            $res = $this->model('nodeModel')->setTags($title, $birim, $tagName, $serialNumber);
            if ($res) {
                helper::flashToastr("alert alert-success", "Başarılı", "Bilgiler Güncellendi, Panel üzerinden kontrol edebilirsiniz ", 10000);
                helper::redirect("/nodes/settings/$serialNumber");
            } else {
                helper::flashToastr("alert alert-danger", "Hata", "Bilgiler Güncellenemedi, sistem yöneticisine danışın ", 10000);
                helper::redirect("/nodes/settings/$serialNumber");
            }
        }
    }
    public function postAdd()
    {
        if ($_POST) {
            $res = $this->model('nodeModel')->insertNode($_POST['serialNumber'], $_POST['title']);
            if ($res) {
                helper::flashToastr("alert alert-success", "Başarılı", "Yeni Cihaz Eklenmiştir, Panel üzerinden kontrol edebilirsiniz ", 10000);
                helper::redirect("/nodes");
            } else {
                helper::flashToastr("alert alert-danger", "Hata", "Cihaz eklenemedi, sistem yöneticisine danışın ", 10000);
                helper::redirect("/nodes");
            }
        }
    }
    public function postUpdate()
    {
        if ($_POST) {
            $res = $this->model('nodeModel')->updateNode($_POST['serialNumber'], $_POST['title']);
            if ($res) {
                helper::flashToastr("alert alert-success", "Başarılı", " Cihaz Güncellenmiştir, Panel üzerinden kontrol edebilirsiniz ", 10000);
                helper::redirect("/nodes");
            } else {
                helper::flashToastr("alert alert-danger", "Hata", "Cihaz Güncellenemdi, sistem yöneticisine danışın ", 10000);
                helper::redirect("/nodes");
            }
        }
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
    public function setBoolValues()
    {
        if ($_POST) {

            $this->model('nodeModel')->setBoolValues($_POST['serialNumber'], $_POST['tagName'], $_POST['tagValue']);
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
    public function tagsForWrite()
    {
        if ($_POST) {

            $node = $this->model('nodeModel')->getNodeById($_POST['serialNumber']);
            if (!$node) {
                echo json_encode(false);
                die();
            } else {
                $res = $this->model('nodeModel')->tagsForWrite($_POST['serialNumber'], $_POST['tagName']);
                $this->model('nodeModel')->deletAfterRead($_POST['serialNumber'], $_POST['tagName']);
                echo json_encode($res, JSON_NUMERIC_CHECK);
            }
        }
    }
}
