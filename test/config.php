<?php
require_once('vendor/autoload.php');

$stripe = array(
  "secret_key"      => "sk_test_dpZfZOY58ChE6bcVEfLiR6k1",
  "publishable_key" => "pk_test_n7Eur6mQNPLlQwld5Tb3L7Cz"
);

\Stripe\Stripe::setApiKey($stripe['secret_key']);
?>
