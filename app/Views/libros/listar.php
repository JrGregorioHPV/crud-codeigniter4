<?= $cabecera; ?>

<div class="container">
    <a href="<?= base_url('crear'); ?>" class="btn btn-primary">Crear un Libro</a>
    <br><br>
    <table class="table table-light">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($libros as $libro): ?>
            <tr>
                <td><?= $libro['id']; ?></td>
                <td>
                    <img src="<?= base_url() ?>/img/<?= $libro['imagen']; ?>" class="img-thumbnail" width="100" alt="">
                </td>
                <td><?= $libro['nombre']; ?></td>
                <td>
                    <a href="<?= base_url('editar/'.$libro['id']) ?>" class="btn btn-warning" type="button">Editar</a>
                    <a href="<?= base_url('borrar/'.$libro['id']) ?>" class="btn btn-danger" type="button">Borrar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $pie; ?>
