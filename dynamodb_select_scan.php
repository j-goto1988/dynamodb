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
$tbl_name = 'user';

try {
	$ret = $dynamodb->scan(array(
		'TableName' => $tbl_name
	));
	echo "<pre>";
	print_r($ret);
	echo "</pre>";
} catch(DyanamoDbException $e) {
	echo $e->getMessage();
}


