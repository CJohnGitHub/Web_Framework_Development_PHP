<?php
// load classes
// ---------------------------------------
require_once __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();
$templatesPath = __DIR__ . '/../templates';

// register Twig with Silex
// -------------------------
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => $templatesPath
));

// the DatabaseManager class needs the following 4 constants to be defined in order to create the DB connection
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'online_team_project_system');
