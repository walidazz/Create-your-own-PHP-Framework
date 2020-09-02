<?php

// $name = isset($_GET['name']) ? $_GET['name'] : 'Walid';

$name = $request->query->get('name', 'Walid');

?>

Hello <?=htmlspecialchars($name, ENT_QUOTES)?>

