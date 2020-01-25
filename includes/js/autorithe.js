/**
 * Login and Registration
 */
let registr_form = $("#registr_form");
let login_form = $("#login_form");

registr_form.on('submit', function (event) {
    event.preventDefault();
    let data = $(this).serializeArray();

    $.ajax({
        type: 'POST',
        url: './includes/server/registration.php',
        data: data,
        dataType: 'json',
        //cache: false,
        success: (r) => {
            if (r['error']) {
                $('#err_registr_pass').html(r['error']);
                $('#err_registr_pass').show();
                setTimeout(() => {
                    $('#err_registr_pass').hide();
                }, 2000);
            }
            if (r['success']) {
                $('#done_registr').html(r['success']);
                $('#done_registr').show();
                $('#err_registr_pass').hide();
                setTimeout(() => {
                    $('#done_registr').hide();
                    window.location.href = "http://websockets/chat.html";
                }, 500);
            }

        }
    });
});