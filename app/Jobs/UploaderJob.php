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
        $meta = [];

        try {
            $fullPath = storage_path("app/public/{$this->folderFile->path}");

            if ($this->folderFile->kind === 'image') {
                $imageInfo = getimagesize($fullPath);
                $meta = [
                    'width'  => $imageInfo[0] ?? null,
                    'height' => $imageInfo[1] ?? null,
                ];

                $thumb50Path  = $this->makeThumbnail($fullPath, 50, 50, 'thumb_50x50');
                $thumb250Path = $this->makeThumbnail($fullPath, 250, 250, 'thumb_250x250');

                $meta['thumbnails'] = [
                    '50x50'   => str_replace(storage_path("app/public/"), '', $thumb50Path),
                    '250x250' => str_replace(storage_path("app/public/"), '', $thumb250Path),
                ];
            } else {
                $ffprobe = \FFMpeg\FFProbe::create();
                $duration = $ffprobe->format($fullPath)->get('duration');
                $videoStream = $ffprobe->streams($fullPath)->videos()->first();

                $meta = [
                    'width'   => $videoStream?->get('width'),
                    'height'  => $videoStream?->get('height'),
                    'duration'=> $duration,
                    'codec'   => $videoStream?->get('codec_name'),
                ];

                $thumbPath = "folders/video_thumb_{$this->folderFile->id}.jpg";
                \FFMpeg::fromDisk('public')
                    ->open($this->folderFile->path)
                    ->getFrameFromSeconds(1)
                    ->export()
                    ->toDisk('public')
                    ->save($thumbPath);

                $meta['thumbnail'] = $thumbPath;
            }

            $this->folderFile->update([
                'meta'   => $meta,
                'status' => 'completed'
            ]);

        } catch (\Throwable $e) {
            // If something fails, mark as failed
            $this->folderFile->update([
                'status' => 'failed',
                'meta'   => ['error' => $e->getMessage()]
            ]);
        }
    }

    protected function makeThumbnail(string $fullPath, int $width, int $height, string $suffix)
    {
        $manager = new ImageManager(new Driver());
        $img = $manager->read($fullPath) ->cover($width, $height, 'center') // crop to center and fit exactly
    ->encodeByExtension('png');

        $dirname = pathinfo($fullPath, PATHINFO_DIRNAME);
        $filename = pathinfo($fullPath, PATHINFO_FILENAME);
        $extension = pathinfo($fullPath, PATHINFO_EXTENSION);

        $thumbPath = "{$dirname}/{$filename}_{$suffix}.{$extension}";
        $img->save($thumbPath);
        return $thumbPath;
    }
}
