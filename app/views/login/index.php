<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="../../index2.html" class="h1"><b>Envest</b> Offer</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Oturum Açmalısınız</p>

                <form action="<?=SITE_URL;?>/login/loginControl" method="POST">
                    <div class="input-group mb-3">
                        <input name="userMail" type="text" class="form-control" placeholder="Korubin Kullanıcı Adı">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input name="userPassword" type="password" class="form-control" placeholder="Şifre">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Beni Hatırla
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Oturum Aç</button>
                        </div>
                        <div class="alert alert-<?= @$_SESSION['statu']; ?>">
                            <?= @$_SESSION['message']; ?>
                        </div>
                        <?php unset($_SESSION['statu']); ?>
                        <?php unset($_SESSION['message']); ?>
                        <!-- /.col -->
                    </div>
                </form>

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- jQuery -->
    <script src="<?= PLUGIN_PATH ;?>/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= PLUGIN_PATH ;?>/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= DIST_PATH ;?>/js/adminlte.min.js"></script>
</body>

</html>