<?php
// Components
define("COMPONENTS_DIR", "components/");
include_once __DIR__ . '/lib/component-helper.php';
// Database
require_once __DIR__ . '/lib/db-helper.php';
// ParseDown
require_once __DIR__ . '/lib/Parsedown.php';
// Timezone
date_default_timezone_set('Europe/Stockholm');
