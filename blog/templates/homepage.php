<!-- homepage.php est la vue de la page d'accueil. Elle affiche la page -->
<!-- Definit le titre de la page dans $title integrer dans la balise <title>
    Definit le contenu de la page dans $content integrer dans la balise <body>
        -->

<?php $title = "Le blog de l'AVBN"; ?>
<!-- ob_start() => fonction qui "memorise" toute la sortie HTML qui suit puis a la fin on recupere le contenu avec ob_get_clean() -->
<?php ob_start(); ?>
<h1>Le super blog de l'AVBN !</h1>
<p>Derniers billets du blog :</p>

<?php
foreach ($posts as $post) {
?>
<div class="news">
    <h3>
        <?= htmlspecialchars($post['title']) ?>
        <!-- equivaut a <?php //echo htmlspecialchars($post['title']); 
                            ?> -->
        <em>le <?= $post['french_creation_date']; ?></em>

    </h3>
    <p>
        <?=
            // On affiche le contenu du billet
            nl2br(htmlspecialchars($post['content']));
            ?>
        <br />
        <em><a href="post.php?id=<?= urldecode($post['identifier']) ?>">Commentaires</a></em>
    </p>
</div>
<?php
} // Fin de la boucle des billets
?>
<!-- on recupere le contenu avec ob_get_clean() et on met le tout dans content 
il GET le contenu capturé et il nettoie la sortie. le nettoyage pour eviter que la sortie soit directement affichée  -->
<?php $content = ob_get_clean(); ?>
<?php require('layout.php') ?>