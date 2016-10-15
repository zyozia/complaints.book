<div class="container">
    <div class="row">
        <h1><?=$title?></h1>
    </div>
</div>
<hr>
<?php

// повідомлення про успішне редагування
Messages::getInfo('edits','edit');
// повідомлення помилок введення форм при редагуванні
Messages::getWrong('errorFormEdits','edit');
// інша помилка при редагуванні
Messages::getWrong('errorEdits','edit');

// повідомлення про додання запису в базу
Messages::getInfo('create','my');
//повідомлення помилок введення форм
Messages::getWrong('errorForm','my');
//повідомлення авторизації
Messages::getWrong('errorAut','us');
//видалення 
Messages::getInfo('del','drop');
//помилка видалення видалення 
Messages::getWrong('errors','drop');
/**/
Messages::getBrowser();
?>

<!--
<p>Модератору дозволяється - редагувати та видаляти повідомлення.  
Після успішної авторизації, у тому ж інтерфейсі додати додаткові функціональні елементи для
забезпечення дій модератора (кнопки Редагувати та Видалити).<hr>

-->
<div class="table-responsive">
<table  id="myTable" class="table table-striped table-hover table-responsive table-border tablesorter">
	<thead>
	<tr>
        <th class="text-center">Ім'я</th>
        <th class="text-center">Email</th>
        <th class="text-center">Дата</th>
        <th class="text-center">Скарга</th>
		<?php if($moderator):?>
		<th class="notsort text-center"><button class="btn btn-default"><i class="glyphicon glyphicon-pencil" aria-hidden="true"></i></button></th>
		<th class="notsort text-center"><button class="btn btn-default"><i class="glyphicon glyphicon-trash" aria-hidden="true"></i></button></th>
		<?php endif; ?>
    </tr>
	</thead>
	<tbody>
<?php if(is_array($complaints)) : ?>
	<?php $i=1; foreach($complaints as $complaint) : ?>
    <tr>
        <td><?=$complaint['username']?></td>
        <td><?=$complaint['email']?></td>
        <td><?=date("d.m.Y H:i:s", strtotime($complaint['adddate']));?></td>
        <td><?=$complaint['complaint']?></td>
		<?php if($moderator):?>
		
		<td class="text-center"><button id="btn-<?=$complaint['id']?>" class="btn btn-success seting" data-toggle="modal" data-target="#modal-1"> <i class="glyphicon glyphicon-pencil" aria-hidden="true"></i></button></td>
		<td class="text-center"><button id="drop-<?=$complaint['id']?>" class="btn btn-danger seting" data-toggle="modal" data-target="#modal-1"><i class="glyphicon glyphicon-trash" aria-hidden="true"></i></button></td>
		<?php endif; ?>
		
	</tr>
    <?php $i++;
	endforeach; ?>
<?php endif ;?>
    </tbody>
</table>
</div>
<?=$pagination?>
<br>
<!--
<p>Форма додавання запису в книгу повинна мати наступні поля:
<br>Ім'я – обов'язкове поле
<br>E-mail – обов'язкове поле
<br>Сайт – необов'язкове поле
<br>CAPTCHA (цифри і букви латинського алфавіту, можна використати готову) – зображення і обов'язкове поле
<br>текст (безпосередньо сам текст, HTML теги неприпустимі) – обов'язкове поле

<br>
<br>
-->
<hr>
<p class="text-primary">Тут ви можете залишити свый відгук</p>
<p class="text-primary">Поля відзначені<span class="text-danger"> * </span>обовязковідля заповнення</p>
<br>
<form method="post" action="" class="form-horizontal">
    <div class="form-group">
        <label for="inputName" class="col-sm-2 col-xs-1 control-label"><span class="text-danger"> * </span> Ім'я</label>
        <div class="col-sm-6 col-xs-5">
            <input type="text" class="form-control" name="my[username]" id="inputName" placeholder="Ім'я">
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail" class="col-sm-2 col-xs-1 control-label"><span class="text-danger"> * </span> Email</label>
        <div class="col-sm-6 col-xs-5">
            <input type="email" class="form-control" name="my[email]" id="inputEmail" placeholder="Email">
        </div>
    </div>
    <div class="form-group">
        <label for="inputSite" class="col-sm-2 col-xs-1 control-label">Сайт</label>
        <div class="col-sm-6 col-xs-5">
            <input type="text" class="form-control" name="my[site]" id="inputSite" placeholder="Сайт">
        </div>
    </div>
    <div class="form-group">
        <label for="inputCountry" class="col-sm-2 col-xs-1 control-label"><span class="text-danger"> * </span> Країна</label>
        <div class="col-sm-6 col-xs-5">
            <select  name="my[country]" class="form-control"  id="inputCountry" >
                <option value="">Country</option>
                <?php foreach($countrys as $country) : ?>
                <option value="<?=$country['code']?>"><?=$country['title']?></option>
                <?php endforeach; ?>         
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="inputText" class="col-sm-2 col-xs-1 control-label"><span class="text-danger"> * </span> Текст</label>
        <div class="col-sm-6 col-xs-5">
            <textarea class="form-control" rows="5" name="my[complaint]" id="inputText"></textarea>
        </div>
    </div>
    <div class="form-group">
	  	<div class="col-sm-offset-2 col-sm-6 col-xs-5">
			<button  type="submit" class="btn btn-primary">Відправити</button>
    	</div>
	</div>
</form>


<div class="modal fade" id="modal-1">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button class="close" type="button" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Управління записами</h4>
			</div>
			<div class="modal-body" id="results">
				<form method="post" action="" class="form-horizontal"id="result">
					<p>Це модельне вікно</p>
				</form>
			</div>
		</div>
	</div>
</div>