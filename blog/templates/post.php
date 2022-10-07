<!-- est la vue d'un billet et ses commentaires. Elle affiche la page-->

<?php $title = "Le blog de l'AVBN"; ?>

<?php ob_start(); ?>
<h1>blog de l'AVBN !</h1>
<p><a href="index.php">Retour à la liste des billets</a></p>

<div class="news">
    <h3>

        <?= htmlspecialchars($post->title) ?>
        <em>le
            <?= $post->frenchCreationDate ?>
        </em>
    </h3>

    <p>
        <?= nl2br(htmlspecialchars($post->content)) ?>
    </p>
</div>

<h2>Commentaires : </h2>

<form action="index.php?action=addComment&id=<?= $post->identifier ?> " method="post">
    <div class="form">
        <label for="author">Auteur</label> <br />
        <input type="text" id="author" name="author" />
    </div>
    <div class="form">
        <label for="comment">Commentaires</label> <br />
        <textarea id="comment" name="comment"></textarea>
    </div>
    <div class="formSubmit">
        <input type="submit">
    </div>
</form>

<?php
foreach ($comments as $comment) {
?>
<p><strong><?= htmlspecialchars($comment->author) ?></strong> le <?= $comment->frenchCreationDate ?></p>
<p>
    <?= nl2br(htmlspecialchars($comment->comment)) ?>
</p>
<?php
}
?>
<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>