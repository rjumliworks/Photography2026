<?php

namespace App\Jobs;

use FFMpeg;
use App\Models\FolderFile;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver; 

class UploaderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $folderFile;

    public function __construct(FolderFile $folderFile)
    {
        $this->folderFile = $folderFile;
    }

    public function handle()
    {
        try {

            if ($this->folderFile->kind !== 'image') {
                $this->folderFile->update(['status' => 'completed']);
                return;
            }

            $manager = new ImageManager(new Driver());

            $originalFullPath = storage_path(
                "app/public/{$this->folderFile->path}"
            );

            $img = $manager->read($originalFullPath);

            // Paths
            $baseDir  = dirname($this->folderFile->path);
            $name     = pathinfo($this->folderFile->path, PATHINFO_FILENAME);

            $previewPath = "{$baseDir}/previews/{$name}.webp";
            $thumb50Path = "{$baseDir}/thumbs/{$name}_50x50.webp";
            $thumb250Path = "{$baseDir}/thumbs/{$name}_250x250.webp";

            // Ensure directories exist
            foreach ([$previewPath, $thumb50Path, $thumb250Path] as $path) {
                @mkdir(
                    dirname(storage_path("app/public/{$path}")),
                    0755,
                    true
                );
            }

            // Save preview
            $img->encodeByExtension('webp', 85)
                ->save(storage_path("app/public/{$previewPath}"));

            // Thumbnails
            $this->makeThumbnail($previewPath, 50, 50, $thumb50Path);
            $this->makeThumbnail($previewPath, 250, 250, $thumb250Path);

            $this->folderFile->update([
                'meta' => [
                    'width'  => $img->width(),
                    'height' => $img->height(),
                    'preview' => $previewPath,
                    'thumbnails' => [
                        '50x50'   => $thumb50Path,
                        '250x250' => $thumb250Path,
                    ],
                ],
                'status' => 'completed',
            ]);

        } catch (\Throwable $e) {
            $this->folderFile->update([
                'status' => 'failed',
                'meta'   => ['error' => $e->getMessage()],
            ]);
        }
    }

    protected function makeThumbnail(string $source, int $w, int $h, string $target)
    {
        $manager = new ImageManager(new Driver());

        $manager
            ->read(storage_path("app/public/{$source}"))
            ->cover($w, $h)
            ->encodeByExtension('webp', 80)
            ->save(storage_path("app/public/{$target}"));
    }
}
