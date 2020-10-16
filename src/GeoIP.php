<?php
namespace Byrnes2014\GeoIP;

use GuzzleHttp\Client;
use Byrnes2014\GeoIP\Exceptions\InvalidArgumentException;
use Byrnes2014\GeoIP\Exceptions\HttpException;

class GeoIP
{


	protected $key;

	protected $guzzleOptions = [];


	public function __construct($key)
	{
		$this->key = $key;
	}

	public function getHttpClient()
	{
		return new Client($this->guzzleOptions);
	}

	public function setGuzzleOptions(array $options)
	{
		$this->guzzleOptions = $options;
	}


	public function getAddress($ip, $format = 'json')
	{

		$url = 'https://restapi.amap.com/v3/ip';

		if (! \in_array(strtolower($format), ['json', 'xml'])) {
			throw new InvalidArgumentException('Invalid response format: '. $format);
		}

		$query = array_filter([
			'key' => $this->key,
			'ip' => $ip,
			'output' => \strtolower($format),
		]);

		try {
			$response = $this->getHttpClient()->get($url, [
                'query' => $query,
            ])->getBody()->getContents();

		return 'json' === $format ? \json_decode($response, true) : $response;
			
		} catch (\Exception $e) {
			throw new HttpException($e->getMessage(), $e->getCode(), $e);
			
		}
		
	}


}