<p>Generates fake addresses, names, text and more</p>

<?php
//require_once "../../../../vendor/autoload.php";

$faker = Faker\Factory::create();

// generate data by accessing properties
echo $faker->name;
// 'Lucy Cechtelar';
echo $faker->address;
// "426 Jordy Lodge
// Cartwrightshire, SC 88120-6700"
echo $faker->text;

?>