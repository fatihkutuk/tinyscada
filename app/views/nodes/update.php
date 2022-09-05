<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Yeni Cihaz Ekleme</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Anasayfa</a></li>
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
                <div class="col-md-12">
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Cihaz Formu<?= helper::flashToastrView("message"); ?></h3>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="/nodes/postUpdate" enctype="multipart/form-data">

                                <div class="row">
                                    <div class="col-sm-4">

                                        <div class="form-group">
                                            <label>Başlık</label>
                                            <input name="title" type="text" value="<?=$params['node']['title']?>" class="form-control" placeholder="Zorunlu" required>
                                        </div>
                                    </div>


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
            </div>

    </section>

</div>