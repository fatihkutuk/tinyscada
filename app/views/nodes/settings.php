<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?=$params['node']['title'];?> (<?=$params['node']['nodeSerialNumber'];?>) Ayarları</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Anasayfa</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <?php foreach ( $params['settings'] as $key=> $item) {?>
                <div class="col-md-12">
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title"><?=$item['tagTitle']?></h3>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="/nodes/setTags" enctype="multipart/form-data">

                                <div class="row">

                                    <div class="col-sm-4">

                                        <div class="form-group">
                                            <label>Başlık</label>
                                            <input name="title" type="text" value="<?=$item['tagTitle']?>" class="form-control" placeholder="Zorunlu" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">

                                        <div class="form-group">
                                            <label>Birim</label>
                                            <input name="birim" type="text" value="<?=$item['tagUnit']?>" class="form-control" placeholder="Zorunlu" >
                                        </div>
                                    </div>
                                    <input name="tagName" type="hidden" value="<?=$item['tagName']?>" class="form-control" placeholder="Zorunlu" required>
                                    <input name="serialNumber" type="hidden" value="<?=$item['serialNumber']?>" class="form-control" placeholder="Zorunlu" required>

                                </div>
                                <div class="row">
                                    <div class="col-sm-1">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-block btn-primary">Kaydet</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>
                <?php } ?>
            </div>

    </section>

</div>