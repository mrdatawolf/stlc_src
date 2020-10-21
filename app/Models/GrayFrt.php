<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class GrayFrt
 * @property $id;
 * @property $town;
 * @property $miles;
 * @property $rate;
 * @property $value;
 *
 * @package App\Models
 */
class GrayFrt extends Model
{
    public $fillable = ['town', 'miles', 'rate', 'value'];
    public $timestamps = true;
    protected $table = 'gray_frt';
    protected $primaryKey = 'id';
    protected $connection = 'sqlite';
}
