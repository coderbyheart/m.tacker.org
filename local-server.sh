#!/bin/bash

export $(eb printenv | grep = | awk '{ print $1 "=" $3; }')
export HTTP_HOST="http://localhost:8080"

php -S localhost:8080 -t ./ local-server-router.php
