<?php

namespace App\Service;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class EncodeToCsv
{
    public function encode(array $headers, array $jsonDecoded): string
    {
        $encoders = [new CsvEncoder()];
        $normalizers = [ new ObjectNormalizer() ];
        $serializer = new Serializer($normalizers, $encoders);

        $options = ['csv_headers' => $headers];
        $csv = $serializer->encode($jsonDecoded, 'csv', $options);

        return $csv;
    }
}
