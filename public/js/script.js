$(document).ready(function () {
    $('#searchForm').on('submit', function (e) {
        e.preventDefault();
        let result = document.querySelector('div.result');
        result.classList.remove("alert-success");
        result.classList.remove("alert-danger");
        result.innerHTML = "";
        $.ajax({
            type: 'POST',
            url: 'ajax',
            data: $('#searchForm').serialize(),
            success: function (data) {
                let msg = "";
                data.forEach(function(item){
                    msg = msg + "<img src='" + item.img + "'> " + item.name + " " + item.percents + "%<br/>";
                });
                result.classList.add('alert-success');
                result.innerHTML = msg;
            },
            statusCode: {
                422:    function (data) {
                    // Т.к. валидация только на максимум символов, не будем парсить json, сразу покажем кто тут батя
                    result.classList.add('alert-danger');
                    result.innerText = 'Введено слишком большой текст. Максимум: 255';
                }
            }
        });
        result.style.border = "1px solid gray";
        result.style.height = "auto";
    })
});