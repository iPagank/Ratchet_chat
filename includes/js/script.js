let socket = new WebSocket("ws://localhost:8080");
socket.onopen = function (event) {
  //code...
};
$(document).ready(function () {
  $('.toast').toast('show');

  let item = document.getElementById("dialog");
  item.scrollTop = item.scrollHeight;

});

let button = document.getElementById("button_submit");

button.onclick = function (event) {
  let text = document.getElementById("textarea_message");

  if (text.value) {
    show_message(text.value, "Name", true);
    socket.send(text.value);
    text.value = "";
  }
};

socket.onmessage = function (event) {
  show_message(event.data, "Name", false);
}

socket.onclose = function (event) {
  //code...
};

socket.onerror = function (error) {
  //alert(`[error] ${error.message}`);
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
  let message_date = new Date();

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