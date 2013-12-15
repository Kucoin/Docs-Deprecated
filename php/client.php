<?php

    /**
     * 对请求的数据进行数字签名
     */
    function sign(array $postDatas){

        //在网站开发接口页面获取$accessKey和$secretKey
        $accessKey = "689ba659-490d-55ad-6968-ccbc5eac74f9";
        $secretKey = "79708445-2070-ae1e-356e-6faef1b50e1d";

        $time = explode(' ', microtime());
        $nonce = $time[1] . substr($time[0], 2, 6);

        $data = [
            'nonce' => $nonce,
            'accessKey' => $accessKey,
            'data'=> json_encode($postDatas)
        ];

        $hash = base64_encode(hash_hmac('sha512',  base64_encode(json_encode($data)) , $secretKey));

        return [
            'accessKey' => $accessKey,
            'hash' => $hash,
            'nonce' => $nonce
        ];

    }

    /**
     * 调用接口
     */
    function callAPI($method, array $params){

        $api_url = "https://www.kucoin.com/api/v1";

        $postData = [
            'method' => $method,
            'params' => $params,
            'id' => 1,
        ];

        $sign = $this->sign($postData);

        $postData = json_encode($postData);

        $headers = [
            'RPC-Signature:' . $sign['hash'],
            'RPC-AccessKey:' . $sign['accessKey'],
            'RPC-Nonce:'     . $sign['nonce'],
            'Content-Type:application/json'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT,
            'Mozilla/4.0 (compatible; Kucoin Bot; '.php_uname('a').'; PHP/'.phpversion().')'
        );
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $res = curl_exec($ch);
        return $res;

    }

    $res = callAPI('getBalance',[]);
    var_dump($res);
