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


namespace Core\Service\Sitemap;


use DateTime;
use Exception;


/**
 * Class SiteMap
 * @package Core\App\SiteMap
 */
class Sitemap extends AbstractSitemap {
	/**
	 * Свойство root.
	 *
	 * @var  string
	 */
	protected string $root = 'urlset';

    /**
     * Добавление значения
     *
     * @param string $loc
     * @param string|null $priority
     * @param string|null $changefreq
     * @param string|null $lastmod
     * @return $this
     * @throws Exception
     */
	public function addItem(string $loc, string $priority = null, string $changefreq = null, string $lastmod = null): self
	{
		if ($this->autoEscape) {
			$loc = htmlspecialchars($loc);
		}

		$url = $this->xml->addChild('url');
		$url->addChild('loc', $loc);

		$changefreq ? $url->addChild('changefreq', $changefreq) : null;
		$priority   ? $url->addChild('priority', $priority)     : null;

		if ($lastmod) {
			if (!($lastmod instanceof DateTime)) {
				$lastmod = new DateTime($lastmod);
			}
			$url->addChild('lastmod', $lastmod->format($this->dateFormat));
		}

		return $this;
	}
}
