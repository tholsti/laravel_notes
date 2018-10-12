<h1>Welcome to the Youtube Jukebox!</h1>

<?php 
  foreach ($songs as $key => $song)
  {
    echo "Song:" . $song["song_title"] . "<br>";
    echo "Artist:" . $song["artist"] . "<br>";
    if ($song["youtube_url"] ) {
      echo "<a href=\"" .$song["youtube_url"] . "\"> Youtube link </a> <br>";
    }
    echo '<a href="/player?id='. $song["id"] . '"> Play this song! </a><br>';  
    echo "<br>";
  }
?> 