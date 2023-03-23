<!-- Extendemos del Layout Principal -->
<?= $this->extend('Admin/layout/main') ?>
<!-- Seccion Titulo -->
<?= $this->section('title') ?>
Dashboard
<?= $this->endSection() ?>
<!-- Seccion Titulo -->
<?= $this->section('header') ?>
Dashboard
<?= $this->endSection() ?>
<!-- Seccion Contenido -->
<?= $this->section('content') ?>

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-8">
            <div class="card card-success card-outline">
            <div class="card-header">
                <h5 class="m-0"><i class="nav-icon fab fa-teamspeak"></i> Articulos</h5>
              </div>
              <div class="card-body">
                <h5 class="card-title"></h5>
                <p class="card-text">
                  Listado de artículos para prueba de traducciones
                </p>
              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

<?= $this->endSection() ?>