<? include("function.php");
include("head.php");
include("menu.php");
global $db;
?>
<br>
<title>Проекты</title>
<div class="content">
    <div>Проекты</div>
    <br>
    <table>
        <?
        $result = $db->query("SELECT * FROM project");
        while ($row = $db->fetch($result)) { ?>
            <tr>
                <a href="#">
                    <td>
                        <? echo $row['name']; ?>

                    </td>
                </a>
                <td>
                    <? echo $row['kluch']; ?>
                </td>
                <a href="#" >
                    <td>
                        <div class="block"><div class="child">Задачи</div></div>
                    </td>
                </a>
            </tr>
            <?
        }
        ?>


    </table>


    <a class="buttom" href="form.php?action=add_project">+ добавить</a>
</div>