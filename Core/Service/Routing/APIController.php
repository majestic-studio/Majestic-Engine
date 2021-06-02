<?php


namespace Core\Service\Routing;


class APIController
{
    /**
     * @var array - массив data
     */
    public array $data = [];
    public array $nuxt = [];

    /**
     * @param int $status_code
     * @param array $error
     * @param array $result
     * @param array $nuxt
     */
    public function setData(int $status_code = 200, array $error = [], array $result = [], array $nuxt = []): void
    {
        $this->data['result'] = $result;
        $this->data['error'] = $error;
        $this->data['code'] = $status_code;
        $this->nuxt = $nuxt;
    }
}