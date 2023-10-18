<?php


if (!function_exists('comparePayloads')) {

    /**
     * Return the difference of two arrays
     *
     * @param array $firstPayload
     * @param array $secondPayload
     * @return array
     */
    function comparePayloads(array $firstPayload, array $secondPayload): array
    {
        // If the first payload is empty, array_diff will return an empty array
        // To print a result, return the second payload if the first is empty
        if (empty($firstPayload)) {
            return $secondPayload;
        }

        // Serialize if array is multi-dimensional
        $diff = array_diff(
            array_map('serialize', $firstPayload),
            array_map('serialize', $secondPayload),
        );

        return array_map('unserialize', $diff);
    }
}
