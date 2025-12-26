<?php
/**
 * Script temporal para verificar extensiones PHP
 * Eliminar después de verificar
 */

echo "<h2>Verificación de Extensiones PHP</h2>";
echo "<p><strong>PHP Version:</strong> " . PHP_VERSION . "</p>";
echo "<p><strong>php.ini usado:</strong> " . php_ini_loaded_file() . "</p>";

$extensions = ['intl', 'zip', 'gd', 'mbstring', 'curl'];

echo "<h3>Estado de Extensiones:</h3>";
echo "<ul>";
foreach ($extensions as $ext) {
    $loaded = extension_loaded($ext);
    $status = $loaded ? '<span style="color: green;">✓ Cargada</span>' : '<span style="color: red;">✗ NO cargada</span>';
    echo "<li><strong>$ext:</strong> $status</li>";
}
echo "</ul>";

if (extension_loaded('intl')) {
    echo "<p style='color: green;'><strong>✓ La extensión intl está cargada correctamente.</strong></p>";
} else {
    echo "<p style='color: red;'><strong>✗ ERROR: La extensión intl NO está cargada.</strong></p>";
    echo "<p>Por favor, verifica que en php.ini la línea <code>extension=intl</code> no tenga punto y coma (;) al inicio.</p>";
}

