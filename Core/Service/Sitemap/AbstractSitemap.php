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
use RuntimeException;
use SimpleXMLElement;


/**
 * Class AbstractSiteMap
 * @package Core\App\SiteMap
 */
abstract class AbstractSitemap
{
	/**
	 * Корень собственности.
	 *
	 * @var  string
	 */
	protected string $root = 'SiteMap';

	/**
	 * Свойство xmlns.
	 *
	 * @var  string
	 */
	protected string $xmlns = 'http://www.sitemaps.org/schemas/sitemap/0.9';

	/**
	 * Кодировка.
	 *
	 * @var  string
	 */
	protected string $encoding = 'utf-8';

	/**
	 * Версия XML.
	 *
	 * @var  string
	 */
	protected string $xmlVersion = '1.0';

	/**
	 * Свойство xml.
	 *
	 */
    protected Sitemap $xml;

	/**
	 * Свойство autoEscape.
	 *
	 * @var  boolean
	 */
	protected bool $autoEscape = true;

	/**
	 * Свойство формата даты.
	 *
	 * @var  string
	 */
	protected string $dateFormat = '';

    /**
     * Клсс инициализации.
     *
     * @param null $xmlns
     * @param string $encoding
     * @param string $XmlVersion
     */
	public function __construct($xmlns = null, $encoding = 'utf-8', $XmlVersion = '1.0')
	{
        if (!empty($xmlns)) {
            $this->xmlns      = $xmlns ? : $this->xmlns;
        }
		$this->encoding   = $encoding;
		$this->xmlVersion = $XmlVersion;

		$this->dateFormat = DateTime::W3C;

		$this->xml = $this->getSimpleXmlElement();
	}

    /**
     * @return SimpleXMLElement
     */
	public function getSimpleXmlElement()
	{
		if (!$this->xml) {
			$this->xml = simplexml_load_string(
				sprintf(
					'<?xml version="%s" encoding="%s"?' . '><%s xmlns="%s" />',
					$this->xmlVersion,
					$this->encoding,
					$this->root,
					$this->xmlns
				)
			);
		}

		return $this->xml;
	}

	/**
	 * @return  string
	 */
	public function toString(): string
    {
		return $this->xml->asXML();
	}

	/**
	 * @return  string
	 */
	public function __toString()
	{
		try {
			return $this->toString();
		} catch (RuntimeException $e) {
			return $e->getMessage();
		}
	}

	/**
	 * Способ получения свойства AutoEscape
	 *
	 * @return  boolean
	 */
	public function getAutoEscape(): bool
    {
		return $this->autoEscape;
	}

	/**
	 * Метод установки свойства autoEscape
	 *
	 * @param $autoEscape
	 * @return $this		Возвращает себя для поддержки цепочки
	 */
	public function setAutoEscape($autoEscape): self
    {
		$this->autoEscape = $autoEscape;

		return $this;
	}

	/**
	 * Способ получения свойства формат даты
	 *
	 * @return string
	 */
	public function getDateFormat(): string
    {
		return $this->dateFormat;
	}

	/**
	 * Метод установки свойства dataFormat
	 *
	 * @param $dateFormat
	 * @return $this		Возвращает себя для поддержки цепочки.
	 */
	public function setDateFormat($dateFormat): self
    {
		$this->dateFormat = $dateFormat;

		return $this;
	}
}
