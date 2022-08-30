<h1 class="mt-4"> </h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a class="breadcrumb-item active" href="<?=SITE_URL;?>/user">Kullanıcılar</a></li>
    <li class="breadcrumb-item"><a class="" href="<?=SITE_URL;?>/user/create">Ekle</a></li>
</ol>
<div class="container">

    <div class="table">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead class="thead-dark">
            <tr>
                <th>Kullanıcı İsmi</th>
                <th>Kullanıcı Rol</th>
                <th>Pasif/Aktif</th>
                <th>Onay Durumu</th>
                <th>Düzenle</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($params['users'] as $key=> $users){?>
                <div class="modal animate" id="ymodal<?=$key;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"><?=$users['name'].' Bu Kart İçin Yetkili Olacak';?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body text-center p-lg">
                                <p><?=$users['name'];?> Kullanıcısını karta yetkilendirmek istedğinizden emin misiniz ?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
                                <a href='<?=SITE_URL;?>/insert/newUserCardRole/<?=$params['card']['id'];?>/<?=$users['id'];?>' type="button" class="btn btn-success">Yetkilendir</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal animate" id="smodal<?=$key;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"><?=$users['name'].' Kullanıcısnın Yetkisi Silenecek';?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body text-center p-lg">
                                <p><?=$users['name'];?> Kullanıcısının yetkisini silmek istediğinizden emin misiniz ?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
                                <a href='<?=SITE_URL;?>/delete/deleteUserCardRole/<?=$params['card']['id'];?>/<?=$users['id'];?>' type="button" class="btn btn-danger">Yetkiyi Sil</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $userRole = $this->model('userModel')->getUserRole($users['userRoleId']);?>
                <tr>
                    <td><?=$users['name'].' '.$users['surName'];?></td>
                    <td><?=$userRole['userRoleName'];?></td>
                    <td>
                        <?php if ($users['isActive']==1){ echo "<a href='".SITE_URL."/update/updateUserActiveStatu/".$users['id']."/0' class=\"btn btn-success\">Hesap Aktif</a>";}else{echo "<a href='".SITE_URL."/update/updateUserActiveStatu/".$users['id']."/1' type=\"button\" class=\"btn btn-danger\">Hesap Pasif</a>";}?>
                    </td>
                    <td><?php if ($users['isAuthenticated']==1){ echo "<a href='".SITE_URL."/update/updateUserConfirmStatu/".$users['id']."/0'  class=\"btn btn-success\">Onaylı</a>";}else{echo "<a href='".SITE_URL."/update/updateUserConfirmStatu/".$users['id']."/1' type=\"button\" class=\"btn btn-danger\">Onay Bekliyor</a>";}?></td>
                    <td><a href="<?=SITE_URL;?>/user/edit/<?=$users['id'];?>" ><i class="fas fa-edit"></i></a></td>
                </tr>

            <?php } ?>

            </tbody>
            <tfoot>
            <tr>
                <th>Kullanıcı İsmi</th>
                <th>Kullanıcı Rol</th>
                <th>Pasif/Aktif</th>
                <th>Onay Durumu</th>
                <th>Düzenle</th>

            </tr>
            </tfoot>
        </table>

    </div>
</div>
