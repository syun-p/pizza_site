<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['login'])==false)
{
    print'ログインされていません。<br />';
    print'<a href=mst_pizz_login.html">ログイン画面へ</a>';
    exit();
}
else
{
    // print $_SESSION['staff_name'];
    print 'Staff';
    print '　さんログイン中<br />';
    print '<br />';
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Pizza_Store</title>
</head>
<body>

<?php

$piz_name=$_POST['name'];
$piz_price=$_POST['price']; //これは配列
$piz_disp=$_POST['disp']; //これは配列
$piz_gazou=$_FILES['gazou'];
$pdisp = array('0:全て表示','1:宅配のみ表示','2:持帰のみ表示','3:非表示');
// $pro_name=htmlspecialchars($pro_name,ENT_QUOTES,'UTF-8');
// $pro_price=htmlspecialchars($pro_price,ENT_QUOTES,'UTF-8');

if($piz_name=='')
{
	print'商品名が入力されていません。<br />';
}
else
{
	print'商品名：';
	print $piz_name;
	print'<br />';
}

if(preg_match('/\A[0-9]+\z/',$piz_price[0])==0
	|| preg_match('/\A[0-9]+\z/',$piz_price[1])==0
	|| preg_match('/\A[0-9]+\z/',$piz_price[2])==0)
{
	print '価格をきちんと入力してください。<br />';
}
else
{
	print '価格:';
	print '<br />';
	print '<span>  S </span>';
	print $piz_price[0];
	print '円 ';
	print $pdisp[$piz_disp[0]];
	print'<br />';
	print '<span>  M </span>';
	print $piz_price[1];
	print '円 ';
	print $pdisp[$piz_disp[1]];
	print'<br />';
	print '<span>  L </span>';
	print $piz_price[2];
	print '円 ';
	print $pdisp[$piz_disp[2]];
	print'<br />';
}

if($piz_gazou['size']>0)
{
	if($piz_gazou['size']>5000000)
	{
		print'画像が大き過ぎます';
	}
	else
	{
		move_uploaded_file($piz_gazou['tmp_name'],'../img/'.$piz_gazou['name']);
		print'<img src="../img/'.$piz_gazou['name'].'" width="40%" height="AUTO">';
		print'<br />';
	}
}

if($piz_name=='' || (preg_match('/\A[0-9]+\z/',$piz_price[0])==0 || preg_match('/\A[0-9]+\z/',$piz_price[1])==0 
|| preg_match('/\A[0-9]+\z/',$piz_price[2])==0) || $piz_gazou['size']>5000000)
{
	print '<form>';
	print '<input type="button" onclick="history.back()" value="戻る">';
	print '</form>';
}
else
{
	print '上記の商品を追加します。<br />';
	print '<form method="post" action="mst_pizz_add_done.php">';
	print '<input type="hidden" name="name" value="'.$piz_name.'">';
	print '<input type="hidden" name="price[]" value="'.$piz_price[0].'">';
	print '<input type="hidden" name="price[]" value="'.$piz_price[1].'">';
	print '<input type="hidden" name="price[]" value="'.$piz_price[2].'">';
	print '<input type="hidden" name="gazou_name" value="'.$piz_gazou['name'].'">';
	print '<input type="hidden" name="disp[]" value="'.$piz_disp[0].'">';
	print '<input type="hidden" name="disp[]" value="'.$piz_disp[1].'">';
	print '<input type="hidden" name="disp[]" value="'.$piz_disp[2].'">';
	print '<br />';
	print '<input type="button" onclick="history.back()" value="戻る">';
	print '<input type="submit" value="ＯＫ">';
	print '</form>';
}

?>
</body>
</html>
