(function(){
  //購入履歴の日付切り替え
  $(document).ready(function(){
    $.ajax({
        datatype : 'json',
        url : "/getDate",
        type : "GET",
    }).done(function(response) {
      var array = JSON.parse(response);
      for(var i=0; i < array.length; i++){
        $('.day' + i).text(array[i]);
        $('.day' + i).attr('href', '/order/' + array[i]);
      }
    }).fail(function(XMLHttpRequest, textStatus, errorThrown) {
        console.log(XMLHttpRequest.message);
        console.log(textStatus);
        console.log(errorThrown.message);
    });
  });
})();
