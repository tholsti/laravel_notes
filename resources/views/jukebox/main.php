<h1>User view: list of all videos in jukebox</h1>

<?php 
  foreach ($songs as $key => $song)
  {
    echo "Song:" . $song["song_title"] . "<br>";
    echo "Artist:" . $song["artist"] . "<br>";
    if ($song["youtube_url"] ) {
      echo "<a href=\"" .$song["youtube_url"] . "\"> Youtube link </a> <br>";
    }
    if ($song["youtube_embed"]) {
      echo $song["youtube_embed"] . "<br>";
    }
  }
?> 