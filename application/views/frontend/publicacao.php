<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <?php
            foreach ($postagem as $destaque) {
            ?>
                <!-- Blog Post -->
                <h1>
                    <?= $destaque->titulo; ?>
                </h1>
                
                <p class="lead">
                    por <a href="<?= base_url('autor/' . $destaque->idautor . '/' . limpar($destaque->nome)); ?>"><?= $destaque->nome; ?></a>
                </p>
                
                <p><span class="glyphicon glyphicon-time"></span> <?= postadoem($destaque->data); ?></p>                
                <hr>
                
                <p><i><?= $destaque->subtitulo; ?></i></p>
                
                <?php
                if ($destaque->img == 1) {
                    $fotoPub = base_url('assets/frontend/img/publicacoes/' . md5($destaque->id) . '.jpg');
                    ?>

                    <img class="img-responsive" src="<?= $fotoPub; ?>" alt="">
                    <hr>

                    <?php
                    
                } 
                ?>                
                
                <p><?= $destaque->conteudo; ?></p>
                <hr>
                
            <?php
            }
            ?>

        </div>