<h1 class="mt-4"> </h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="<?=SITE_URL;?>/user">Kullanıcılar</a></li>
    <li class="breadcrumb-item"><a class="breadcrumb-item active" href="<?=SITE_URL;?>/user/profile">Hesabım</a></li>
</ol>
<div class="row">

    <div class="col-md-9">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Profil Ayarlarınız</h4>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <form action="<?=SITE_URL?>/update/updateUserProfile" method="post">

                            <div class="form-group row">
                                <label for="name" class="col-4 col-form-label">İsim</label>
                                <div class="col-8">
                                    <input id="name" name="name" value="<?=$params['user']['name'];?>" class="form-control here" type="text">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="lastname" class="col-4 col-form-label">Soyisim</label>
                                <div class="col-8">
                                    <input id="surName" name="surName" value="<?=$params['user']['surName'];?>" class="form-control here" type="text">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="newpass" class="col-4 col-form-label">Şifre</label>
                                <div class="col-8">
                                    <input id="newpass" name="userPassword"  value="" class="form-control here" type="password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="newpass" class="col-4 col-form-label">Şifre Tekrar</label>
                                <div class="col-8">
                                    <input id="newpass" name="reUserPassword"  value="" class="form-control here" type="password">
                                </div>
                            </div>
                            <small id="defaultRegisterFormPasswordHelpBlock" class="form-text text-muted mb-4">
                                Şifrenizde En az 1 adet Büyük Karakter Olmalı<br>
                                Şifreniz en az 6 karakter içerebilir
                            </small>
                            <div class="form-group row">
                                <div class="offset-4 col-8">
                                    <button name="submit" type="submit" class="btn btn-primary">Profilimi Güncelle</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>