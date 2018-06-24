<?php

class AutoWebOffice {

    public $api_key_get;
    public $api_key_set;
    public $shop_id;
    
    public function __construct($api_key_get, $api_key_set, $shop_id)
    {
        $this->api_key_get = $api_key_get;
        $this->api_key_set = $api_key_set;
        $this->shop_id = $shop_id;
    }

    public function getOrderStatus()
    {
        return [
            1 => 'Создан',
            2 => 'Отказ',
            3 => 'В обработке',
            4 => 'Ошибка',
            5 => 'Оплачен',
        ];
    }

    static public function getAmoStatus($ao_status)
    {
        $list = [
            1 => 9134097,
            2 => 143,
            3 => 9134100,
            4 => 9134100,
            5 => 142,
        ];
        return $list[$ao_status];
    }

    public function getOrderLine($orderLineId)
    {
        return $this->exec('GET', 'accountline', [
            'search[id_account_line]' => $orderLineId,
        ]);
    }

    public function getOrders($params = [])
    {
        return $this->exec('GET', 'accounts', $params);
    }

    public function newOrder($params = [])
    {
        return $this->exec('POST', 'accounts', $params, 'account');
    }

    public function orderIsPaid($orderId)
    {
        return $this->exec('PUT', 'accounts', [
            'id' => $orderId,
            'id_account_status' => 5,
        ], 'account');
    }

    public function changeOrderStatus($orderId, $amoStatus)
    {
        $aoStatuses = [
            9134097 => 1,
            143 => 2,
            9134100 => 3,
            142 => 5,
        ];
        if(!isset($aoStatuses[$amoStatus]))
            return false;
        return $this->exec('PUT', 'accounts', [
            'id' => $orderId,
            'id_account_status' => $aoStatuses[$amoStatus],
        ], 'account');
    }

    public function newOrderLine($params = [])
    {
        return $this->exec('POST', 'accountline', $params, 'accountline');
    }

    public function sendMail($orderId)
    {
        return $this->exec('GET', 'accountssendmail', [
            'id' => $orderId,
        ]);
    }

    public function getContactByOrderId($orderId)
    {
        $contactData = [];
        $order = $this->getOrders([
            'search[id_account]' => $orderId,
        ]);

        if(isset($order[0])) {
            $targetOrder = $order[0];
            $contactData = [
                'name' => $targetOrder->name,
                'email' => $targetOrder->email,
                'phone' => $targetOrder->phone_number,
                'product_id' => $targetOrder->delivery_address,
            ];
        }

        return $contactData;
    }

    private function exec($method_name = 'GET', $method, $params = [], $method_single = '')
    {
        if( $curl = curl_init() )
        {
            curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);

            $api_request_url = 'https://' . $this->shop_id . '.autoweboffice.ru/?r=api/rest/' . $method;

            if ($method_name == 'DELETE')
            {
                $query_params = array_merge($params, ['key' => $this->api_key_set]);
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
                curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($query_params));
            }

            elseif ($method_name == 'GET' && $method != 'accountssendmail')
            {
                $query_params = array_merge($params, ['key' => $this->api_key_get]);
                $api_request_url .= '&' . http_build_query($query_params);
            }

            elseif ($method_name == 'GET' && $method == 'accountssendmail')
            {
                $query_params = array_merge($params, ['key' => $this->api_key_set]);
                $api_request_url .= '&' . http_build_query($query_params);
            }

            elseif ($method_name == 'POST')
            {
                $xml_data = '<?xml version="1.0" encoding="utf-8"?>';
                $xml_data .= '<' . $method . '>';

                $xml_data .= '<' . $method_single . '>';
                foreach($params as $param_name => $param_value):
                    $xml_data .= '<' . $param_name . '>' . $param_value . '</' . $param_name . '>';
                endforeach;
                $xml_data .= '</' . $method_single . '>';
                $xml_data .= '</' . $method . '>';

                $api_request_url .= '&' . http_build_query(['key' => $this->api_key_set]);
                curl_setopt($curl, CURLOPT_POST, TRUE);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $xml_data);
            }

            elseif ($method_name == 'PUT')
            {
                $query_params = array_merge($params, ['key' => $this->api_key_set]);
                $api_request_url .= '&' . http_build_query($query_params);
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
            }

            curl_setopt($curl, CURLOPT_URL, $api_request_url);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

            $out_json = curl_exec($curl);

            if($out_json === false)
                return curl_error($curl);
            else
                $out_obj = json_decode($out_json);

            return $out_obj;
        }
    }

}