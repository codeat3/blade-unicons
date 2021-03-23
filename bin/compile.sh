#!/usr/bin/env bash

set -e

# prepare the source of icons by cloning the repo
TEMP_DIR=blade-icon-temp-dir
DIRECTORY=$(cd `dirname $0` && pwd)

mkdir -p $TEMP_DIR
SOURCE=$TEMP_DIR/unicons
# git clone git@github.com:Iconscout/unicons.git $TEMP_DIR/unicons
cd $SOURCE
git pull
cd $DIRECTORY/../
RESOURCES=$DIRECTORY/../resources/svg

echo $SOURCE
echo "Reading categories"
for CATEGORY_DIR in $SOURCE/svg/*; do
    echo "Reading icons..."
    echo $CATEGORY_DIR
    CATEGORY_NAME=${CATEGORY_DIR##*/}
    for ICON_DIR in $CATEGORY_DIR/*; do
        # Category Directory Path
        # echo $ICON_DIR
        # exit

        # Icon Name
        ICON_NAME=${ICON_DIR##*/}
        if [[ $CATEGORY_NAME = 'line' ]]
        then
            CONVERTED_ICON_DESTINATION_NAME="${ICON_NAME//\.svg/-o.svg}"
            CP_COMMAND='cp '$ICON_DIR' '$RESOURCES/$CONVERTED_ICON_DESTINATION_NAME
            # $CP_COMMAND
        elif [[ $CATEGORY_NAME = 'monochrome' ]]
        then
            CONVERTED_ICON_DESTINATION_NAME="${ICON_NAME//\.svg/-m.svg}"
            CP_COMMAND='cp '$ICON_DIR' '$RESOURCES/$CONVERTED_ICON_DESTINATION_NAME
            # $CP_COMMAND
        elif [[ $CATEGORY_NAME = 'solid' ]]
        then
            CONVERTED_ICON_DESTINATION_NAME=$ICON_NAME
            CP_COMMAND='cp '$ICON_DIR' '$RESOURCES/$CONVERTED_ICON_DESTINATION_NAME
            $CP_COMMAND
        fi
        # echo $ICON_NAME

    done
done

echo "copied all svgs!"

echo "All Done!"
# echo "Run `php bin/compile.php` to update the svgs"
