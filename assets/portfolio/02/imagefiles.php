<?php

    $title="Image Files";

    include ("assets/inc/header.inc.php");

    // include ("assets/inc/navigation.inc.php");

?>

    <div id="rightColumn">

        <div id="wrapper">

            <div id="content">

                    <div id="leftContent">

                    </div>



                    <div id="rightContent">

                    </div> <!-- End of Right Content -->



                    <h1>Raster</h1>

                    <p>The format breaks the image into a rectangular grid and each rectangle is called a pixel. A pixel is the smallest component found in the image and appears as a colored dot.</p>

                    <p>Raster uses the width and height of the image in pixels and by the number of bits per pixel, or a color depth. Color depth determines the number of colors the pixel can represent.</p>

                    <div class="rightBox">

                        <p>Common types of Raster format:</p>

                        <ul>

                            <li>Joint Photographic Experts Group (JPEG)</li>

                            <li>Portable network Graphics (PNG)</li>

                            <li>Graphics Interchange Format (GIF)</li>

                            <li>Tagged Image File Format (TIFF)</li>

                            <li>Bitmap File Format (BMP)</li>

                        </ul>

                    </div>

                    <p>The disadvantage of the Raster is resize the image is because of the resolution dependent. Resolution dependent is that the quality of the image depends on its resolution. The resolution is the number of pixels per inch. Also, the Raster tends to have a large file size. Every time, the size of the image increases, the format have to increase the number of pixels. For the example, the memory size of a 3 x 3 image needs to store 9 pixels while a 20 x 20 image uses 400 pixels.</p>



                    <p>Today, most popular images you see in Raster forms are TIFF, GIF, JPEG and, PNG. They use the bitmap to store information about the image.</p>



                    <h1>Vector</h1>



                    <p>Vector format uses the mathematical expressions as the simple geometrical objects, such as points, lines, curves, shapes, and polygons.</p>

                    <p>This format stores the mathematical functions and it contains the information of vectors, or paths, which tells where the direction goes.</p>

                    <div class="leftBox">

                        <p>Common types of vector format:</p>

                        <ul>

                            <li>Adobe Illustrator (AI)</li>

                            <li>Scalable Vector Graphics (SVG)</li>

                            <li>Portable Document Format (PDF)</li>

                            <li>Encapsulated Postscript (EPS)</li>

                        </ul>

                    </div>

                    <p>Vector format scales easily to any size without a loss of quality. The advantage of the vector format over Raster is the small file size. When the image is enlarged, the memory size and quality of the vector format remains same.</p>

                    <p>The disadvantage of the vector format is when there is a need for soft toned images. Raster can do this job better because it simply changes the color depth of the pixels. vector format is not suitable for photographs.</p>

                    

                    <div id="adv">

                        <p>Advantages:</p>

                        <ul>

                            <li>Vector format is the resolution independent that is flexible with any size without loss of the quality.</li>

                            <li>Vector format only store the information of mathematics formulas, not pixels.</li>

                            <li>Vector format can place any object over or below the objects.</li>

                        </ul>

                    </div>

                    <div id="disAdv">

                        <p>Disadvantage:</p>

                        <ul>

                            <li>Vector format is not a good format to store the photographs.</li>

                            <li>Vector format does not store the information of subtle tone of color very well.</li>

                            <li>Vector format is not cost effective. The time and talent are needed to create a good image.</li>

                        </ul>

                    </div>

            </div>  <!-- End of the Conent -->

        </div>  <!-- End of the Wrapper -->

    </div>

<?php

    include ("assets/inc/footer.inc.php");

?>