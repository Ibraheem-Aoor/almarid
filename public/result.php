<?php
require_once 'paytabs.php';

$pt = new paytabs("moh.bashiti7@gmail.com", "6XT1DXMfzkpScAKQ89smO6GpS2UrWBP2yJ4cHRrgcR9osTeB3HXSNEhGHc7DOXGnHLAoD2FPTOdmIsXMaVEYzWFh8MVWKCkrnUP1");
$result = $pt->verify_payment($_POST['payment_reference']);
echo "<center><h1>" . $result->result . "</h1></center>";

?>