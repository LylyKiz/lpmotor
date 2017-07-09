<div align="center" id="loadBar">bvbv</div>

<?php

include("function.php");
include("head.php");
global $db;
$action=$_REQUEST['action'];
if($action='add_project'){?>
    <p class="message-feedback"></p>
    <form id="feedback-valid">
        <input type="hidden" name="action" value="add_project.on">
Новый проект
        <ul id="feedback-form">
            <li><label>Название:</label><input type="text" name="name" maxlength="255"></li>
            <li><label>Ключ:</label><input type="text" name="kluch"></li>
        </ul>
        <button type="submit" id="send">Отправить</button>

        <!--<input type="submit" id="submit-send" value="Отправить" onclick="show()"></center>-->
    </form>
    <script type="text/javascript">

            $('#feedback-valid').submit(function(){
                var formNm = $('#feedback-valid');
                $.ajax({
                    type: 'POST',
                    url: "form.php?action=add_project.on",
                    data: formNm.serialize(),
                    // действие, при ответе с сервера
                    success: function (data) {
                        // в случае, когда пришло success. Отработало без ошибок
                        if (data.result == 'success') {
                            alert('форма корректно заполнена');
                            // в случае ошибок в форме
                        } else {
                            // перебираем массив с ошибками
                            for (var errorField in data.text_error) {
                                // выводим текст ошибок
                                $('#' + errorField + '_error').html(data.text_error[errorField]);
                                // показываем текст ошибок
                                $('#' + errorField + '_error').show();
                                // обводим инпуты красным цветом
                                $('#' + errorField).addClass('error_input');
                            }
                        }
                    }
                });
                // останавливаем сабмит, чтоб не перезагружалась страница
                return false;
            });

        </script>
<?}
if($action='add_project.on'){
    $errorContainer = array();
    $params = array(
        'name' => $_REQUEST['name'],
        'kluch' => $_REQUEST['kluch'],
     );

    // проверка всех полей на пустоту
    foreach($params as $fieldName => $oneField){
        if($oneField == '' || !isset($oneField)){
            $errorContainer[$fieldName] = 'Поле обязательно для заполнения';
        }
    }
//проверка на латиницу
    if(preg_match('/[^a-zA-z0-9_]/i', $params['kluch'])) {
        $errorContainer['kluch'] = 'Необходимо ввести в поле ключа только латиницу';
    }

// делаем ответ для клиента
    if(empty($errorContainer)){
        // если нет ошибок сообщаем об успехе
        echo (array('result' => 'success'));
        $db->query("INSERT INTO project SET ?u", $params);
    }else{
        // если есть ошибки то отправляем
        echo (array('result' => 'error', 'text_error' => $errorContainer));
    }




}

