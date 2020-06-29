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
		"id": 12
	}
');

$eav = $marshaler->marshalJson('
	{
		":change_name": "更新2",
		":condition_name": "追加テスト2"
	}
');

$params = [
	'TableName' => $tbl_name,
	'Key' => $key,
	'UpdateExpression' => 
		'set #name = :change_name',
	'ConditionExpression' => '#name = :condition_name',
	'ExpressionAttributeValues'=> $eav,
	'ReturnValues' => 'UPDATED_NEW',
	'ExpressionAttributeNames'=> ['#name' => 'name']
];

try {
	$ret = $dynamodb->updateItem($params);
	echo "<pre>";
	print_r($ret);
	echo "</pre>";
} catch(DyanamoDbException $e) {
	echo $e->getMessage();
}


