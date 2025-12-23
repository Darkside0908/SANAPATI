#!/bin/bash

# Post-build script for Railway deployment
# Ensures assets are properly built and accessible

echo "🔨 Post-build checks..."

# Check if public/build exists
if [ -d "public/build" ]; then
    echo "✅ Vite build directory exists"
    ls -la public/build/ | head -n 10
else
    echo "❌ WARNING: public/build directory not found!"
    echo "Running npm run build again..."
    npm run build
fi

# Check manifest
if [ -f "public/build/manifest.json" ] || [ -f "public/build/.vite/manifest.json" ]; then
    echo "✅ Vite manifest found"
else
    echo "❌ WARNING: Vite manifest not found!"
fi

# Set permissions
chmod -R 755 public/build 2>/dev/null || true
chmod -R 755 storage 2>/dev/null || true
chmod -R 755 bootstrap/cache 2>/dev/null || true

echo "✅ Post-build checks complete"
