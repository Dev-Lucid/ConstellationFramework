#!/usr/bin/php
<?php
echo("Starting database build process...\n");
echo("---------------------------------\n");
echo shell_exec('php -f lib/ConstellationFramework/bin/build/db-tables.php');
echo shell_exec('php -f lib/ConstellationFramework/bin/build/db-views.php');
echo shell_exec('php -f lib/ConstellationFramework/bin/build/db-triggers.php');
echo shell_exec('php -f lib/ConstellationFramework/bin/build/db-functions.php');
echo shell_exec('php -f lib/ConstellationFramework/bin/build/db-procedures.php');
echo("---------------------------------\n");
echo("Build complete!\n");

?>