
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Page Title - SB Admin</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
</head>
<body class="bg-success">
<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header"><h3 class="text-center font-weight-light my-4">Şifre Yenileme </h3></div>
                            <div class="card-body">
                                <form method="post" action="<?=SITE_URL;?>/login/updatePassword/<?=$params['code'];?>">
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="form-group"><label class="small mb-1" for="inputPassword">Şifre</label><input name="password" class="form-control py-4" id="inputPassword" type="password" placeholder="Şifreyi Giriniz" /></div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group"><label class="small mb-1" for="inputConfirmPassword">Şifre Tekrar</label><input name="rePassword" class="form-control py-4" id="inputConfirmPassword" type="password" placeholder="Şifreyi Tekrar Giriniz" /></div>
                                        </div>
                                        <small id="defaultRegisterFormPasswordHelpBlock" class="form-text text-muted mb-4">
                                            Şifrenizde En az 1 adet Büyük Karakter Olmalı<br>
                                            Şifreniz en az 6 karakter içerebilir
                                        </small>
                                    </div>

                                    <div class="form-group mt-4 mb-0"><button class="btn btn-primary btn-block" type="submit">Resetle</button></div>
                                </form>
                        </div>
>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <div id="layoutAuthentication_footer">
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Envest 2019</div>
                </div>
            </div>
        </footer>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
</body>
</html>
