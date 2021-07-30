$(document).ready(function(){
  $('#search').keyup(function(event){
    var Search = $('#search').val();

    if (Search != '') {
      $.ajax({
        url: './../include/search.php',
        method: 'POST',
        data: {search:Search},
        success: function (data) {
          $('#content').html(data);
        }
      })
    }else {
      $('#content').html('');
    }

    $(document).on('click','a',function(){
      $('#search').val($(this).text());
      $('#content').html('');
    });
  });

  var value = $('#search').val();

  value = addEventListener("keyup", function(event) {
    if (event.keyCode === 13) {
      event.preventDefault();
      document.getElementById("btn-search").click();
    }
  });

  $(document).on('click','#btn-search', function(){
    var value = $('#search').val();
    $.ajax({
      url: './../include/displaysearch.php',
      method: 'POST',
      data:{query:value},
      success: function(data) {
        $("#searchResult").html(data);
        $("#searchResult").show();
        $("#allProduct").hide();
        $("#pagination_number").hide();
      }
    });
  });
});
