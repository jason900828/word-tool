

function change(){

	var button = document.getElementById('cha').innerHTML;

	if(button == "刪除按鈕"){
		var add_card = document.getElementById('add_card');
        add_card.style.display = "none";
        var del_card = document.getElementById('del_card');
        del_card.style.display = "";
        document.getElementById('cha').innerHTML = "新增按鈕";
	}
	else if(button == "新增按鈕"){
		var del_card = document.getElementById('del_card');
        del_card.style.display = "none";
        var add_card = document.getElementById('add_card');
        add_card.style.display = "";
        document.getElementById('cha').innerHTML = "刪除按鈕";
	}
}