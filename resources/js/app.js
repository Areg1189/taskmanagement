/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

$('.task-edit-add').on('click', function () {
    var url = $(this).data('url');
    var container = $('.task-container');
    container.html('Loading ...');
    axios.get(url).then(function (response) {
        container.html(response.data.html);
        $('.datepicker').datetimepicker({
            icons: {
                time: 'glyphicon glyphicon-time far fa-clock',
                date: 'glyphicon glyphicon-calendar far fa-calendar-alt',
                up: 'glyphicon glyphicon-chevron-up fas fa-arrow-up',
                down: 'glyphicon glyphicon-chevron-down fas fa-arrow-down',
                previous: 'glyphicon glyphicon-chevron-left fas fa-arrow-left',
                next: 'glyphicon glyphicon-chevron-right fas fa-arrow-right',
                today: 'glyphicon glyphicon-screenshot fas fa-calendar-week',
            },
            format: 'YYYY-MM-DD H:m:s'
        });
        $('.select2').select2({
            ajax: {
                url: function () {
                    return $(this).data('url');
                },
                data: function (data) {
                    return {
                        search: data.term,
                    }
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
            }
        });
    })
});


$(document).on('click', '.save-button', function () {
    var form = $('.edit-add-form')[0];
    var t = $(form).attr("action"), n = $(form), i = new FormData(form);
    $.ajax({
        url: t,
        type: "POST",
        dataType: "json",
        data: i,
        processData: !1,
        contentType: !1,
        beforeSend: function () {
            $("body").css("cursor", "progress"), $(".has-error").removeClass("has-error"), $(".help-block").remove()
        },
        success: function (e) {
            $("body").css("cursor", "auto");
            if (e.errors) {
                $.each(e.errors, function (t, n) {
                    console.log($(".edit-add-form").find("[name='" + t + "']"));
                    var i = $(".edit-add-form").find('#' + t), r = i.first().parent().offset().top,
                        o = $("nav.navbar").height();
                    0 === Object.keys(e.errors).indexOf(t) && $("html, body").animate({scrollTop: (r - o) - 50 + "px"}, "fast"), i.parent().addClass("has-error").append("<span class='help-block' style='color:#f96868;font-size: 14px;'>" + n + "</span>")
                })
            } else {
                $(form).submit()
            }

        },
    })
});

$(document).on('submit', '.change-status', function (form) {
    form.preventDefault();
    var url = $(this).attr('action');
    $.ajax({
        url: url,
        type: 'PUT',
        data: $(this).serialize(),
        success:function(data){
            $('.task-container').prepend('<div class="alert alert-success alert-dismissible fade show">\n' +
                '        <button type="button" class="close" data-dismiss="alert">&times;</button>\n' +
                '        <span>data.message</span>\n' +
                '    </div>');
        }
    })
});




