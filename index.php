<?php include("header.php"); ?>
        <div role="main">
            
            <div id="image-container">
                <div id="left-overlay">&nbsp;</div>
                <div id="right-overlay">&nbsp;</div>
                <div id="button-holder">
                    <a href="#" class="move-left">Move Left</a>
                    <a href="#" class="move-right">Move Right</a>
                </div>
                <div id="image-slider">
                    <img src="img/slideshow/slide1.jpg" alt="Image 01" />
                    <img src="img/slideshow/slide2.jpg" alt="Image 02" />
                    <img src="img/slideshow/slide3.jpg" alt="Image 03" />
                </div>
            </div>
            <?php 
				//$detect = new Mobile_Detect(); 
				if ( ($detect->isMobile()) || ($detect->isTablet()) )
				{
			?>
            <ul id="gallery" class="gallery">
            	<li><a href="img/slideshow/slide1.jpg" alt="Image 01" /><img src="img/slideshow/slide1.jpg" alt="Image 01" /></a></li>
                <li><a href="img/slideshow/slide2.jpg" alt="Image 02" /><img src="img/slideshow/slide2.jpg" alt="Image 02" /></a></li>
            </ul>
            <?php } ?>
            
            <div class="wrapper">
                
                <h1>Hello and welcome to dermaskin.co.uk we are experts in Advanced Facial Aesthetics, we work exclusively with Professional Doctors to change the way you want to look.</h1>
            
                <div class="colone alpha">
                	<img src="img/mobile/dental-treatment.jpg" alt="dental services">
                 	<h2 class="ribbon one">Dentistry Services</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vehicula iaculis lectus, ac viverra orci egestas vel. Suspendisse vehicula iaculis.</p>
                    <span>To find out more <a href="#">click here</a></span>
                </div>
                
                <div class="colone alpha omega">
                    <img src="img/mobile/lip-fillers.jpg" alt="Lip Fillers">
					<h2 class="ribbon two">Lip Fillers</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vehicula iaculis lectus, ac viverra orci egestas vel. Suspendisse vehicula iaculis.</p>
                    <span>To find out more <a href="#">click here</a></span>
                </div>
                
                <div class="colone alpha omega">
                    <img src="img/mobile/anti-wrinkle.jpg" alt="Anti-Wrinkle Treatment">
					<h2 class="ribbon three">Anti-Wrinkle Treatment</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vehicula iaculis lectus, ac viverra orci egestas vel. Suspendisse vehicula iaculis.</p>
                    <span>To find out more <a href="#">click here</a></span>
                </div>
                
                <div class="colone omega">
                    <img src="img/mobile/dermal-fillers.jpg" alt="Dermal Fillers">
					<h2 class="ribbon four">Dermal Fillers</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vehicula iaculis lectus, ac viverra orci egestas vel. Suspendisse vehicula iaculis.</p>
                    <span>To find out more <a href="#">click here</a></span>
                </div>
                
                <div class="info">
                	<h3><a href="#">For information on other treatments click here:</a></h3>
                    <ul>
                    	<li><a href="#">Botulinum Toxin A</a></li>
                        <li><a href="#">Anti-Wrinkle Treatment</a></li>
                        <li><a href="#">Dermal Fillers</a></li>
                        <li><a href="#">Lip Fillers</a></li>
                        <li><a href="#">Chemical Skin Peel</a></li>
                        <li><a href="#">Teeth Whitening</a></li>
                        <li><a href="#">Laser Skin Resurfacing</a></li>
                        <li><a href="#">Laser Tattoo Removal</a></li>
                        <li><a href="#">Dentistry Services</a></li>
                    </ul>
                </div>

            </div>
        </div>
	</div>
</div>
<?php include("footer.php"); ?>

