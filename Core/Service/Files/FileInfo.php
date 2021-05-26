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


namespace Core\Service\Files;


use Core\Service\Config\Config;
use Core\Service\Settings\Setting;
use Exception;


/**
 * Класс для получения необходимой информации о файле
 *
 * Class FileInfo
 * @package Core\Service\Files
 */
class FileInfo implements FileInterface
{
    /**
     * Сепаратор
     *
     * @var string $sep   = /
     */
    protected string $sep = '/';

    /**
     * Результат запроса details функции details
     *
     * @var array
     */
    protected array $details = [];


    /**
     * Получение размера файла
     *
     * @param string $file
     * @return string
     */
	public function getFileSize(string $file): string
	{
		return $this->convert_byte(filesize($file));
	}

    /**
     * Получение инфорации о файле в виде массива с содержанием "полный путь", "имя файла", "размер файла"
     * с вычислением на байта, мегабайты и так далее.
     *
     *
     * @param string $file
     * @param string $sub_folder
     * @param string $theme
     * @param string $folder
     * @param string $section
     * @return string|array
     * @throws Exception
     */
    public function details(string $file, string $sub_folder, string $theme = '', string $folder = '', string $section = ''): array|string
    {
        $file_info = new self();
        if ($section === '') {
            $section = $_SERVER['DOCUMENT_ROOT'] . $this->sep . 'Library';
        } else {
            $section = $_SERVER['DOCUMENT_ROOT'] . $section;
        }

        if ($theme === '') {
            $theme = Setting::item('active_theme', 'theme')->value;
        }

        if ($folder === '') {
            $folder = $this->sep . 'Themes';
        }

        $object = $folder . $this->sep . $theme . $this->sep . $sub_folder . $this->sep . $file;

        $this->details['src'] = Config::item('host') . $this->sep . 'Library' . $folder . $this->sep . $theme . $this->sep . $sub_folder . $this->sep . $file;
        $this->details['FTP'] = $_SERVER['DOCUMENT_ROOT'] . $this->sep . 'Library' . $folder . $this->sep . $theme . $this->sep . $sub_folder . $this->sep . $file;
        $this->details['file'] = $file;
        $this->details['type'] = filetype ($this->details['FTP']);
        $this->details['size'] = $file_info->getFileSize($section . $object);
        $this->details['last_edit'] = date("F d Y H:i:s.", fileatime($this->details['FTP']));


        if (!file_exists($this->details['FTP'])) {
            $this->details['error'] = 'Ошибка, файл не найден';

            return $this->details['error'];
        }

        return $this->details;
    }
	/**
	 * Функция принимает размер файла в байтах и отдает строку с точным размером файла в формате:
	 * байт, килобайт, мегабайт, гигобайт, терабайт. Если число байт выше допустимого значения для терабайт показывает
	 * общую сумму терабайт
	 *
	 * @param string
	 * @return string
	 */
	private function convert_byte( $file_size): string
    {
		# Типы размеров
		$formats = [' - byte',' - KB',' - MB',' - GB',' - TB'];
		# Размер по умолчанию
		$format = 0;

        /**
		* прогоняем цикл
        */
		while ($file_size > 1024 && count($formats) !== ++$format)
		{
			$file_size = round($file_size / 1024, 2);
		}

        /**
         * Если число большое, мы выходим из цикла с
         * форматом превышающим максимальное значение
         * поэтому нужно добавить последний возможный
         * размер файла в массив еще раз
         */
		$formats[] = ' - TB';

		return $file_size . $formats[$format];
	}
}