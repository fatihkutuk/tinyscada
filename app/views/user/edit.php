
<h1 class="mt-4"> </h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="<?=SITE_URL;?>/user">Kullanıcılar</a></li>
    <li class="breadcrumb-item"><a class="breadcrumb-item active" href="<?=SITE_URL;?>/user/edit/<?=$params['user']['id'];?>"><?=$params['user']['name'];?></a></li>
</ol>
<div class="row">
    <div class="col-md-4">

    </div>
    <div class="card mb-4">
        <div class="card-header"><h3 class="text-center font-weight-light my-4">Düzenle</h3></div>
        <div class="card-body">
            <form action="<?=SITE_URL;?>/update/updateUserAccount/<?=$params['user']['id'];?>" method="post">
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group"><label class="small mb-1" for="inputFirstName">İsim</label><input name="name" value="<?=$params['user']['name'];?>" class="form-control py-4" id="inputFirstName" type="text" placeholder="İsim Giriniz" /></div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group"><label class="small mb-1" for="inputLastName">Soyisim</label><input name="surName" value="<?=$params['user']['surName'];?>" class="form-control py-4" id="inputLastName" type="text" placeholder="Soyisim Giriniz" /></div>
                    </div>
                </div>
                <div class="form-row">

                    <div class="col-md-6">
                        <div class="form-group"><label class="small mb-1" for="inputLastName">Kullanıcı Adı</label><input name="userName" value="<?=$params['user']['userName'];?>" class="form-control py-4" id="inputLastName" type="text" placeholder="Kulanıcı Adı Giriniz" /></div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group"><label class="small mb-1" for="inputConfirmPassword">Kullanıcı Tipi</label>
                            <select name="userRole" class="form-control lg" type="text">

                                <?php foreach($params['userRoles'] as $key => $value){ ?><option  <?php if ($params['user']['userRoleId']==$value['id']) { echo "selected";}?> value="<?=$value['id'];?>" ><?=$value['userRoleName'];?> </option><?php } ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group mt-4 mb-0"><button type="submit" class="btn btn-primary btn-block" >Düzenle</button></div>
            </form>
        </div>
    </div>
</div>



