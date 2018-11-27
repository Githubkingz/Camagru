<?php

print_r(PDO::getAvailableDrivers());

if (in_array("mysql",PDO::getAvailableDrivers()))
{
    echo "You have PDO for MySQL driver installed";
}
else
{
    echo "You don't have the drivers installed";
}

?>