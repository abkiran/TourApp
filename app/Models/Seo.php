<?php
namespace App\Models;

class Seo extends Model
{
    /**
     * table name
     *
     * @var string
     */
    public $table = 'seo';

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
    protected $fillable = ['title', 'description', 'keywords'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['id'];

    public function selectData($search, $field, $order_by, $order_by_type)
    {
        $data = Seo::select('id', 'title', 'description', 'keywords');

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
