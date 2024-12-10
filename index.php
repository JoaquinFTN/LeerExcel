<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>2DAW 24-25</title>
        <link rel="stylesheet" href="style.css"/>
    </head>
    <body>
        <?php

            require 'vendor/autoload.php';

            use PhpOffice\PhpSpreadsheet\IOFactory;
            use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
            
                // Carga el archivo de Excel
                $filePath = 'Lista 2DAW 24-25.xlsx';
                $spreadsheet = IOFactory::load($filePath);

                // Selecciona la primera hoja
                $hoja = $spreadsheet->getActiveSheet();

                // Obtener el número máximo de fila y columna
                $filaMaxima = $hoja->getHighestRow(); // Número de fila más alto
                $maximaColumna = $hoja->getHighestColumn(); // Letra de la columna más alta
                $maximaColumnaIndice = Coordinate::columnIndexFromString($maximaColumna); // Índice numérico de la columna más alta

                // Iterar solo sobre las filas y columnas que contienen datos
                for ($i = 1; $i <= $filaMaxima; $i++) {
                    $fila = [];
                    for ($j = 1; $j <= $maximaColumnaIndice; $j++) {
                        // Convierte el índice de columna a su equivalente en letra (A, B, C...)
                        $celda = $hoja->getCell(Coordinate::stringFromColumnIndex($j) . $i)->getValue();
                        $fila[] = $celda ? $celda : ''; // Agregar la celda solo si no está vacía
                    }
                    // Imprime la fila si no está vacía
                    if (array_filter($fila)) { // Esta línea omite las filas completamente vacías
                        echo implode(" ", $fila) . PHP_EOL;
                        echo '<br>';
                    }
                }
        ?>
    </body>
</html>
    