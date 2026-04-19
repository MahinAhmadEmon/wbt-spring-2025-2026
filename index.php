<!DOCTYPE html>
<html>
<body>

<?php

//Problem_1
$length = 10;
$width = 10;

$perimeter = 2 * ($length + $width);

echo "$perimeter <br>" ;

//Problem_2

$amount = 30;
$VAT = $amount * 0.15;

$Total = $amount + $VAT;

echo "new value $Total <br>";

//Problem_3

$value = 12;

if($value % 2==0){
    echo "$value is even <br>";
}else{
    echo "$value is odd <br>";
}

//Problem_4

$value1 = 10;
$value2 = 20;
$value3 = 30;

if($value1 >= $value2 && $value1 >= $value3 ){
    echo "$value1 is larger <br>";
}else if($value2 >= $value1 && $value2 >= $value3){
    echo "$value2 is larger <br>";
}else{
    echo "$value3 is larger <br>";
}

//Problem_5

for($i = 10; $i <= 101; $i++){
    if($i % 2==0){
        echo "<br>";
    }else{
        echo "$i <br>";
    }
}

//Problem_6
$fruits = array("Apple", "Banana", "Orange", "Mango");
$find = "Banana";

for($i = 0; $i < count($fruits); $i++){
    if($fruits[$i] == $find){
        echo "$find is found at index $i <br>";
        $found = true;
        break; 
    }
}

?>

</body>

</html>