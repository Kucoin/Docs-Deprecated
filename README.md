

行情数据接口
--------

钱包接口
--------

交易接口
--------
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



