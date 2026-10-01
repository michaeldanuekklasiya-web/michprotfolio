<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

/**
 * Stores uploads under public/uploads (works on shared hosting without storage:link),
 * downscaled and re-encoded as WebP so the public site stays light.
 */
class ImageUploader
{
    public static function store(UploadedFile $file, string $folder, int $maxWidth = 1600, int $quality = 80): string
    {
        $dir = public_path('uploads/'.$folder);
        File::ensureDirectoryExists($dir);

        $name = now()->format('Ymd').'-'.Str::random(10);
        $source = @imagecreatefromstring(file_get_contents($file->getRealPath()));

        // GD can't read it (e.g. SVG/GIF animation) — keep the original file as-is.
        if (! $source || ! function_exists('imagewebp')) {
            $filename = $name.'.'.$file->extension();
            $file->move($dir, $filename);

            return 'uploads/'.$folder.'/'.$filename;
        }

        $w = imagesx($source);
        $h = imagesy($source);
        $nw = min($w, $maxWidth);
        $nh = (int) round($h * $nw / $w);

        $canvas = imagecreatetruecolor($nw, $nh);
        imagealphablending($canvas, false);
        imagesavealpha($canvas, true);
        imagecopyresampled($canvas, $source, 0, 0, 0, 0, $nw, $nh, $w, $h);

        $filename = $name.'.webp';
        imagewebp($canvas, $dir.'/'.$filename, $quality);
        imagedestroy($source);
        imagedestroy($canvas);

        return 'uploads/'.$folder.'/'.$filename;
    }

    /** Only deletes files we uploaded ourselves; bundled images under img/ are left alone. */
    public static function delete(?string $path): void
    {
        if ($path && str_starts_with($path, 'uploads/')) {
            File::delete(public_path($path));
        }
    }
}
