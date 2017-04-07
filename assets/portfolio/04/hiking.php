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

        <h1> Hiking</h1>

        <p>Guam Boonie Stomp is an organization where a  group of hikers can meet every Saturday and anyone can join them at the center court of Chamorro Village at 9 am.  It only cost $2 per hiker over the age of 12.  The cost covers t-shirts that one can earn after hiking with them ten times. However, the hikers have to be aware that they need to bring a lot of water depending on the difficulties of the hike.  Generally hiking is easy to hike, but they forewarn the level of difficulty before they embark.  Also, Boonie Stomp does not provide transportation so hikers would need their own transportation, which everyone follows each other to the hiking site.</p>

        <div id="gallery-center">

            <div id="thumbs">
                <a href="javascript: changeImage(1);"><img onClick="fadeMe(pic1)" src="asset/Media/Pictures/Activities/img01thumb.jpg" alt="" /></a>
                <a href="javascript: changeImage(2);"><img onClick="fadeMe(pic2)" src="asset/Media/Pictures/Activities/img02thumb.jpg" alt="" /></a>
                <a href="javascript: changeImage(3);"><img onClick="fadeMe(pic3)" src="asset/Media/Pictures/Activities/img03thumb.jpg" alt="" /></a>
                <a href="javascript: changeImage(4);"><img onClick="fadeMe(pic4)" src="asset/Media/Pictures/Activities/img04thumb.jpg" alt="" /></a>
            </div>

            <div id="bigimages">
                <div id="pic1">
                    <img src="asset/Media/Pictures/Activities/img01.jpg" alt=""/>
                </div>

                <div id="pic2">
                    <img src="asset/Media/Pictures/Activities/img02.jpg" alt=""/>
                </div>

                <div id="pic3">
                    <img src="asset/Media/Pictures/Activities/img03.jpg" alt=""/>
                </div>

                <div id="pic4">
                    <img src="asset/Media/Pictures/Activities/img04.jpg" alt=""/>
                </div>
            </div>
        </div> <!-- End of gallery center -->
    </div>  <!-- End Content -->

	<script>
        document.getElementById("Hiking").style.backgroundColor="#95dce2";
    </script>
<?php
    include("asset/inc/footer.inc.php");
?>