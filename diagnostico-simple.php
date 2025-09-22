<?php
// Script simple para diagnosticar el problema de imágenes
// Ejecutar desde el navegador: https://jugueria.curceando.es/diagnostico-simple.php

echo "<h1>🔍 DIAGNÓSTICO DE IMÁGENES</h1>";
echo "<pre>";

// 1. Verificar ubicación actual
echo "1. UBICACIÓN ACTUAL:\n";
echo getcwd() . "\n\n";

// 2. Verificar si el directorio storage existe
echo "2. VERIFICANDO STORAGE:\n";
$storagePath = __DIR__ . '/storage';
if (is_dir($storagePath)) {
    echo "✓ Directorio storage existe\n";
    
    $storageAppPath = $storagePath . '/app';
    if (is_dir($storageAppPath)) {
        echo "✓ Directorio storage/app existe\n";
        
        $storageAppPublicPath = $storageAppPath . '/public';
        if (is_dir($storageAppPublicPath)) {
            echo "✓ Directorio storage/app/public existe\n";
            
            $productosPath = $storageAppPublicPath . '/productos';
            if (is_dir($productosPath)) {
                echo "✓ Directorio productos existe\n";
                
                $images = scandir($productosPath);
                $imageFiles = array_filter($images, function($file) {
                    return !in_array($file, ['.', '..']) && preg_match('/\.(jpg|jpeg|png|gif)$/i', $file);
                });
                
                echo "Imágenes encontradas: " . count($imageFiles) . "\n";
                if (count($imageFiles) > 0) {
                    echo "Primeras 5 imágenes:\n";
                    foreach (array_slice($imageFiles, 0, 5) as $image) {
                        echo "  - $image\n";
                    }
                }
            } else {
                echo "✗ Directorio productos NO existe\n";
            }
        } else {
            echo "✗ Directorio storage/app/public NO existe\n";
        }
    } else {
        echo "✗ Directorio storage/app NO existe\n";
    }
} else {
    echo "✗ Directorio storage NO existe\n";
}

echo "\n3. VERIFICANDO ENLACE SIMBÓLICO:\n";
$publicStoragePath = __DIR__ . '/public/storage';
if (is_link($publicStoragePath)) {
    echo "✓ Enlace simbólico existe\n";
    echo "Apunta a: " . readlink($publicStoragePath) . "\n";
    
    $targetPath = readlink($publicStoragePath);
    if (is_dir($targetPath)) {
        echo "✓ Destino del enlace existe\n";
    } else {
        echo "✗ Destino del enlace NO existe\n";
    }
} else {
    echo "✗ Enlace simbólico NO existe\n";
}

echo "\n4. VERIFICANDO CÓDIGO ACTUAL:\n";
$indexFile = __DIR__ . '/resources/views/productos/index.blade.php';
if (file_exists($indexFile)) {
    $content = file_get_contents($indexFile);
    if (strpos($content, 'storage/app/public') !== false) {
        echo "✓ Código usa ruta /storage/app/public/\n";
    } else {
        echo "✗ Código NO usa ruta /storage/app/public/\n";
    }
    
    if (strpos($content, 'Storage::url') !== false) {
        echo "⚠️  Código aún usa Storage::url()\n";
    } else {
        echo "✓ Código NO usa Storage::url()\n";
    }
} else {
    echo "✗ Archivo index.blade.php NO existe\n";
}

echo "\n5. PROBANDO ACCESO WEB:\n";
$testImage = '6HbjjxWzZlDwoduetw6PlV5qK2KThBNHF3sloT56.jpg';
$baseUrl = 'https://jugueria.curceando.es';

$testUrls = [
    "$baseUrl/storage/productos/$testImage",
    "$baseUrl/storage/app/public/productos/$testImage",
    "$baseUrl/jugueria/storage/productos/$testImage",
    "$baseUrl/jugueria/storage/app/public/productos/$testImage"
];

foreach ($testUrls as $url) {
    $headers = @get_headers($url);
    if ($headers && strpos($headers[0], '200') !== false) {
        echo "✓ $url - ACCESIBLE\n";
    } else {
        echo "✗ $url - NO ACCESIBLE\n";
    }
}

echo "\n6. INTENTANDO CREAR ENLACE SIMBÓLICO:\n";
if (!is_link($publicStoragePath)) {
    $target = __DIR__ . '/storage/app/public';
    if (symlink($target, $publicStoragePath)) {
        echo "✓ Enlace simbólico creado exitosamente\n";
    } else {
        echo "✗ Error al crear enlace simbólico\n";
        echo "Error: " . error_get_last()['message'] . "\n";
    }
} else {
    echo "✓ Enlace simbólico ya existe\n";
}

echo "\n=== DIAGNÓSTICO COMPLETADO ===\n";
echo "</pre>";

echo "<h2>📋 INSTRUCCIONES:</h2>";
echo "<p>1. Copia todo el resultado de arriba</p>";
echo "<p>2. Pégalo en el chat para análisis</p>";
echo "<p>3. Si hay errores, los solucionaremos paso a paso</p>";
?>
