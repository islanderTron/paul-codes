<?php
    $title = ("Culture");
    include("asset/inc/header.inc.php");
?>
<script>
    document.getElementById("Culture").style.backgroundColor="#95dce2";
</script>
    <script type="text/javascript" src="asset/JS/pictureJS.js"></script>
    <div id="content"> 
		<?php
            include("asset/inc/culture.inc.php");
        ?>            

        <h1> Chamorro Foods</h1>
        <p>These Chamorro foods are very popular on Guam at fiesta or at home.  Every day the Chamorro people do eat rice and meat because it is part of tradition and habit that pretty much was started after the Spanish incursion from the 1500’s and World War II when the American soldiers introduced potted meat.  An interesting aspect of the Chamorro people is that they like to eat dinner while listening to the island songs to help them enjoy eating the foods.  It is very common to see that and you would be amazed how delicious the foods taste.  Without a doubt, you would love it!</p>
        <div id="gallery-center">
            <div id="thumbs">
                <a href="javascript: changeImage(1);"><img onClick="fadeMe(pic1)" src="asset/Media/Pictures/Foods/img01thumb.jpg" alt="" /></a>
                <a href="javascript: changeImage(2);"><img onClick="fadeMe(pic2)" src="asset/Media/Pictures/Foods/img02thumb.jpg" alt="" /></a>
                <a href="javascript: changeImage(3);"><img onClick="fadeMe(pic3)" src="asset/Media/Pictures/Foods/img03thumb.jpg" alt="" /></a>
                <a href="javascript: changeImage(4);"><img onClick="fadeMe(pic4)" src="asset/Media/Pictures/Foods/img04thumb.jpg" alt="" /></a>
            </div>
            <div id="bigimages">
                <div id="pic1">
                    <img src="asset/Media/Pictures/Foods/img01.jpg" alt=""/>
                    <p><a target="_blank" href="http://www.paulaq.com/bagogikoreanrecipe.html">Bagogi</a></p>
                </div>

                <div id="pic2">
                    <img src="asset/Media/Pictures/Foods/img02.jpg" alt=""/>
                    <p><a target="_blank" href="http://www.paulaq.com/chamorro_bbq_marinadeguambarbecuemarinade.html">Chamorro BBQ Marinade</a></p>
                </div>

                <div id="pic3">
                    <img src="asset/Media/Pictures/Foods/img03.jpg" alt=""/>
                    <p><a target="_blank" href="http://www.paulaq.com/spam_jamguamrecipe.html">Chamorro Spam Jam</a></p>
                </div>

                <div id="pic4">
                    <img src="asset/Media/Pictures/Foods/img04.jpg" alt=""/>
                    <p><a target="_blank" href="http://www.paulaq.com/lumpiaguamrecipe.html">Lumpia</a></p>
                </div>
            </div>
        </div>
    </div>  <!-- End Content --> 
    <script>
		document.getElementById("Foods").style.backgroundColor = "#95dce2";
	</script>
<?php
    include("asset/inc/footer.inc.php");
?>