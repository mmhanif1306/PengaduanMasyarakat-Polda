# Deployment Guide - Pengaduan Masyarakat Polda

Panduan lengkap untuk deploy aplikasi Laravel ke Google Compute Engine menggunakan Docker.

## Prerequisites

- Google Cloud Platform account
- Domain name (opsional)
- Cloudinary account untuk file storage

## 1. Setup Google Compute Engine

### Buat VM Instance
```bash
# Buat VM instance dengan spesifikasi minimum
gcloud compute instances create pengaduan-app \
    --zone=asia-southeast2-a \
    --machine-type=e2-medium \
    --boot-disk-size=20GB \
    --boot-disk-type=pd-standard \
    --image-family=ubuntu-2004-lts \
    --image-project=ubuntu-os-cloud \
    --tags=http-server,https-server
```

### Setup Firewall Rules
```bash
# Allow HTTP traffic
gcloud compute firewall-rules create allow-http \
    --allow tcp:80 \
    --source-ranges 0.0.0.0/0 \
    --target-tags http-server

# Allow HTTPS traffic
gcloud compute firewall-rules create allow-https \
    --allow tcp:443 \
    --source-ranges 0.0.0.0/0 \
    --target-tags https-server


```

## 2. Connect ke VM Instance

```bash
# SSH ke instance
gcloud compute ssh pengaduan-app --zone=asia-southeast2-a
```

## 3. Deploy Aplikasi

### Method 1: Menggunakan Script Otomatis

```bash
# Download dan jalankan script deployment
wget https://raw.githubusercontent.com/your-username/PengaduanMasyarakat-Polda/main/deploy.sh
chmod +x deploy.sh
sudo ./deploy.sh
```

### Method 2: Manual Deployment

#### Install Docker dan Docker Compose
```bash
# Update system
sudo apt update && sudo apt upgrade -y

# Install Docker
curl -fsSL https://get.docker.com -o get-docker.sh
sudo sh get-docker.sh
sudo usermod -aG docker $USER

# Install Docker Compose
sudo curl -L "https://github.com/docker/compose/releases/latest/download/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
sudo chmod +x /usr/local/bin/docker-compose

# Logout dan login kembali untuk apply group changes
exit
```

#### Clone Repository
```bash
# SSH kembali ke instance
gcloud compute ssh pengaduan-app --zone=asia-southeast2-a

# Clone repository
git clone https://github.com/your-username/PengaduanMasyarakat-Polda.git
cd PengaduanMasyarakat-Polda
```

#### Setup Environment
```bash
# Copy file environment
cp .env.production .env

# Generate application key
APP_KEY=$(openssl rand -base64 32)
sed -i "s/GENERATE_NEW_KEY_HERE/$APP_KEY/g" .env

# Update domain (ganti dengan domain Anda)
sed -i "s/your-domain.com/your-actual-domain.com/g" .env

# Update Cloudinary URL
sed -i "s|cloudinary://API_KEY:API_SECRET@CLOUD_NAME|your-cloudinary-url|g" .env
```

#### Build dan Start Containers
```bash
# Build containers
docker-compose build

# Start services
docker-compose up -d

# Wait for database to be ready
sleep 30

# Run Laravel setup
docker-compose exec app php artisan key:generate --force
docker-compose exec app php artisan migrate --force
docker-compose exec app php artisan config:cache
docker-compose exec app php artisan route:cache
docker-compose exec app php artisan view:cache
```

## 4. Setup SSL dengan Let's Encrypt (Opsional)

```bash
# Install Certbot
sudo apt install certbot python3-certbot-nginx -y

# Dapatkan SSL certificate
sudo certbot --nginx -d your-domain.com

# Setup auto-renewal
sudo crontab -e
# Tambahkan line berikut:
# 0 12 * * * /usr/bin/certbot renew --quiet
```

## 5. Monitoring dan Maintenance

### Check Status Containers
```bash
docker-compose ps
docker-compose logs app
```

### Backup Database
```bash
# Database backup is handled through Supabase dashboard
# You can also use pg_dump if you have direct access:
# pg_dump your_supabase_connection_string > backup_$(date +%Y%m%d_%H%M%S).sql

# For restore, use Supabase dashboard or:
# psql your_supabase_connection_string < backup_file.sql
```

### Update Aplikasi
```bash
# Pull latest changes
git pull origin main

# Rebuild containers
docker-compose build --no-cache
docker-compose up -d

# Run migrations if needed
docker-compose exec app php artisan migrate --force

# Clear caches
docker-compose exec app php artisan config:cache
docker-compose exec app php artisan route:cache
docker-compose exec app php artisan view:cache
```

## 6. Troubleshooting

### Common Issues

1. **Container tidak start**
   ```bash
   docker-compose logs app
   docker-compose down && docker-compose up -d
   ```

2. **Database connection error**
   ```bash
   # Test database connection
   docker-compose exec app php artisan tinker
   # Then run: DB::connection()->getPdo();
   
   # Check if PostgreSQL extensions are installed
   docker-compose exec app php -m | grep pgsql
   ```

3. **Permission issues**
   ```bash
   docker-compose exec app chown -R www-data:www-data /var/www/html/storage
   docker-compose exec app chmod -R 755 /var/www/html/storage
   ```

4. **Memory issues**
   ```bash
   # Check memory usage
   free -h
   docker stats
   
   # Restart containers
   docker-compose restart
   ```

### Performance Optimization

1. **Enable OPcache**
   - Sudah dikonfigurasi di Dockerfile

2. **Redis caching**
   - Sudah dikonfigurasi untuk session dan cache

3. **Nginx optimization**
   - Gzip compression enabled
   - Static file caching
   - Rate limiting

## 7. Security Checklist

- [ ] Update semua packages secara berkala
- [ ] Setup firewall (UFW)
- [ ] Enable SSL/HTTPS
- [ ] Change default database passwords
- [ ] Setup regular backups
- [ ] Monitor logs untuk aktivitas mencurigakan
- [ ] Disable debug mode di production
- [ ] Setup fail2ban untuk protection

## 8. Monitoring

### Setup Log Monitoring
```bash
# View application logs
docker-compose logs -f app

# View nginx logs
docker-compose exec app tail -f /var/log/nginx/access.log
docker-compose exec app tail -f /var/log/nginx/error.log
```

### Resource Monitoring
```bash
# Monitor resource usage
docker stats
htop
df -h
```

## Support

Jika mengalami masalah, silakan:
1. Check logs terlebih dahulu
2. Restart containers
3. Buat issue di repository GitHub

---

**Note**: Pastikan untuk mengganti semua placeholder (your-domain.com, your-cloudinary-url, dll) dengan nilai yang sesuai untuk environment Anda.