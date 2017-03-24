<?php
//HTTP Response Header Protections
include 'includes/page_secure.php';
//Common Includes
include 'conf.inc.php';
include 'includes/functions.php';

?>
<!DOCTYPE html>
<html lang="en" class="html">
    <head>
        <!--Meta tags, Javascripts, CSS-->
        <?php include 'includes/scripts_metas_css.php'; ?>
        
        <!--Google Analytics-->
        <?php include 'google_analytics.php'; ?>        
        <!--End of Google Analytics-->
        
        <title><?php title(); ?></title>
    </head>

    <body>
        <div class="pageLoader">
            <div>
                <span>Casellas</span>
            </div>
        </div>
        <!--Navigation-->
        <nav class="navbar navbar-inverse navbar-fixed-top cypher-nav-wrapper">
            <div class="container container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a id="navbar-brand" class="navbar-brand" href="index.php?pg=home">
                        <img class="logo-casellas img-responsive" src="images/casellas-logo.png" alt="Casellas"/>
                        <img class="logo-casellas-png img-responsive" src="images/casellas-transparent.png" alt="Casellas"/>
                        <span class="logo-text">Casellas</span>
                    </a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">            
                        <li><a href="index.php?pg=about" title="About Us">About Us</a></li>
                        <li><a href="index.php?pg=menus" title="Menus">Menu</a></li>
                        <li><a href="index.php?pg=awards_and_testimonials" title="Awards &amp; Reviews">Awards &amp; Reviews</a></li>
                        <li><a href="index.php?pg=gallery" title="Gallery">Gallery</a></li>
                        <li><a href="index.php?pg=events" title="News &amp; Events">News &amp; Events</a></li>
                        <li><a href="index.php?pg=reservation" title="Reservation">Reservation</a></li>
                        <!--<li><a href="#enquiry-form-wrapper" id="reservation">Reservation</a></li>-->
                        <li><a href="index.php?pg=contact" title="Contact">Contact</a></li>          
                    </ul>
                </div>
            </div>
        </nav>
        
        <?php
        if ($_GET['pg'] == 'home' || $_GET['pg'] == null) {
            include 'includes/banner_responsive.php';
            include 'includes/links_responsive.php';
        } 
        ?>                
        <!-- Begin page content -->
        <div class="container">            
            <div class="content-wrapper">
                <div class="col-md-1 side-links">
                    <?php include 'includes/cypher_left_nav.php'; ?>
                </div>         
                <?php include 'includes/cypher_content.php'; ?>
            </div>
        </div>
        
        <!--Social floater-->
        <div class="socialFloater">
            <!--<a href="#enquiry-form-wrapper" class="social-enquiry" title="Enquire Here"></a>-->
            <a href="index.php?pg=vip" class="social-vip" title="VIP"></a>
            <a href="https://www.facebook.com/pages/Casellas-Wine-Tapas-Grill/110389758981393" class="social-fb" title="Visit us on Facebook" target="_blank"></a>
            <a href="http://instagram.com/casellas_tapas" class="social-instagram" title="Instagram"></a>
            <a href="https://twitter.com/Casellas_Tapas" class="social-twitter" title="Twitter"></a>
        </div>            
        <!--Social floater-->

        <!--Footer-->
        <?php include 'includes/footer.php'; ?>
        <!--Enquiry-->
        <?php include 'includes/enquiry.php'; ?>
        <!--Public Notice-->
        <?php include 'includes/notification.php'; ?>
        <!--Scripts-->
        <?php include 'includes/scripts_bottom.php' ?>
    </body>
</html>
