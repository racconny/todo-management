let list_id = document.querySelector("#title").dataset.id;
let delete_buttons;
let edit_buttons;
let titles;

const sendRequest = (action, item, data, sender) => {
    $.ajax({
        url: "request_handler.php",
        type: "POST",
        data: {
            action: action,
            item: item,
            data: JSON.stringify(data)
        },
        success: function(data_){
            if (action === 'delete'){
                deletePoint(sender);
            }

            if (action === 'add'){
                prependPoint(data_, data);
            } 

            if (action === 'edit'){
                changeTitle(sender, data[1]);
            } 

            if (action === 'cross'){
                alert(data_);
            }
        }
    });
}

const changeTitle = (element, new_title) => {
    element.parentNode.children[0].innerHTML = new_title;
}

const refreshStat = () => {
    let points = document.querySelectorAll('.list-item');
    document.querySelector('.list-stat-all').innerHTML = points.length;

    let done = document.querySelectorAll('.crossed-item');
    document.querySelector('.list-stat-done').innerHTML = done.length;
}

const deletePoint = (element) => {
    $(element).parent().fadeOut(200, function() { 
        $(this).remove();

        setTimeout(refreshStat, 200);
    })
}

const refresh = () => {
    delete_buttons = document.querySelectorAll('.delete-btn');
    delete_buttons.forEach(function(elem){
            elem.addEventListener('click', function(){
            sendRequest('delete', 'point', this.dataset.id, this);
        });
    })

    edit_buttons = document.querySelectorAll('.edit-btn');
    edit_buttons.forEach(function(elem){
            elem.addEventListener('click', function(){
            let title = this.parentNode.children[0].innerHTML;
            let new_title = prompt("Enter new title", title);
            if (new_title){
                sendRequest('edit', 'point', [this.dataset.id, new_title], this);
            } 
        });
    })

    titles = document.querySelectorAll('.item-title');
    titles.forEach(function(elem){
        elem.addEventListener('click', function(){
        sendRequest('cross','point',[this.dataset.id, (this.classList.contains("crossed-item"))]);
        elem.classList.toggle("crossed-item");
        refreshStat();
    });

    refreshStat();
})

    let points = document.querySelectorAll('.list-item');
    document.querySelector('.list-stat-all').innerHTML = points.length;

    let done = document.querySelectorAll('.crossed-item');
    document.querySelector('.list-stat-done').innerHTML = done.length;
}

document.querySelector('.add-btn').addEventListener('click', function(){
    let point_title = document.querySelector('.new-item-title').value.trim();
    if (point_title){
        sendRequest("add", "point", [list_id, point_title]);
        refresh();
    } else alert("Enter something");
})

document.querySelector('.new-item-title').addEventListener("keyup", function(event) {
    if (event.keyCode === 13) {
      event.preventDefault();
      let point_title = this.value.trim();
      if (point_title){
        sendRequest("add", "point", [list_id, point_title]);
        refresh();
    } else alert("Enter something");
    }
});

const prependPoint = (id, title) => {
    title = title[1];
    //construct this element
    let item = document.createElement("div");
    let title_sign = document.createElement("span");
    let delete_btn = document.createElement("button");
    let edit_btn = document.createElement("button");

    item.classList.add("list-item");
    title_sign.innerHTML = title;
    title_sign.classList.add("item-title");
    title_sign.dataset.id = id;

    item.appendChild(title_sign);

    edit_btn.dataset.id = id;
    edit_btn.classList.add("item-button");
    edit_btn.classList.add("edit-btn");
    edit_btn.innerHTML = `<span class="fas fa-pen"></span>`;
    edit_btn.style.color = "#40acff";
    edit_btn.style.marginLeft = "5px";

    delete_btn.dataset.id = id;
    delete_btn.classList.add("item-button");
    delete_btn.classList.add("delete-btn");
    delete_btn.innerHTML = `<span class="fas fa-trash"></span>`;
    delete_btn.style.color = "#ff9f9f";
    delete_btn.style.marginLeft = "5px";

    item.appendChild(edit_btn);
    item.appendChild(delete_btn);

    let container = document.querySelector('.todos-container');

    $(container)
    .prepend($(item)
        .hide()
        .fadeIn(1000)
    );
    
    document.querySelector('.new-item-title').value = "";

    refresh();
}

refresh();
