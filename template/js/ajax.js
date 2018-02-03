$(document).ready(function () {
    $('#userName').click(function () {
        $.post('ajax.php', {name: $("#userName").val()}, function (data) {
            data = JSON.parse(data);
            $('.newlist').empty();
            $(".pag").empty();
            for (var id in data) {
                $('.newlist').append("<tr>" +
                    "<td style=\"\">\n" +
                    "<img src='" + data[id].img + "' width='100px' height='75px' class=\"img-rounded\">\n" + "</td>" +
                    "<td>" + data[id].name + "</td>" +
                    "<td>" + data[id].email + "</td>" +
                    "<td>" + data[id].status + "</td>" +
                    "<td>" + data[id].text + "</td>" +
                    "</tr>");
            }

        });
    });

    $('#userEmail').click(function () {
        $.post('ajax.php', {email: $("#userEmail").val()}, function (data) {
            data = JSON.parse(data);
            $('.newlist').empty();
            $(".pag").empty();
            for (var id in data) {
                $('.newlist').append("<tr>" +
                    "<td style=\"\">\n" +
                    "<img src='" + data[id].img + "' width='100px' height='75px' class=\"img-rounded\">\n" + "</td>" +
                    "<td>" + data[id].name + "</td>" +
                    "<td>" + data[id].email + "</td>" +
                    "<td>" + data[id].status + "</td>" +
                    "<td>" + data[id].text + "</td>" +
                    "</tr>");
            }
        });
    });

    $('#userStatus').click(function () {
        $.post('ajax.php', {status: $("#userStatus").val()}, function (data) {
            data = JSON.parse(data);
            $('.newlist').empty();
            $(".pag").empty();
            for (var id in data) {
                $('.newlist').append("<tr>" +
                    "<td style=\"\">\n" +
                    "<img src='" + data[id].img + "' width='100px' height='75px' class=\"img-rounded\">\n" + "</td>" +
                    "<td>" + data[id].name + "</td>" +
                    "<td>" + data[id].email + "</td>" +
                    "<td>" + data[id].status + "</td>" +
                    "<td>" + data[id].text + "</td>" +
                    "</tr>");
            }
        });
    });
});