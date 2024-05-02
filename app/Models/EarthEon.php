<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class EarthEon extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'eon',
        'era',
        'period',
        'subperiod',
        'epoch',
        'age',
        'base',
        'duration',
        'eon_desc'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images');
    }

    public function getUrl(): ?string
    {
        $media = $this->getFirstMedia('images');

        return $media ? $media['original_url'] : null;
    }

    public function getName(): ?string
    {
        $media = $this->getFirstMedia('images');

        return $media ? $media['name'] : null;
    }
    
}
