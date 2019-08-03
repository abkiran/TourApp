<?php
namespace App\Models;

class City extends Model
{
    /**
     * table name
     *
     * @var string
     */
    public $table = 'city';

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
    protected $fillable = ['name', 'url'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['id'];

    public function selectData($search, $field, $order_by, $order_by_type)
    {
        $data = City::select('id', 'name', 'url');

        if ($search) {
            $data->where($field, 'like', '%' . $search . '%');
        }

        if ($order_by) {
            $data->orderby($order_by, $order_by_type);
        } else {
            $data->orderby('id', 'asc');
        }
        return $data->paginate(20);
    }
}
