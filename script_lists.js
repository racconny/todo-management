let edit_buttons = document.querySelectorAll(".edit-btn");
let delete_buttons = document.querySelectorAll(".delete-btn");

delete_buttons.forEach(function(elem){
    elem.addEventListener('click', function(){
        if (confirm("Are you really sure?")){
            sendRequest("delete", "list", this.dataset.id, this);
        }
    });
})

edit_buttons.forEach(function(elem){
    elem.addEventListener('click', function(){
        let new_name = prompt("Enter new list name:", this.parentNode.parentNode.children[0].children[0].innerHTML);
        sendRequest("edit", "list", [this.dataset.id, new_name], this);
    });
})

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
            if (action === "add"){
                location.reload();
            } else if (action === "delete"){
                afterRemoveHandler(sender);
            } else if (action === "edit"){
                afterEditHandler(sender, data[1]);
            }
        }
    });
}

const addList = () => {
    let title = prompt("Enter your list title", "").trim();
    if (title){
        sendRequest("add", "list", title);
    }
}

const afterRemoveHandler = (element) => {   
    $(element).parent().parent().fadeOut(200, function() { 
        $(this).remove();
    })
}

const afterEditHandler = (element, new_title) => {
    element.parentNode.parentNode.children[0].children[0].innerHTML = new_title;
}

