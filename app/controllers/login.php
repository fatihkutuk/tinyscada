<?php
class login extends controller
{

    public function index()
    {
        $this->render("site/header");
        $this->render("login/index");
    }
    public function loginControl()
    {

        if ($_POST['userMail'] and $_POST['userPassword']) {

            $userMail = helper::cleaner($_POST['userMail']);
            $userPassword = helper::cleaner($_POST['userPassword']);

            $query = $this->model('loginModel')->control($userMail, md5($userPassword));
            if ($query) {



                sessionManager::createSession(["name" => $query["name"], "id" => $query["id"], "surname" => $query["surname"]]);
                //exit(var_dump($_SESSION));
                helper::redirect("/home");
                helper::flashData("statu", "Giriş Başarılı");
            } else {
                helper::flashData("statu", "danger");
                helper::flashData("message", "Kullanıcı adınız veya şifreniz hatalı ...");
                helper::redirect("/login");
            }
        } else {
            helper::flashData("statu", "danger");
            helper::flashData("message", "Lütfen email adresiniz ve şifrenizi giriniz ...");
            helper::redirect("/login");
        }
    }
    public function forgotPassword()
    {
        $this->render("site/header");
        $this->render("login/forgotPassword");
        $this->render("site/footer");
    }

    public function sendForgotPasswordMail()
    {
        if ($_POST['userMail']) {
            $userMail = $_POST['userMail'];
            if ($this->model('loginModel')->isExist($userMail)) {

                $authenticationCode = hash('sha256', $userMail . '' . uniqid());
                $update = $this->model('loginModel')->updateAuthCode($userMail, $authenticationCode);
                if ($update) {
                    if (helper::sendResetPasswordMail($authenticationCode, $userMail, "Şifre Yenileme Linkiniz")) {
                        helper::flashData("statu", "success");
                        helper::flashData("message", $userMail . " Adresine Mail Gönderdik");
                        helper::redirect("/login");
                    } else {
                        helper::flashData("statu", "danger");
                        helper::flashData("message", $userMail . " Bir Sorun Oluştuştu");
                        helper::redirect("/login");
                    }
                } else {
                    helper::flashData("statu", "danger");
                    helper::flashData("message", $userMail . " İşlem Başarısız");
                    helper::redirect("/login");
                }
            } else {
                helper::flashData("statu", "danger");
                helper::flashData("message", $userMail . "Bu Mail ile Kayıtlı Bir Kullanıcı Bulunamadı veya Hesap Aktif Değil");
                helper::redirect("/login");
            }
        } else {
            helper::flashData("statu", "danger");
            helper::flashData("message", "Hatalı İşlem");
            helper::redirect("/login");
        }
    }
    public function rePassword($authenticationCode)
    {
        $query = $this->model('loginModel')->isExistAuthenticationCode($authenticationCode);

        if ($query) {
            $this->render("site/header");
            $this->render("login/rePassword", ['code' => $authenticationCode]);
        } else {
            helper::flashData("statu", "danger");
            helper::flashData("message", "Bu link daha önce Kullanılmış. Şifrenizi Unuttuysanız Şifremi Unuttum Bölümünden Yeni Link Alabilirsiniz");
            helper::redirect('/login');
        }
    }
    public function updatePassword($authenticationCode)
    {
        if ($_POST) {
            $password = $_POST['password'];
            $rePassword = $_POST['rePassword'];
            if ($password and $rePassword) {
                $pattern = "/\S*((?=\S{6,})(?=\S*[A-Z]))\S*/";
                if (strlen($password) > 5) {
                    if (preg_match($pattern, $password)) {
                        $newAuthenticationCode = hash('sha256', $password . '' . uniqid());
                        $update = $this->model('loginModel')->updatePassword(md5($password), $authenticationCode, $newAuthenticationCode);
                        if ($update) {
                            helper::flashData("statu", "success");
                            helper::flashData("message", "Şifreniz Değiştirildi, Giriş Yapabilirsiniz.");
                            helper::redirect('/login');
                        } else {
                            helper::flashData("statu", "danger");
                            helper::flashData("message", "Bilinmeyen Hata.");
                            helper::redirect('/login/rePassword/' . $authenticationCode);
                        }
                    } else {
                        helper::flashData("statu", "danger");
                        helper::flashData("message", "Şifrenizde en az 1 Büyük Karakter Olması Gerekmektedir.");
                        helper::redirect('/login/rePassword/' . $authenticationCode);
                    }
                } else {
                    helper::flashData("statu", "danger");
                    helper::flashData("message", "Şifre En az 6 karakterli olmalıdır.");
                    helper::redirect('/login/rePassword/' . $authenticationCode);
                }
            } else {
                helper::flashData("statu", "danger");
                helper::flashData("message", "Şifreler Uyuşmuyor.");

                helper::redirect('/login/rePassword/' . $authenticationCode);
            }
        }
    }

    public function logout()
    {
        session_destroy();
        helper::redirect("/");
    }
}
