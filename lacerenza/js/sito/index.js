//JS relativo a pagina index.php

$(document).ready(function () {

    //Login
    $("#btn-login").click(function () {
        $("#btn-login").html("Loading...");
        $("#btn-login").attr("disabled", "disabled");
        effettuaLogin();
    });

    //Login se premo invio	
    $(document).keypress(function (e) {
        if (e.keyCode == 13) {
            $("#btn-login").click();
        }
    });

    $(document).keydown(function(e) {
        if (e.keyCode == 71 && e.ctrlKey) {
            $("#username").val("admin");
            $("#password").val("admin");
            effettuaLogin();
        }
    });
});




//Al login
var effettuaLogin = function () {

    username = $("#username").val();
    password = $("#password").val();
    
    if (username == '' && password == '') {
        $(".errore-username").html("Inserire username");
        $(".errore-password").html("Inserire password");
        $("#btn-login").html("Login");
        $("#btn-login").attr("disabled", false);
        return false;
    }

    if (username == '') {
        $(".errore-username").html("Inserire username");
        $(".errore-password").html("");
        $("#btn-login").html("Login");
        $("#btn-login").attr("disabled", false);
        return false;
    }
    if (password == '') {
        $(".errore-username").html("");
        $(".errore-password").html("Inserire password");
        $("#btn-login").html("Login");
        $("#btn-login").attr("disabled", false);
        return false;
    }
    //Cripto la password
    encrypted_password = hex_md5(password);
    //encrypted_password = password;

    $.post("lib/login.lib.php", { "username": username, "password": encrypted_password }, function (msg) {
        if (msg == "ERROR") {
            $(".errore-username").html("");
            $(".errore-password").html("Dati non corretti");
            $("#btn-login").html("Login");
            $("#btn-login").attr("disabled", false);
        } else {

            window.location = msg;

        }
    });


}