<?php

namespace App\Support;

use Illuminate\Support\Facades\File;

class ProdVite
{
    public function links(array $entries): string
    {
        $manifestPath = public_path('build/manifest.json');
        if (!File::exists($manifestPath)) {
            return '<!-- prodvite: manifest not found, run `npm run build` -->';
        }

        $manifest = json_decode(File::get($manifestPath), true);
        $base = asset('build');

        $out = '';
        foreach ($entries as $entry) {
            $entry = trim($entry, " '\"");
            if (!isset($manifest[$entry])) {
                continue;
            }
            $file = $manifest[$entry]['file'];
            if (str_ends_with($entry, '.css')) {
                $out .= '<link rel="stylesheet" href="' . $base . '/' . $file . '">' . "\n";
            } else {
                $out .= '<script type="module" src="' . $base . '/' . $file . '"></script>' . "\n";
            }
        }

        return $out;
    }
}
