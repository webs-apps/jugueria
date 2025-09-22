#!/bin/bash

echo "=== DIAGNÓSTICO COMPLETO DE IMÁGENES ==="
echo "Fecha: $(date)"
echo ""

# 1. Verificar ubicación actual
echo "1. UBICACIÓN ACTUAL:"
pwd
echo ""

# 2. Verificar si el script de diagnóstico existe
echo "2. VERIFICANDO SCRIPT DE DIAGNÓSTICO:"
if [ -f "fix-images.php" ]; then
    echo "✓ fix-images.php existe"
    echo "Ejecutando script de diagnóstico..."
    php fix-images.php
else
    echo "✗ fix-images.php NO existe"
fi
echo ""

# 3. Verificar cambios en el código
echo "3. VERIFICANDO CÓDIGO ACTUAL:"
echo "Buscando rutas de imágenes en el código:"
grep -n "storage" resources/views/productos/index.blade.php | head -5
echo ""

# 4. Verificar estructura de directorios
echo "4. ESTRUCTURA DE DIRECTORIOS:"
echo "Storage existe:"
ls -la storage/ 2>/dev/null || echo "✗ Directorio storage no existe"
echo ""
echo "Storage/app existe:"
ls -la storage/app/ 2>/dev/null || echo "✗ Directorio storage/app no existe"
echo ""
echo "Storage/app/public existe:"
ls -la storage/app/public/ 2>/dev/null || echo "✗ Directorio storage/app/public no existe"
echo ""

# 5. Verificar imágenes
echo "5. IMÁGENES EN STORAGE:"
if [ -d "storage/app/public/productos" ]; then
    echo "✓ Directorio productos existe"
    echo "Imágenes encontradas:"
    ls -la storage/app/public/productos/ | head -10
    echo "Total de imágenes: $(ls storage/app/public/productos/ | wc -l)"
else
    echo "✗ Directorio productos NO existe"
fi
echo ""

# 6. Verificar enlace simbólico
echo "6. ENLACE SIMBÓLICO:"
if [ -L "public/storage" ]; then
    echo "✓ Enlace simbólico existe"
    echo "Apunta a: $(readlink public/storage)"
    echo "Verificando si el destino existe:"
    if [ -d "$(readlink public/storage)" ]; then
        echo "✓ Destino del enlace existe"
    else
        echo "✗ Destino del enlace NO existe"
    fi
else
    echo "✗ Enlace simbólico NO existe"
fi
echo ""

# 7. Verificar permisos
echo "7. PERMISOS:"
echo "Permisos de storage:"
ls -ld storage/
echo "Permisos de public:"
ls -ld public/
echo ""

# 8. Probar acceso web
echo "8. PROBANDO ACCESO WEB:"
echo "Probando diferentes URLs..."
test_urls=(
    "https://jugueria.curceando.es/storage/productos/6HbjjxWzZlDwoduetw6PlV5qK2KThBNHF3sloT56.jpg"
    "https://jugueria.curceando.es/storage/app/public/productos/6HbjjxWzZlDwoduetw6PlV5qK2KThBNHF3sloT56.jpg"
    "https://jugueria.curceando.es/jugueria/storage/productos/6HbjjxWzZlDwoduetw6PlV5qK2KThBNHF3sloT56.jpg"
)

for url in "${test_urls[@]}"; do
    echo "Probando: $url"
    if curl -s -I "$url" | head -1 | grep -q "200"; then
        echo "✓ ACCESIBLE"
    else
        echo "✗ NO ACCESIBLE"
    fi
done
echo ""

# 9. Verificar caché
echo "9. LIMPIANDO CACHÉ:"
php artisan view:clear
echo "✓ Caché de vistas limpiado"
echo ""

echo "=== DIAGNÓSTICO COMPLETADO ==="
echo "Copia y pega este resultado completo para análisis"
