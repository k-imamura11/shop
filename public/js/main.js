(function(){
  $(document).ready(function(){
    $.ajax({
        datatype : 'json',
        url : "/getDate",
        type : "GET",
    }).done(function(response) {
      var array = JSON.parse(response);
      alert(array[1]);
      for(var i=0; i < 6; i++){
        $('.days' +i).innerHTML = array[i];
      }
    }).fail(function(XMLHttpRequest, textStatus, errorThrown) {
        console.log(XMLHttpRequest.message);
        console.log(textStatus);
        console.log(errorThrown.message);
    });
  });
})();
