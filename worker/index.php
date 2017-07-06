<?php
	require 'autoloader.php';
	ini_set('max_execution_time', 800);
	
	$worker = new Worker();
	
	$test2 = $worker::runWorker('/opt/lampp/htdocs/worker/data/', 'http://helion.pl/xml/produkty-wszystkie.xml');
	
	//Metoda sprawdzania zużycia zasobow {
/*	$time = microtime(TRUE);
    $mem = memory_get_usage();
		// tutaj wstawiamy funkcje ktora chcemy przetestowac
		
		// end
	print_r(array(
  		'memory' => (memory_get_usage() - $mem) / (1024 * 1024),
 	    'seconds' => microtime(TRUE) - $time
)); //  koniec testu*/

	
?>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="title" content="content">
	<meta name="description" content="content">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes" />
	<title>Worker</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.4.2/css/bulma.min.css">
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.css">
	<link rel="stylesheet" type="text/css" href="/worker/css/style.css">

	<script src="https://use.fontawesome.com/b195b119c5.js"></script>
</head>
<body>


<div class="container">
<label for="bookstore">Wybierz listę: </label>
	<select id="bookstore" name="bookstore" >
		<option value="" >Wybierz...</option>
		<option value="helion">Helion</option>
		<option value="onepress">Onepress</option>
		<option value="sensus">Sensus</option>
		<option value="septem">Septem</option>
		<option value="dlabystrzakow">Dla Bystrzaków</option>
		<option value="bezdroza">Bezdroża</option>
		<option value="ebookpoint">Ebookpoint</option>
		<option value="videopoint">Videopoint</option>
	</select>

	<table id="table_id" class="display">
    <thead>
        <tr>
            <th>isbn</th>
            <th>ean</th>
            <th>ident</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Row 1 Data 1</td>
            <td>Row 1 Data 2</td>
            <td>Row 1 Data 3</td>
        </tr>
        <tr>
            <td>Row 2 Data 1</td>
            <td>Row 2 Data 2</td>
            <td>Row 2 Data 3</td>
        </tr>
    </tbody>
</table>
	
</div>



	 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	 <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.js"></script>
	 <script src="/worker/js/app.js"> 




	 </script>
</body>
</html>