#!/bin/bash

echo "🔧 Setting up the environment..."

# CRITICAL: Ensure production environment settings
echo "🌍 Setting APP_ENV to production..."
if [ -f .env ]; then
    sed -i 's/^APP_ENV=local/APP_ENV=production/' .env
    sed -i 's/^APP_DEBUG=true/APP_DEBUG=false/' .env
    echo "✅ Environment set to production mode"
fi

echo "🔢 Incrementing APP_VERSION in .env..."
# Check if .env file exists

if [ -f .env ]; then
    # Extract current version
    current_version=$(grep "^APP_VERSION=" .env | cut -d '"' -f2)

    if [ -z "$current_version" ]; then
        # APP_VERSION not found, set default
        echo 'APP_VERSION="1.0"' >> .env
        echo "✅ APP_VERSION not found. Set to default: 1.0"
    elif [[ $current_version =~ ^([0-9]+)\.([0-9]+)$ ]]; then
        major=${BASH_REMATCH[1]}
        minor=${BASH_REMATCH[2]}
        new_minor=$((minor + 1))
        new_version="${major}.${new_minor}"

        # Replace version in .env
        sed -i "s/^APP_VERSION=\"${current_version}\"/APP_VERSION=\"${new_version}\"/" .env

        echo "✅ APP_VERSION updated: $current_version → $new_version"
    else
        echo "⚠️ Could not parse APP_VERSION format: '$current_version'"
    fi
else
    echo "❌ .env file not found."
fi

# CRITICAL: Remove any cached files that may have been uploaded
echo "🗑️ Removing any uploaded cached files (prevents 404 errors)..."
rm -rf bootstrap/cache/*.php 2>/dev/null || true
echo "✅ Old cache files removed"

# CRITICAL: Remove Vite hot file that causes dev server mode
echo "🔥 Removing Vite hot file (forces production asset mode)..."
rm -f public/hot 2>/dev/null || true
echo "✅ Vite hot file removed"

# Fix permissions for Laravel BEFORE running artisan commands
echo "🔐 Setting correct permissions..."
chmod -R 755 .
chmod -R 775 storage bootstrap/cache 2>/dev/null || true

# Set proper ownership (common for web servers)
echo "👤 Setting ownership to www user..."
chown -R www:www . 2>/dev/null || chown -R www-data:www-data . 2>/dev/null || echo "⚠️ Note: Could not change owner (may need manual fix)"

# Ensure storage and cache are writable
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# Laravel production optimizations
if [ -f artisan ]; then
    echo "🔁 Clearing all Laravel caches..."
    php artisan config:clear 2>/dev/null || true
    php artisan cache:clear 2>/dev/null || true
    php artisan route:clear 2>/dev/null || true
    php artisan view:clear 2>/dev/null || true
    
    echo "✅ All caches cleared"
    
    echo "🔁 Optimizing for production..."
    php artisan config:cache
    # NOTE: NOT caching routes because it causes 404 errors with this app structure
    # php artisan route:cache
    php artisan view:cache
    
    echo "✅ Laravel optimization complete (routes NOT cached to prevent 404)"
fi

echo "✅ Setup complete."
echo ""
echo "✨ Deployment successful! Site should be running at your domain."
echo ""
echo "📝 Notes:"
echo "   • Routes are NOT cached (prevents 404 errors)"
echo "   • If you still get 404: Check Nginx config points to $(pwd)/public"
echo "   • For details: See .deploy_tools/.docs/NGINX_CONFIGURATION.md"