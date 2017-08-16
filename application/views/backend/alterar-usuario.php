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
                            echo form_open('admin/usuario/salvar_alteracoes');
                            foreach ($usuarios as $usuario) {
                                ?>

                                <div class="form-group">
                                    <label>
                                        Nome do Usuário</label>
                                    <input type="text" name="txtNome" class="form-control" placeholder="Nome do Usuário" value="<?= $usuario->nome; ?>"/>
                                </div>

                                <div class="form-group">
                                    <label>
                                        E-mail</label>
                                    <input type="text" name="txtEmail" class="form-control" placeholder="E-mail" value="<?= $usuario->email; ?>"/>
                                </div>

                                <div class="form-group">
                                    <label>
                                        Histórico</label>
                                    <textarea name="txtHistorico" class="form-control" placeholder="Histórico"><?= $usuario->historico; ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label>
                                        User</label>
                                    <input type="text" name="txtUser" class="form-control" placeholder="User" value="<?= $usuario->user; ?>"/>
                                </div>

                                <div class="form-group">
                                    <label>
                                        Senha</label>
                                    <input type="password" name="txtSenha" class="form-control"/>

                                </div>

                                <div class="form-group">
                                    <label>
                                        Confirmar Senha</label>
                                    <input type="password" name="txtConfirmarSenha" class="form-control"/>

                                </div>

                                <input type="hidden" name="txtId" value="<?= $usuario->id; ?>"/>

                                <button type="submit" class="btn btn-default">Atualizar</button>
                            </div>


                            <?php
                            echo form_close();
                            ?>

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
                    <div class="panel-body">
                        <div class="row" style="padding-bottom: 10px;">
                            <div class="col-lg-3 col-lg-offset-3">
                                <?php
                                if ($usuario->img == 1) {
                                    echo img('assets/frontend/img/usuarios/' . md5($usuario->id) . '.jpg');
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
                                echo form_open_multipart('admin/usuario/nova_foto');
                                echo form_hidden('id', md5($usuario->id));

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
