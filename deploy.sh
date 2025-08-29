#!/bin/bash

# Set the local git repository path
# LOCAL_REPO_PATH="/path/to/your/"

# Set the VPS SSH details (make sure SSH key authentication is set up)
VPS_USER="padail"
VPS_HOST="103.175.221.6"
VPS_REPO_PATH="/var/www/STUNTLESS"

# Navigate to the local git repository
echo "Navigating to local repository..."
# cd $LOCAL_REPO_PATH || { echo "Local repository not found!"; exit 1; }

# Add, commit, and push changes to the remote repository
echo "Pushing changes to remote repository..."
git add . && git commit -m "deploy" && git push origin main

# SSH into the VPS and perform git pull
echo "Pulling latest changes on VPS..."
ssh $VPS_USER@$VPS_HOST << EOF
    cd $VPS_REPO_PATH || { echo "VPS repository not found!"; exit 1; }
    sudo git pull origin main
EOF

echo "Git push and pull completed successfully."
