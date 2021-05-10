<?php


namespace Core\Service\Routing;


class APIController
{
    /**
     * @var array - массив data
     */
    public array $data = [];
    public array $nuxt = [];


    public function setData($status_code = 200, $error = [], $result = [], $nuxt = []): void
    {
        $this->data['result'] = $result;
        $this->data['error'] = $error;
        $this->data['code'] = $status_code;
        $this->nuxt = $nuxt;
    }
}