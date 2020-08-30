<?php include("includes/header.php");

if(isset($_GET['id'])) {
    $albumId =  $_GET['id'];
} else {
    header("Location: index.php");
}

$album = new Album($con, $albumId);

$artist = $album->getArtist();


?>

<div class="entityInfo">
    <div class="leftSection">
        <img src="<?php echo $album->getArtworkPath(); ?>" alt="Album Cover">
    </div>

    <div class="rightSection">
        <h2><?php echo $album->getTitle(); ?></h2>
        <p>By <?php echo $artist->getName(); ?></p>
        <p><?php echo $album->getNumberOfSongs() ?> Songs</p>
        
    </div>
</div>

<div class="tracklistContainer">
    <ul class="tracklist">

<?php

$songIdArray = $album->getSongIds();
foreach($songIdArray as $songId) {
    echo $songId . "<br>";
}

?>



    </ul>
</div>

<?php include("includes/footer.php"); ?>
