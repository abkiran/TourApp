<?php
namespace App\Models;

class Location extends Model
{
    /**
     * table name
     *
     * @var string
     */
    public $table = 'location';

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
    protected $fillable = ['name', 'url', 'latitude', 'longitude', 'city_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['id'];

    /**
     * Locations City
     *
     * @return void
     */
    public function locationCity()
    {
        return $this->hasOne('\App\Models\City', 'id', 'city_id')->with(['locationCity']);
    }
}
