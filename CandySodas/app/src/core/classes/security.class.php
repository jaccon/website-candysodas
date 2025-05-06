<?php
class Security {

    public static function inputSanitizer($input, $maxSize = 255) {
        if (is_array($input)) {
            return array_map(function($item) use ($maxSize) {
                return self::inputSanitizer($item, $maxSize);
            }, $input);
        }

        // Limite de tamanho
        if (strlen($input) > $maxSize) {
            return false;
        }

        $input = trim($input);
        $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
        
        // Aplicar a sanitização de comandos SQL completos
        $input = self::sanitizeSqlCommands($input);

        // Remover caracteres inválidos para JSON
        $input = self::sanitizeJsonInput($input);

        return $input;
    }

    private static function sanitizeJsonInput($input) {
        // Remover caracteres que podem corromper o JSON
        $invalidJsonChars = [
            '/[\x00-\x1F\x7F]/',  // Controles ASCII
            '/["\x5C]/'           // Aspas e barras invertidas mal formadas
        ];

        return preg_replace($invalidJsonChars, '', $input);
    }

    private static function sanitizeSqlCommands($input) {
        // Detecta se a string parece ser um comando SQL completo
        $patterns = [
            '/\b(SELECT|INSERT|UPDATE|DELETE|DROP|TRUNCATE|ALTER|CREATE|EXEC|UNION)\b.*\b(FROM|WHERE|SET|LIMIT|VALUES|INTO|ORDER)\b/i', // Comandos SQL válidos com contexto
            '/--/', // Comentários SQL
            '/;/',  // Ponto e vírgula
            '/\b(OR|AND)\b.*\=/i' // Operadores lógicos
        ];

        // Sanitizar comandos SQL completos
        return preg_replace($patterns, '', $input);
    }
}
?>
