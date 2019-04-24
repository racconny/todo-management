let list_id = document.querySelector("#title").dataset.id;
let delete_buttons;
let edit_buttons;

const sendRequest = (action, item, data, sender) => {
    $.ajax({
        url: "request_handler.php",
        type: "POST",
        data: {
            action: action,
            item: item,
            data: data
        },
        success: function(data_){
            if (action === 'delete' && item === 'point'){
                deletePoint(sender);
            }

            if ((action === 'add') && item === 'point'){
                prependPoint(data_, data);
                //alert(data);
            } 
        }
    });
}

const prependPoint = (id, title) => {
    title = title.split("|")[1];
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

    //and append this block

    let container = document.querySelector('.todos-container');
    container.prepend(item);
    
    document.querySelector('.new-item-title').value = "";

    refresh();
}

const deletePoint = (element) => {
    $(element).parent().fadeOut(300, function() { 
        $(this).remove();
        refresh();
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
            alert(this.dataset.id);
        });
    })

    let points = document.querySelectorAll('.list-item');
    document.querySelector('.list-stat-all').innerHTML = points.length;

    let done = document.querySelectorAll('.crossed-item');
    document.querySelector('.list-stat-done').innerHTML = done.length;
}

document.querySelector('.add-btn').addEventListener('click', function(){
    let point_title = document.querySelector('.new-item-title').value;
    sendRequest("add", "point", (list_id + "|" + point_title));
})

refresh();
