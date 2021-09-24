<?= $cabecera; ?>
<div class="container">
    <div class="card" style="">
      <div class="card-body">
        <h5 class="card-title">Modificar datos del libro</h5>
        <p class="card-text">
            <h1>Formulario de Editar</h1>
            <form method="post" action="<?= site_url('/actualizar'); ?>" enctype="multipart/form-data">
                <input type="hidden" name="id" id="id" value="<?= $libro['id']; ?>">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input id="nombre" value="<?= $libro['nombre']; ?>" class="form-control" type="text" name="nombre">
                </div>
                <div class="form-group">
                    <label for="imagen">Imagen:</label>
                    <br>
                    <img src="<?= base_url() ?>/img/<?= $libro['imagen']; ?>" class="img-thumbnail" width="100" alt="">
                    <input id="imagen" class="form-control-file" type="file" name="imagen">
                </div>
                <button class="btn btn-success" type="submit">Actualizar</button>
                <a href="<?= base_url('listar') ?>" class="btn btn-info">Cancelar</a>
            </form>
      </div>
    </div>
</div>
<?= $pie; ?>