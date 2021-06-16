#!/bin/bash

######## variables

SERVER_IP=""
SERVER_PORT=""

REMOTE_USER=""
REMOTE_DB=""
REMOTE_PASS=""

LOCAL_USER=""
LOCAL_PASS=""
LOCAL_DB=""

SITE_URL=""

######## script

ssh $REMOTE_USER@$SERVER_IP -p $SERVER_PORT "mysqldump --no-tablespaces --no-create-db -u$REMOTE_USER -p$REMOTE_PASS $REMOTE_DB > ~/dump.sql ; exit"
scp -P $SERVER_PORT $REMOTE_USER@$SERVER_IP:~/dump.sql /tmp/dump.sql
mysql -h localhost -u $LOCAL_USER -p$LOCAL_PASS $LOCAL_DB </tmp/dump.sql
rm /tmp/angama.sql
echo "UPDATE $LOCAL_DB.wp_options SET option_value = '$SITE_URL' WHERE option_name = 'home' OR option_name = 'siteurl'" | mysql -h localhost -u $LOCAL_USER -p$LOCAL_PASS $LOCAL_DB
