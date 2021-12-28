var x;
$( function() {
    x = $( "#sortable" ).sortable();
    $( "#sortable" ).disableSelection();
    
    setInterval(function(){
        
        var idsInOrder = $("#sortable").sortable("toArray");
        var final__ = idsInOrder.join(",");
        $("#order_val").val(final__);
        
    },500)
  } );