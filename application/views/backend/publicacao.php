<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?= 'Administrar ' . $subtitulo; ?></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?= 'Adicionar Nova ' . $subtitulo; ?>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">

                            <?php
                            echo validation_errors('<div class="alert alert-danger">', '</div>');
                            echo form_open('admin/publicacao/inserir');
                            ?>

                            <div class="form-group">
                                <label>Categoria</label>
                                <select name="selectCat" class="form-control">

                                    <?php foreach ($categorias as $categoria) {
                                        ?>
                                        <option value="<?= $categoria->id; ?>"><?= $categoria->titulo; ?></option>
                                        <?php
                                    }
                                    ?>

                                </select>

                            </div>

                            <div class="form-group">
                                <label>
                                    Título</label>
                                <input type="text" name="txtTitulo" class="form-control" placeholder="Título" value="<?= set_value('txtTitulo'); ?>"/>
                            </div>

                            <div class="form-group">
                                <label>
                                    Sub Título</label>
                                <input type="text" name="txtSubTitulo" class="form-control" placeholder="Sub Título" value="<?= set_value('txtSubTitulo'); ?>"/>
                            </div>

                            <div class="form-group">
                                <label>
                                    Conteúdo</label>
                                <textarea name="txtConteudo" class="form-control" placeholder="Conteúdo"><?= set_value('txtConteudo'); ?></textarea>
                            </div>

                            <div class="form-group">
                                <label>
                                    Data</label>
                                <input type="datetime-local" name="txtData" class="form-control" placeholder="Data" value="<?= set_value('txtData'); ?>"/>
                            </div>

                            <input type="hidden" name="txtUsuario" value="<?= $this->session->userdata('userLogado')->id; ?>"/>

                            <button type="submit" class="btn btn-default">Cadastrar</button>


                            <?php
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

        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?= 'Alterar/Excluir ' . $subtitulo . ' Existente'; ?>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <style>
                                img{
                                    width: 200px;
                                }
                            </style>
                            <?php
                            $this->table->set_heading("Foto", "Título", "Data", "Alterar", "Excluir");
                            foreach ($publicacoes as $publicacao) {

                                $titulo = $publicacao->titulo;
                                if ($publicacao->img == 1) {
                                    $fotoPub = img('assets/frontend/img/publicacoes/' . md5($publicacao->id) . '.jpg');
                                } else {
                                    $fotoPub = img('assets/frontend/img/sem-imagem.jpg');
                                }

                                $data = postadoem($publicacao->data);
                                $alterar = anchor(base_url('admin/publicacao/alterar/' . md5($publicacao->id)), '<i class="fa fa-edit fa-fw"></i> Alterar');
                                $excluir = anchor(base_url('admin/publicacao/excluir/' . md5($publicacao->id)), '<i class="fa fa-remove fa-fw"></i> Excluir');

                                $this->table->add_row($fotoPub, $titulo, $data, $alterar, $excluir);
                            }

                            $this->table->set_template(array(
                                'table_open' => '<table class="table table-striped">'
                            ));
                            echo $this->table->generate();
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
