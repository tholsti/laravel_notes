<form action="" method="post">

    <?= csrf_field() ?>

    <label for="song_title">Song Title</label><br>
    <input type="text" name="song_title" id="song_title" value="<?= htmlspecialchars($note['song_title']) ?>">
    <br><br>

    <label for="artist">Artist</label><br>
    <input type="text" name="artist" id="artist" value="<?= htmlspecialchars($note['artist']) ?>">
    <br><br>
    
    <label for="youtube_link">Youtube code</label><br>
    <input type="text" name="youtube_link" id="youtube_link" value="<?= htmlspecialchars($note['youtube_link']) ?>">
    <br><br>
    

    <label for="genre">Genre</label><br>
    <input type="select" name="genre" id="genre" value="<?= htmlspecialchars($note['genre']) ?>">
    <br><br>

    <label for="date_of_upload">Date of upload</label><br>
    <input type="text" name="date_of_upload" id="date_of_upload" value="<?= htmlspecialchars($note['date_of_upload']) ?>">
    <br><br>
    

    <input type="submit" value="Save">

</form>
