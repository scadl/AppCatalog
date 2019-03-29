<head>
<title>FM Index</title>
<style type="text/css">
td { 
	background: #ddd;
	padding:3px;
}
th {
	background: #ccc; 
	padding:3px;
	border-radius:7px 7px 0px 0px;
}
a:link { color: #000; text-decoration:none; }
a:active { color: #999; text-decoration:underline; }
a:visited { color: #000; text-decoration:none; }
a:hover { color: #999; text-decoration:underline; }
#arclabl{
	position:relative;
	top: -20px;
	height: 0px;
	font-size: 9.3pt;
	font-weight: bold;
	color: #9b4f12;
}
#flink:hover{ color: #999; text-decoration:underline; }
</style>
</head>
<body style="font-family:sans-serif;">

<?php
session_start();
if (isset($_GET['logout'])) {
	unset($_SESSION['ulog']);
	session_destroy();
	//echo "session_closed";
}

include "FM-Connect.php";
$dbsrv_descriptor = DBInit($dbadres, $dbuser, $dbpass);
$sdres=DBConn($dbname, $dbsrv_descriptor);

if (!$sdres){
	$dbcrres=mysqli_query($sdres, "CREATE DATABASE _personal;");
	if ($dbcrres){
		//echo "БД создана успешно.<br>";
	} else {
		echo "БД не создана! Ошибка".mysql_error()."<br>";
	}
} else {
	//echo "БД уже существует.<br>";
	$tbures=mysqli_query($dbsrv_descriptor, "SELECT * FROM fmindex;");
	if ($tbures){
		//echo "Таблица открыта успешно.<br>";
	} else {
		echo "Не возможно открыть таблицу. Ошибка: ".mysql_error()."<br> Создаю таблицу...<br>";
		$tbcrres=mysqli_query($dbsrv_descriptor, "CREATE TABLE fmindex (
		appid INT(15) NOT NULL AUTO_INCREMENT,
		app CHAR(250) CHARACTER SET utf8,
		descr TEXT,
		size FLOAT, 
		targetos CHAR(50) CHARACTER SET utf8, 
		package CHAR(150) CHARACTER SET utf8, 
		license CHAR(70) CHARACTER SET utf8,
		price INT(15),
		link TEXT(370),
		linktype CHAR (50),
		PRIMARY KEY (appid)
		) CHARACTER SET utf8;");
		if ($tbcrres){
			//echo "Таблица создана успешно <br>";
		} else {
			echo "Таблица НЕ создана! Ошибка:<br>".mysqli_error($dbsrv_descriptor)."<br>";
		}
	}
	$ubdres=mysqli_query($dbsrv_descriptor, "SELECT * FROM fmusers");
	if ($ubdres){
		//echo "БД пользователей открыта успешно";
	} else {
		echo "Не возможно открыть таблицу. Ошибка: ".mysqli_error($dbsrv_descriptor)."<br> Создаю таблицу...<br>";
		$ubdcrres=mysqli_query($dbsrv_descriptor, "CREATE TABLE fmusers (
		uid INT(5) NOT NULL AUTO_INCREMENT,
		uname CHAR(15) CHARACTER SET utf8,
		upasswd CHAR (25) CHARACTER SET utf8,
		PRIMARY KEY (uid)) CHARACTER SET utf8;");
		if ($ubdcrres){
			echo "Таблица пользователей создана успешно <br>";
		} else {
			echo "Таблица пользователей НЕ создана! Ошибка:<br>".mysqli_error($dbsrv_descriptor)."<br>";
		}
	}
}

/*
if(mysqli_query($dbsrv_descriptor,"SELECT * FROM fmindex")){
	$fmnm=mysqli_query($dbsrv_descriptor,"SELECT * FROM fmindex ORDER BY appid;");
	while($fmnames=mysql_fetch_array($fmnm)){
	echo $fmnames['app']."<br>";
	};
}
*/

if (isset($_GET['edel'])){
$edelres=mysqli_query($dbsrv_descriptor, "DELETE FROM fmindex WHERE appid=".$_GET['edel'].";");
	if($edelres){
	echo "Запись <b>".$_GET['edel']."</b> удалена<br>";
	} else {
	echo "Запись не может быть удалена! <br>".mysql_error()."<br>";
	}
} else {
//echo "Нечего удалять <br>";
}

if (isset($_POST['appnm'])){

	$fmiconsrv="C:/xampp/htdocs/MyPHP/fmico/".basename($_FILES['iconf']['name']);
	if(move_uploaded_file($_FILES['iconf']['tmp_name'], $fmiconsrv)){
		echo "Файл ".$_FILES['iconf']['name']." Успешно загружен<br>";
	}
	$fmiconhtm="/".ltrim($fmiconsrv, "C:/xampp/htdocs");
	if ($_POST['adde']){
		$addres=mysqli_query($dbsrv_descriptor,"INSERT INTO fmindex SET
		app='".$_POST['appnm']."',
		descr='".$_POST['descrpt']."',
		size='".$_POST['dssize']."',
		targetos='".$_POST['oss']."',
		package='".$_POST['paktp']."',
		license='".$_POST['ulicense']."',
		price='".$_POST['uprice']."',
		link='".$_POST['dlink']."',
		linktype='".$_POST['dlnktp']."',
		icon='".$fmiconhtm."';");
		if ($addres){
		echo "Запись успешно добавлена";
		} else {
		echo "Не удалось добавть запись. <br>".mysql_error();
		}
	} else {
		$addres=mysqli_query($dbsrv_descriptor,"UPDATE fmindex SET
		app='".$_POST['appnm']."',
		descr='".$_POST['descrpt']."',
		size='".$_POST['dssize']."',
		targetos='".$_POST['oss']."',
		package='".$_POST['paktp']."',
		license='".$_POST['ulicense']."',
		price='".$_POST['uprice']."',
		link='".$_POST['dlink']."',
		linktype='".$_POST['dlnktp']."'		
		WHERE appid=".$_POST['appidh'].";");
		if(!$_FILES['iconf']['error']){
			mysqli_query($dbsrv_descriptor,"UPDATE fmindex SET icon='".$fmiconhtm."' WHERE appid=".$_POST['appidh'].";");
		}		
		if ($addres){
		echo "Запись успешно обновлена<br>";
		} else {
		echo "Не удалось обновить запись. <br>".mysql_error();
		}		
	}
	//echo "Оригинальное имя у клиента: ".$_FILES['iconf']['tmp_name']."<br>";
	//echo "MIME-тип: ".$_FILES['iconf']['type']."<br>";
	//echo "Размер файла: ".$_FILES['iconf']['size']."<br>";
	//echo "Имя и место на сервере: ".$_FILES['iconf']['tmp_name']."<br>";
	echo "Ошибка загрузки, если есть: ".$_FILES['iconf']['error']."<br>";
	
} else {
//echo "Нечего добавлять";
}

if (isset($_SESSION['ulog'])){
echo "
<div align='right'>
<a href='FM-index.php?logout=1' target='_self'>Выйти</a><br>
<a href='FM-add.php'><b>Добавить запись</b></a><br>
</div>
";
} else {
echo "
<div align='right'>
<span style='cursor:pointer' onClick='EntPoupap()' id='flink'>Войти</span><br>
<span style='cursor:pointer' onClick='RegPoupap()' id='flink'><i>Зарегистрироваться</i></span>
</div>";
}

?>
<script type="text/javascript">
function EntPoupap(){
	var popwind=window.open("FM-reg.php?regv=0","Входв в систему","status=no, resizable=no, scrollbars=no, directories=no, location=yes, menubar=no, titlebar=no, top="+ Math.round((document.body.offsetHeight/2)-100) +", left="+ Math.round((document.body.offsetWidth/2)-200) +", width=400, height=170");

	var wnch=self.setInterval(function(){WndChk()},100) 
	function WndChk(){
		if (popwind.closed){ 
		location.reload(1); 
		self.clearInterval(wnch);
		}
	}
}

function RegPoupap(){
	window.open("FM-reg.php?","Регистрация в системе","status=no, resizable=no, scrollbars=no, directories=no, location=no, menubar=no, titlebar=no, top="+ Math.round((document.body.offsetHeight/2)-100) +", left="+ Math.round((document.body.offsetWidth/2)-200) +", width=400, height=50");
}
</script>


<br>

<table width="100%" align="center" cellspacing="3">
<tr align="center" >
<?php
if (isset($_SESSION['ulog'])){
echo "<th>ID</th>";
}
?>
<th>Icon</th>
<th>Applicaton Name</th>
<th>Description</th>
<th>Size</th>
<th>Target OS</th>
<th>Package Format</th>
<th>License</th>
<th>Price</th>
<th>Download link</th>
<th>Link Type</th>
<?php
if (isset($_SESSION['ulog'])){
echo "<th>Del...</th>
<th>Edit...</th>";
}
?>
</tr>
<?php

if(mysqli_query($dbsrv_descriptor,"SELECT * FROM fmindex")){
	$fmnm=mysqli_query($dbsrv_descriptor,"SELECT * FROM fmindex ORDER BY appid;");
	if ($fmnm) {
		while($fmnames=mysqli_fetch_array($fmnm)){
			echo "<tr align='center'>";
			if (isset($_SESSION['ulog'])){ 	echo "<td>".$fmnames['appid']."</td>"; }			
			echo "<td style='padding:5px;'>";
			if ($fmnames['icon']=="/MyPHP/fmico/"){
				echo "<img src='fmico/kpersonalizer.png' width='32'>";
			} else {
				echo "<img src='".$fmnames['icon']."' width='32'>";
			}
			echo "</td>
			<td>".$fmnames['app']."</td>
			<td>".$fmnames['descr']."</td>
			<td>".$fmnames['size']." Mb</td>";
			switch ($fmnames['targetos']){
				case 'win16': echo "<td><img src='fmtech/oss/win3-1.png' width='32' title='16и битные Windows (1.0-3.1)'></td>"; break;
				case 'win9x': echo "<td><img src='fmtech/oss/Windows-98.png' width='32' title='32х битные Windows (95-Me)'></td>"; break;
				case 'winnt': echo "<td><img src='fmtech/oss/Windows-xp.png' width='32' title='Семейство Windows NT (2k-XP)'></td>"; break;
				case 'winv7': echo "<td><img src='fmtech/oss/windows-7.png' width='32' title='Современный Windows (Vista,7,8)'></td>"; break;
				case 'allwin': echo "<td><img src='fmtech/oss/windows-black.png' width='32' title='Все версии Windows'></td>"; break;
				case 'unix': echo "<td><img src='fmtech/oss/Freebsd-orig.png' width='32' title='Семейство Unix, BSD'></td>"; break;
				case 'lxdeb': echo "<td><img src='fmtech/oss/Debain_logo.png' width='32' title='Семейство Debain Linux'></td>"; break;
				case 'lxrpm': echo "<td><img src='fmtech/oss/slackware-shine.png' width='32' title='Семейство Slacware Linux'></td>"; break;
				case 'lxrh': echo "<td><img src='fmtech/oss/redhat.png' width='32' title='Семейство Red Hat Linux'></td>"; break;
				case 'lxsrc': echo "<td><img src='fmtech/oss/linux.png' width='32' title='Другой Linux'></td>"; break;
				case 'alllx': echo "<td><img src='fmtech/oss/unix_my.png' width='32' title='Все версии Linux/Unix'></td>"; break;
				case 'solaris': echo "<td><img src='fmtech/oss/solaris-ico.png' width='32' title='Семейство Oracle Solaris'></td>"; break;
				case 'osx': echo "<td><img src='fmtech/oss/mac-os-x.png' width='32' title='Семейство Mac OS (до Tiger)'></td>"; break;
				case 'macos': echo "<td><img src='fmtech/oss/mac-os.png' width='32' title='Семейство Mac OS X'></td>"; break;
				case 'wm': echo "<td><img src='fmtech/oss/wm-6.png' width='32' title='Семейство Windows Mobile'></td>"; break;
				case 'lxand': echo "<td><img src='fmtech/oss/android-stroke.png' width='32' title='Мобильная ОС Android (Linux)'></td>"; break;
				case 'maem': echo "<td><img src='fmtech/oss/maemo-ico-stroke.png' width='32' title='Мобильная ОС Maemo (Linux)'></td>"; break;
				case 'wp7': echo "<td><img src='fmtech/oss/wp7.png' width='32' title='Мобильная ОС Windows Phone 7'></td>"; break;
				case 'wp8': echo "<td><img src='fmtech/oss/wp8.png' width='32' title='Мобильная ОС Windows Phone 8'></td>"; break;
				case 'ios': echo "<td><img src='fmtech/oss/ios-logo-ico.png' width='32' title='Мобильная ОС iOS'></td>"; break;
			};
			switch ($fmnames['package']){
				case 'ispk':echo "<td><img src='fmtech/pak/is10.png' width='32' title=' Инсталлятор InstallShield '></td>"; break;
				case 'innpk':echo "<td><img src='fmtech/pak/inno_setup.png' width='32' title=' Инсталлятор InnoPackage '></td>"; break;
				case 'smi':echo "<td><img src='fmtech/pak/smim.png' width='32' title=' Инсталлятор SmartInstallMaker '></td>"; break;
				case 'irs':echo "<td><img src='fmtech/pak/irsf.png' width='32' title=' Инсталлятор IndigoRose '></td>"; break;
				case 'nsis':echo "<td><img src='fmtech/pak/nsis.png' width='32' title=' Инсталлятор Nulsoft IS '></td>"; break;
				case 'iapkg':echo "<td><img src='fmtech/pak/iaw.png' width='32' title=' Инсталятор InstallAware '></td>"; break;
				case 'zip':echo "<td><img src='fmtech/pak/zip_arc.png' width='32' title=' Портабл версия в архиве '></td>"; break;
				case 'deb':echo "<td><img src='fmtech/pak/archive_icon.png' width='32' title=' Пакет-инсталлер *.DEB '><div id='arclabl'>DEB</div></td>"; break;
				case 'rpm':echo "<td><img src='fmtech/pak/archive_icon.png' width='32' title=' Пакет-инсталлер *.RPM '><div id='arclabl'>RPM</div></td>"; break;
				case 'ebd':echo "<td><img src='fmtech/pak/archive_icon.png' width='32' title=' Пакет-инсталлер *.EBUILD '><div id='arclabl'>EBD</div></td>"; break;
				case 'lxpkg':echo "<td><img src='fmtech/pak/archive_icon.png' width='32' title=' Пакет-инсталлер *.PKG '><div id='arclabl'>PKG</div></td>"; break;
				case 'pisi':echo "<td><img src='fmtech/pak/archive_icon.png' width='32' title=' Пакет-инсталлер *.PISI '><div id='arclabl'>PISI</div></td>"; break;
				case 'lzm':echo "<td><img src='fmtech/pak/archive_icon.png' width='32' title=' Пакет-инсталлер *.LZM '><div id='arclabl'>LZM</div></td>"; break;
				case 'pet':echo "<td><img src='fmtech/pak/archive_icon.png' width='32' title=' Пакет-инсталлер *.PET *.PUP '><div id='arclabl'>PET</div></td>"; break;
				case 'dmg':echo "<td><img src='fmtech/pak/dmg_detailed.png' width='32' title=' Образ диска *.DMG '></td>"; break;
				case 'app':echo "<td><img src='fmtech/pak/app.png' width='32' title=' Портабл бинарник *.APP '></td>"; break;
				case 'macpkg':echo "<td><img src='fmtech/pak/pkg.png' width='32' title=' Пакет-инсталлер *.PKG '></td>"; break;
				case 'tgz':echo "<td><img src='fmtech/pak/archive_icon.png' width='32' title=' Архив с исходником *.TGZ *.TAR.GZ '><div id='arclabl'>TGZ</div></td>"; break;
				case 'apk':echo "<td><img src='fmtech/pak/apk_arc.png' width='32' title=' Пакет-инсталлер *.APK '></td>"; break;
				case 'wpx':echo "<td><img src='fmtech/pak/xap_box.png' width='32' title=' Пакет-инсталлер *.XAP '></td>"; break;
				case 'ipa':echo "<td><img src='fmtech/pak/ipa.png' width='32' title=' Пакет-инсталлер *.IPA '></td>"; break;
			};
			switch ($fmnames['license']){
				case 'trial':echo "<td> Пробная версия (Время ограничено) </td>"; break;
				case 'sharware':echo "<td> Пробная версия (Функционал ограничен) </td>"; break;
				case 'Freeware':echo "<td> Бесплатная (Закрытые исходники)  </td>"; break;
				case 'GPL':echo "<td> Бесплатная (Открытые исходники) </td>"; break;
			};
			echo "<td> $ ".$fmnames['price']."</td>";			
			echo "<td><a href='".$fmnames['link']."' target='_blank'>".$fmnames['link']."</a></td>";
			switch ($fmnames['linktype']){
				case 'authtor':echo "<td> Официальный сайт производителя\автора </td>"; break;
				case 'sstor':echo "<td> Хранилище приложений (SourceForge, и т.д.) </td>"; break;
				case 'clstor':echo "<td> Облачный диск пользователя (Я.Диск, и т.д.) </td>"; break;
				case 'flshr':echo "<td> Файлообменник (LetItBit, и т.д.) </td>"; break;
				case 'p2plk':echo "<td> P2P ссылка (Torrent, ed2k, i2p) </td>"; break;
				case 'ostor':echo "<td> Интрнет магазин (Google Play, WP Store, и т.д.) </td>"; break;
				case 'inters':echo "<td> Сайт-посредник (Зеркало) </td>"; break;
			};
			if (isset($_SESSION['ulog'])){
			echo "
			<td><a href='FM-index.php?edel=".$fmnames['appid']."' target='_self'>Delete this!</a></td>
			<td><a href='FM-add.php?eedit=".$fmnames['appid']."' target='_self'>Edit this!</a></td>
			</tr>"; }			
		}
	} else {
		echo "<tr align='center'><td colspan='12'> Нет записей в таблице </td></tr>";
	}
}

?>
 </table>

</body>