<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <?php foreach ($params['nodes'] as $key => $item) { ?>
          <div class="col-md-4">
            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title"><?=$item['title']?></h3>
                <div class="card-tools">
                  <a href="#" class="btn btn-sm btn-tool">
                    <i class="fas fa-cog" title="Ayarlar"></i>
                  </a>
                  <a href="#" class="btn btn-sm btn-tool">
                    <i class="fas fa-eye" title="Detay"></i>
                  </a>
                  <a href="#" class="btn btn-sm btn-tool">
                    <i class="fas fa-chart-pie" title="Log Grafikleri"></i>
                  </a>
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                  <p class="text-gray text-xl">
                    <i class="fas fa-thermometer-three-quarters nav-icon"></i>
                  </p>
                  <p class="d-flex flex-column text-right">
                    <span class="font-weight-bold tag" id="sicaklik-<?=$item['nodeSerialNumber']?>">
                      23
                    </span>
                    <span class="text-muted">Sıcaklık</span>
                  </p>
                </div>

                <div class="d-flex justify-content-between align-items-center border-bottom mb-3">

                  <p class="text-gray text-xl">
                    <i class="fas fa-tint"></i>
                  </p>
                  <p class="d-flex flex-column text-right">
                    <span class="font-weight-bold tag" id="nem-<?=$item['nodeSerialNumber']?>">
                      0.8%
                    </span>
                    <span class="text-muted">Nem</span>
                  </p>
                </div>

                <div class="d-flex justify-content-between align-items-center border-bottom mb-3">

                  <p class="text-gray text-xl">
                    <i class="fas fa-bolt"></i>
                  </p>
                  <p class="d-flex flex-column text-right">
                    <span class="font-weight-bold">
                      <a class="btn btn-app writetag" id="do1-<?=$item['nodeSerialNumber']?>">
                        <i class="fas fa-pause"></i> Aç
                      </a>
                    </span>
                    <span class="text-muted">Dijital Çıkış 1</span>
                  </p>
                </div>

                <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                  <p class="text-gray text-xl">
                    <i class="fas fa-wave-square"></i>
                  </p>
                  <p class="d-flex flex-column text-right">
                    <span class="font-weight-bold tag" id="di-<?=$item['nodeSerialNumber']?>">
                      <i class="fas fa-toggle-off"></i>
                    </span>
                    <span class="text-muted">Dijital Giriş 1</span>
                  </p>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-0">
                  <p class="text-gray text-xl">
                    <i class="fas fa-wave-square"></i>
                  </p>
                  <p class="d-flex flex-column text-right">
                    <span class="font-weight-bold text-success tag" id="di1-<?=$item['nodeSerialNumber']?>">
                      <i class="fas fa-toggle-on"></i>

                    </span>
                    <span class="text-muted">Dijital Giriş 2</span>
                  </p>
                </div>


              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
</div>
</section>
</div>