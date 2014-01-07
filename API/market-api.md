行情数据接口 
--------
***行情数据接口均为公开接口，可以直接使用HTTP GET方式调用***

***
### Depth 当前市场挂单深度

***GET:***  https://www.kucoin.com/data/depth

***参数:*** 

名称 | 类型 | 可选值 | 说明
--- | --- | --- | --- 
limit | Number | 10(默认),50,100 | 获取条数
group | Number | 0 : 不合并 <br>1 : 以0.1元为单位合并数据 <br>2 : 以1元为单位合并数据 (默认)<br>3 : 以10元为单位合并数据  | 合并数据的方式

***
### Ticker 

***GET:***  https://www.kucoin.com/data/ticker

***参数:*** 无

***
### Deal 最近成交记录

***GET:***  https://www.kucoin.com/data/deal

***参数:*** 

名称 | 类型 | 可选值 | 说明
--- | --- | --- | --- 
limit | Number | 10(默认),50,100 | 获取条数
time | Number | Unix时间戳 | 只返回此时间之后的成交记录

