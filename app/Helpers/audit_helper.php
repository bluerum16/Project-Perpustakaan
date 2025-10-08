<?php

if (! function_exists('diff_audit_data')) {
    function diff_audit_data(array $old, array $new): array
    {
        $result = [];
        $allKeys = array_unique(array_merge(array_keys($old), array_keys($new)));

        foreach ($allKeys as $key) {
            $oldVal = $old[$key] ?? '';
            $newVal = $new[$key] ?? '';

            $result[] = [
                'field'   => $key,
                'old'     => $oldVal,
                'new'     => $newVal,
                'changed' => $oldVal != $newVal
            ];
        }
        return $result;
    }
}