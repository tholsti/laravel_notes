<<<<<<< HEAD
<h1>User view: list of all videos in jukebox</h1>
=======
<h1>Welcome to the Youtube Jukebox!</h1>
>>>>>>> master

<?php 
  foreach ($songs as $key => $song)
  {
    echo "Song:" . $song["song_title"] . "<br>";
    echo "Artist:" . $song["artist"] . "<br>";
    if ($song["youtube_url"] ) {
      echo "<a href=\"" .$song["youtube_url"] . "\"> Youtube link </a> <br>";
    }
<<<<<<< HEAD
    if ($song["youtube_embed"]) {
      echo $song["youtube_embed"] . "<br>";
    }
=======
    echo '<a href="/player?id='. $song["id"] . '"> Play this song! </a><br>';  
    echo "<br>";
>>>>>>> master
  }
?> 