<?php

namespace  Modules\Frontend\Model;



use Core\Service\Orm\Database\Eloquent\Model;

class FrontendModel extends Model
{
    protected $table = 'product';
    protected  $fillable = ['id', 'name'];


}