jQuery(function(){
    function scroll_to_top(speed) {
        $('body,html').animate({scrollTop: 0}, speed);
    }

    function scroll_to_elem(elem,speed) {
        if(document.getElementById(elem)) {
            var destination = jQuery('#'+elem).offset().top;
            jQuery("body,html").animate({scrollTop: destination}, speed);
        }
    }
    // Сбрасываем значения всех полей на странице
  //  $('.text').val('');

    // Функция проверки правельности введеного имени
    function NameCheck(){
        // Убираем все классы с поля «Ваше имя»
        $('#userName').removeClass();
        // Определяем длину значения поля
        var nameLngth = $('#userName').val().length;
        if((nameLngth <= 1)||($('#userName').val().indexOf(' ')<= 0)){
            $('#userName').addClass('notValid');
            $('#userName').next().text('Введите пожалуйста ваше имя и фамилию');
            return false;
        } else {
            // Здесь мы пишем что должно быть, если все введено верно
            $('#userName').addClass('valid');
            $('#userName').next().text('');
            return true;
        }
    }


    function CityCheck(){
    // Функция срабатывает по событию .blur поля Сity
        $('#City').removeClass();
        var CityLngth = $('#City').val().length;
        if(CityLngth <=1 ){
            $('#City').addClass('notValid');
            $('#City').next().text('Введите пожалуйста название города');
            return false;
        }
       else{
            $('#City').addClass('valid');
            $('#City').next().text('');
            return true;
        }
    }
    function EmailCheck(){
        // Убираем все классы с поля «Ваш e-mail»
        $('#userEmail').removeClass();
        // Берем значение поля «Ваш e-mail»
        var emailV = $('#userEmail').val();
        // Задаем регулярное выражение которое проверит наш e-mail
        var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,6})+$/;
        // Проверяем верно ли введен e-mail
        if (filter.test(emailV)) {
            $('#userEmail').addClass('valid');
            $('#userEmail').next().text('');
            return true;
        } else {
            // Здесь мы пишем что должно быть, если e-mail введен неверно
            $('#userEmail').addClass('notValid');
            $('#userEmail').next().text('Введите пожалуйста правильно ваш e-mail');
            return false;
        }
    }

    function PhoneCheck(){
        // Убираем все классы с поля «Ваш номер телефона»
        $('#phoneNumber').removeClass();
        // Берем значение поля «Ваш номер телефона»
        var phoneV = $('#phoneNumber').val();
        // Определяем длину значения поля
        var phoneLngth = phoneV.length;
        // Проверяем чтобы в поле были только цифры
        if( /[^0-9]/.test(phoneV) ) {
            $('#phoneNumber').addClass('notValid');
            $('#phoneNumber').next().text('Номер телефона должен содержать только цифры');
            return false;
        } else if (phoneLngth <= 5) {
            // Проверяем чтобы длина номера телефона была не меньше 6 символов
            $('#phoneNumber').addClass('notValid');
            $('#phoneNumber').next().text('Введите пожалуйста ваш номер телефона');
            return false;
        } else {
            // Здесь мы пишем что должно быть, если все введено верно
            $('#phoneNumber').addClass('valid');
            $('#phoneNumber').next().text('');
            return true;
        }
    }

    function CodeCheck()
    {
        $("#msgbox").removeClass().addClass('messagebox').text('Проверка...').fadeIn("slow");
        $.post("ajax/regvalidation",{ code:$('#code').val() } ,function(data)
        {
            if(data=='no')
            {
                $("#msgbox").fadeTo(200,0.1,function()
                {
                    $('#msgbox').html('Введен некорректный код').addClass('messageboxerror').fadeTo(900,1);
                    return false;
                });
            }
            else
            {
                $("#msgbox").fadeTo(200,0.1,function()
                {
                    $('#msgbox').html('Код доступен для регистрации').addClass('messageboxok').fadeTo(900,1);
                    return true;
                });
            }

        });

    }
    var filesExt = ['jpg', 'gif', 'png'];
    function PhotoCheck(){
    var parts = $('#photo').val().split('.');
    $("#msgbox_photo").removeClass().addClass('messagebox').text('Проверка...').fadeIn("slow");
        if(filesExt.join().search(parts[parts.length - 1]) == -1){
            // alert('Good!');
            $('#msgbox_photo').html('Направильный формат').addClass('messageboxerror').fadeTo(900,1);
        return false;
        }
        else if ($('#photo').val().length < 3){
                $('#msgbox_photo').html('Выберите файл').addClass('messageboxerror').fadeTo(900,1);
            return false;
            }
            else
            {
                $('#msgbox_photo').html('Успешно').addClass('messageboxok').fadeTo(900,1);
                return true
            };
    }

    function CheckAgree(){
        $("#msgbox_Agree").removeClass().text('');
        if ($("#Agree").prop("checked")){
            return true;
        }
        else{
            $('#msgbox_Agree').html('Нужно принять условия договора').addClass('messageboxerror').fadeTo(900,1);
            return false;
        };
    }
    //Проверки по нажитию кнопки
    $("form[name='feedBack']").submit(function(){
        if (!CodeCheck()){
            //return false;
        }
        if ( !NameCheck() || !CityCheck() || !EmailCheck()|| !PhoneCheck()||!CheckAgree() || !PhotoCheck()){
           // alert("all is good");
            scroll_to_top(3000);
    return false;
        }
        else{
        return true;
        }
    });
    //Проверки по выходу из поля
    $('#userName').blur(function(){
        NameCheck();
    });

    $('#City').blur(function() {
        CityCheck();
    }
    );

    $('#userEmail').blur(function(){
       EmailCheck();
    });

    $('#phoneNumber').blur(function(){
        PhoneCheck();
    });

    $("#code").blur(function(){
        CodeCheck();
    });

     // массив расширений
    $('input[type=file]').change(function(){
       PhotoCheck();
    });
    $('#Agree').change(function(){
       CheckAgree();
    });

});