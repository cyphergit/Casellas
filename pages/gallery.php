<?php include 'google_analytics.php'; ?>

<?php
function imageDisplay($thumbDir, $origDir) {
    $orig_directory = $origDir;
    $thumb_directory = $thumbDir;
    
    $allowed_types = array('jpg', 'jpeg', 'gif', 'png');
    $file_parts = array();
    $ext = '';
    $title = '';
    $i = 0;

    $dir_handle = @opendir($thumb_directory) or die("There is an error with your image directory!");

    $i = 1;
    while ($file = readdir($dir_handle)) {
        /* Skipping the system files: */
        if ($file == '.' || $file == '..')
            continue;

        $file_parts = explode('.', $file);
        $ext = strtolower(array_pop($file_parts));

        /* Using the file name (withouth the extension) as a image title: */
        $title = implode('.', $file_parts);
        $title = htmlspecialchars($title);

        /* If the file extension is allowed: */
        if (in_array($ext, $allowed_types)) {
            echo "<a href='$orig_directory/$file'>";
            echo "<img class='img-responsive' id='image-" . ($i++) . "' src='$thumb_directory/$file', data-big='$orig_directory/$file', data-title='$title', data-description='$title'/>";
            echo"</a>";
        }
    }

    /* Closing the directory */
    closedir($dir_handle);
}
?>

<div class="col-md-11 content-container">
    <div class="content">
        <h1>Gallery</h1>
        <div id="galleria">
            <?php
            $thumbDir = 'images/gallery/thumbs';
            $origDir = 'images/gallery/original';

            imageDisplay($thumbDir, $origDir);
            ?>
        </div>
    </div>
</div>

<script>
    // Load the classic theme
    Galleria.loadTheme('scripts/galleria/themes/classic/galleria.classic.min.js');

    // Initialize Galleria
    Galleria.run('#galleria');
</script>