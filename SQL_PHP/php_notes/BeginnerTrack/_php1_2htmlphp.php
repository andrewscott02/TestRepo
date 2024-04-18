<!-- PHP Basics -->
<!-- https://teamtreehouse.com/library/php-basics-2 -->

<!-- HTML and PHP -->
<h1><?php echo "This is a php generated header"?></h1>
<p><?php echo "This is a php generated paragraph"?></p>

<!-- PHP Generated Footer -->
<section class="footer">
    &copy; <?php echo date("Y"); ?> by Andrew Scott
</section>

<!-- Get Last Modified Date -->
<section class="lastModified">
    <p>
        <?php echo "Last Modified: " . date("F d Y H:i:s", getlastmod()); ?>
    </p>
</section>

<!-- PHP Generated Footer with Last Modified Date -->
<section class="footer">
    &copy; <?php
    echo date("Y");
    echo " by Andrew Scott. ";
    echo "Last Modified: " . date("F d Y H:i:s", getlastmod());
    ?> 
</section>

<!-- Combining Multiple Files with Includes -->
<h2>Unit Conversion</h2>
<?php
    include "unitConversion.php";
?>