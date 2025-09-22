<?php
// Script para verificar y corregir el problema de imágenes
echo "=== VERIFICANDO PROBLEMA DE IMÁGENES ===\n";

// 1. Verificar si el enlace simbólico existe
$storageLink = __DIR__ . '/public/storage';
if (is_link($storageLink)) {
    echo "✓ Enlace simbólico existe: " . readlink($storageLink) . "\n";
} else {
    echo "✗ Enlace simbólico NO existe\n";
}

// 2. Verificar si las imágenes están en storage
$imagesPath = __DIR__ . '/storage/app/public/productos';
if (is_dir($imagesPath)) {
    $images = scandir($imagesPath);
    $imageFiles = array_filter($images, function($file) {
        return !in_array($file, ['.', '..']) && preg_match('/\.(jpg|jpeg|png|gif)$/i', $file);
    });
    echo "✓ Imágenes encontradas: " . count($imageFiles) . "\n";
    if (count($imageFiles) > 0) {
        echo "  Primera imagen: " . reset($imageFiles) . "\n";
    }
} else {
    echo "✗ Directorio de imágenes NO existe\n";
}

// 3. Verificar acceso web a una imagen
$testImage = '6HbjjxWzZlDwoduetw6PlV5qK2KThBNHF3sloT56.jpg';
$imagePath = $imagesPath . '/' . $testImage;
if (file_exists($imagePath)) {
    echo "✓ Imagen de prueba existe: $testImage\n";
    
    // Probar diferentes URLs
    $baseUrl = 'https://jugueria.curceando.es';
    $urls = [
        "$baseUrl/storage/productos/$testImage",
        "$baseUrl/storage/app/public/productos/$testImage",
        "$baseUrl/jugueria/storage/productos/$testImage",
        "$baseUrl/jugueria/storage/app/public/productos/$testImage"
    ];
    
    echo "Probando URLs:\n";
    foreach ($urls as $url) {
        $headers = @get_headers($url);
        if ($headers && strpos($headers[0], '200') !== false) {
            echo "✓ $url - ACCESIBLE\n";
        } else {
            echo "✗ $url - NO ACCESIBLE\n";
        }
    }
} else {
    echo "✗ Imagen de prueba NO existe\n";
}

// 4. Crear enlace simbólico si no existe
if (!is_link($storageLink)) {
    echo "\n=== CREANDO ENLACE SIMBÓLICO ===\n";
    $target = __DIR__ . '/storage/app/public';
    if (symlink($target, $storageLink)) {
        echo "✓ Enlace simbólico creado exitosamente\n";
    } else {
        echo "✗ Error al crear enlace simbólico\n";
    }
}

echo "\n=== COMPLETADO ===\n";
?>
