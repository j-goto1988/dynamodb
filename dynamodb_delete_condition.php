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
		"id": 11
	}
');

$eav = $marshaler->marshalJson('
	{
		":name_val": "削除テスト"
	}
');

$params = [
	'TableName' => $tbl_name,
	'Key' => $key,
	'ConditionExpression' => '#name = :name_val',
	'ExpressionAttributeValues'=> $eav,
	'ExpressionAttributeNames'=> ['#name' => 'name']
];

try {
	$ret = $dynamodb->deleteItem($params);
	echo "<pre>";
	print_r($ret);
	echo "</pre>";
} catch(DyanamoDbException $e) {
	echo $e->getMessage();
}


