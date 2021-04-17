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


namespace Core\Service\Http;


/**
 * Класс для работы с заголовком браузера
 *
 * Class Header
 * @package Core\Service\Http
 */
class Header extends AbstractHeader
{
    public static function code (int $code): int
    {
        return http_response_code($code);
    }
    /**
     * Обработка отправки запроса Content Type страницы
     * $header принимает string, но в случаи пустого
     * поля в router.php приходит NULL, из-за
     * этого необходимо проводить проверку, пустое
     * ли поле заголовка страницы
     *
     * @param mixed $header - заголовок страницы
     */
    public function header ($header = ''): void
    {
        if(array_key_exists($header, $this->type) === false) {
            $header = 'html';
        }

        $this->construct($this->type[$header]);
    }

    /**
     * Отправка уже обработанного Content-Type
     * конченному клиенту
     *
     * @param string $header    - заголовок страницы, HTML, json и так далее
     */
    private function construct(string $header): void
    {
        header('Content-Type: ' . $header . ' . ' . $this->charset);
    }

    /**
     * Отправка кода 403, страница не найдена
     *
     * @return void
     */
	public static function code403(): void
    {
        header('HTTP/1.0 403 Forbidden');
	}

    /**
     * Отправка кода 404, страница не найдена
     *
     * @return void
     */
	public static function code404(): void
    {
		header('HTTP/2.0 404 Not Found');
	}

	public static function allowAPI(): void
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: *, Authorization');
        header('Access-Control-Allow-Methods: *');
        header('Access-Control-Allow-Credentials: ture');

    }
}
