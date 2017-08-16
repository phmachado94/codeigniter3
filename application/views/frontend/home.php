<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">
                <?= $titulo; ?>
                <small>> <?= $subtitulo; ?></small>
            </h1>

            <?php
            foreach ($postagem as $destaque) {
                ?>
                <!-- Blog Post -->
                <h2>
                    <a href="<?= base_url('postagem/' . $destaque->id . '/' . limpar($destaque->titulo)); ?>"><?= $destaque->titulo; ?></a>
                </h2>
                <p class="lead">
                    por <a href="<?= base_url('autor/' . $destaque->idautor . '/' . limpar($destaque->nome)); ?>"><?= $destaque->nome; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?= postadoem($destaque->data); ?></p>
                <hr>

                <?php
                if ($destaque->img == 1) {
                    $fotoPub = base_url('assets/frontend/img/publicacoes/' . md5($destaque->id) . '.jpg');
                    ?>

                    <img class="img-responsive" src="<?= $fotoPub; ?>" alt="">
                    <hr>

                    <?php
                    
                } 
                ?>

                <p><?= $destaque->subtitulo;
                    ?></p>
                <a class="btn btn-primary" href="<?= base_url('postagem/' . $destaque->id . '/' . limpar($destaque->titulo)); ?>">Leia mais <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
                <?php
            }
            ?>




        </div>