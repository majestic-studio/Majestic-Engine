<?php


namespace Modules\API\Model;




use Core\Service\Orm\Database\Eloquent\Model;

class ProductModel extends Model
{
    protected $table = 'users';
    protected $fillable = ['name'];
}