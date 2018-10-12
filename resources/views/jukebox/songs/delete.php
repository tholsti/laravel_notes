<h1>Delete item</h1>

<form action="" method="post">
<?= csrf_field() ?>
  <label for="song_title">Are you sure that you want to delete?</label><br>
  <input type="submit" value="Cancel">
  <input type="submit" name="del" value="Delete">
</form>