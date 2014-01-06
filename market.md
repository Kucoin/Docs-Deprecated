行情数据接口 
--------
***行情数据接口均为公开接口，可以直接使用HTTP GET方式调用***

***
### Depth 当前市场挂单深度

***GET:***  https://www.kucoin.com/data/depth

***参数:*** 
<table>
  <tr>
    <th>名称</th><th>类型</th><th>可选值</th><th>说明</th>
  </tr>
  <tr>
    <td>limit</td><td>Number</td><td>10(默认),50,100</td><td>获取条数</td>
  </tr>
  <tr>
    <td>group</td><td>Number</td><td>
    0 : 不合并 <br>
    1 : 以0.1元为单位合并数据 <br>
    2 : 以1元为单位合并数据 (默认)<br>
    3 : 以10元为单位合并数据 
    </td><td>合并数据的方式</td>
  </tr>
</table>

***
### Ticker 

***GET:***  https://www.kucoin.com/data/ticker

***参数:*** 无

***
### Deal 最近成交记录

***GET:***  https://www.kucoin.com/data/deal

***参数:*** 
<table>
  <tr>
    <th>名称</th><th>类型</th><th>可选值</th><th>说明</th>
  </tr>
  <tr>
    <td>limit</td><td>Number</td><td>10(默认),50,100</td><td>获取条数</td>
  </tr>
  <tr>
    <td>time</td><td>Number</td><td>Unix时间戳</td><td>只返回此时间之后的成交记录</td>
  </tr>
</table>
