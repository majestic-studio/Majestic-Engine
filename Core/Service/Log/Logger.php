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


namespace Core\Service\Log;


use Core\Service\Files\FileInfo;


/**
 * Класс для работы с логами
 *
 * Class Logger
 * @package Core\Service\Log
 */
class Logger
{
	/**
	 * Формат файла
	 * @var string $format
	 */
    protected string $format = '.log';

	/**
	 * Массив ошибок
	 * @var array $error
	 */
    private array $error = [];

	/**
	 * Пусть файловой системы к папке файла
	 * @var string
	 */
    private string $file_dir = CORE_DIR . DIRECTORY_SEPARATOR . 'Uploads' . DIRECTORY_SEPARATOR . 'user' . DIRECTORY_SEPARATOR;


	public function logger(string $user_name, string $message): array
    {
		$file = $this->getFile($user_name);
		$this->getMessage($file, $message, $user_name);
		return $this->getFile($user_name);
	}

	/**
	 * Запись данных в нужный файл
	 *
	 * @param array $file
	 * @param string $message
	 * @param string $user_name
	 * @return array|mixed
	 */
	private function getMessage(array $file, string $message, string $user_name)
	{
		$file	= $file['file_info']['uri'];
		$get_file 	= file_get_contents($file);

		$file_open = fopen($file, 'wb+');

		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}

		fwrite($file_open, $get_file);
		fwrite($file_open,  "\n");
		fwrite($file_open,  "\n");
		fwrite($file_open,  "Время: " . date('H:i:s'));
		fwrite($file_open,  "\n");
		fwrite($file_open,  "Пользователь: " . $user_name);
		fwrite($file_open,  "\n");
		fwrite($file_open, "Действие: " . $message);
		fwrite($file_open,  "\n");
		fwrite($file_open,  "IP адрес: " . $ip);
		fwrite($file_open,  "\n----------------------------------------");
		fclose($file_open);

		return $file;
	}

	/**
	 * Проверка на существование файла, если файла нет, то создаем его и возвращаем путь к файлу
	 *
	 * @param string $user_name
	 * @return array
	 */
	private function getFile(string $user_name): array
	{
		$info = new FileInfo();
		# Дата за текущий день
		$date = date("d M Y");
		# Путь к файлу
		$file_dir	= $this->file_dir . $user_name . DIRECTORY_SEPARATOR . 'log' . DIRECTORY_SEPARATOR;
		# Название файла в формате 'log - дата'
		$file_name	= 'log - ' . $date;
		# Имя файла
		$file 		= $file_dir . $file_name . $this->format;
		# URL файла
		$site_url	= 'Uploads' . DIRECTORY_SEPARATOR . 'user' . DIRECTORY_SEPARATOR . $user_name . DIRECTORY_SEPARATOR . 'log' . DIRECTORY_SEPARATOR . $file_name . $this->format;
		# Проверка, есть ли файл. Если файла нет, то пытаемся создать его.
		if(file_exists($file)) {

			# Проверка, доступен ли файл для записи
			if(!is_writable($file)) {
				$error['writable'] = 'Недостаточно прав для записи в файл: ' . $file_name . $this->format . ' пользователя: ' . $user_name;
				$this->setError($error);
			}

			# Проверка, доступен ли файл для чтения
			if(!is_readable($file)) {
				$error['readable'] = 'Недостаточно прав для чления файла: ' . $file_name . $this->format . ' пользователя: ' . $user_name;
				$this->setError($error);
			}

		} else {
			# Добавление в массив $this->error сообщения, что файла нет и он создается.
			$error['not_file'] = 'Файла: ' . $file_name . $this->format . ' пользователя: ' . $user_name . ' не существует';
			$error['status'] = 'Попытка создания файла: ' . $file_name . $this->format . ' для пользователя: ' . $user_name;
			$this->setError($error);
			$message = "Majestic Logger\nЛоги пользвателя: " . $user_name . "\nДата создания: " . $date . "\n\n----------------------------------------";
			# Создание файла

			$charset_message = htmlspecialchars($message, ENT_QUOTES, 'urf-8' );

			touch($charset_message);

			$handler = fopen($file, 'wb');
			fwrite($handler, $message);
			fclose($handler);
			@chmod( $handler, 0666 );
		}
        return [
            'file_info'		=> [
                'uri'		=> $file,
                'url'		=> $site_url,
                'name'		=> $file_name . $this->format,
                'user'		=> $user_name,
                'file_size'	=> $info->getFileSize($file)
            ],
            'error' => $this->error
        ];
	}

	/**
	 * Массиво ошибок
	 *
	 * @param array $error
	 * @return array
	 */
	private function setError(array $error): array
	{
		foreach ($error as $key => $value) {
			$this->error[$key] = $value;
		}

		return $this->error;
	}
}