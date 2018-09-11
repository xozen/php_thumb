<?
ini_set('gd.jpeg_ignore_warning', 1);
error_reporting(0);

/*

ver 0.4 - 2016.9.20

src : image file relative path
w : width
h : height
q : qulity of jpeg result
zc : zoom crop, 1 = centered, t = top related
igr : ignore respect ratio (not applied)

*/

extract($_GET);

$to = $_GET["to"];

if (!$src) exit();
if (!$w) exit();
if (!$h) exit();
if (!$q) $q = 90;
if (!$noexpand) $noexpand = false;



$file = $_SERVER["DOCUMENT_ROOT"].$src;
list($src_w, $src_h, $src_type) = getimagesize($file);
if ($src_type==1)     $src = @imagecreatefromgif($file);
else if ($src_type==2) $src = @imagecreatefromjpeg($file); 
else if ($src_type==3) $src = @imagecreatefrompng($file);



if ($src_w > $src_h) {  //Horizontal Image

	$dst_w = $w;
	$dst_h = floor($src_h*$w/$src_w);

} else {

	$dst_h = $h;
	$dst_w = floor($src_w*$h/$src_h);

}


if ($zc || $igr) {

	$dst_w = $w;
	$dst_h = $h;

}


if ($zc) {

	if ($src_w > $src_h) {  //Horizontal Image

		$src_x = ($src_w - $src_h)/2;
		$src_y = 0;

		$src_w = $src_h;  //PLACE TO LAST!

	} else {

		$src_x = 0;
		$src_y = ($src_h - $src_w)/2;
		if(strtolower($zc) == "t") $src_y = 0;  //ZoomCrop from Top

		$src_h = $src_w;  //PLACE TO LAST!


	}

}


/*
    noexpand 모드 활성시,
    원본이미지가 만들어질 이미지보다 작을 경우,
    확대 리사이즈 처리를 하지 않고 원본 그대로 출력
                                                      */

if ($noexpand && ($src_w*$src_h) < ($dst_w*$dst_h)) {

    $dst = $src;

} else {

    $dst = imagecreatetruecolor($dst_w, $dst_h);

    imagecopyresampled(
    	$dst, $src,
    	0, 0, $src_x, $src_y,  //dst_x ,dst_y ,src_x ,src_y
    	$dst_w, $dst_h, $src_w, $src_h  //dst_w ,dst_h ,src_w ,src_h
    );

}









if (!$to) header("Content-Type: image/jpeg");
imagejpeg($dst, $to, $q);

imagedestroy($src);
imagedestroy($dst);


?>