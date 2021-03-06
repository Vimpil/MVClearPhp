<?php

define("ROOT", "/var/www/html/MVClearPhp");
define("CONTROLLER_PATH", ROOT. "/controllers/");
define("MODEL_PATH", ROOT. "/models/");
define("VIEW_PATH", ROOT. "/views/");



require_once (ROOT. '/db.php');


require_once (ROOT. '/route.php');


require_once MODEL_PATH. 'Model.php';

require_once VIEW_PATH. 'View.php';



require_once CONTROLLER_PATH. 'Controller.php';



Routing::buildRoute();
