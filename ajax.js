var d ;
$.ajax({
    url: "add_buttom.php",
    type: "POST",
    data:  new FormData(this),
    contentType: false,
    cache: false,
    processData:false,
    success: function(data){
        d = data;
        $("#cards").html(d);
        
    },
            
    error: function(){
        alert("error");
    }             
});
    