<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;


class Post extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasSlug;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'content',
        'featured_image',
        'post_status'
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function save(array $options = []) {
        if (!isset($this->user_id) || !(intval($this->user_id)>0)  ) {
            $this->author_id = auth()->id();
        }
    
        return parent::save($options);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('thumbnail')
            ->fit(Manipulations::FIT_CROP, 300, 300)
            ->nonQueued();
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('post_slug')
            ->skipGenerateWhen(fn () => $this->post_status === 'draft')
            ->doNotGenerateSlugsOnUpdate()->preventOverwrite();
    }

     /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'post_slug';
    }

}
