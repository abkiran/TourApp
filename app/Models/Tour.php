<?php
namespace App\Models;

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
     * Tours Location 
     *
     * @return void
     */
    public function tourLocation()
    {
        return $this->hasOne('\App\Models\Location', 'id', 'location_id')->with(['locationCity']);
    }

    /**
     * Tours Seo
     *
     * @return void
     */
    public function tourSeo()
    {
        return $this->hasOne('\App\Models\Seo', 'id', 'seo_id');
    }
}
