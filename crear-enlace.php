<?php
// Script simple para crear el enlace simbólico
echo "<h1>🔧 CREANDO ENLACE SIMBÓLICO</h1>";
echo "<pre>";

$publicStoragePath = __DIR__ . '/public/storage';
$targetPath = __DIR__ . '/storage/app/public';

echo "1. Eliminando enlace existente...\n";
if (file_exists($publicStoragePath)) {
    unlink($publicStoragePath);
    echo "✓ Enlace eliminado\n";
} else {
    echo "✓ No había enlace que eliminar\n";
}

echo "\n2. Creando nuevo enlace simbólico...\n";
if (symlink($targetPath, $publicStoragePath)) {
    echo "✓ Enlace simbólico creado exitosamente\n";
    echo "De: $publicStoragePath\n";
    echo "A: $targetPath\n";
    
    echo "\n3. Verificando enlace...\n";
    if (is_link($publicStoragePath)) {
        echo "✓ Enlace simbólico funciona\n";
        echo "Apunta a: " . readlink($publicStoragePath) . "\n";
        
        echo "\n4. Probando acceso a imagen...\n";
        $testImage = 'productos/dEnPB5ovVChpWiwNw4OLhIQhzLPZAmTVRtkJenNd.png';
        $imagePath = $publicStoragePath . '/' . $testImage;
        
        if (file_exists($imagePath)) {
            echo "✓ Imagen accesible vía enlace simbólico\n";
        } else {
            echo "✗ Imagen NO accesible vía enlace simbólico\n";
        }
        
        echo "\n5. Probando URL...\n";
        $url = "https://jugueria.curceando.es/storage/productos/dEnPB5ovVChpWiwNw4OLhIQhzLPZAmTVRtkJenNd.png";
        $headers = @get_headers($url);
        if ($headers && strpos($headers[0], '200') !== false) {
            echo "✓ URL accesible: $url\n";
        } else {
            echo "✗ URL NO accesible: $url\n";
        }
        
    } else {
        echo "✗ Error: Enlace simbólico no funciona\n";
    }
} else {
    echo "✗ Error al crear enlace simbólico\n";
    echo "Error: " . error_get_last()['message'] . "\n";
}

echo "\n=== COMPLETADO ===\n";
echo "</pre>";

echo "<h2>🎯 AHORA PRUEBA:</h2>";
echo "<p>1. Crear un nuevo producto con imagen</p>";
echo "<p>2. Verificar si la imagen se muestra correctamente</p>";
?>
