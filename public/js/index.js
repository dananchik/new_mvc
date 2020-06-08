$(document).ready(() => {
    function getCookie(name) {
        let matches = document.cookie.match(new RegExp(
            "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
        ));
        return matches ? decodeURIComponent(matches[1]) : undefined;
    }
    if (getCookie('part2')) {
        $('#listLoginDetails')
            .removeClass('active active_tab1')
            .removeAttr('href data-toggle')
            .addClass('inactive_tab1');


        $('#LoginDetails').removeClass('active');

        $('#listCompanyDetails')
            .removeClass('inactive_tab1')
            .addClass('active_tab1 active')
            .attr('href', '#CompanyDetails')
            .attr('data-toggle', 'tab');
        $('#CompanyDetails').addClass('active in').removeClass('fade');
    }

    $('#btn_login_next').click(() => {
            var error_email = '';
            var error_firstname = '';
            var error_lastname = '';
            var error_phone = '';
            var error_subject = '';
            var error_country = '';
            var error_birthday = '';
            var email = $('#email');

            if ($.trim(email.val()).length === 0) {
                error_email = 'lenght = 0'
                $('#error_email').text(error_email)
                email.addClass('has-error');
            } else {
                var filter = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;
                if (!filter.test(email.val())) {
                    error_email = 'invalid email'
                    $('#error_email').text(error_email)
                    email.addClass('has-error');
                } else {
                    error_email = '';
                    $('#error_email').text(error_email)
                    email.removeClass('has-error');
                    var firstname = $('#firstname');
                    if ($.trim(firstname.val()).length == 0) {
                        error_firstname = 'name = 0'
                        $('#error_firstname').text(error_firstname)
                        firstname.addClass('has-error')
                    } else {
                        error_firstname = '';
                        $('#error_firstname').text(error_firstname);
                        firstname.removeClass('has-error');
                        var lastname = $('#lastname');
                        if ($.trim(lastname.val()).length === 0) {
                            error_lastname = 'lastname = 0';
                            $('#error_lastname').text(error_lastname);
                            lastname.addClass('has-error');
                        } else {
                            error_lastname = '';
                            $('#error_lastname').text(error_lastname);
                            lastname.removeClass('has-error');
                            var subject = $('#subject');
                            if ($.trim(subject.val()).length === 0) {
                                error_subject = 'subject = 0';
                                $('#error_subject').text(error_subject);
                                subject.addClass('has-error');
                            } else {
                                error_subject = '';
                                $('#error_subject').text(error_subject);
                                subject.removeClass('has-error');
                                var phone = $('#phone');
                                if ($.trim(phone.val()).length === 0) {
                                    error_phone = 'phone = 0';
                                    $('#error_phone').text(error_phone);
                                    phone.addClass('has-error');
                                } else {
                                    var phone_filter = /^(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){10,14}(\s*)?$/;
                                    if (!phone_filter.test(phone.val())) {
                                        error_phone = 'invalid phone';
                                        $('#error_phone').text(error_phone);
                                        phone.addClass('has-error');
                                    } else {
                                        error_phone = '';
                                        $('#error_phone').text(error_phone);
                                        phone.removeClass('has-error');
                                        var birthday = $('#birthday');

                                        if (birthday.val().length === 0) {
                                            error_birthday = 'birthday = 0'
                                            $('#error_birthday').text(error_birthday);
                                        } else {
                                            error_birthday = ''
                                            $('#error_birthday').text(error_birthday);
                                            var country = $('#country')
                                            if (country.val().length === 0) {
                                                error_country = 'country invalid';
                                                $('#error_country').text(error_country);
                                                country.addClass('has-error');
                                            } else {
                                                error_country = '';
                                                $('#error_country').text(error_country);
                                                country.removeClass('has-error');
                                                if (error_email !== '' || error_firstname !== '' || error_lastname !== '' || error_subject !== '' || error_phone !== '' || error_country !== '' || error_birthday !== '') {
                                                    $('.alert-danger').text('неизвестная ошибка')
                                                } else {

                                                    $.ajax({
                                                        type: "POST",
                                                        cache: false,
                                                        dataType: "json",
                                                        data: {
                                                            'email': email.val(),
                                                            'firstname': firstname.val(),
                                                            'lastname': lastname.val(),
                                                            'subject': subject.val(),
                                                            'birthday': birthday.val(),
                                                            'phone': phone.val(),
                                                            'country': country.val(),
                                                            'first': true
                                                        },

                                                        success: (data) => {

                                                            if (!data.error) {
                                                                $('.alert-danger').fadeToggle(1000).text('');
                                                                $('.alert-success').fadeToggle(1000).text(data.data);
                                                                $('#listLoginDetails')
                                                                    .removeClass('active active_tab1')
                                                                    .removeAttr('href data-toggle')
                                                                    .addClass('inactive_tab1');

                                                                $('#LoginDetails').removeClass('active');

                                                                $('#listCompanyDetails')
                                                                    .removeClass('inactive_tab1')
                                                                    .addClass('active_tab1 active')
                                                                    .attr('href', '#CompanyDetails')
                                                                    .attr('data-toggle', 'tab');
                                                                $('#CompanyDetails').addClass('active in').removeClass('fade');
                                                            } else {
                                                                $('#btn_login_next').attr('disabled', false);
                                                                $('.alert-danger').text(data.errortext).fadeToggle(1000)
                                                            }
                                                        },
                                                        beforeSend: () => {
                                                            $('#btn_login_next').attr('disabled', true);
                                                        }

                                                    })


                                                }

                                            }
                                        }

                                    }

                                }
                            }
                        }
                    }
                }
            }
        }
    )
    $('#btn_company_next').click(() => {
        var company_error = ''
        var aboutme_error = ''
        var file_error = ''
        var position_error = ''
        var company = $('#company')
        if (company.val().length === 0) {
            company_error = 'company invalid';
            $('#error_company').text(company_error);
            company.addClass('has-error');
        } else {
            company_error = '';
            $('#error_company').text(company_error);
            company.removeClass('has-error');
            var aboutme = $('#aboutMe')
            if (aboutme.val().length === 0) {
                aboutme_error = 'aboutme invalid';
                $('#error_aboutMe').text(aboutme_error);
                aboutme.addClass('has-error');
            } else {
                aboutme_error = '';
                $('#error_aboutMe').text(aboutme_error);
                aboutme.removeClass('has-error');
                var position = $('#position')
                if (position.val().length === 0) {
                    position_error = 'position invalid';
                    $('#error_position').text(position_error);
                    position.addClass('has-error');
                } else {
                    position_error = '';
                    $('#error_position').text(position_error);
                    position.removeClass('has-error');
                    var file = $('#image').prop('files')[0]


                    if (file === undefined) {
                        file_error = 'file invalid';
                        $('#error_file').text(file_error)
                        $('#image').addClass('has-error');
                    } else {
                        file_error = '';
                        $('#error_file').text(file_error)
                        $('#image').removeClass('has-error');
                        var fd = new FormData();
                        fd.append('img', file)
                        fd.append('company', company.val())
                        fd.append('aboutme', aboutme.val())
                        fd.append('position', position.val())
                        $.ajax({
                            url: "/updateUser",
                            type: "POST",
                            cache: false,
                            processData: false,
                            contentType: false,
                            dataType: "json",
                            data: fd,


                            success: (data) => {
                                if (data.error) {
                                    $('.alert-danger').text(data.errortext).fadeToggle(1000);
                                    $('#btn_company_next').attr("disabled", false);
                                } else {
                                    $('.alert-success').text(data.data).fadeToggle(1000).delay(2000);
                                    $('#register_form').fadeOut(1000)
                                    $('.buttons').removeClass('d-none')
                                }

                            },
                            beforeSend: () => {
                                $('#btn_company_next').attr("disabled", true);
                            }

                        })
                    }
                }
            }
        }
    })
})