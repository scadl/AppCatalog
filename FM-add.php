<?php session_start(); ?>
<head>
<title>Add your app</title>

</head>
<body style="font-family:sans-serif;">

<style type="text/css">
td {
font-size:11pt;
}
</style>
<div align="center" style="padding:25px">
<form name="add_fm" method="post" action="FM-index.php" style="width:600px; background:#ddd; padding:15px; text-align:left; border-radius:15px;" enctype="multipart/form-data">
<table width="100%" border="0">
<tr>
<td width="50%">Имя приложения (<250 символов):</td>
<td width="50%"><input type="edit" name="appnm" size="40"></td>
</tr><tr>
<td valign="center">Описание приложения:</td>
<td> <textarea name="descrpt" cols="40" rows="15"></textarea> </td>
</tr><tr>
<td>Прикрепить иконку приложения (PNG)</td>
<td>
<input type="hidden" name="MAX_FILE_SIZE" value="300000" />
<input type="file" name="iconf" size="30">
</td>
</tr><tr>
<td>Размер дистрибутива: </td>
<td><input type="number" name="dssize" size="30" value="0"> Mb</td>
</tr><tr>
<td>Целевая ОС:</td>
<td>
<select name="oss" size="1">
<option value="win16">Windows 1.0-3.11</option>
<option value="win9x">Windows 95-Me (Win9x)</option>
<option value="winnt">Windows NT,2k,XP (WinNT)</option>
<option value="winv7">Windows Vista, 7, 8</option>
<option value="allwin" selected>All Windows Versions</option>
<option value="unix">Unix & BSD family</option>
<option value="lxdeb">Debain Linux Family</option>
<option value="lxrpm">Slacware Linux Family</option>
<option value="lxrh">Red Hat Linux Family</option>
<option value="lxsrc">other Linux</option>
<option value="alllx">All Linux/Unix Versions</option>
<option value="solaris">Solaris OS</option>
<option value="osx">Mac OS X</option>
<option value="macos">Mac OS</option>
<option value="wm">Windows Mobile</option>
<option value="lxand">Android (arm-Linux)</option>
<option value="maem">Maemo (arm-Linux)</option>
<option value="wp7">Windows Phone 7</option>
<option value="wp8">Windows Phone 8 (Apollo)</option>
<option value="ios">iOS (iPhone, iPad)</option>
</select>
</td>
</tr><tr>
<td>Формат дистрибутива: </td>
<td>
<select name="paktp" size="1">
<option value="ispk">InstallShield (EXE+CAB)</option>
<option value="innpk">InnoPackage (EXE+BIN,DAT,etc)</option>
<option value="smi">SmartInstallMaker (EXE)</option>
<option value="irs">IndigoRose Pack (EXE+BIN,DAT,etc)</option>
<option value="nsis">Nirsoft Scripted Installer (EXE)</option>
<option value="iapkg">Install Aware Package (EXE+BIN,DAT,etc)</option>
<option value="zip" selected>Portable ZIP,RAR,7Z,etc</option>
<option value="deb">Linux DEB (Debain family)</option>
<option value="rpm">Linux RPM (Red Hat, SUSE)</option>
<option value="ebd">Linux EBUILD (Gentoo family)</option>
<option value="lxpkg">Linux PKG (Arc Linux family)</option>
<option value="pisi">Linux PISI (Pardus, Solus) </option>
<option value="lzm">Linux LZM (Slax)</option>
<option value="pet">Linux PUP,PET (Puppy)</option>
<option value="dmg">Mac_OS Image DMG</option>
<option value="app">Mac_OS Binary APP</option>
<option value="macpkg">Mac_OS Package PKG</option>
<option value="tgz">Sources TGZ, TAR.GZ</option>
<option value="apk">Android APK</option>
<option value="wpx">Windows_Phone XAP</option>
<option value="ipa">iOS IPA</option>
</select>
</td>
</tr><tr>
<td>Лицензия на использование приложения:</td>
<td>
<select name="ulicense">
<option value="trial">Commerce Trial</option>
<option value="sharware">Commerce Sharware</option>
<option value="Freeware" selected>Freeware (Closed Source)</option>
<option value="GPL">Open Source GNU GPL</option>
</select>
 <input type="number" size="7" value="0" name="uprice"> USD
</td>
</tr><tr>
<td>Ссылка на загрузку (<370 символов): </td>
<td>
<input type="edit" name="dlink" size="40">
</td>
</tr><tr>
<td> Тип ссылки: </td>
<td>
<select name="dlnktp">
<option value="authtor">Официальный сайт производителя\автора</option>
<option value="sstor">Хранилище приложений (SourceForge, etc)</option>
<option value="clstor">Облачный диск пользователя (Я.Диск, etc)</option>
<option value="flshr">Файлообменник (LetItBit, etc)</option>
<option value="p2plk">P2P ссылка (Torrent, ed2k, i2p)</option>
<option value="ostor">Интрнет магазин (Google Play, WP Store, etc)</option>
<option value="inters">Сайт-посредник (Зеркало)</option>
</select>
</td>
</tr>
<tr><td colspan="2" align="center"> 
<input type="hidden" value="1" name="adde">
<input type="hidden" value="" name="appidh">
<br>
<input style="padding:5px;" name="submbtn" type="submit" value="Добавить"> 
</td></tr>
</table>
</form>


<?php
if (isset($_GET['eedit'])){
include "FM-Connect.php";
$dbsrv_descriptor = DBInit($dbadres, $dbuser, $dbpass);
mysqli_query($dbsrv_descriptor,"USE ".$dbname.";");
mysqli_error($dbsrv_descriptor);

$appdata=mysqli_fetch_array(mysqli_query($dbsrv_descriptor,"SELECT * FROM fmindex WHERE appid=".$_GET['eedit'].";"));
mysqli_error($dbsrv_descriptor);
echo "<script type='text/javascript'>
	document.forms['add_fm'].elements['appnm'].value='".$appdata['app']."';
	document.forms['add_fm'].elements['descrpt'].value='".$appdata['descr']."';
	document.forms['add_fm'].elements['dssize'].value='".$appdata['size']."';
	document.forms['add_fm'].elements['oss'].value='".$appdata['targetos']."';
	document.forms['add_fm'].elements['paktp'].value='".$appdata['package']."';
	document.forms['add_fm'].elements['ulicense'].value='".$appdata['license']."';
	document.forms['add_fm'].elements['uprice'].value='".$appdata['price']."';
	document.forms['add_fm'].elements['dlink'].value='".$appdata['link']."';
	document.forms['add_fm'].elements['dlnktp'].value='".$appdata['linktype']."';
	document.forms['add_fm'].elements['appidh'].value='".$appdata['appid']."';
	document.forms['add_fm'].elements['adde'].value=0;
	document.forms['add_fm'].elements['submbtn'].value='Обновить';
	</script>";
} else {
//echo "Nothing to Edit, so Add new!<br>";
}
?>
<body>