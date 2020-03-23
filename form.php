<div id="container">
<h1> Контракт: </h1>
<div id="for">
<form action="" method="POST">
<h2 id="mt">	ФИО: </h2>
  <input name="fio" />
  
   <h2> E-mail: </h2> 
  <input name="mail"> 
  
  <h2>Год Рождения: </h2>
  <select name="year">
  	<?php for ($i = 1900; $i<2020; $i++) {?>
  		<option value="<?php print($i);?>"> <?php print($i);?> </option>
  	<?php } ?>
  </select>
  
  <h2> Суперспособности: </h2>
  
  <select name="abilities[]" multiple>
  		<option value="Immortal"> Бессмертие </option>
  		<option value="Walls"> Прохождение сквозь стены </option>
  		<option value="Levitation"> Левитация </option>
  </select>  
  
  <h2>Количество конечностей: </h2>
  <p>
  	<input name="limps" type=radio value="1" id="r"> 1;
  </p>
   <p>
  	<input name="limps" type=radio value="2" id="r"> 2;
  </p>
   <p>
  	<input name="limps" type=radio value="4" id="r"> 4;
  </p>
  
  <h2>Пол: </h2>
  <p>
  	<input name="sex" type=radio value="male" id="r"> Мужской;
  </p>
   <p>
  	<input name="sex" type=radio value="female" id="r"> Женский;
  </p>
  
  <h2> Биография: </h2>
  <textarea name="bio"></textarea>
  
  <h2> С контрактом ознакомлен:  <input type="checkbox" name="checkbox" value="T"> </h2> 
  
  <input id="mb" type="submit" value="Отпправить данные" />
</form>
</div>
</div>