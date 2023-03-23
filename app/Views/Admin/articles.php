<!-- Extendemos del Layout Principal -->
<?= $this->extend('Admin/layout/main') ?>
<!-- Seccion Titulo -->
<?= $this->section('title') ?>
Dashboard
<?= $this->endSection() ?>
<!-- Seccion Titulo -->
<?= $this->section('header') ?>
Artículos
<?= $this->endSection() ?>
<!-- Seccion Contenido -->
<?= $this->section('content') ?>

<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <div class="card-body table-responsive p-0" style="height: 300px;">
      <table class="table table-head-fixed text-nowrap">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Lenguaje Principal</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($articles as $article): ?>
            <tr>
              <td><?= $article->id ?></td>
              <td><?= $article->name ?></td>
              <td><?= $article->description ?></td>
              <td><?= $article->locale ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div><!-- /.container-fluid -->
</div>
<!-- /.content -->

<?= $this->endSection() ?>