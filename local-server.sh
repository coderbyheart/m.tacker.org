#!/bin/bash

export $(eb printenv | grep = | awk '{ print $1 "=" $3; }')

php -S localhost:8080 -t ./ local-server-router.php
