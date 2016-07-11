#!/bin/bash

for i in {1..500}; do /usr/bin/php /path/to/ps3-manager/html/sql_import.php; sleep 5; done
