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
                            echo form_open('admin/publicacao/salvar_alteracoes');
                            foreach ($publicacoes as $publicacao) {
                                ?>

                                <div class="form-group">
                                    <label>Categoria</label>
                                    <select name="selectCat" class="form-control">

                                        <?php foreach ($categorias as $categoria) {
                                            ?>
                                        <option value="<?= $categoria->id; ?>" <?php if ($categoria->id == $publicacao->categoria) echo "selected"; ?>><?= $categoria->titulo; ?></option>
                                            <?php
                                        }
                                        ?>

                                    </select>

                                </div>

                                <div class="form-group">
                                    <label>
                                        Título</label>
                                    <input type="text" name="txtTitulo" class="form-control" placeholder="Título" value="<?= $publicacao->titulo; ?>"/>
                                </div>

                                <div class="form-group">
                                    <label>
                                        Sub Título</label>
                                    <input type="text" name="txtSubTitulo" class="form-control" placeholder="Sub Título" value="<?= $publicacao->subtitulo; ?>"/>
                                </div>

                                <div class="form-group">
                                    <label>
                                        Conteúdo</label>
                                    <textarea name="txtConteudo" class="form-control" placeholder="Conteúdo"><?= $publicacao->conteudo; ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label>
                                        Data</label>
                                    <input type="datetime-local" name="txtData" class="form-control" placeholder="Data" value="<?= strftime('%Y-%m-%dT%H:%M:%S', strtotime($publicacao->data)); ?>"/>
                                </div>
                            
                            <input type="hidden" name="txtId" value="<?= $publicacao->id; ?>"/>
                            


                                <button type="submit" class="btn btn-default">Alterar</button>


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

            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <?= 'Imagem de Destaque do ' . $subtitulo; ?>
                    </div>
                    
                    <style type="text/css">
                        img{
                            width: 400px;
                        }                        
                    </style>
                    
                    <div class="panel-body">
                        <div class="row" style="padding-bottom: 10px;">
                            <div class="col-lg-8 col-lg-offset-1">
                                <?php
                                if ($publicacao->img == 1) {
                                    echo img('assets/frontend/img/publicacoes/' . md5($publicacao->id) . '.jpg');
                                } else {
                                    echo img('assets/frontend/img/sem-imagem.jpg');
                                }
                                ?>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <?php
                                $divOpen = '<div class="form-group">';
                                $divClose = '</div>';
                                echo form_open_multipart('admin/publicacao/nova_foto');
                                echo form_hidden('id', md5($publicacao->id));

                                echo $divOpen;
                                $imagem = array(
                                    'name' => 'userfile',
                                    'class' => 'form-control'
                                );
                                echo form_upload($imagem);
                                echo $divClose;

                                echo $divOpen;
                                $botao = array(
                                    'name' => 'btn_adicionar',
                                    'class' => 'btn btn-default',
                                    'value' => 'Adicionar Nova Imagem'
                                );
                                echo form_submit($botao);
                                echo $divClose;

                                echo form_close();
                            }
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
