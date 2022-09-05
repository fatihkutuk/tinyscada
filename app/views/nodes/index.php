<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Kayıtlı Cihazlar</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Anasayfa</a></li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Cihaz Listesi</h3>
              <div class="card-tools">
                <a type="button" href="/nodes/add" title="Yeni Teklif" class="btn btn-primary btn-sm daterange">
                  <i class="fas fa-plus"></i>
                </a>

              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                  <div class="col-sm-12 col-md-6"></div>
                  <div class="col-sm-12 col-md-6"></div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <table id="nodestable" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
                      <thead>
                        <tr>
                          <th class="sorting sorting_asc" tabindex="0" aria-controls="nodestable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Seri Numarası</th>
                          <th class="sorting" tabindex="0" aria-controls="nodestable" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">İsim</th>
                          <th class="sorting" tabindex="0" aria-controls="nodestable" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Local Ip</th>
                          <th class="sorting" tabindex="0" aria-controls="nodestable" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Dış Ip</th>
                          <th class="sorting" tabindex="0" aria-controls="nodestable" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">İşlemler</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($params["nodes"] as $key => $item) { ?>
                          <tr class="even">
                            <td><?= $item["nodeSerialNumber"] ?></td>
                            <td class="sorting_1 dtr-control"><?= $item["title"] ?></td>
                            <td><?= $item["localIp"] ?></td>
                            <td><?= $item["externalp"] ?></td>
                            <td>
                              <div class="btn-group">
                                <a href="/nodes/update/<?= $item["nodeSerialNumber"] ?>" title="Düzenle" class="btn btn-success"><i class="fas fa-edit"></i></a>
                                <a type="button" title="Sil" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                <a href="/nodes/settings/<?= $item["nodeSerialNumber"] ?>" data-id="1" title="Ayarlar" id="dwn" class="btn btn-default"><i class="fas fa-cog"></i></a>
                              </div>
                            </td>
                          </tr>

                        <?php } ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th class="sorting sorting_asc" tabindex="0" aria-controls="nodestable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Seri Numarası</th>
                          <th class="sorting" tabindex="0" aria-controls="nodestable" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">İsim</th>
                          <th class="sorting" tabindex="0" aria-controls="nodestable" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Local Ip</th>
                          <th class="sorting" tabindex="0" aria-controls="nodestable" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Dış Ip</th>
                          <th class="sorting" tabindex="0" aria-controls="nodestable" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">İşlemler</th>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>

              </div>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
      </div>
    </div>
  </section>

</div>