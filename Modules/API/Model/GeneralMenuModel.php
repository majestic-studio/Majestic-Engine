<?php


namespace Modules\API\Model;


use Core\Service\Orm\Model;
use Query;

class GeneralMenuModel extends Model
{
    protected static string $table = 'menu_section';

    /**
     * @throws \Exception
     */
    public function getSectionMenu()
    {
        return Query::table(static::$table, __CLASS__)
            ->select(['name', 'icon'])
            ->orderBy('id', 'ASC')
            ->allJson();
    }

}