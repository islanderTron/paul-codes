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
                
        <h1>Beaches</h1>
        <p>Going to the beach is one of the best activities on Guam.  You can have small parties or BBQ's with friends or/and families.  You can go snorkeling, swimming, play the volleyball, or any other activities you choose to do.  Also, you can sit and lay down to enjoy the heat.  Guam's ocean waters maintains a tempature between 82-86&deg;F.  The ocean feels really nice when swimming while it’s sunny and humid during the afternoon.</p>
        <div id="gallery-center">
            <div id="thumbs">
                <a href="javascript: changeImage(1);"><img onClick="fadeMe(pic1)" src="asset/Media/Pictures/Activities/img09thumb.jpg" alt="" /></a>
                <a href="javascript: changeImage(2);"><img onClick="fadeMe(pic2)" src="asset/Media/Pictures/Activities/img10thumb.jpg" alt="" /></a>
                <a href="javascript: changeImage(3);"><img onClick="fadeMe(pic3)" src="asset/Media/Pictures/Activities/img11thumb.jpg" alt="" /></a>
                <a href="javascript: changeImage(4);"><img onClick="fadeMe(pic4)" src="asset/Media/Pictures/Activities/img12thumb.jpg" alt="" /></a>
            </div>
            <div id="bigimages">
                <div id="pic1">
                    <img src="asset/Media/Pictures/Activities/img09.jpg" alt=""/>
                </div>

                <div id="pic2">
                    <img src="asset/Media/Pictures/Activities/img10.jpg" alt=""/>
                </div>

                <div id="pic3">
                    <img src="asset/Media/Pictures/Activities/img11.jpg" alt=""/>
                </div>

                <div id="pic4">
                    <img src="asset/Media/Pictures/Activities/img12.jpg" alt=""/>
                </div>
            </div>
        </div> <!-- End of gallery center -->
    </div>  <!-- End Content -->
	<script>
        document.getElementById("Beaches").style.backgroundColor="#95dce2";
    </script>
<?php
    include("asset/inc/footer.inc.php");
?>