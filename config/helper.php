<?php

class helper extends model
{
    static function redirect($url)
    {
        if ($url) {
            if (!headers_sent()) {
                header("Location:" . $url);
            } else {
                echo '<script>location.href="' . $url . '";</script>';
            }
        }
    }
    static function generateRandomPassword($lenght, $tip = 5)
    {
        $sifre = "";
        for ($i = 0; $i < $lenght; $i++) {
            //Sadece sayı üretme
            if ($tip == 1)
                $sifre .= chr(rand(48, 57)); //0-9

            //Büyük harf üretme
            elseif ($tip == 2)
                $sifre .= chr(rand(65, 90)); //A-Z

            //Küçük harf üretme
            elseif ($tip == 3)
                $sifre .= chr(rand(97, 122)); //a-z

            //sembol üretme
            elseif ($tip == 4)
                $sifre .= chr(rand(33, 38));

            //karışık şifre üretme
            elseif ($tip == 5) {
                $sec = rand(1, 4);
                if ($sec == 1)     $sifre .= chr(rand(33, 38)); //sembol üretme
                elseif ($sec == 2) $sifre .= chr(rand(65, 90)); //A-Z
                elseif ($sec == 3) $sifre .= chr(rand(97, 122)); //a-z
                elseif ($sec == 4) $sifre .= chr(rand(48, 57)); //0-9
            }
        }
        return $sifre;
    }

    static function cleaner($text)
    {
        $array = array('insert', 'update', 'union', 'select', '*');
        $text = str_replace($array, '', $text);
        $text = strip_tags($text);
        $text = trim($text);
        return $text;
    }

    static function flashData($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    static function flashDataView($key)
    {
        if (isset($_SESSION[$key])) {
            $sonuc = $_SESSION[$key];
            unset($_SESSION[$key]);
            echo $sonuc;
        }
    }
    static function formGenerate($data)
    {
        $html = null;

        foreach (json_decode($data['cardTypeContent'], true) as $key => $value) {
            $html .= '<div class="form-group">';
            $html .= '<div class="items row">';
            $html .= '<div class="col-md-12">';
            $html .= "<label> " . $value['adi'] . " </label>";
            $html .= '<input type="hidden" name="cardTypeContent[' . ($key + 1) . '][adi]" value="' . $value['adi'] . '" class="form-control">';
            $html .= '<input type="text" name="cardTypeContent[' . ($key + 1) . '][degeri]" class="form-control"/>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
        }
        return $html;
    }
    static function flashToastr($tip, $title, $mesaj, $sure)
    {

        $html = "<script>";
        $html .= "$(document).Toasts('create', {";
        $html .= "title: '$title',";
        $html .= "body: '$mesaj',";
        $html .= "autohide: true,";
        $html .= "delay: $sure,";
        $html .= "class:'$tip'";
        $html .= "})";
        $html .= "</script>";

        $_SESSION['toastr'] = $html;
    }
    static function flashToastrView($key)
    {
        if (isset($_SESSION[$key])) {
            $sonuc = $_SESSION[$key];
            echo $sonuc;
            unset($_SESSION[$key]);
        }
    }
    static function sendAuthMail($authenticationCode, $userMail, $name, $surName, $userPassword, $subject, $message)
    {

        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = 'smtp.yandex.com.tr';
        $mail->Port = 465;
        $mail->SMTPSecure = 'ssl';
        $mail->Username = 'fatih.kutuk@envest.com.tr';
        $mail->Password = 'Fth.ktk.179';
        $mail->SetFrom("fatih.kutuk@envest.com.tr", 'Tiny Scada');
        $mail->AddAddress($userMail, $name . ' ' . $surName);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = $subject;
        $content = $message . '<a href="' . SITE_URL . '/user/confirmAcount/' . $authenticationCode . '"> 
        Hesabınızı Bu Linkten Onaylayınız : </a><br> Link Üzerinden bağlantı kuramazsanız bu linki kopyalayıp tarayıcınızda 
        açın ' . SITE_URL . '/user/confirmAcount/' . $authenticationCode . ' <br><hr>
        Kullanıcı Adınız: ' . $userMail . ' <br> Şifreniz:' . $userPassword . '<hr>';
        $mail->MsgHTML($content);

        if (!$mail->Send()) {
            return "Mail gönderilemedi. Hata kodu: " . $mail->ErrorInfo;
        } else {
            return "Mail gönderildi";
        }
    }
    static function sendResetPasswordMail($authenticationCode, $userMail, $message)
    {

        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = 'smtp.yandex.com.tr';
        $mail->Port = 465;
        $mail->SMTPSecure = 'ssl';
        $mail->Username = 'fatih.kutuk@envest.com.tr';
        $mail->Password = 'Fth.ktk.179';
        $mail->SetFrom("fatih.kutuk@envest.com.tr", 'Envest Crypt');
        $mail->AddAddress($userMail, $userMail);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = $message;
        $content = '<a href="' . SITE_URL . '/login/rePassword/' . $authenticationCode . '"> Şifrenizi Bu Linkten Yenileyiniz</a><br> Kullanıcı Adınız: ' . $userMail;
        $mail->MsgHTML($content);

        if (!$mail->Send()) {
            return "Mail gönderilemedi. Hata kodu: " . $mail->ErrorInfo;
        } else {
            return "Mail gönderildi";
        }
    }
}
