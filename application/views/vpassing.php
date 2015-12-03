<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Passing</title>
</head>
<body>
<p>
<table border="0" cellpadding="0" cellspacing="0">
<?php
	$list = explode("-", $parameter);
	for($i=1;$i<count($list);$i+=4){
?>
<form method="post" action="passing">
  <tr>
    <td width="125"><input name="textfield" type="text" id="textfield" value="<?php echo $list[$i] ?>" size="15" /></td>
    <td width="125"><label>
      <input name="textfield2" type="text" id="textfield2" value="<?php echo $list[$i+1] ?>" size="15" />
     </label>
    </td>
    <td width="125"><input name="textfield3" type="text" id="textfield3" value="<?php echo $list[$i+2] ?>" size="15" /></td>
    <td width="125"><input name="textfield4" type="text" id="textfield4" value="<?php echo $list[$i+3] ?>" size="15" /></td>
    <td width="30"><label>
      <input type="hidden" name="urutan" value="<?php echo $i ?>" />
	  <input type="hidden" name="parameter" value="<?php echo $parameter?>" />
      <input type="submit" name="hapus" id="hapus" value="hapus" />
    </label></td>
  </tr>
</form>
<?php	
	}
?>
</table>
</p>
<p>&nbsp;</p>
<form method="post" action="passing">
<label>
Perbaikan :<br />
<select name="data1" id="data1">
  <option>Pilihan1</option>
  <option>Pilihan2</option>
  <option>Pilihan3</option>
</select>
</label>
<label>
<input name="data2" type="text" id="data2" size="15" autocomplete="off" />
</label>
<label>
<input name="data3" type="text" id="data3" size="15" autocomplete="off"/>
</label>
<label>
<input name="data4" type="text" id="data4" size="15" autocomplete="off"/>
</label>
<input type="hidden" name="parameter" value="<?php echo $parameter?>" />
<br />
<label>
<input type="submit" name="kirim" id="kirim" value="Submit" />
</label>
<br />
<br />
</form>


<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="550" align="center">
	<form id="form1" name="form1" method="post" action="passing">
      <label>
        <input type="hidden" name="parameter" value="<?php echo $parameter?>" />
        <input type="submit" name="simpan" id="simpan" value="Simpan" />
        </label>
    </form>      <label></label></td>
  </tr>
</table>
</body>
</html>
