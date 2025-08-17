#!/bin/bash

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

echo -e "${GREEN}Starting Laravel App Deployment on Port 518${NC}"

# Step 1: Navigate to project directory
echo -e "${YELLOW}Step 1: Navigating to project directory...${NC}"
cd /var/www/html/new_learn_app

# Step 2: Stop any existing containers for this project
echo -e "${YELLOW}Step 2: Stopping existing containers...${NC}"
docker-compose down 2>/dev/null || true

# Step 3: Set proper permissions
echo -e "${YELLOW}Step 3: Setting file permissions...${NC}"
sudo chown -R $USER:$USER .
chmod -R 755 .
chmod -R 775 storage bootstrap/cache

# Step 4: Fix git configuration
echo -e "${YELLOW}Step 4: Configuring git...${NC}"
git config --global --add safe.directory /var/www/html/new_learn_app

# Step 5: Backup existing .env and create new one
echo -e "${YELLOW}Step 5: Configuring environment...${NC}"
if [ -f .env ]; then
    cp .env .env.backup.$(date +%Y%m%d_%H%M%S)
fi

# Create the properly configured .env file
cat > .env << 'EOF'
APP_NAME="Natsave AML | Learn App"
APP_ENV=production
APP_KEY=base64:IXP9rpOwzT0hKuRDnnhTF/lk0QK6ZO6VV9pknOdRqwQ=
APP_DEBUG=false
APP_TIMEZONE=UTC
APP_URL=http://102.23.120.249:518

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

APP_MAINTENANCE_DRIVER=file
APP_MAINTENANCE_STORE=database

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=learn_mysql_db
DB_PORT=3306
DB_DATABASE=learn_app_518
DB_USERNAME=learn_user
DB_PASSWORD=learn_pass_518

CACHE_DRIVER=file
CACHE_STORE=file
CACHE_PREFIX=learn_app_cache_
SESSION_DRIVER=file
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

QUEUE_CONNECTION=database
BROADCAST_CONNECTION=log
FILESYSTEM_DISK=public

LIVEWIRE_UPLOAD_PATH=livewire-tmp
LIVEWIRE_UPLOAD_DISK=local
LIVEWIRE_TEMPORARY_FILE_UPLOAD_DISK=local
LIVEWIRE_TEMPORARY_FILE_UPLOAD_DIRECTORY=livewire-tmp

UPLOAD_MAX_FILESIZE=50M
POST_MAX_SIZE=60M
MAX_FILE_UPLOADS=20

MAIL_MAILER=log
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

VITE_APP_NAME="${APP_NAME}"

OPEN_SANCTIONS_API_KEY=69c2cedca0bea99a972de11e28791d57
YENTE_API_URL=http://127.0.0.1:8000

ACTIVITY_TRACKING_ENABLED=true
ACTIVITY_LOG_IP=true
ACTIVITY_LOG_USER_AGENT=true
ACTIVITY_CLEANUP_DAYS=365
VIDEO_PROGRESS_INTERVAL=5

MEMCACHED_HOST=127.0.0.1
EOF

# Step 6: Build and start containers
echo -e "${YELLOW}Step 6: Building and starting Docker containers...${NC}"
docker-compose up -d --build

# Step 7: Wait for MySQL to be ready
echo -e "${YELLOW}Step 7: Waiting for MySQL to initialize...${NC}"
sleep 60

# Step 8: Run post-deployment commands
echo -e "${YELLOW}Step 8: Running Laravel setup commands...${NC}"
docker-compose exec -T learn_web_app php artisan key:generate --force
docker-compose exec -T learn_web_app php artisan migrate --force
docker-compose exec -T learn_web_app php artisan db:seed --force
docker-compose exec -T learn_web_app php artisan storage:link

# Step 9: Reset admin password for testing
echo -e "${YELLOW}Step 9: Setting up admin user...${NC}"
docker-compose exec -T learn_web_app php artisan tinker --execute="
\$admin = \App\Models\User::find(1);
if(\$admin) {
    \$admin->password = bcrypt('password');
    \$admin->save();
    echo 'Admin password reset successfully';
}
"

# Step 10: Assign modules to admin
echo -e "${YELLOW}Step 10: Assigning modules to admin user...${NC}"
docker-compose exec -T learn_web_app php artisan tinker --execute="
\$modules = DB::table('modules')->pluck('id');
foreach(\$modules as \$moduleId) {
    \$exists = DB::table('module_user')
        ->where('user_id', 1)
        ->where('module_id', \$moduleId)
        ->exists();
    if(!\$exists) {
        DB::table('module_user')->insert([
            'user_id' => 1,
            'module_id' => \$moduleId,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
echo 'Modules assigned to admin';
"

# Step 11: Clear all cache
echo -e "${YELLOW}Step 11: Clearing cache...${NC}"
docker-compose exec -T learn_web_app php artisan config:clear
docker-compose exec -T learn_web_app php artisan cache:clear
docker-compose exec -T learn_web_app php artisan route:clear
docker-compose exec -T learn_web_app php artisan view:clear
docker-compose exec -T learn_web_app php artisan config:cache

# Step 12: Check container status
echo -e "${YELLOW}Step 12: Checking container status...${NC}"
docker-compose ps

# Step 13: Open firewall ports
echo -e "${YELLOW}Step 13: Configuring firewall...${NC}"
sudo ufw allow 518/tcp
sudo ufw allow 9518/tcp

# Final message
echo -e "${GREEN}========================================${NC}"
echo -e "${GREEN}Deployment Complete!${NC}"
echo -e "${GREEN}========================================${NC}"
echo -e "Main App: ${GREEN}http://102.23.120.249:518${NC}"
echo -e "phpMyAdmin: ${GREEN}http://102.23.120.249:9518${NC}"
echo -e ""
echo -e "Login Credentials:"
echo -e "Email: ${GREEN}admin@natsave.co.zm${NC}"
echo -e "Password: ${GREEN}password${NC}"
echo -e ""
echo -e "Database Access (phpMyAdmin):"
echo -e "Server: ${GREEN}learn_mysql_db${NC}"
echo -e "Username: ${GREEN}learn_user${NC}"
echo -e "Password: ${GREEN}learn_pass_518${NC}"
echo -e "Database: ${GREEN}learn_app_518${NC}"
echo -e "${GREEN}========================================${NC}"