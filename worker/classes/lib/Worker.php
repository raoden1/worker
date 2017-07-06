<?php

class Worker {

	
	/*Uruchamia Workera, przyjmuje parametry:
	$loc - (string) lokalizacja, gdzie plik .xml ma być zapisany
	$url - (string) z jakiego URL plik .xml ma być pobrany*/
	public function runWorker ($loc, $url){
		self::_downloadDataXml($loc, $url);
		self::_XMLToJsonFile(); 
	}

	//Pobieranie danych z URL do wybranego folderu| $localization = './../../', $url = 'http://helion.pl/xml/produkty-wszystkie.xml'
	private function _downloadDataXml($localization, $url) {
		// do użycia tej metody należy dodać ini_set('memory_limit', '32M'); => max size 32m
		/*$content = file_get_contents('http://helion.pl/xml/produkty-wszystkie.xml');
		file_put_contents('./data/produkty.xml', $content);*/ 
	  try {
			$dateFormat = self::_getDateCurrent();
			//echo $dateFormat;
			//sćieżka, do której zapisywany jest pobirany plik .xml
			$fileName = $localization.$dateFormat.'.xml';
			//Sprawdzeie czy plik istnieje, jeżeli NIE to łączy się z podanym URL i pobiera wymagany plik
			if ( file_exists($fileName) ) {

				echo "<p class='notification is-primary download' style='display: inline:block;'>Plik istnieje w :".$fileName."</p>";
						
			} else {
					//Sprawdzenie czy jest połączenie z URL, w przypadku niepowodzenia wyświetlany jest komunikat
					$process = fopen($url, 'r') or die('Nie można połączyć się z URL');
					if ( $process ) {
						echo '<p id="fileEx" class="notification is-primary" style="display: inline:block;">Brak pliku!<br>';
						echo '<p class="notification is-danger download">Trwa pobieranie bazy danych...</p><br>';
						//Odczyt z url
						$src = fopen($url, 'r');
						//Zapis pliku
						$dest = fopen($fileName, 'w');
						//kopiowanie z $src do $dest
						stream_copy_to_stream($src, $dest);

						//zakończenie połączenia 
						fclose($process);


						//echo stream_copy_to_stream($src, $dest1) . " bajtow skopiowanych do " . $fileName;
					} else {
							//Sygnalizuje błąd w przypadku podania nieprawidłowych parametrów
							throw new Exception('Błędnie podana ścieżka do źrodła lub pliku. Sprawdź połączenie z internetem');
						}
					
			} 
		} catch (Exception $e) { echo 'Wykryto błąd: ',  $e->getMessage(), "\n"; }
	}
	// Konwersja XML do array
	private function _xmlObjToArr() { 

		
		$dateCurrent = self::_getDateCurrent();
		$srcOfXML = "../worker/data/".$dateCurrent.".xml";
		//Array do, której dodaje się wszystkie wygenerowane kolumny z $kolumny
    	$stack = array();
    	//Ładowanie pliku .xml
		$xml = simplexml_load_file($srcOfXML) or die("Błąd: Nie można połączyć się z plikiem");
		// Ścieżka wybierania nodes lub node-sets w dokumencie XML
		$xmlXPath = $xml->xpath("/details/lista");
		//iterator
		$i=0;

			//Przeszukiwanie <details> w pliku .xml w poszukiwaniu <lista> ||Wykonuje się tyle razy ile jest elementów
			//<lista> w pliku
			foreach ($xmlXPath as $list) {


					//Ustala nazwę listy z atrybutu <lista baza=""> i grupuje w zbiory książek należące do danej listy.
        	      	$key = (string)$list->attributes()->baza;
        	      	$stack[$i] = array (
        	      		$key => self::_forEachTroughXMLArray($list)
        	      		);
        	      	$i++;

	    }

		return $stack;
		
		}//end of func xmlObjToArr


	private function _XMLToJsonFile(){
     ///opt/lampp/htdocs/worker/data/2017-07-04.xml

		
		$dateCurrent = self::_getDateCurrent();
		//Ścieżka zapisu pliku
		$fileName = '../worker/data/json/' . $dateCurrent . '.json';
		//Tablica do konwersji z Array do pliku .json 
		$arrToConvert = self::_xmlObjToArr();
		//konwersja do formatu json
		$json_data = json_encode( $arrToConvert, 128 );
		//Zapisanie danych json do pliku $fileName
		file_put_contents( $fileName, $json_data );

	}	
	// Przeszukuje daną <lista baza=""> pobierając informacje o każdej książce w tej liscie.
	private function _forEachTroughXMLArray($xpaths){

		$i=0;
				foreach ($xpaths->ksiazka as $book) {
		
	 			$kolumny = array(

	 				
        	      	"isbn" => (string)$book->isbn,
        	      	"ean" => (string)$book->ean,
        	      	"ident" => (string)$book->ident

        	     
        	     );
          
		 	$stack[$i] = $kolumny; 		

			    $i++;	

	        }
	        return $stack;
	}

	private function _getDateCurrent(){
		$date = new DateTime();
		return $date->format( 'Y-m-d' );
	}


}
















?>