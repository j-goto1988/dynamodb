<?php
require_once 'vendor/autoload.php';

use Aws\DynamoDb\Exception\DynamoDbException;
use Aws\DynamoDb\Marshaler;

$sdk = new Aws\Sdk([
	'region' => 'ap-northeast-1',
	'version' => 'latest',
	'credentials' => [
		'key'=>'',
		'secret'=>''
	]
]);

$dynamodb = $sdk->createDynamoDb();
$marshaler = new Marshaler();

$tbl_name = 'user';

$key = $marshaler->marshalJson('
	{
		"id": 5
	}
');

$params = [
	'TableName' => $tbl_name,
	'Key' => $key
];

try {
	$ret = $dynamodb->getItem($params);
	echo "<pre>";
	print_r($ret['Item']);
	echo "</pre>";
} catch(DyanamoDbException $e) {
	echo $e->getMessage();
}


