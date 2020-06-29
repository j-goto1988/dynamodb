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

$item = $marshaler->marshalJson('
	{
		"id": 11,
		"name": "名前テスト"
	}
');

$params = [
	'TableName' => $tbl_name,
	'Item' => $item
];

try {
	$ret = $dynamodb->putItem($params);
	echo "<pre>";
	print_r($ret);
	echo "</pre>";
} catch(DyanamoDbException $e) {
	echo $e->getMessage();
}


