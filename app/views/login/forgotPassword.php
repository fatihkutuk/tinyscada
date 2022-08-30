<body class="bg-primary">
<div id="layoutAuthentication">

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header"><h3 class="text-center font-weight-light my-4">Şifre Yenileme </h3></div>
                            <div class="card-body">
                                <div class="small mb-3 text-muted">Girdiğiniz Sistemde Kayıtlı OlanMail Adresinize Şifrenizi Sıfırlamak İçin Mail Göndereceğiz.</div>
                                <form method="POST" action="<?=SITE_URL;?>/login/sendForgotPasswordMail">
                                    <div class="form-group"><label class="small mb-1" for="inputEmailAddress">Email Adresi</label><input class="form-control py-4" name="userMail" id="inputEmailAddress" type="email" aria-describedby="emailHelp" placeholder="Mail Adresinizi Girin" /></div>
                                    <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0"><a class="small" href="../../../index.php">Giriş Sayfasına Dön</a><button class="btn btn-primary" type="submit">Gönder</button></div>
                                </form>
                            </div>
                            <div class="card-footer text-center">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>

