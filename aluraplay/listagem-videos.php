<?php require_once 'inicio-html.php'; //traz o cabeçalho em html ?>

<ul class="videos__container">
    <?php foreach ($videoList as $video): /*mesclei php com html, agora esse "li" esta dentro do meu foreach. Para cada um dos li no meu banco de dados, esse li será exibido*/ ?>
            <li class="videos__item">
                <iframe width="100%" height="72%" src="<?= $video->url;//<?= é a mesma coisa que abrir uma tag php e escrever echo ?>"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
                <div class="descricao-video">
                    <img src="public/img/logo.png" alt="logo canal alura">
                    <h3><?php echo $video->title; ?></h3>
                    <div class="acoes-video">
                        <a href="/editar-video?id=<?= $video->id; ?>">Editar</a>
                        <a href="/remover-video?id=<?= $video->id; ?>">Excluir</a>
                    </div>
                </div>
            </li>
    <?php endforeach; ?>
</ul>
<?php require_once 'fim-html.php'; //fim do html ?>