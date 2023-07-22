<?php

if (!function_exists('filterByLinkQuery')) {

    function filterByLinkQuery($link, $key , $value = null )
    {
        $data = Request()->all();
        $query='?';
        $data[$key] = $value;
        foreach ($data as $key => $value) {
            if ($value == null) {
                unset($data[$key]);
            }
            $query .= $key . '=' . $value . '&';

        }
        return $link . $query . "#products";
    }
}


