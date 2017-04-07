<?php
    $title = ("Culture");
    include("asset/inc/header.inc.php");
?>
<script>
	document.getElementById("Culture").style.backgroundColor="#95dce2";
</script>
    <div id="content"> 
		<?php
            include("asset/inc/culture.inc.php");
        ?>
        <h1> List of Guam's Villages</h1>
        <ul id="GuamVillage">
        	<li>Agana Heights</li>
            <li>Agat</li>
            <li>Asan-Maisna</li>
            <li>Barrigada</li>
            <li>Chalan-Pago-Ordot</li>
            <li>Dededo</li>
            <li>Hag&aring;t&ntilde;a</li>
            <li>Iranajan</li>
            <li>Mangilao</li>
            <li>Merizo</li>
            <li>Mongmong-Toto-Maite</li>
            <li>Piti</li>
            <li>Santa Rita</li>
            <li>Sinajana</li>
            <li>Talofofo</li>
            <li>Tamuning (Tumon)</li>
            <li>Umatac</li>
            <li>Yigo</li>
            <li>Yona</li>
        </ul>
        <div class="figure">
        	<img src="asset/Media/Pictures/Culture/villages1.jpg" alt="Guam Villages">
            <p><a target="_blank" href="http://guamfoodguide.com/userfiles/map_big.jpg">Guam Villages</a></p>
    	</div>
    </div>  <!-- End Content -->
	<script>
        document.getElementById("Villages").style.backgroundColor="#95dce2";
    </script>
<?php
    include("asset/inc/footer.inc.php");
?>