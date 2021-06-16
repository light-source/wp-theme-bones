#!/bin/bash

######## arguments

# 1. testType = all*, codeception, testcafe
# 2. isDebug = 0*, 1

testType="all"
isDebug=0

if [ -n "$1" ]; then
  testType=$1
fi

if [ -n "$2" ]; then
  isDebug=$2
fi

######## variables

dbHost=""
dbSiteName=""
dbTestName=""
dbUser=""
dbPassword=""
siteUrl="http://theme.loc"
siteDomain="theme.loc"

relativePathToWpRoot="../../../.."
relativePathToCodeception="../tests/codeception"
relativePathToTestcafe="../tests/testcafe"
relativePathToCodeceptionBin="../vendors/vendor/bin/codecept"
parentPath=$(
  cd "$(dirname "${BASH_SOURCE[0]}")" || exit
  pwd -P
)
exitStatus=0

######## functions

function _escape() {

  local var=$1

  result=$(printf '%s\n' "$var" | sed 's:[][\\/.^$*"]:\\&:g')

  echo "$result"

}

# for acceptance & wpunit tests
function _makeCodeceptionEnvironmentConfig() {

  local pathToCodeception=$1
  local parentPath=$2
  local dbHost=$3
  local dbTestName=$4
  local dbUser=$5
  local dbPassword=$6
  local siteUrl
  siteUrl=$(_escape "$7")
  local siteDomain=$8

  cd "$pathToCodeception" || exit

  cp .env.testing .env.testing.copy
  sed -i "s/\$HOST/$dbHost/g" .env.testing
  sed -i "s/\$DB/$dbTestName/g" .env.testing
  sed -i "s/\$USER/$dbUser/g" .env.testing
  sed -i "s/\$PASS/$dbPassword/g" .env.testing
  sed -i "s/\$URL/$siteUrl/g" .env.testing
  sed -i "s/\$DOMAIN/$siteDomain/g" .env.testing

  cd "$parentPath" || exit

}

function _restoreCodeceptionEnvironmentConfig() {

  local pathToCodeception=$1
  local parentPath=$2

  cd "$pathToCodeception" || exit
  mv .env.testing.copy .env.testing -f
  cd "$parentPath" || exit

}

# for acceptance tests (because there is no htaccess in git by default)
function _makeHtaccess() {

  local pathToWpRoot=$1
  local parentPath=$2

  cd "$pathToWpRoot" || exit

  if [[ -f ".htaccess" ]]; then
    cp .htaccess .htaccess.copy
  fi
  cp .htaccess.sample .htaccess

  cd "$parentPath" || exit

}

function _restoreHtaccess() {

  local pathToWpRoot=$1
  local parentPath=$2

  cd "$pathToWpRoot" || exit

  if [[ -f ".htaccess.copy" ]]; then
    mv .htaccess.copy .htaccess -f
  fi

  cd "$parentPath" || exit

}

# for acceptance tests (because there is no config in git by default)
function _makeWpConfig() {

  local pathToWpRoot=$1
  local parentPath=$2
  local dbHost=$3
  local dbSiteName=$4
  local dbUser=$5
  local dbPassword=$6

  cd "$pathToWpRoot" || exit

  if [[ -f "wp-config.php" ]]; then
    cp wp-config.php wp-config.php.copy
  fi
  cp wp-config-sample.php wp-config.php
  sed -i "s/localhost/$dbHost/g" wp-config.php
  sed -i "s/database_name_here/$dbSiteName/g" wp-config.php
  sed -i "s/username_here/$dbUser/g" wp-config.php
  sed -i "s/password_here/$dbPassword/g" wp-config.php

  cd "$parentPath" || exit

}

function _restoreWpConfig() {

  local pathToWpRoot=$1
  local parentPath=$2

  cd "$pathToWpRoot" || exit

  if [[ -f "wp-config.php.copy" ]]; then
    mv wp-config.php.copy wp-config.php -f
  fi

  cd "$parentPath" || exit

}

function _runCodeception() {

  local pathToCodeceptionBin=$1
  local pathToCodeception=$2
  local isDebug=$3
  local arguments=""

  if [ "$isDebug" -eq 1 ]; then
    arguments="--debug"
  fi

  php "$pathToCodeceptionBin" run "$arguments" -c "$pathToCodeception" --xml

  # return instead of 'echo $?' because the main function also can have an output
  return $?

}

function _runTestcafe() {

  local pathToTestcafe=$1
  local parentPath=$2

  cd "$pathToTestcafe" || exit

  npx testcafe -c 4
  result=$?

  cd "$parentPath" || exit

  # return instead of 'echo $?' because the main function also can have an output
  return $result

}

######## script

dbPassword=$(_escape "$dbPassword")
cd "$parentPath" || exit

_makeCodeceptionEnvironmentConfig "$relativePathToCodeception" "$parentPath" "$dbHost" "$dbTestName" "$dbUser" "$dbPassword" "$siteUrl" "$siteDomain"
_makeHtaccess "$relativePathToWpRoot" "$parentPath"
_makeWpConfig "$relativePathToWpRoot" "$parentPath" "$dbHost" "$dbSiteName" "$dbUser" "$dbPassword"

if [ $exitStatus -eq 0 ] && { [ "all" == "$testType" ] || [ "codeception" == "$testType" ]; }; then

  _runCodeception "$relativePathToCodeceptionBin" "$relativePathToCodeception" "$isDebug"
  exitStatus=$?

fi

if [ $exitStatus -eq 0 ] && { [ "all" == "$testType" ] || [ "testcafe" == "$testType" ]; }; then

  _runTestcafe "$relativePathToTestcafe" "$parentPath"
  exitStatus=$?

fi

_restoreCodeceptionEnvironmentConfig "$relativePathToCodeception" "$parentPath"
_restoreHtaccess "$relativePathToWpRoot" "$parentPath"
_restoreWpConfig "$relativePathToWpRoot" "$parentPath"

exit "$exitStatus"
