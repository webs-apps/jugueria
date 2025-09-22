<?php
// Script para crear el enlace simbólico correcto
echo "<h1>🔧 ARREGLANDO ENLACE SIMBÓLICO</h1>";
echo "<pre>";

$publicStoragePath = __DIR__ . '/public/storage';
$targetPath = __DIR__ . '/storage/app/public';

echo "1. Verificando rutas:\n";
echo "Enlace simbólico: $publicStoragePath\n";
echo "Destino: $targetPath\n\n";

echo "2. Verificando si el destino existe:\n";
if (is_dir($targetPath)) {
    echo "✓ Directorio destino existe\n";
    
    echo "3. Verificando contenido del destino:\n";
    $files = scandir($targetPath);
    foreach ($files as $file) {
        if ($file != '.' && $file != '..') {
            echo "  - $file\n";
        }
    }
} else {
    echo "✗ Directorio destino NO existe\n";
}

echo "\n4. Verificando enlace simbólico actual:\n";
if (is_link($publicStoragePath)) {
    echo "✓ Enlace simbólico existe\n";
    echo "Apunta a: " . readlink($publicStoragePath) . "\n";
    
    // Verificar si el destino del enlace existe
    $linkTarget = readlink($publicStoragePath);
    if (is_dir($linkTarget)) {
        echo "✓ Destino del enlace existe\n";
    } else {
        echo "✗ Destino del enlace NO existe\n";
    }
} else {
    echo "✗ Enlace simbólico NO existe\n";
}

echo "\n5. Eliminando enlace simbólico existente (si existe):\n";
if (is_link($publicStoragePath) || file_exists($publicStoragePath)) {
    if (unlink($publicStoragePath)) {
        echo "✓ Enlace simbólico eliminado\n";
    } else {
        echo "✗ Error al eliminar enlace simbólico\n";
    }
} else {
    echo "✓ No hay enlace simbólico que eliminar\n";
}

echo "\n6. Creando nuevo enlace simbólico:\n";
if (symlink($targetPath, $publicStoragePath)) {
    echo "✓ Enlace simbólico creado exitosamente\n";
    
    echo "\n7. Verificando nuevo enlace:\n";
    if (is_link($publicStoragePath)) {
        echo "✓ Enlace simbólico funciona\n";
        echo "Apunta a: " . readlink($publicStoragePath) . "\n";
        
        // Probar acceso a una imagen
        echo "\n8. Probando acceso a imagen:\n";
        $testImage = 'productos/dEnPB5ovVChpWiwNw4OLhIQhzLPZAmTVRtkJenNd.png';
        $imagePath = $publicStoragePath . '/' . $testImage;
        
        if (file_exists($imagePath)) {
            echo "✓ Imagen accesible vía enlace simbólico\n";
        } else {
            echo "✗ Imagen NO accesible vía enlace simbólico\n";
        }
        
        // Probar URL
        echo "\n9. Probando URL:\n";
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

echo "<h2>📋 INSTRUCCIONES:</h2>";
echo "<p>1. Copia todo el resultado de arriba</p>";
echo "<p>2. Pégalo en el chat para verificar</p>";
echo "<p>3. Luego prueba crear un producto con imagen</p>";
?>
