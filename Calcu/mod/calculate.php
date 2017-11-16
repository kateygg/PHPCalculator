<? php

try {

	if ( ! isset($_POST['sequence'])){

		throw new Exception('Invalid Request');
	}

	$values = array_filter(
		$_POST['sequence'],
		function($value) {

			return(
				is_numeric($value) ||
				in_array($value, array('+','-','/','*'))
			);
		}
	);

	if (empty($values)){

		throw new Exception("Empty Request");

	}

	$calculation = 'return ('.implode(' ', $values).');';
	$value = eval($calculation);

	echo json_encode([

		number_format($value, 1	)

	]);

} catch (Exception $e){
	
	header("HTTP/1.0 402 " . $e->getMessage());
}