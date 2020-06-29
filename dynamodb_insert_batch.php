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
	$ret = $dynamodb->batchWriteItem(array(
		'RequestItems' => array(
			$tbl_name => array(
				array(
					'PutRequest' => array(
						'Item' => array(
							'id' => array('N' => '12'),
							'name' => array('S' => '追加テスト2')
						)
					)
				),
				array(
					'PutRequest' => array(
						'Item' => array(
							'id' => array('N' => '13'),
							'name' => array('S' => '追加テスト3')
						)
					)
				)
			)
		)
	));
	echo "<pre>";
	print_r($ret);
	echo "</pre>";
} catch(DyanamoDbException $e) {
	echo $e->getMessage();
}


