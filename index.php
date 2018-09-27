<?php
$size = $password_size = "";
if(isset($_GET['submit'])){
	$size = $_GET['size'];
	$password_size = $_GET['pwd-len'];
	if(empty($size))
		$size = 5;

	if(empty($password_size)) {
		$password_size = 8;
	}
}

?>


<html>
<head>
	<title>User Generated Data</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="container">
	<h2>User Generated Data With PHP</h2>
	<p>Generate useful and limitless Data</p>
	<form action="index.php" method="GET">
		<div class="form-box">
			<label>Size of data N: </label>
			<input type="number" name="size" min=1 max=1000>
			<label>Password Length (optional)</label>
			<input type="number" name="pwd-len" min=1 max=30>
		    <input type="submit" name="submit" value="Submit">
		</div>
	</form>

	<?php generateData((int) $size, (int) $password_size); ?>
</div>
</body>
</html>


<?php


function generatePassword(int $length = 6) {
	$string = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

	if( $length < 0 or $length > strlen($string) ){
		return null;
	}

	return substr(str_shuffle($string), 0, $length);
}



function generateData(int $size, int $pwd_length){

	$json = file_get_contents('data.json');
	$jsonData = json_decode($json);
	$data = [];
    
    echo '<table>';
    echo '<tr>'.
         '<th>#</th><th>First Name</th><th>Last Name</th>'.
         '<th>Email</th><th>Dummy Password</th>'.
         '</tr>';
    

	for($i = 0; $i < $size; $i++ ){
		$rand = mt_rand(0, 999);
		$data[$i] = $jsonData[$i];
		echo $user = '<tr>
					<td>'.($i+1).'</td>
					<td>'.$jsonData[$rand]->first_name.'</td>
					<td>'.$jsonData[$rand]->last_name.'</td>
					<td>'.$jsonData[$rand]->email.'</td>
					<td>'.generatePassword($pwd_length).'</td>
				</tr>';
	}
    
   echo '</table>';

    return $data;
}

?>




















