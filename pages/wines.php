<div id="con-left">
    <?php
    include('includes/cypher_left_nav.php');

    function randomBannerImage($imgFrom, $imgTo) {

        $images = range($imgFrom, $imgTo);
        shuffle($images);

        foreach ($images as $image) {
            $img = $image;
        }

        echo "<img src='images/menu-$img.jpg' alt='Menu'/>";
    }
    ?>
</div>

<div id="con-right">
    <div class="con-right-container">
        <div class="wrapper">
            <h1>Wines</h1>
            <img src='images/menu-3.jpg' alt='Menu'/>
            <p>
                The right wine, the right glass, the right quantity, the right dish. Our wine, 
                like our food is ever-changing and constantly evolving… 
            </p>
            <p>
                Featuring over 200 varietals and showcasing a range of local and international selections, 
                all our wines are hand chosen and handled with the utmost care by our fully trained sommeliers,
                to ensure the perfect accompaniment to your meal.
            </p>
        </div>
    </div>
</div>