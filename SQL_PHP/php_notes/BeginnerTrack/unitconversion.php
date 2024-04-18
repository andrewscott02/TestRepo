<!-- Unit Conversion Tool -->
<!-- Rewritten to be used in HTML -->
<?php
    #region pounds to kilograms

    $pounds = 140;

    $lb_to_kg = 0.453592;

    $kilograms = $pounds * $lb_to_kg;

    echo "<p>Weight: ";
    echo $pounds;
    echo " lb = ";
    echo $kilograms;
    echo " kg</p>";

    #endregion

    #region miles to kilometers

    $miles = 2.5;

    $miles_to_km = 1.60934;

    $kilometers = $miles * $miles_to_km;

    echo "<p>Distance: ";
    echo $miles;
    echo " miles = ";
    echo $kilometers;
    echo " kilometers</p>";

    #endregion
?>