
行情数据接口
--------

钱包接口
--------
- [getBalance](#getbalance)


交易接口
--------

- [buyOrder](#buyorder)
- [sellOrder](#sellorder)
- [cancelOrder](#cancelorder)
- [getOrder](#getorder)
- [getOrders](#getorders)
- [getTransactions](#gettransactions)
- [transferBTC](#transferBTC)

***

### buyOrder  

***描述:***  下比特币买单

***参数:***
  <table>
  <tr>
    <th>参数</th><th>类型</th><th>必选</th><th>说明</th>
  </tr>
  <tr>
    <td>Price</td><td>Number</td><td>是</td><td>买 1 比特币所接受的人民币价格，最多支持小数点后 2 位精度</td>
  </tr>
  <tr>
    <td>Amount</td><td>Number</td><td>是</td><td>要买入的比特币数量，最多支持小数点后 8 位精度</td>
  </tr>
</table>

***JSON请求示例:***
```json
{"method":"buyOrder","params":[1000,1],"id":1}
```
***返回值:***
<table>
  <tr>
    <th>名称</th><th>类型</th><th>说明</th>
  </tr>
  <tr>
    <td>result</td><td>Boolean</td><td>如果下单成功，返回 true</td>
  </tr>
</table>
***JSON返回示例:***
```json
{"result":true,"id":"1"} 
```
***
### sellOrder  

***描述:***  下比特币卖单

***参数:***
  <table>
  <tr>
    <th>参数</th><th>类型</th><th>必选</th><th>说明</th>
  </tr>
  <tr>
    <td>Price</td><td>Number</td><td>是</td><td>卖 1 比特币所开出的人民币价格，最多支持小数点后 2 位精度</td>
  </tr>
  <tr>
    <td>Amount</td><td>Number</td><td>是</td><td>要卖出的比特币数量，最多支持小数点后 8 位精度</td>
  </tr>
</table>

***JSON请求示例:***
```json
{"method":"sellOrder","params":[1000,1],"id":1}
```
***返回值:***
<table>
  <tr>
    <th>名称</th><th>类型</th><th>说明</th>
  </tr>
  <tr>
    <td>result</td><td>Boolean</td><td>如果下单成功，返回 true</td>
  </tr>
</table>
***JSON返回示例:***
```json
{"result":true,"id":"1"} 
```
***
### cancelOrder  

***描述:***  取消活动状态的挂单

***参数:***
  <table>
  <tr>
    <th>参数</th><th>类型</th><th>必选</th><th>说明</th>
  </tr>
  <tr>
    <td>id</td><td>Number</td><td>是</td><td>挂单编号</td>
  </tr>

</table>

***JSON请求示例:***
```json
{"method":"cancelOrder","params":[12],"id":1}
```
***返回值:***
<table>
  <tr>
    <th>名称</th><th>类型</th><th>说明</th>
  </tr>
  <tr>
    <td>result</td><td>Boolean</td><td>如果取消挂单成功，返回 true</td>
  </tr>
</table>
***JSON返回示例:***
```json
{"result":true,"id":"1"} 
```
***
### getOrder  

***描述:***  获取单个挂单的状态

***参数:***
  <table>
  <tr>
    <th>参数</th><th>类型</th><th>必选</th><th>说明</th>
  </tr>
  <tr>
    <td>id</td><td>Number</td><td>是</td><td>挂单编号</td>
  </tr>

</table>

***JSON请求示例:***
```json
{"method":"getOrder","params":[12],"id":1}
```
***返回值:***
<table>
  <tr>
    <th>名称</th><th>类型</th><th>说明</th>
  </tr>
  <tr>
    <td>result</td><td>Object</td><td>Order对象</td>
  </tr>
</table>
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

***参数:***
  <table>
  <tr>
    <th>参数</th><th>类型</th><th>必选</th><th>允许值</th><th>说明</th>
  </tr>
  <tr>
    <td>status</td><td>String</td><td>是</td>
    <td>
    'all' : 所有订单<br>
    'open' : 活动的订单 <br>
    'has_deal' : 有成交的订单 <br>
    'processed' : 完全成交的订单 <br>
    'canceled' : 已取消的订单</td>
    <td>获取特定状态的订单</td>
  </tr>

</table>

***JSON请求示例:***
```json
{"method":"getOrders","params":['all'],"id":1}
```
***返回值:***
<table>
  <tr>
    <th>名称</th><th>类型</th><th>说明</th>
  </tr>
  <tr>
    <td>result</td><td>Array</td><td>包含Order对象的数组</td>
  </tr>
</table>
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
***

