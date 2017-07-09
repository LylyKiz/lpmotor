$(function () {                             // когда страница загружена
    $('.menu a').each(function () {      // проходим по нужным нам ссылками
        var location = window.location.href // переменная с адресом страницы
        var link = this.href                // переменная с url ссылки
        var result = location.match(link);  // результат возвращает объект если совпадение найдено и null при обратном

        if(result != null) {                // если НЕ равно null
            $(this).addClass('current');    // добавляем класс
        }
    });
});
