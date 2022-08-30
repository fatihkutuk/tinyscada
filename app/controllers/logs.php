<?php
class logs extends controller
{

    public function index()
    {
        if (!$this->sessionManager->isLogged()){helper::redirect('/login');die();}
        $this->render("site/header");
        $this->render("site/sidebar");
        $this->render("logs/index");
        $this->render("site/footer");
    }

}