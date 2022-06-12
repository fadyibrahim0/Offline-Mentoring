<?php

require_once "../../core/config.php";
require_once PATH .  "core/functions.php";
require_once PATH .  "core/sessions.php";

deleteSession('cart');
setSession('success', 'Cart Cleared Successfully!');
redirect(URL . "views/order/add.php");