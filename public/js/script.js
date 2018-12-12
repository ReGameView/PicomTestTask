$(document).ready(function () {
    $('#searchForm').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: 'ajax',
            data: $('#searchForm').serialize(),
            success: function (data) {
                let msg = "";
                data.forEach(function(item){
                    msg = msg + "<img src='" + item.img + "'> " + item.name + " " + item.percents + "%<br/>";
                });
                let result = document.querySelector('div.result');
                result.classList.remove("alert-success");
                result.classList.remove("alert-warning");
                if(data === '1') {
                    result.classList.add('alert-warning');
                    result.innerHTML = 'ERROR: Слишком длинный запрос. Ограничение до 255 символов';
                }else {
                    result.classList.add('alert-success');
                    result.innerHTML = msg;
                }
                result.style.border = "1px solid gray";
                result.style.height = "auto";
            }
        })
    })
});