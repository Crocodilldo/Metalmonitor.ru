<?php

namespace App\Services\ParsingServices;

class ProductParameterNormalizerService
{
    public function normalize(array $rawInformation): array
    {
        $result = [];

        foreach ($rawInformation as $product) {
            $product = str_replace(['х', 'x', '/'], '*', $product);
            $product = str_replace('мм', '', $product);
            $product = str_replace('.', ',', $product);

            preg_match(
                '/([0-9]+)?,?([0-9]+)?\*?([0-9]+)?,?([0-9]+)?\*?([0-9]+),?([0-9]+)?/',
                $product,
                $matches
            );

            if (empty($matches[0])) {
                $result[] = '';
                continue;
            }

            $parameter = trim($matches[0], ' \,');
            $parameterParts = explode('*', $parameter);
            $parameterParts = str_replace(',', '.', $parameterParts);
            $parameterParts = array_map('floatval', $parameterParts);
            rsort($parameterParts, SORT_NUMERIC);

            $result[] = implode('*', $parameterParts);
        }
        
        return $result;
    }
}
