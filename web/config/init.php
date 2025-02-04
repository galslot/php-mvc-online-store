<?php

define("DEBUG", 1); // 0 - Prod.

define("ROOT", dirname(__DIR__));
define("WWW", ROOT. "/public");
define("APP", ROOT. "/app");
define("CORE", ROOT. "/core");
define("HELPERS", ROOT. "/core/helpers");
define("VIEWS", ROOT. "/app/views");
define("LAYOUT_DIR", ROOT. "/app/views/layouts");

define("CACHE", ROOT. "/var/cache");
define("LOGS", ROOT. "/var/log");
define("PERMISSION_VAR", 0777);

define("CONFIG", ROOT. "/config");
define("LAYOUT_NAME", "shop");
define("HOME_PAGE", "http://localhost");
define("ADMIN", "http://localhost/admin");
define("UPLOADS", ROOT. "/public/uploads");
define("NO_IMAGE", "uploads/no_image.jpg");

define("DB_HOST", "db8");
define("DB_USER", "root");
define("DB_PASS", "123456");
define("DB_NAME", "framework8");

require_once ROOT. "/vendor/autoload.php";

