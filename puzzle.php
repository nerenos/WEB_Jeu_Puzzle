<head><script>
var tabver=new Array;
<?php 
if(isset($_GET['level'])){
$nx = $_GET['level'];
$ny = $nx;
}
else
{
$nx = 3;
$ny = 3;
}
if(isset($_GET['puzzle'])){
$image = $_GET['puzzle'];
}
else
{
$image = "";
}
$lx = 300/$nx;
$ly = 300/$ny;
for($i=0;$i<$nx*$ny;$i++){
echo "tabver[".$i."]=0;\n";
}
?>
var i=true;
var idel;
var test = 1;

function change(id) {
if(test==1) {
idel = id;
x1 = window.document.getElementById(idel).offsetLeft;
y1 = window.document.getElementById(idel).offsetTop;
x = x1 - 5;
y = y1 - 5;
test = 0;
}
}

function place(id, num) {
if(test==0) {
if(id==idel) {
tabver[num]=1;
var elid = "place"+num;
document.getElementById(elid).className= idel;
document.getElementById(idel).style.visibility = "hidden";
test = 1;
idel = "";
gg = 1;
for(i=0;i<tabver.length;i++)
{ 
if(tabver[i]==0) { 
gg = 0;
}}
if(gg == 1){
alert("gagné");
}}}}

document.onmousemove=move;
var tabimg = new Array();
<?php
echo "tabimg = [";
if ($handle = opendir('./images')) {
    while (false !== ($entry = readdir($handle))) {
    if($entry!='index.php' && $entry!='.' && $entry!='..' && $entry!="Thumbs.db"){
      echo ",\"$entry\"";
    }}}
closedir($handle);
echo "];";
?>
var im = 1;
function jeucharg(j) {
if(j>(tabimg.length-1)) j=1;
if(j<1) j=tabimg.length-1;
document.getElementById('imgdiapo').src = "images/"+tabimg[j];
sep = "/";
n = tabimg.length-1;
txt = j+sep+n;
document.getElementById('nimgdiapo').innerHTML = txt;
urlimg = '<?php echo $Domaine;?>/?page=jeux.php&puzzle='+tabimg[j];
im=j;
}
function level(j) {
urll="<?php echo $Domaine;?>/?page=jeux.php&puzzle=<?php echo $image;?>&level="+j;
location.href=urll
}
</script><style>
<?php 
$compt = 0;
for($j=1;$j<$ny+1;$j++){
$y= -($j-1)*$ly;
for($i=1;$i<$nx+1;$i++){
$x= -($i-1)*$lx;
echo ".piece".$compt."{background-image: url(images/".$image.");background-position:".$x."px ".$y."px;overflow: hidden;}";
$compt++;
}
}
?>
.level {
display: inline-block;
border-radius: 20px 20px 20px 20px;
text-align: center;
width: 150px;
border: 1px solid #31B404;
background-color: #40FF00;
margin-left: 30px;
margin-top: 25px;
}
</style>
 </head><div><div class="level" onclick="level(2)">facile</div><div class="level" onclick="level(3)">normal</div><div class="level" onclick="level(4)">difficile</div><div class="level" onclick="level(5)">super dur</div></div>
 <div><div class="imgdiapo" onclick="location.href=urlimg;"><img src="" id="imgdiapo"></div>
<div class="menudiapo">
<div class="previmg" onclick="javascript:jeucharg(im-1);"><<</div><div class="nimgdiapo" id="nimgdiapo"></div><div class="nextimg" onclick="javascript:jeucharg(im+1);">>></div>
</div><script type="text/javascript">
<!--
jeucharg(1);
-->
</script></div><div style="height:60px;"></div>
 <?php

$compt = 0;
for($j=1;$j<$ny+1;$j++){
$y= -($j-1)*$ly;
for($i=1;$i<$nx+1;$i++){
$x= -($i-1)*$lx;
//echo "<div id=".$compt." class=\"image\" style=\"border: 1px solid black;background-image: url(images/ane.gif);background-position:".$x."px ".$y."px;overflow: hidden;height:".$lx."px;width:".$ly."px;display: inline-block;\"></div>";
$tab[$compt]= "<div id=\"piece".$compt."\" onclick=\"change('piece".$compt."')\" class=\"piece".$compt."\" style=\"border: 1px solid black;height:".$lx."px;width:".$ly."px;display: inline-block;position:relative;\"></div>";
$tab2[$compt]= "<div id=\"place".$compt."\" onclick=\"place('piece".$compt."',".$compt.")\" style=\"border: 0.5px solid grey;height:".$lx."px;width:".$ly."px;display: inline-block;position:relative;\"></div>";
$compt++;
}
}
shuffle($tab);
$compt = 0;
echo "<div>";
echo "<div style=\"display: inline-block;margin-top: 20px;margin-left: 40px;\">";
for($j=1;$j<$ny+1;$j++){
echo "<div>";
for($i=1;$i<$nx+1;$i++){
print $tab[$compt];
$compt++;
}
echo "</div>";
}
echo "</div>";
$compt = 0;
echo "<div  style=\"display: inline-block;margin-top: 20px;margin-right: 40px;float: right;\">";
for($j=1;$j<$ny+1;$j++){
echo "<div>";
for($i=1;$i<$nx+1;$i++){
print $tab2[$compt];
$compt++;
}
echo "</div>";
}
echo "</div></div>";
?>