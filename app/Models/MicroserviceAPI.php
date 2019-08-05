<?php

namespace App\Models;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use Symfony\Component\Debug\Exception\FatalThrowableError;

class MicroserviceAPI
{
    public $header = '';
    private $api_server = '';

    public function __construct($header=[], $api_server = null)
    {
        $this->header = $header;
        $this->api_server = $api_server ?? '';
    }

    public function get($params)
    {
        $header = $this->header;
        $options = [
            'query' => $params,
            'headers' => $header,
        ];

        return $options;
    }

    public function post($params)
    {
        $header = $this->header;
        $options = [
            'form_params' => $params,
            'headers' => $header,
        ];
        return $options;
    }

    public function put($params)
    {
        $header =$this->header;
        $options = [
            'form_params' => $params,
            'headers' => $header,
        ];
        return $options;
    }

    public function delete($params)
    {
        $header = $this->header;
        $options = [
            'form_params' => $params,
            'headers' => $header,
        ];
        return $options;
    }

    public function action($method, $function, $params)
    {
        switch ($method) {
            case 'GET':
                $options = $this->get($params);
                break;
            case 'POST':
                $options = $this->post($params);
                break;
            case 'PUT':
                $options = $this->put($params);
                break;
            case 'DELETE':
                $options = $this->delete($params);
                break;
        }

        $client = new Client();
        try {
            $response = $client->$method($this->api_server . $function, $options);
            return $response->getBody()->getContents();
        }
        catch (RequestException $exception) {
            if($exception->getResponse() ==null)
            {
                $content['status_code'] = 500;
                $content['message'] = '系统出错啦.'.$exception->getMessage();
                return json_encode($content);
            }
            $content = $exception->getResponse()->getBody()->getContents();
            $content= json_decode($content,true);
            if(isset($content['status_code']) and $content['status_code']==422)
            {
                $content['message'] = '验证错误.';
            }

            return json_encode($content);
        } catch (Exception $exception) {
            return json_encode($exception);
        }
        return null;
    }

}
