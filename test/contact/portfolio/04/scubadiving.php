<?php
    $title="Activities";
    include("asset/inc/header.inc.php");
?>
<script>
	document.getElementById("Activities").style.backgroundColor="#95dce2";
</script>
<script type="text/javascript" src="asset/JS/pictureJS.js"></script>
    <div id="content"> 
		<?php
            include("asset/inc/activities.inc.php");
        ?>
        <h1> Scuba Diving</h1>
        <p>Guam has at least fifty different places to go scuba diving with various diving groups such as <a target="_blank" href="http://www.mdaguam.com/">MDA</a>, <a target="_blank" href="http://gtds.com/">GTDS</a> and several others. The most popular places are Blue Hole, Crevice, Coral Gardens, Haps Reef, and Pete’s Reef where you could see more than 200 species of sea critters, fishes, sharks and rays. They have all the diving equipment that you need to rent so you don’t have to lug yours.</p>
        <div id="gallery-center">
            <div id="thumbs">
                <a href="javascript: changeImage(1);"><img onClick="fadeMe(pic1)" src="asset/Media/Pictures/Activities/img05thumb.jpg" alt="" /></a>
                <a href="javascript: changeImage(2);"><img onClick="fadeMe(pic2)" src="asset/Media/Pictures/Activities/img06thumb.jpg" alt="" /></a>
                <a href="javascript: changeImage(3);"><img onClick="fadeMe(pic3)" src="asset/Media/Pictures/Activities/img07thumb.jpg" alt="" /></a>
                <a href="javascript: changeImage(4);"><img onClick="fadeMe(pic4)" src="asset/Media/Pictures/Activities/img08thumb.jpg" alt="" /></a>
            </div>
            <div id="bigimages">
                <div id="pic1">
                    <img src="asset/Media/Pictures/Activities/img05.jpg" alt=""/>
                    
                </div>

                <div id="pic2">
                    <img src="asset/Media/Pictures/Activities/img06.jpg" alt=""/>
                    
                </div>

                <div id="pic3">
                    <img src="asset/Media/Pictures/Activities/img07.jpg" alt=""/>
                    
                </div>

                <div id="pic4">
                    <img src="asset/Media/Pictures/Activities/img08.jpg" alt=""/>
                    
                </div>
            </div>
        </div> <!-- End of gallery center -->
    </div>  <!-- End Content -->
	<script>
        document.getElementById("ScubaDiving").style.backgroundColor="#95dce2";
    </script>
<?php
    include("asset/inc/footer.inc.php");
?>