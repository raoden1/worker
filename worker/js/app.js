$(document).ready( function () {
    // Event wyboru z pola <select></select>
	$("#bookstore").on('change', function() {
        //element to <option></option> w tagu <select>. Następuje wyszykiwanie tego elementu,
        //który został zaznaczony i następnie w zależności od tego jaką wartość ma atrybut
        // {value} - ładuje odpowiednią listę z pliku .json 
      var element = $(this).find('option:selected'); 
        var bookstore = "";
     	  //console.log(bookstore);
     	if (element.attr("value") == "helion") { bookstore = "0.helion";}
     	else if (element.attr("value") == "undefined") { bookstore = "0.helion";}
     	else if (element.attr("value") == "onepress") { bookstore = "1.onepress";}
     	else if (element.attr("value") == "sensus") { bookstore = "2.sensus";}
     	else if (element.attr("value") == "septem") { bookstore = "3.septem";}
     	else if (element.attr("value") == "dlabystrzakow") { bookstore = "4.dlabystrzakow";}
     	else if (element.attr("value") == "bezdroza") { bookstore = "5.bezdroza";}
     	else if (element.attr("value") == "ebookpoint") { bookstore = "6.ebookpoint";}
     	else if (element.attr("value") == "videopoint") { bookstore = "7.videopoint";}
     	else{
     		alert('Nie można odnaleźć danych lub nie wybrano bazy!');
     	}	
     
     	var fileName = getCurrentDate();
        //DataTables framework, inicjalizacja obiektu. Przy ponownym tworzeniu tabeli wymaga się
        //by poprzednia tabela została wyczyszczona i zniszczona i na nowo zainicjalizowana
     $('#table_id').DataTable().clear().destroy();
        var table = $('#table_id').DataTable({
            //spolszczenie DataTabel
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Polish.json"
            },
        	responsive: true,
        	ajax: {
            url: '/worker/data/json/'+ fileName +'.json',
            dataSrc:  bookstore
        },
            	
       	 columns: [
         	{data :"isbn"},
         	{data :"ean"},
         	{data :"ident"}
         ]
         
        });

     table.ajax.reload();
});

//Funkcja zwracająca datę w formacie YYYY-MM-DD
function getCurrentDate(){
	var today = new Date();
	var day = today.getDate();
	var month = today.getMonth()+1; //Syczeń zaczyna się jako 0!
	var year = today.getFullYear();

		if(day<10) {
		    day = '0'+day;
		} 

		if(month<10) {
 		   month = '0'+month;
		} 

	today = year + '-' + month + '-' + day;
	return today;
} 
$(function() {
    //Znikanie komunikatów
    setTimeout(function() { $("#fileEx").fadeOut(1500); }, 5000)

    setTimeout(function() { $(".download").fadeOut(1500); }, 10000)

});
});