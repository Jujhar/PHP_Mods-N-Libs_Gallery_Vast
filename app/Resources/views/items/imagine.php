<p>Imagine allows for image manipulation</p>


<?php
//require_once "../../../../vendor/autoload.php";

$palette = new Imagine\Image\Palette\RGB();

$image = $imagine->create(new Box(400, 300), $palette->color('#000'));

$image->draw()->ellipse(new Point(200, 150), new Box(300, 225), $image->palette()->color('fff'));

$image->save('ellipse.png');

?>