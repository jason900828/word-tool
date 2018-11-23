var strUrl =location.search;
var getNamearr = strUrl.split("?name=");
var getName = getNamearr[1];


var d ;
$.ajax({
    url: "get_infor.php",
    type: "GET",
    data:  "&getName="+getName,
    contentType: false,
    cache: false,
    processData:false,
    success: function(data){
        d = data;
        var infor = d.split("\t");
        $("#buttom_name").val(infor[1]);
        $("#buttom_url").val(infor[0]);
        $("#image_label").html(infor[2]);
        $("#buttom_org").val(infor[1]);
    },
            
    error: function(){
        alert("error");
    }             
});
   