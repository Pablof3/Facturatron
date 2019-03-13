function prueba()
{
    $.ajax({
        type: "GET",
        url: "http://localhost/MVC/Paginas/prueba",
        data: "",
        success: function (response) {
            alert(response);
        }
    });
}