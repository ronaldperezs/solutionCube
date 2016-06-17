$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$("#ejecutar").click(function(){

	var request = $.ajax({
	  url: "cube/" + $("#entrada").val(),
	  method: "GET"
	});
	 
	request.done(function( data ) {
		if(data.valido){
			if(data.mensaje){
				$("#consola").append(data.mensaje+"<br>");
			}			
		}else{
			alert("operacion erronea");
		}	  
	});
	 
	request.fail(function( jqXHR, textStatus ) {
	  alert( "Request failed: " + textStatus );
	});

});

$("#reiniciar").click(function(){

	var request = $.ajax({
	  url: "cube/reiniciar",
	  method: "GET"
	});
	 
	request.done(function( data ) {
	  $("#consola").html("");
	});
	 
	request.fail(function( jqXHR, textStatus ) {
	  alert( "Request failed: " + textStatus );
	});

});