<?php

include "stripe-php-master/init.php";

$Publishable_key = "pk_test_51Qd3W5Px6HkKfodWoQwjv8Hp1ciweabtFZOQVSX94WsnJDfYt99RMrW04CXLrrOcHiUdj2gUqHr3NY0v1DhTmroM008DbuAanT";
$Secret_key = "sk_test_51Qd3W5Px6HkKfodWjiFXRGvoi5z6WQDyRZXdWFXd5DaxH14fcmJujmuqHHNNGF5DgdKzM8GaSK2GPasl0LrbKVMQ005YxGd3UT";

\Stripe\Stripe::setApiKey($Secret_key);
?>