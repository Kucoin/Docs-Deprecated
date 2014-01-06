钱包/交易接口 
--------
以下均为私密接口，调用前需要使用账户的访问密钥进行[接口签名认证](#接口签名认证详细步骤)，并以HTTP POST(JsonRPC 2.0)的方式进行调用

当前私密接口一共包含四种权限： 查询[GETINFO] , 更新信息[UPDATEINFO] , 交易[TRADE], 转账[TRANSFER] ，请在网站开发接口页面进行授权
 
- [getContacts](#getcontacts)   获取所有收款人
- [addContact](#addcontact)   添加收款人
- [addBTCAddress](#addbtcaddress)   添加新的比特币收款地址
- [getBTCAddresses](#getbtcaddresses)    获取所有比特币收款地址
- [getAccount](#getaccount)  获取账户信息
- [getBalance](#getbalance)  获取余额信息
- [getTransactions](#gettransactions)  获取交易记录
- [transferBTC](#transferbtc)  转出/提现比特币
- [buyOrder](#buyorder)  下比特币买单
- [sellOrder](#sellorder)  下比特币卖单
- [cancelOrder](#cancelorder)  取消挂单
- [getOrder](#getorder)  获取订单信息
- [getOrders](#getorders)  获取多个订单信息


***
### 接口调用代码

PHP示例代码：
```php

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
    
```

***其他语言的示例代码请在Github代码仓库的对应文件中查看***


***
### getContacts

***描述:***  获取所有收款人

***接口权限: 查询*** 

***参数:*** 无

***JSON请求示例:***
```json
{"method":"getContacts","params":[],"id":1}
```
***返回值:***

名称  | 类型 | 说明
--- | --- | ---
result  | Object[] | Contact对象数组


***JSON返回示例:***
```json
{
    "result": {
        "contacts":[
                {
                    "address": "1KuCoin5Rew1viKZYkgeds21Y19pdLpuhb",
                    "name" : "John"
                },
                {
                    "address": "Jason.Lee",
                    "name" : "Jason.Lee"
                },
                {
                    "address": "grace@gmail.com",
                    "name" : "Grace"
                }
            ]
        }
    ,
    "id": 1
}
```
***
### addContact

***描述:***  添加收款人

***接口权限: 更新信息*** 

***参数:*** 

名称  | 类型 | 说明
--- | --- | ---
Address  | String | 联系人的收款地址，可以是比特币地址，KUCOIN的用户名或者登录邮箱（请自行确保其有效性）
Name | String | 用于显示的收款人姓名


***JSON请求示例:***
```json
{"method":"addContact","params":["1KuCoin5Rew1viKZYkgeds21Y19pdLpuhb","John"],"id":1}
```

***返回值:***

名称  | 类型 | 说明
--- | --- | ---
result  | Boolean | 添加结果

***JSON返回示例:***
```json
{ "result": true, "id": 1 }
```

***
### addBTCAddress

***描述:***  获取一个新的比特币收款地址

***接口权限: 更新信息*** 

***参数:*** 无

***JSON请求示例:***
```json
{"method":"createBTCAddress","params":[],"id":1}
```
***返回值:***

名称  | 类型 | 说明
--- | --- | ---
result  | Object | Address对象

***JSON返回示例:***
```json
{
    "result": {
        "address":
                {
                    "address": "1KuCoin5Rew1viKZYkgeds21Y19pdLpuhb",
                    "label" : "",
                }
            ]
        }
    ,
    "id": 1
}
```

***
### getBTCAddresses  

***描述:***  获取账户全部比特币收款地址

***接口权限: 查询*** 

***参数:*** 无

***JSON请求示例:***
```json
{"method":"getBTCAddresses","params":[],"id":1}
```
***返回值:***

名称  | 类型 | 说明
--- | --- | ---
result  | Object[] | Address对象数组

***JSON返回示例:***
```json
{
    "result": {
        "addresses":[
                {
                    "address": "1KuCoiNkB6ckLWbcad3N4h16MLUtPa8M9K",
                    "label" : "default",
                },
                {
                    "address": "1KucoinXL8sxfmesmdQHR6YfC6p2XsZ7Km",
                    "label" : "donation",
                }
            ]
        }
    ,
    "id": 1
}
```
***
### getAccount  

***描述:***  获取账户信息

***接口权限: 查询*** 

***参数:*** 无

***JSON请求示例:***
```json
{"method":"getAccount","params":[],"id":1}
```
***返回值:***

名称  | 类型 | 说明
--- | --- | ---
result  | Object | Account对象

***JSON返回示例:***
```json
{
    "result": {
        "account":
            {
                "email": "jason.lee@gmail.com",
                "username" : "jason.lee",
                "daily_btc_limit" : "1000",
                "mobile" : "18616802032"
            }
        }
    ,
    "id": 1
}
```
***
### getBalance  

***描述:***  获取账户余额

***接口权限: 查询*** 

***参数:*** 无

***JSON请求示例:***
```json
{"method":"getBalance","params":[],"id":1}
```
***返回值:***

名称  | 类型 | 说明
--- | --- | ---
result  | Object[] | 包含Balance对象的数组

***JSON返回示例:***
```json
{
    "result": {
        "balances": [
            {
                "currency": "BTC",
                "balance": 1001.55812,
                "unconfirmed_balance": 0,
                "update_time": 1387125744
            },
            {
                "currency": "CNY",
                "balance": 995075.31,
                "update_time": 1387125744
            }
        ]
    },
    "id": 1
}
```
***
### getTransactions  

***描述:***  获取交易记录

***参数:***

参数  | 类型 | 必选 | 允许值 | 说明
--- | --- | --- | --- | ---
type  | String | 是 |  'btc_deposit' : 比特币充值记录 <br>'btc_transfer' : 比特币转账和提现记录 <br>'trade_btc' : 比特币交易记录(包含买入和卖出记录) <br>'buy_btc' : 比特币买入记录 <br>'sell_btc' : 比特币卖出记录 <br>'btc_transfer_fee' : 比特币转账和提现手续费 <br>'trade_fee' : 交易手续费 | 获取特定类型的交易记录
type | Number | 否 |  正整数,缺省值为10 | 获取数量

***JSON请求示例:***
```json
{"method":"getTransactions","params":['trade_btc',2],"id":1}
```
***返回值:***

名称  | 类型 | 说明
--- | --- | ---
result  | Array | 包含Transaction对象的数组

***JSON返回示例:***
```json
{
    "result": [
        {
            "id": 3164,
            "btc_amount": "0.43431000",
            "cny_amount": "35.00",
            "fee_btc": "0.00000000",
            "type": "trade_in",
            "time": 1387119208
        },
        {
            "id": 6164,
            "btc_amount": "0.13431000",
            "cny_amount": "474.97",
            "fee_btc": "0.00000000",
            "type": "trade_in",
            "time": 1387119412
        }
    ],
    "id": 1
}
```
***
### transferBTC  

***描述:***  转出比特币

***接口权限: 转账*** 

***参数:***

参数  | 类型 | 必选 | 允许值 | 说明
--- | --- | --- | --- | ---
type | String | 是 |   'btc_address' : 比特币地址 <br>'username' :  KUCOIN用户名 <br>'email' : KUCOIN用户的邮箱 <br>| 转出目的地的类型
to | String | 是 |  长度为3 ~ 60的字符串 | 接收人
amount | Number | 是 |  正数,最多支持小数点后 8 位精度 | 转出金额

***JSON请求示例:***
```json
{ 
    "method":"transferBTC",
    "params":["btc_address","1KuCoin5Rew1viKZYkgeds21Y19pdLpuhb",1.1201],
    "id":1
}
```
***返回值:***

名称  | 类型 | 说明
--- | --- | ---
result  | Boolean | 转账成功返回true

***JSON返回示例:***
```json
{"result":true,"id":"1"} 
```

***

### buyOrder  

***描述:***  下比特币买单

***接口权限: 交易*** 

***参数:***

名称  | 类型 | 必选 | 说明 | 
--- | --- | --- | ---
price  | Number | 是 | 买 1 比特币所接受的人民币价格，最多支持小数点后 2 位精度
amount  | Number | 是 | 要买入的比特币数量，最多支持小数点后 8 位精度

***JSON请求示例:***
```json
{"method":"buyOrder","params":[1000,1],"id":1}
```
***返回值:***

名称  | 类型 | 说明 | 
--- | --- | --- 
price  | Boolean | 如果下单成功，返回 true

***JSON返回示例:***
```json
{"result":true,"id":"1"} 
```
***
### sellOrder  

***描述:***  下比特币卖单

***接口权限: 交易*** 

***参数:***

名称  | 类型 | 必选 | 说明 | 
--- | --- | --- | ---
price  | Number | 是 | 卖 1 比特币所开出的人民币价格，最多支持小数点后 2 位精度
amount  | Number | 是 | 要卖出的比特币数量，最多支持小数点后 8 位精度

***JSON请求示例:***
```json
{"method":"sellOrder","params":[1000,1],"id":1}
```
***返回值:***

名称  | 类型 | 说明 | 
--- | --- | --- 
result  | Boolean | 如果下单成功，返回 true

***JSON返回示例:***
```json
{"result":true,"id":"1"} 
```
***
### cancelOrder  

***描述:***  取消活动状态的挂单

***接口权限: 交易*** 

***参数:***

名称  | 类型 | 必选 | 说明 | 
--- | --- | --- | ---
id  | String | 是 | 挂单编号

***JSON请求示例:***
```json
{"method":"cancelOrder","params":[12],"id":1}
```
***返回值:***

名称  | 类型 | 说明 | 
--- | --- | --- 
result  | Boolean | 如果取消挂单成功，返回 true

***JSON返回示例:***
```json
{"result":true,"id":"1"} 
```
***
### getOrder  

***描述:***  获取单个挂单的状态

***接口权限: 查询*** 

***参数:***

名称  | 类型 | 必选 | 说明 | 
--- | --- | --- | ---
id  | String | 是 | 挂单编号

</table>

***JSON请求示例:***
```json
{"method":"getOrder","params":[12],"id":1}
```
***返回值:***

名称  | 类型 | 说明 | 
--- | --- | --- 
result  | Object | Order对象

***JSON返回示例:***
```json
{
    "result": {
        "id": 1,
        "status": "open",
        "type": "ask",
        "btc_amount": "0.46961000",
        "deal_btc_amount": "0.00000000",
        "deal_cny_amount": "0.00",
        "create_time": 1387118198,
        "update_time": 1387118198
    },
    "id": 1
}
```
***
### getOrders 

***描述:***  获取多个挂单的状态

***接口权限: 查询*** 

***参数:***

名称  | 类型 | 必选 | 允许值 | 说明 | 
--- | --- | --- | --- | ---
status  | String | 是 |  'all' : 所有订单<br>'open' : 活动的订单 <br>'has_deal' : 有成交的订单 <br>'processed' : 完全成交的订单 <br>'canceled' : 已取消的订单 | 获取特定状态的订单

***JSON请求示例:***
```json
{"method":"getOrders","params":['all'],"id":1}
```
***返回值:***

名称  | 类型 | 说明 | 
--- | --- | --- 
result  | Array | 包含Order对象的数组

***JSON返回示例:***
```json
{
    "result": [{
        "id": 1,
        "status": "open",
        "type": "ask",
        "btc_amount": "0.46961000",
        "deal_btc_amount": "0.00000000",
        "deal_cny_amount": "0.00",
        "create_time": 1387118198,
        "update_time": 1387118198
    },{
        "id": 2,
        "status": "processed",
        "type": "ask",
        "btc_amount": "0.16961000",
        "deal_btc_amount": "0.00000000",
        "deal_cny_amount": "0.00",
        "create_time": 1387118200,
        "update_time": 1387118200
    }],
    "id": 1
}
```
