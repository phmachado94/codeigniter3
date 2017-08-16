<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">
                <?= $titulo; ?>
                <small>> 
                <?php 
                if ($subtitulo != '') {
                    echo $subtitulo;
                } else {
                    foreach ($subtituloDB as $tituloDB) {
                        echo $tituloDB->titulo;
                    }
                }
                ?>
                </small>
            </h1>

            <?php
            foreach ($postagem as $categoria) {
            ?>
                <!-- Blog Post -->
                <h2>
                    <a href="<?= base_url('postagem/' . $categoria->id . '/' . limpar($categoria->titulo)); ?>"><?= $categoria->titulo; ?></a>
                </h2>
                <p class="lead">
                    por <a href="<?= base_url('autor/' . $categoria->idautor . '/' . limpar($categoria->nome)); ?>"><?= $categoria->nome; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?= postadoem($categoria->data); ?></p>
                <hr>
                
                <?php
                if ($categoria->img == 1) {
                    $fotoPub = base_url('assets/frontend/img/publicacoes/' . md5($categoria->id) . '.jpg');
                    ?>

                    <img class="img-responsive" src="<?= $fotoPub; ?>" alt="">
                    <hr>

                    <?php
                    
                } 
                ?>
                    
                <p><?= $categoria->subtitulo; ?></p>
                <a class="btn btn-primary" href="<?= base_url('postagem/' . $categoria->id . '/' . limpar($categoria->titulo)); ?>">Leia mais <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
            <?php
            }
            ?>




        </div>