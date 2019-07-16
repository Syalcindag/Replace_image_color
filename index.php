<?php
$dirname = "/htdocs/resim/";
$images = glob($dirname."*.jpg");
echo $dirname;

foreach (glob("*.jpg") as $dosya) {
    echo "$dosya "."<br>";

    $picture = imagecreatefrompng($dosya);

    $img_w = imagesx($picture);
    $img_h = imagesy($picture);

    $newPicture = imagecreatetruecolor( $img_w, $img_h );
    imagesavealpha( $newPicture, true );
    $rgb = imagecolorallocatealpha( $newPicture, 0, 0, 0, 127 ); //seffaflık resmi verir
    imagefill( $newPicture, 0, 0, $rgb );  //Belirtilen koordinattan başlayarak (resmin üst sol köşesi 0.0'dır) belirtilen resmi renk ile boyar.

    $color = imagecolorat( $picture, $img_w-1, 1);//bu kısımda resmin sol üst köşesini renginde olan tüm yerleri transparan yapıyor
    $rgb2 = imagecolorallocatealpha( $newPicture, 13, 71, 161, 1 );//rgba(69, 72, 232, 1) mavi
    $beyaz = imagecolorallocatealpha( $newPicture, 255, 255, 255, 1 );  //rgba(255, 255, 255, 1) beyaz
    echo $color;

    for( $x = 0; $x < $img_w; $x++ ) {
        for( $y = 0; $y < $img_h; $y++ ) {
            $c = imagecolorat( $picture, $x, $y );
            if($color != $c){         
                imagesetpixel( $newPicture, $x, $y,    $beyaz);   //resim  kısımları trasnparent olacak       
            } 
            else {
                
                imagesetpixel( $newPicture, $x, $y,    $rgb2); //diger kısımlar mavi
            }          
        }
    }

    imagepng($newPicture, $dosya);
    imagedestroy($newPicture);
    imagedestroy($picture);
}

?>


