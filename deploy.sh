#!/bin/bash

# Deployment script for Google Compute Engine
# Make sure to run this script with sudo privileges

set -e

echo "🚀 Starting deployment process..."

# Update system packages
echo "📦 Updating system packages..."
sudo apt-get update
sudo apt-get upgrade -y

# Install Docker and Docker Compose if not already installed
if ! command -v docker &> /dev/null; then
    echo "🐳 Installing Docker..."
    curl -fsSL https://get.docker.com -o get-docker.sh
    sudo sh get-docker.sh
    sudo usermod -aG docker $USER
fi

if ! command -v docker-compose &> /dev/null; then
    echo "🐳 Installing Docker Compose..."
    sudo curl -L "https://github.com/docker/compose/releases/latest/download/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
    sudo chmod +x /usr/local/bin/docker-compose
fi

# Create application directory
echo "📁 Setting up application directory..."
APP_DIR="/var/www/pengaduan-masyarakat"
sudo mkdir -p $APP_DIR
sudo chown $USER:$USER $APP_DIR

# Clone or update repository
if [ -d "$APP_DIR/.git" ]; then
    echo "🔄 Updating existing repository..."
    cd $APP_DIR
    git pull origin main
else
    echo "📥 Cloning repository..."
    git clone https://github.com/your-username/PengaduanMasyarakat-Polda.git $APP_DIR
    cd $APP_DIR
fi

# Copy production environment file
echo "⚙️ Setting up environment..."
cp .env.production .env

# Generate application key
echo "🔑 Generating application key..."
APP_KEY=$(openssl rand -base64 32)
sed -i "s/GENERATE_NEW_KEY_HERE/$APP_KEY/g" .env

# Update domain in .env file
read -p "Enter your domain (e.g., your-domain.com): " DOMAIN
sed -i "s/your-domain.com/$DOMAIN/g" .env

# Setup Cloudinary credentials
read -p "Enter your Cloudinary URL: " CLOUDINARY_URL
sed -i "s|cloudinary://API_KEY:API_SECRET@CLOUD_NAME|$CLOUDINARY_URL|g" .env

# Build and start containers
echo "🏗️ Building Docker containers..."
docker-compose down --remove-orphans
docker-compose build --no-cache

echo "🚀 Starting containers..."
docker-compose up -d

# Wait for services to be ready
echo "⏳ Waiting for services to be ready..."
sleep 15

# Run Laravel setup commands
echo "🔧 Running Laravel setup..."
docker-compose exec -T app php artisan key:generate --force
docker-compose exec -T app php artisan config:cache
docker-compose exec -T app php artisan route:cache
docker-compose exec -T app php artisan view:cache
docker-compose exec -T app php artisan migrate --force

# Set proper permissions
echo "🔒 Setting permissions..."
docker-compose exec -T app chown -R www-data:www-data /var/www/html/storage
docker-compose exec -T app chown -R www-data:www-data /var/www/html/bootstrap/cache

# Setup firewall (optional)
echo "🔥 Setting up firewall..."
sudo ufw allow 22/tcp
sudo ufw allow 80/tcp
sudo ufw allow 443/tcp
sudo ufw --force enable

# Setup SSL with Let's Encrypt (optional)
read -p "Do you want to setup SSL with Let's Encrypt? (y/n): " SETUP_SSL
if [ "$SETUP_SSL" = "y" ]; then
    echo "🔐 Setting up SSL..."
    sudo apt-get install -y certbot
    sudo certbot --nginx -d $DOMAIN
fi

echo "✅ Deployment completed successfully!"
echo "🌐 Your application is now available at: http://$DOMAIN:8000"
echo ""
echo "📝 Next steps:"
echo "1. Update your DNS records to point to this server's IP"
echo "2. Configure your Cloudinary settings in the admin panel"
echo "3. Test all functionality"
echo "4. Setup monitoring and backups"

# Show container status
echo ""
echo "📋 Container status:"
docker-compose ps