<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Panel</h1>
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
                        Tanımsız
                    </span>
                    <span class="text-muted" id="title-sicaklik-<?=$item['nodeSerialNumber']?>">
                      
                  </span>
                  </p>
                </div>

                <div class="d-flex justify-content-between align-items-center border-bottom mb-3">

                  <p class="text-gray text-xl">
                    <i class="fas fa-tint"></i>
                  </p>
                  <p class="d-flex flex-column text-right">
                    <span class="font-weight-bold tag" id="nem-<?=$item['nodeSerialNumber']?>">
                    Tanımsız
                    </span>
                    <span class="text-muted" id="title-nem-<?=$item['nodeSerialNumber']?>"></span>
                  </p>
                </div>

                <div class="d-flex justify-content-between align-items-center border-bottom mb-3">

                  <p class="text-gray text-xl">
                    <i class="fas fa-bolt"></i>
                  </p>
                  <p class="d-flex flex-column text-right">
                    <span class="font-weight-bold">
                      <a class="btn btn-app writetag" data-val=""  onclick="setBool(<?=$item['nodeSerialNumber']?>,'do1',this)" id="color-do1-<?=$item['nodeSerialNumber']?>">
                        <i class="fas fa-ban" id="icon-do1-<?=$item['nodeSerialNumber']?>"></i> 
                      </a>
                    </span>
                    <span class="text-muted" id="title-do1-<?=$item['nodeSerialNumber']?>"></span>
                  </p>
                </div>

                <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                  <p class="text-gray text-xl">
                    <i class="fas fa-wave-square"></i>
                  </p>
                  <p class="d-flex flex-column text-right">
                    <span class="font-weight-bold tag" id="color-di1-<?=$item['nodeSerialNumber']?>">
                      <i class="fas fa-ban" id="icon-di1-<?=$item['nodeSerialNumber']?>"></i>
                    </span>
                    <span class="text-muted" id="title-di1-<?=$item['nodeSerialNumber']?>"></span>
                  </p>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-0">
                  <p class="text-gray text-xl">
                    <i class="fas fa-wave-square"></i>
                  </p>
                  <p class="d-flex flex-column text-right">
                  <span class="font-weight-bold tag" id="color-di2-<?=$item['nodeSerialNumber']?>">
                      <i class="fas fa-ban" id="icon-di2-<?=$item['nodeSerialNumber']?>"></i>

                    </span>
                    <span class="text-muted" id="title-di2-<?=$item['nodeSerialNumber']?>"></span>
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