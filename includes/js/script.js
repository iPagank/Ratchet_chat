let socket = new WebSocket("ws://localhost:8080");
let user_name;
$(document).ready(function () {
  $('.toast').toast('show');

  let item = document.getElementById("dialog");
  item.scrollTop = item.scrollHeight;

  user_name = document.getElementById("user_name").textContent;
});

socket.onopen = function () {
  let data = {
    'connect':user_name
  }
  socket.send(JSON.stringify(data));
};

let button = document.getElementById("button_submit");

button.onclick = function (event) {
  let text = document.getElementById("textarea_message");
let data = {
  'name': user_name,
  'text': text.value
}
  if (data.name && data.text) {
    show_message(data.text, data.name, true);
    socket.send(JSON.stringify(data));
    
    text.value = "";
  }
};

socket.onmessage = function (event) {
  let data = JSON.parse(event.data);
  if(data.text && data.name){
  show_message(data.text, data.name, false);
  }
  if(data.connect){
    user_connect(data.connect);
  }
}

socket.onclose = function (event) {
  //code...
};

socket.onerror = function (error) {
  //code...
};

/**
 * Show messages on screeen
 * 
 * @param {string} str Message text
 * @param {string} name User name
 * @param {bool} boolean Specifies which side to display the message
 * 
 */
function show_message(str, name, boolean) {

  let item = document.getElementById("dialog");

  if (name && str) {
    if (boolean === true) {
      let send_message = `<div class="row d-flex flex-row mt-3">
<div class="col d-flex flex-row">
  <div class="toast" data-autohide="false">
    <div class="toast-header">
      <strong class="mr-auto text-primary">${name}</strong>
    </div>
    <div class="toast-body">
      ${str}
    </div>
  </div>
</div>
</div>`;

      item.insertAdjacentHTML('beforeend', send_message);
      item.scrollTop = item.scrollHeight;
      $('.toast').toast('show');
    }
    if (boolean === false) {
      let incoming_message = `<div class="row d-flex flex-row-reverse mt-3">
<div class="col d-flex flex-row-reverse">
  <div class="toast" data-autohide="false">
    <div class="toast-header">
      <strong class="ml-auto text-primary">${name}</strong>
    </div>
    <div class="toast-body">
      ${str}
    </div>
  </div>
</div>
</div>`;
      item.insertAdjacentHTML('beforeend', incoming_message);
      item.scrollTop = item.scrollHeight;
      $('.toast').toast('show');
    }
  }
}
/**
 * Function show connect message
 * 
 * @param {sting} data Name of user
 */
function user_connect(data){
 let item = document.getElementById('dialog');
 let message = `<div class="alert alert-success" id="user_join" role="alert">User ${data} connected!</div>`;
 item.insertAdjacentHTML('beforeend',message);
 let alert = document.getElementById('user_join');
 alert.style.display ='block';
}