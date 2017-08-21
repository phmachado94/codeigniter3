<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?= 'Administrar ' . $subtitulo; ?></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?= 'Alterar ' . $subtitulo; ?>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php
                            echo validation_errors('<div class="alert alert-danger">', '</div>');
                            foreach ($categorias as $categoria) {
                                echo form_open('admin/categoria/salvar_alteracoes/' . md5($categoria->id));
                                ?>

                                <div class="form-group">
                                    <label>
                                        Nome da Categoria</label>
                                    <input type="text" name="txtCategoria" class="form-control" placeholder="Nome da Categoria" value="<?= $categoria->titulo; ?>"/>

                                </div>

                                <input type="hidden" name="txtId" value="<?= $categoria->id; ?>">

                                <button type="submit" class="btn btn-default">Atualizar</button>

                                <?php
                            }
                            echo form_close();
                            ?>
                        </div>

                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-6 -->

    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

