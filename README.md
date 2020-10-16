# GeoIP

基于  [高德开放平台](https://lbs.amap.com/dev/id/newuser) 的 PHP IP地理定位组件。

## 安装

```sh
$ composer require byrnes2014/geoip -vvv
```

## 配置

在使用本扩展之前，你需要去 [高德开放平台](https://lbs.amap.com/dev/id/newuser) 注册账号，然后创建应用，获取应用的 API Key。

## 使用

```php
use Byrnes2014\GeoIP\GeoIP;

$key = 'xxxxxxxxxxxxxxxxxxxxxxxxxxx';

$geoip = new GeoIP($key);
```

###  获取实时地理信息

```php
$response = $geoip->getAddress('101.80.72.241');
```
示例：

```
{
    "status":"1",
    "info":"OK",
    "infocode":"10000",
    "province":"上海市",
    "city":"上海市",
    "adcode":"310000",
    "rectangle":"120.8397067,30.77980118;122.1137989,31.66889673"
}
```


### 获取 XML 格式返回值

第二个参数为返回值类型，可选 `json` 与 `xml`，默认 `json`：

```php
$response = $geoip->getAddress('101.80.72.241', 'xml');
```

示例：

```xml
<?xml version="1.0" encoding="UTF-8"?>
<response>
    <status>1</status>
    <info>OK</info>
    <infocode>10000</infocode>
    <province>上海市</province>
    <city>上海市</city>
    <adcode>310000</adcode>
    <rectangle>120.8397067,30.77980118;122.1137989,31.66889673</rectangle>
</response>
```

### 参数说明

```
array|string getAddress(string $ip string $format = 'json')
```

> - `$ip` - IP地址，比如：“101.80.72.241”；
> - `$format`  - 输出的数据格式，默认为 json 格式，当 output 设置为 “`xml`” 时，输出的为 XML 格式的数据。

### 在 Laravel 中使用

在 Laravel 中使用也是同样的安装方式，配置写在 `config/services.php` 中：

```php
	.
	.
	.
	 'weather' => [
		'key' => env('GEOIP_API_KEY'),
    ],
```

然后在 `.env` 中配置 `GEOIP_API_KEY` ：

```env
GEOIP_API_KEY=xxxxxxxxxxxxxxxxxxxxx
```

可以用两种方式来获取 `Byrnes2014\GeoIP\GeoIP` 实例：

#### 方法参数注入

```php
	.
	.
	.
	public function edit(GeoIP $geoip) 
	{
		$response = $geoip->getAddress('101.80.72.241');
	}
	.
	.
	.
```

#### 服务名访问

```php
	.
	.
	.
	public function edit() 
	{
		$response = app('geoip')->getAddress('101.80.72.241');
	}
	.
	.
	.

```

## 参考

- [高德开放IP定位接口](https://lbs.amap.com/api/webservice/guide/api/ipconfig)

## License

MIT
