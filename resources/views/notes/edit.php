<form action="" method="post">

    <?= csrf_field() ?>

    <label for="title">Title</label><br>
    <input type="text" name="title" id="title" value="<?= htmlspecialchars($note['title']) ?>">
    <br><br>

    <label for="topic">Topic</label><br>
    <input type="text" name="topic" id="topic" value="<?= htmlspecialchars($note['topic']) ?>">
    <br><br>
    
    <label for="text">Text</label><br>
    <textarea name="text" id="text" cols="30" rows="10"><?= htmlspecialchars($note['text']) ?></textarea>
    <br><br>

    <label for="author">Author</label><br>
    <input type="text" name="author" id="author" value="<?= htmlspecialchars($note['author']) ?>">
    <br><br>


    <input type="submit" value="Save">

</form>
