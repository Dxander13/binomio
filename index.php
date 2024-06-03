<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de Expansión de Binomios</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Calculadora de Expansión de Binomios</h1>
        <form id="binomialForm" action="index.php" method="post">
            <label for="exponent">Introduce la potencia (n):</label>
            <input type="number" id="exponent" name="exponent" min="0" required>
            <button type="submit">Calcular</button>
        </form>
        <div id="result" class="result">
            <?php
            // Procesar el formulario cuando se envíe
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $n = intval($_POST['exponent']);
                if ($n >= 0) {
                    echo "<h3>Resultado:</h3>";
                    echo "<p>(a + b)^$n = " . expandBinomial($n) . "</p>";
                } else {
                    echo "<p class='error'>Por favor, introduce un número válido para la potencia (n).</p>";
                }
            }

            // Función recursiva para calcular el coeficiente binomial C(n, k)
            function binomialCoefficient($n, $k) {
                if ($k == 0 || $k == $n) {
                    return 1;
                } else {
                    return binomialCoefficient($n - 1, $k - 1) + binomialCoefficient($n - 1, $k);
                }
            }

            // Función para expandir el binomio (a + b)^n
            function expandBinomial($n) {
                $result = "";
                for ($k = 0; $k <= $n; $k++) {
                    $coefficient = binomialCoefficient($n, $k);
                    $aExponent = $n - $k;
                    $bExponent = $k;

                    // Construir el término del binomio
                    $term = ($coefficient == 1 ? "" : $coefficient);
                    if ($aExponent > 0) {
                        $term .= "a";
                        if ($aExponent > 1) {
                            $term .= "^" . $aExponent;
                        }
                    }
                    if ($bExponent > 0) {
                        if ($aExponent > 0) {
                            $term .= "b";
                        } else {
                            $term .= "b";
                        }
                        if ($bExponent > 1) {
                            $term .= "^" . $bExponent;
                        }
                    }

                    // Añadir el término al resultado
                    $result .= ($k == 0 ? "" : " + ") . $term;
                }
                return $result;
            }

            // Función principal para recibir el valor de n y mostrar la expansión
            function mostrarExpansionBinomial($n) {
                echo "(a + b)^$n = " . expandBinomial($n) . "\n";
            }
            ?>
        </div>
    </div>
    
</body>
</html>