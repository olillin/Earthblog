<!-- Tailwind -->
<script src="/lib/tailwindcss-cdn-3.4.1.js"></script>
<script>
    tailwind.config = {}
</script>
<style type="text/tailwindcss">
    @tailwind base;
    @tailwind components;
    @tailwind utilities;

    @layer base {}
</style>
<?php
// Liftkit
require_once __DIR__ . '/lib/chainlift-liftkit/liftkit.php';
// Components
define("COMPONENTS_DIR", "components/");
include_once __DIR__ . '/lib/component-helper.php';
// Database
require_once __DIR__ . '/lib/db-helper.php';
?>