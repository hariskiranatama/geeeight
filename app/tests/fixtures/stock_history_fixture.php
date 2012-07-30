<?php
/* StockHistory Fixture generated on: 2010-12-20 10:12:27 : 1292814927 */
class StockHistoryFixture extends CakeTestFixture {
    var $name = 'StockHistory';
    var $table = 'stock_history';
    var $import = array('model' => 'StockHistory');


    var $records = array(
		array(
			'id' => 1,
			'user_id' => 1,
			'status' => 'add',
			'stock_num' => 10,
			'created' => '2010-12-04 19:16:34',
			'modified' => '2010-12-04 19:16:34',
			'item_id' => 7
		),
		array(
			'id' => 2,
			'user_id' => 1,
			'status' => 'add',
			'stock_num' => 5,
			'created' => '2010-12-04 19:16:55',
			'modified' => '2010-12-04 19:16:55',
			'item_id' => 7
		),
	);
}
