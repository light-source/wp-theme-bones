#!/bin/bash

# all arguments are passing to codeception
# use --debug flag to see additional info, 'codecept_debug' function to have a custom print

######## variables

dbSiteName="" # for acceptance tests (because there is no config in git by default)
dbTestName=""       # for wpunit tests (to provide path to a test db)
dbUser=""
dbPassword=""
dbHost="localhost"
siteUrl="http://theme.loc"
siteDomain="theme.loc"

relativePathToWpRoot="../../../.."
relativePathToCodeception="../tests/codeception"
relativePathToTestcafe="../tests/testcafe"

######## script

# escape to use in sed
dbPassword=$(printf '%s\n' "$dbPassword" | sed 's:[][\\/.^$*]:\\&:g')
siteUrl=$(printf '%s\n' "$siteUrl" | sed 's:[][\\/.^$*]:\\&:g')
siteDomain=$(printf '%s\n' "$siteDomain" | sed 's:[][\\/.^$*]:\\&:g')

parent_path=$(
  cd "$(dirname "${BASH_SOURCE[0]}")" || exit
  pwd -P
)
exitStatus=1

function makeCodeceptionEnvironmentConfig() {

  cd $relativePathToCodeception || exit
  cp .env.testing .env.testing.copy
  sed -i "s/\$HOST/$dbHost/g" .env.testing
  sed -i "s/\$DB/$dbTestName/g" .env.testing
  sed -i "s/\$USER/$dbUser/g" .env.testing
  sed -i "s/\$PASS/$dbPassword/g" .env.testing
  sed -i "s/\$URL/$siteUrl/g" .env.testing
  sed -i "s/\$DOMAIN/$siteDomain/g" .env.testing
  cd "$parent_path" || exit

}

function restoreCodeceptionEnvironmentConfig() {

  cd $relativePathToCodeception || exit
  mv .env.testing.copy .env.testing -f
  cd "$parent_path" || exit

}

function makeHtaccess() {

  cd "$relativePathToWpRoot" || exit

  if [[ -f ".htaccess" ]]; then
    cp .htaccess .htaccess.copy
  fi
  cp .htaccess.sample .htaccess

  cd "$parent_path" || exit

}

function restoreHtaccess() {

  cd "$relativePathToWpRoot" || exit

  if [[ -f ".htaccess.copy" ]]; then
    mv .htaccess.copy .htaccess -f
  fi

  cd "$parent_path" || exit

}

function makeWpConfig() {

  cd "$relativePathToWpRoot" || exit
  if [[ -f "wp-config.php" ]]; then
    cp wp-config.php wp-config.php.copy
  fi
  cp wp-config-sample.php wp-config.php
  sed -i "s/database_name_here/$dbSiteName/g" wp-config.php
  sed -i "s/username_here/$dbUser/g" wp-config.php
  sed -i "s/password_here/$dbPassword/g" wp-config.php
  sed -i "s/localhost/$dbHost/g" wp-config.php
  cd "$parent_path" || exit

}

function restoreWpConfig() {

  cd "$relativePathToWpRoot" || exit
  if [[ -f "wp-config.php.copy" ]]; then
    mv wp-config.php.copy wp-config.php -f
  fi
  cd "$parent_path" || exit

}

function runCodeception() {
  php ../vendors/vendor/bin/codecept run -c $relativePathToCodeception --xml "$@"
  exitStatus=$?
}

function runTestcafe() {

  cd $relativePathToTestcafe || exit
  npx testcafe -c 4
  exitStatus=$?
  cd "$parent_path" || exit

}

cd "$parent_path" || exit

makeCodeceptionEnvironmentConfig # for acceptance & wpunit tests
makeHtaccess                     # for acceptance tests (because there is no htaccess in git by default)
makeWpConfig                     # for acceptance tests (because there is no config in git by default)

runCodeception "$@"
#if [[ $exitStatus -eq 0 ]]; then
  #runTestcafe
#fi

restoreCodeceptionEnvironmentConfig
restoreHtaccess
#restoreWpConfig

exit $exitStatus
