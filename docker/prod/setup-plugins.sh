#!/bin/bash

# Activate plugins
wp plugin activate advanced-custom-fields --allow-root
wp plugin activate classic-editor --allow-root
wp plugin activate wp-post-page-clone --allow-root

# Verify installation
wp plugin list --allow-root 