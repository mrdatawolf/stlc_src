<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Orders
 * @property $id;
 * @property $name;
 * @property $released;
 * @property $need_re;
 * @property $order_number;
 * @property $po_number;
 * @property $quantity;
 * @property $thick;
 * @property $width;
 * @property $length;
 * @property $grade;
 * @property $mill;
 * @property $frt;
 * @property $total;
 *
 * @package App\Models
 */
class Orders extends Model
{
    public $fillable = ['name', 'released', 'need_re', 'order_number', 'po_number', 'quantity', 'thick', 'width', 'length', 'grade', 'mill', 'frt', 'total'];
    public $timestamps = true;
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $connection = 'sqlite';
}
