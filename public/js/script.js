$(document).ready(function () {
    $('#searchForm').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: 'ajax',
            data: $('#searchForm').serialize(),
            success: function (data) {
                let result = document.querySelector('div.result');
                // result.innerHTML = "";
                result.style.background = 'lightgreen';
                result.style.border = "1px solid gray";
                result.style.height = "200px";
                result.innerHTML = data;
            }
        })
    })
});