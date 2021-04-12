<?php
/**
 *=====================================================
 * Majestic Engine - by Zerxa Fun (Majestic Studio)   =
 *-----------------------------------------------------
 * @url: http://majestic-studio.ru/                   -
 *-----------------------------------------------------
 * @copyright: 2020 Majestic Studio and ZerxaFun      -
 *=====================================================
 *                                                    =
 *                                                    =
 *                                                    =
 *=====================================================
 */


namespace Core\Service\Pagination;


/**
 * Class Pagination
 * @package Core\Service\Pagination
 */
class Pagination
{
    /**
     * @var int
     */
    protected int $count;

	/**
	 * Получение общего количества объектов в БД
	 *
	 * @param $query
	 * @return int
	 */
	private function getCount(array $query): int
	{
		$this->count = count($query);

		return $this->count;
	}

	/**
	 * Пагинация с X до Y записей общего количества объектов
	 *
	 * @param array $query
	 * @param string $id
	 * @param int $totalPageItem
	 * @return array
	 */
	public function pagination(array $query, string $id, int $totalPageItem): array
    {
		$allItem = $this->getCount($query);

		# Если передается строка, то выводим первую странциу
		if(ctype_digit($id) === null) {
            $id = '1';
        }

		$totalItem = ceil( $allItem / $totalPageItem );
		$primaryCount = $totalPageItem * ($id - 1);
		$lastCount = $totalPageItem * ($id - 1) + $totalPageItem;

        return [
            'start' 	=> $primaryCount,
            'last' 		=> $lastCount,
            'totalPage' => $totalItem,
            'pageID' => $id
        ];
	}


	/**
	 * Вывод массива пагиации [start_page => 1, this_page = X, total_page = Y, pagination = array,
	 * count_array = count(pagination), mid_start = 3, mid_end = 2, next_page = Z, back_page = I
	 *
	 * @param int $totalPage
	 * @param int $thisPage
	 * @param int $leftLimit
	 * @param int $rightLimit
	 * @return mixed
	 */
	public static function navigation(int $totalPage, int $thisPage, int $leftLimit, int $rightLimit)
	{
		$navigation['start_page'] = 1;
		$navigation['this_page'] = $thisPage;
		$navigation['total_page'] = $totalPage;

		# Если в начале пагиации
		if($thisPage > $leftLimit && $thisPage < ($totalPage - $rightLimit))
			{
				for($i = $thisPage - $leftLimit; $i<=$thisPage + $rightLimit; $i++) {
					$active = 'false';

					if ($i === $thisPage) {
                        $active = 'true';
                    }

					$navigation['pagination'][$i] = [
						'id' => $i,
						'url' => $i,
						'active' => $active
					];
				}

			}

			# Если находися в "середине" пагиации
			elseif($thisPage<=$leftLimit)
			{
				$iSlice = 3 + $leftLimit - $thisPage;

				for ($i = 1; $i <= $thisPage + ($rightLimit + $iSlice); $i++ ) {
					$active = 'false';

					if ($i === $thisPage) {
                        $active = 'true';
                    }

					$navigation['pagination'][$i] = [
						'id' => $i,
						'url' => $i,
						'active' => $active
					];

					if($i === $totalPage) {
                        break;
                    }
				}

			}

			# Если последняя страница пагиации
			else {
				$iSlice = $rightLimit - ($totalPage - $thisPage);
				for($i = 1; $i <= $thisPage + ($rightLimit + $iSlice); $i++ ) {
					$active = 'false';

					if ($i === $thisPage) {
                        $active = 'true';
                    }

					$navigation['pagination'][$i] = [
						'id' => $i,
						'url' => $i,
						'active' => $active
					];

					if($i === $totalPage) {
                        break;
                    }
				}
			}

		$navigation['count_array'] = count($navigation['pagination']);
		$back_page = $thisPage - 1;

		if($back_page === 0) {
            $back_page = 1;
        }

		$next_page = $thisPage + 1;

		if($next_page > $navigation['count_array']) {
            $next_page = $thisPage;
        }

		$navigation['mid_start'] = 3;
		$navigation['mid_end'] = 2;
		$navigation['next_page'] = $next_page;
		$navigation['back_page'] = $back_page;

		return $navigation;
	}
}