<?php
class user extends controller
{

    public function index()
    {
        if (!$this->sessionManager->isLogged()){helper::redirect('/login');die();}
        if ($this->userInfo['userRoleId']!=1){helper::flashToastr("alert alert-danger","error","Bu Alanda İşlem Yapamazsınız","7000"); helper::redirect('/'); die();}

        $users = $this->model('userModel')->listAllUsers();
        $this->render('site/header');
        $this->render('site/sidebar');
        $this->render('user/index',['users'=>$users]);
        $this->render('site/footer');
    }
    public function create()
    {
        if (!$this->sessionManager->isLogged()){helper::redirect('/login');die();}

        $userRoles = $this->model("userModel")->listAllUserRoles();
        $this->render('site/header');
        $this->render('site/sidebar');
        $this->render('user/create',['userRoles'=>$userRoles]);
        $this->render('site/footer');
    }
    public function edit($userId)
    {
        if (!$this->sessionManager->isLogged()){helper::redirect('/login');die();}
        if ($this->userInfo['userRoleId']!=1){helper::flashToastr("alert alert-danger", "Hata","Yetkisiz İşlem","7000");helper::redirect('/user');die();}
        $user = $this->model('userModel')->singleUserData($userId);
        $userRoles = $this->model("userModel")->listAllUserRoles();
        $this->render('site/header');
        $this->render('site/sidebar');
        $this->render('user/edit',['user'=>$user,'userRoles'=>$userRoles]);
        $this->render('site/footer');
    }
    public function register()
    {
        if ($_POST) {
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            $tel = $_POST['tel'];
            $rePassword = $_POST['rePassword'];
            if( $password==$rePassword ){
                if(!$this->model('userModel')->isExist($tel,$email)){
                    $hash = hash('sha256',$password);
                    $save = $this->model('userModel')->create($name,$surname,md5($password),$email,$tel,$hash);
                    //exit(var_dump($save));
                    if($save){
                        $send = helper::sendAuthMail($hash,$email,$name,$surname,$password,'Hesap Onayı','Hesabınızı Onaylayın');
                        if($send){
                            helper::flashData("statu","success");
                            helper::flashData("message","Tebrikler! Hesabınız oluşturuldu. Giriş Yapmak için mailinize gelen link üzerinden mailinizi onaylamanız gerekmetedir.
                            Not:MAil Ulaşmadıysa Lütfen Spamları da kontrol ediniz.");
                            helper::redirect("/",["email" => $_POST["email"]]);
                        }else{
                            helper::flashData("statu","danger");
                            helper::flashData("message",$send);
                            helper::redirect("/");
                        }

                    }
                }else{
                    helper::flashData("statu","danger");
                    helper::flashData("message","Bu bilgilere ait kullanıcı var.");
                    helper::redirect("/main/register");
                }
            }else{
                helper::flashData("statu","danger");
                helper::flashData("message","Şifreler Uyuşmuyor.");
                helper::redirect("/main/register");
            }

        }
    }
    public function profile()
    {
        if (!$this->sessionManager->isLogged()){helper::redirect('/login');die();}

        $user = $this->model('userModel')->singleUserData($this->userInfo['id']);
        $this->render('site/header');
        $this->render('site/sidebar');
        $this->render('user/profile',['user'=>$user]);
        $this->render('site/footer');
    }
    public function confirmAcount($authenticationCode)
    {
        $query = $this->model('userModel')->getUserByAuthCode($authenticationCode);
        if ($query['isAuthenticated']==0)
        {
            $query = $this->model('userModel')->confirmAcount($authenticationCode);
            if ($query)
            {
                helper::flashData("statu","success");
                helper::flashData("message","Hesabınız Onayandı, giriş Yapabilirsiniz");
                helper::redirect("/login/index");
            }
            else
            {
                helper::flashData("statu","danger");
                helper::flashData("message","Bilinmeyen Hata");
                helper::redirect("/login/index");
            }
        }
        else
        {
            helper::flashData("statu","danger");
            helper::flashData("message","Daha Önce Onaylanmış");
            helper::redirect("/login/index");
        }

    }

}