const input = document.getElementById("add");
const list = document.getElementById("list");

function addTask(){
    if(input.value === ''){
        alert("you should write something !!!");
    }
    else{
        let li = document.createElement("li");
        li.innerHTML = input.value;
        list.appendChild(li);
        let del = document.createElement("del");
        del.innerHTML="\u00d7";
        li.appendChild(del);
    }
    input.value="";
    save();
}

list.addEventListener("click",function(e){
    if(e.target.tagName === "LI"){
        e.target.classList.toggle("checked");
        save();
    }
    else if(e.target.tagName === "DEL"){
        e.target.parentElement.remove();
        save();
    }
}, false);


function save(){
    localStorage.setItem("task",list.innerHTML);
}
function show(){
    list.innerHTML=localStorage.getItem("task");
}
show();

