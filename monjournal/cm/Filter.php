<?php

namespace cm;

class Filter 
{
    public static function filtreXSS(string $data) : string {
        $balisesOk = "<p><b><i>";
        // On filtre les données entrantes en supprimant les balises HTML non autorisées.
        $filtered_data = strip_tags($data, $balisesOk);

        // ...

        return $filtered_data;
    }
}
