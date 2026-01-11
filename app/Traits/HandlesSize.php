<?php

namespace App\Traits;

trait HandlesSize
{
    public function formatBytes($bytes, $precision = 2)
    {
        if ($bytes <= 0) {
            return [
                'size' => 0,
                'unit' => 'Byte',
                'bytes' => 0
            ];
        }

        $units = ['Byte', 'KB', 'MB', 'GB', 'TB'];
        $base = floor(log($bytes, 1024));
        $value = $bytes / pow(1024, $base);

        return [
            'size' => round($value, $precision),
            'unit'  => ($base === 0 && $bytes === 1) ? 'Byte' : $units[$base] . ($base === 0 ? 's' : ''),
            'bytes' => $bytes
        ];
    }
}
