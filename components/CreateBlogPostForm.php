<form id="createBlog" action="/post/create.php" method="POST">
    <h2>Nytt blogginlägg</h2>
    <?= Component('Blogtext') ?>
    <button type="submit">Publicera</button>
</form>