#!/usr/bin/php
<?php
echo("Starting build process...\n");
echo("---------------------------------\n");
echo shell_exec('php -f lib/ConstellationFramework/bin/build/includes-css.php');
echo shell_exec('php -f lib/ConstellationFramework/bin/build/includes-js.php');
echo shell_exec('php -f lib/ConstellationFramework/bin/build/includes-models.php');
echo("---------------------------------\n");
echo("Build complete!\n");
?>