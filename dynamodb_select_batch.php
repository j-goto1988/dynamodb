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

$keys = [];
$id_list = ['1', '5'];

foreach ($id_list as $id) {
	$keys[] = array(
		'id' => array('N' => $id)
	);
}

try {
	$ret = $dynamodb->batchGetItem(array(
		'RequestItems' => array(
			$tbl_name => array(
				'Keys' => $keys
			)
		)
	));
	echo "<pre>";
	print_r($ret);
	echo "</pre>";
} catch(DyanamoDbException $e) {
	echo $e->getMessage();
}


