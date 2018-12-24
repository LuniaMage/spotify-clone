<?php include('includes/header.php');
include('includes/config.php');

if(isset($_GET['id'])) {
  $albumId = $_GET['id'];
} else {
  header("Location: index.php");
}

$album = new Album($con, $albumId);
$artist = $album->getArtist();

?>


<div class="entityInfo">

  <div class="leftSection">
    <img src="<?php echo $album->getArtwork(); ?>">
  </div>

  <div class="rightSection">
      <h2><?php echo $album->getTitle(); ?></h2>
      <p>By <?php echo $artist->getName(); ?></p>
      <p><?php echo $album->getNumberOfSongs(); ?></p>
  </div>
</div>

<div class="trackListContainer">
  <ul class="trackList">
    <?php  
      $songIdArray = $album->getSongIds();
      $i = 1; 
      foreach($songIdArray as $songId) {
        $albumSong = new Song($con, $songId);
        $albumArtist = $albumSong->getArtist();

        echo "<li class='trackListRow'>
          <div class='trackCount'>
            <img class='play' src='assets/icons/icons8-play.png'>
            <span class='trackNumber'>$i</span>
          </div>

          <div class='trackInfo'>
            <span class='trackName'>" . $albumSong->getTitle() . "</span>
            <span class='artistName'>" . $albumArtist->getName() . "</span>
          </div>

          <div class='trackOptions'>
            <img class='optionsButton' src='assets/icons/icons8-more_filled.png'>
          </div>

          <div class='trackDuration'>
            <span class='duration'>" . $albumSong->getDuration() . "</span>
          </div>
        </li>";
        
          $i = $i + 1;
      }
    ?>
  </ul>
</div>












<?php include('includes/footer.php'); ?>