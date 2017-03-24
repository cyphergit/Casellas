<?php include 'google_analytics.php'; ?>
<?php

function randomBannerImage($imgFrom, $imgTo) {

    $images = range($imgFrom, $imgTo);
    shuffle($images);

    foreach ($images as $image) {
        $img = $image;
    }

    echo "<img src='images/menu-$img.jpg' alt='Menu' class='img-responsive img-header'/>";
}
?>

<div class="col-md-11 content-container">
    <div class="content">
        <h1>Menus</h1>
        <?php randomBannerImage(1, 10); ?>

        <p class="menu-direct">Select below one of our menus</p>

        <div class="menu-wrapper">
            <a href="menus/lunch_2014.pdf" title="Lunch Menu" target="_blank" class="img-responsive">
                <img src="images/menu_lunch.gif" alt="Lunch Menu"/>
            </a>
            <a href="menus/alacarte_2013.pdf" title="A la carte Menu" target="_blank" class="img-responsive">
                <img src="images/menu_alacarte.gif" alt="A la carte Menu"/>
            </a>
            <a href="menus/tapas_2014.pdf" title="Tapas Menu" target="_blank" class="img-responsive">
                <img src="images/menu_tapas.gif" alt="Tapas Menu"/>
            </a>
            <a href="menus/dinner_2014.pdf" title="Dinner Menu" target="_blank" class=" img-responsive">
                <img src="images/menu_dinner.gif" alt="Dinner Menu"/>
            </a>
        </div>
        <p>
            Flawless attention to detail and unique character, our creative Modern Australian and Spanish inspired
            Tapas menus expertly prepared and executed by award winning Head Chef Ellen Mendoza Garcia and her team,
            will allow you to experience something truly special that we hope will influence your understanding of
            restaurant dining. Focusing on high quality produce, a respect for technique, exemplary service and a
            thirst for constant refinement, our menus continually evolves to take advantage of each ingredient at
            the height of its flavour, colour, appearance and quality.
        </p>
        <p>
            Our “modern-contemporary” Australian cuisine, built on European foundations that integrates
            traditional Australian, Middle Eastern, South American and Asian influences, represents not just a
            certain period, but also showcases the moving artistry of food and the diversity of flavours that
            Australia has to offer.
        </p>
        <p>
            Whilst our tribute to Spanish inspired Tapas, incorporating traditional flavours & textures by sourcing,
            local and international ingredients to create a simple yet rustic menu, which we feel plays homage to
            the tapas bars of Spain. Designed to be shared with friends in our lounge and paired with a great wine.
        </p>
        <h1>Wines</h1>
        <img src='images/menu-3.jpg' alt='Menu' class="img-responsive img-header"/>
        <p>
            The right wine, the right glass, the right quantity, the right dish. Our wine,
            like our food is ever-changing and constantly evolving…
        </p>
        <p>
            Featuring over 250 varietals and showcasing a range of local and international selections,
            all our wines are hand chosen and handled with the utmost care by our fully trained sommeliers,
            to ensure the perfect accompaniment to your meal.
        </p>
    </div>
</div>