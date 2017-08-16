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
                    <?= 'Adicionar Novo ' . $subtitulo; ?>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php
                            echo validation_errors('<div class="alert alert-danger">', '</div>');
                            echo form_open('admin/usuario/inserir');
                            ?>

                            <div class="form-group">
                                <label>
                                    Nome do Usuário</label>
                                <input type="text" name="txtNome" class="form-control" placeholder="Nome do Usuário" value="<?= set_value('txtNome'); ?>"/>
                            </div>

                            <div class="form-group">
                                <label>
                                    E-mail</label>
                                <input type="email" name="txtEmail" class="form-control" placeholder="E-mail" value="<?= set_value('txtEmail'); ?>"/>
                            </div>

                            <div class="form-group">
                                <label>
                                    Histórico</label>
                                <textarea name="txtHistorico" class="form-control" placeholder="Histórico"><?= set_value('txtHistorico'); ?></textarea>
                            </div>

                            <div class="form-group">
                                <label>
                                    User</label>
                                <input type="text" name="txtUser" class="form-control" placeholder="User" value="<?= set_value('txtUser'); ?>"/>
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

                            <button type="submit" class="btn btn-default">Cadastrar</button>
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
                    <?= 'Alterar/Excluir ' . $subtitulo . ' Existente'; ?>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <style>
                                img{
                                    width: 50px;
                                }
                            </style>
                            <?php
                            $this->table->set_heading("Foto", "Nome do Usuário", "Alterar", "Excluir");
                            foreach ($usuarios as $usuario) {
                                
                                if ($usuario->img == 1) {
                                    $fotoUsu = img('assets/frontend/img/usuarios/' . md5($usuario->id) . '.jpg');
                                } else {
                                    $fotoUsu = img('assets/frontend/img/sem-imagem.jpg');
                                }

                                $nomeUsu = $usuario->nome;
                                $alterar = anchor(base_url('admin/usuario/alterar/' . md5($usuario->id)), '<i class="fa fa-edit fa-fw"></i> Alterar');
                                $excluir = anchor(base_url('admin/usuario/excluir/' . md5($usuario->id)), '<i class="fa fa-remove fa-fw"></i> Excluir');

                                $this->table->add_row($fotoUsu, $nomeUsu, $alterar, $excluir);
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
