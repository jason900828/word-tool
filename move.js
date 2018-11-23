

    

function mouse_move(move_obj)
{
    var el = document.getElementById('cards');
    
    Sortable.create(el, {
      // 參數設定[註1]
      disabled: false, // 關閉Sortable
      animation: 150,  // 物件移動時間(單位:毫秒)
      handle: ".cards",  // 可拖曳的區域
      filter: ".ignore",  // 過濾器，不能拖曳的物件
      preventOnFilter: true, // 當過濾器啟動的時候，觸發event.preventDefault()
      draggable: ".gb_T",  // 可拖曳的物件
      ghostClass: "sortable-ghost",  // 拖曳時，給予物件的類別
      chosenClass: "sortable-chosen",  // 選定時，給予物件的類別
      forceFallback: false  // 忽略HTML5 DnD
    });
} 


