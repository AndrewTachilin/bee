<?php include('../controllers/PostController.php');?>
<style>
    .popup-box {
        position: absolute;
        border-radius: 5px;
        background: #fff;
        display: none;
        box-shadow: 1px 1px 5px rgba(0,0,0,0.2);
        font-family: Arial, sans-serif;
        z-index: 9999999;
        font-size: 14px;


    }

    .popup-box .close {
        position: absolute;
        top: 0px;
        right: 0px;
        font-family: Arial, Helvetica, sans-serif;
        font-weight: bold;
        cursor: pointer;
        color: #434343;
        padding: 20px;
        font-size: 20px;
    }

    .popup-box .close:hover {
        color: #000;
    }

    .popup-box h2 {
        padding: 0;
        margin: 0;
        font-size: 18px;
    }
    .popup-box .top {
        padding: 20px;
    }

    .popup-box .bottom {
        height: 100px;
        background: #eee;
        border-top: 1px solid #e5e5e5;
        padding: 20px;
        border-bottom-left-radius: 5px;
        border-bottom-right-radius: 5px;
    }

    #blackout {
        background: rgba(0,0,0,0.3);
        position: absolute;
        top: 0;
        overflow: hidden;
        z-index: 999999;
        left: 0;
        display: none;
    }
</style>
    <div class="container" style="padding-top: 50px">
        <table class="table">
            <thead>
            <?php ?>  <tr>
                <th>
                    <a href="&page=<? if($_GET['page']>=1)echo $_GET['page']-1?>&field=name&sort=asc">
                        <li style="float: left;  list-style-type: none;"><span class="glyphicon glyphicon-chevron-up"></span></a>
                    Firstname
                    <a href="?page=<? if($_GET['page']>=1)echo $_GET['page']-1?>&field=name&sort=desc">
                        <li style="float: left;  list-style-type: none; margin-left: 5px"> <span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span> <span class="glyphicon-class"></span> </li></a>
                </th>
                </li>
                <th>
                    <a href="?page=<? if($_GET['page']>=1)echo $_GET['page']-1?>&field=task&sort=asc">
                        <li style="float: left;  list-style-type: none;"><span class="glyphicon glyphicon-chevron-up"></span></a>
                    text
                    <a href="?page=<? if($_GET['page']>=1)echo $_GET['page']-1?>&field=task&sort=desc">
                        <li style="float: left;  list-style-type: none; margin-left: 5px"> <span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span> <span class="glyphicon-class"></span> </li></a>
                </th>
                <th>
                    Setstatus
                </th>
                <th>
                    <a href="?page=<? if($_GET['page']>=1)echo $_GET['page']-1?>&field=email&sort=asc">
                        <li style="float: left;  list-style-type: none;"><span class="glyphicon glyphicon-chevron-up"></span></a>
                    Email
                    <a href="?page=<? if($_GET['page']>=1)echo $_GET['page']-1?>&field=email&sort=desc">
                        <li style="float: left;  list-style-type: none; margin-left: 5px"> <span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span> <span class="glyphicon-class"></span> </li></a>
                </th>
                <th>
                    Image
                </th>
                    <th>
                        status
                    </th>

            </tr>
            </thead>
            <tbody>
            <?php

            if(isset($_POST['logout'])){
                $_SESSION['admin'] = false;
            }
            foreach ($pagination as $oneTask){
                if($oneTask['status']==1){
                    $class = 'Success';
                    $oneTask['status'] = '<span class="glyphicon glyphicon-list-alt"> Working</span>';

                }else{ $class = 'Danger';
                    $oneTask['status'] = '<span class="glyphicon glyphicon-remove"> Waiting</span>';

                }
             ?>
                <tr class="'.$class.'">                
                    <th><?=$oneTask['name']?>
                    </th>
                    <th>

                        <?php

                        if($_SESSION['admin']){?>
                        <form method="post">
                         <input type="text" name="updateText" value="<?=$oneTask['task']?>"/>
                         <input  type="hidden" name="id" value="'.$oneTask['id'].'"/> 
                         <input type="submit" name="updateSubmit" style="    margin-left: 100px;margin-top: 20px;padding-left: 10px;">
                          <input type="checkbox" name="option" value="1">
                        </form></th>
                    <?php }else{
                echo $oneTask['task']; }?>
                    <th><?=$oneTask['email']?></th>
                    <th> <img width="320" height="240" src="<?=$oneTask["image"]?>"></th>
                      <th><?=$oneTask['status']?></th>
                     
                </tr>
            <?php
            }
            ?>
    </div>
    </tbody>
    </table>
    </div>
    <nav aria-label="Page navigation">
        <ul class="pagination" style="padding-left: 40%">
            <?php if($_GET['page']>1){?>
                <li>
                    <a href="?page=<? if($_GET['page']>=1)echo $_GET['page']-1?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            <? } ?>
            <?php
            for ($i=1; $i<=count($allTasks)/2;$i++){
                echo "<li><a href='?page=$i'>$i</a></li>";
            }
            ?>
            <?php

            if($_GET['page']<count($allTasks)/2){?>
                <li>
                    <a href="?page=<? if($_GET['page']< count($allTasks)/2)echo $_GET['page']+1?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            <?php }
            ?>

        </ul>
    </nav>
    <form id="form" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="Email">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" id="userName" placeholder="User name" name="name">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" id="text" placeholder="text" name="text">
        </div>

        <div class="form-group">
            <label for="exampleInputFile">File input</label>
            <input type="file" id="exampleInputFile" name="image">
            <p class="help-block">Example block-level help text here.</p>
        </div>

        <button type="submit" class="btn btn-default" name="submit">Submit</button>

   <a class="popup-link-1" href="" onclick="value()">Preview </a>

<div class="popup-box" id="popup-box-1">
    <div class="close">X</div>
    <div class="top">
        <h2>Preview</h2>
    </div>
    <div class="bottom">
       <div class="info">
           <div id="namePreview"></div>
           <div id="emailPreview"></div>
            <div id="taskPreview"></div>



        </div>
    </div>
</div>


    </form>


    </body>
    </html>

<script>
function value() {


    var text = document.getElementById('text');
    var appendtext = document.getElementById('taskPreview');
    appendtext.innerHTML = $('#text').val();



    var name = document.getElementById('userName');
    var appendName = document.getElementById('namePreview');
    appendName.innerHTML = $('#userName').val();



    var email = document.getElementById('exampleInputEmail1');
    var appendEmail = document.getElementById('emailPreview');
    appendEmail.innerHTML = $('#exampleInputEmail1').val();

}
</script>



<script>
    $(document).ready(function() {

        $('body').append('<div id="blackout"></div>');

        var boxWidth = 400;
        function centerBox() {

            /* определяем нужные данные */
            var winWidth = $(window).width();
            var winHeight = $(document).height();
            var scrollPos = $(window).scrollTop();

            /* Вычисляем позицию */

            var disWidth = (winWidth - boxWidth) / 2;
            var disHeight = scrollPos + 150;

            /* Добавляем стили к блокам */
            $('.popup-box').css({'width' : boxWidth+'px', 'left' : disWidth+'px', 'top' : disHeight+'px'});
            $('#blackout').css({'width' : winWidth+'px', 'height' : winHeight+'px'});

            return false;
        }
        $(window).resize(centerBox);
        $(window).scroll(centerBox);
        centerBox();
        $('[class*=popup-link]').click(function(e) {

            /* Предотвращаем действия по умолчанию */
            e.preventDefault();
            e.stopPropagation();

            /* Получаем id (последний номер в имени класса ссылки) */
            var name = $(this).attr('class');
            var id = name[name.length - 1];
            var scrollPos = $(window).scrollTop();

            /* Корректный вывод popup окна, накрытие тенью, предотвращение скроллинга */
            $('#popup-box-'+id).show();
            $('#blackout').show();
            $('html,body').css('overflow', 'hidden');

            /* Убираем баг в Firefox */
            $('html').scrollTop(scrollPos);
        });

        $('[class*=popup-box]').click(function(e) {
            /* Предотвращаем работу ссылки, если она являеться нашим popup окном */
            e.stopPropagation();
        });
        $('html').click(function() {
            var scrollPos = $(window).scrollTop();
            /* Скрыть окно, когда кликаем вне его области */
            $('[id^=popup-box-]').hide();
            $('#blackout').hide();
            $("html,body").css("overflow","auto");
            $('html').scrollTop(scrollPos);
        });
        $('.close').click(function() {
            var scrollPos = $(window).scrollTop();
            /* Скрываем тень и окно, когда пользователь кликнул по X */
            $('[id^=popup-box-]').hide();
            $('#blackout').hide();
            $("html,body").css("overflow","auto");
            $('html').scrollTop(scrollPos);
        });
    });
</script>
