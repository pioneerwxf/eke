<?
//���ļ����ڿ��ٲ���UTF8������ļ��ǲ��Ǽ���BOM�������Զ��Ƴ�
//By Bob Shen

$basedir="."; //�޸Ĵ���Ϊ��Ҫ����Ŀ¼�����ʾ��ǰĿ¼
$auto=1; //�Ƿ��Զ��Ƴ����ֵ�BOM��Ϣ��1Ϊ�ǣ�0Ϊ��

//���²��øĶ�

if ($dh = opendir($basedir)) {
while (($file = readdir($dh)) !== false) {
if ($file!='.' && $file!='..' && !is_dir($basedir."/".$file)) echo "filename: $file ".checkBOM("$basedir/$file")." <br>";
}
closedir($dh);
}

function checkBOM ($filename) {
global $auto;
$contents=file_get_contents($filename);
$charset[1]=substr($contents, 0, 1);
$charset[2]=substr($contents, 1, 1);
$charset[3]=substr($contents, 2, 1);
if (ord($charset[1])==239 && ord($charset[2])==187 && ord($charset[3])==191) {
if ($auto==1) {
$rest=substr($contents, 3);
rewrite ($filename, $rest);
return ("<font color=red>BOM found, automatically removed.</font>");
} else {
return ("<font color=red>BOM found.</font>");
}
}
else return ("BOM Not Found.");
}

function rewrite ($filename, $data) {
$filenum=fopen($filename,"w");
flock($filenum,LOCK_EX);
fwrite($filenum,$data);
fclose($filenum);
}
?> 