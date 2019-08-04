<?php
namespace App\Models;

use App\Models\Location;
use App\Models\Seo;

class Tour extends Model
{
    /**
     * table name
     *
     * @var string
     */
    public $table = 'tour';

    /**
     * timestamps disabled
     *
     * @var string
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'url', 'description', 'location_id', 'duration', 'is_live', 'is_promoted', 'seo_id', 'booking_count'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['id'];
    
    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['seo', 'location'];

    /**
     * Tours Location 
     *
     * @return void
     */
    public function location()
    {
        return $this->hasOne(Location::class, 'id', 'location_id')->with(['city']);
    }

    /**
     * Tours Seo
     *
     * @return void
     */
    public function seo()
    {
        return $this->hasOne(Seo::class, 'id', 'seo_id');
    }
}
