<?php
//echo "你好";
$source="/oilPaint/public/uploads/20210516/fe2c0052230340ce8e4fadb4969dc5d9.jpg,/oilPaint/public/uploads/20210516/1c8dd4fcf464ccf2165d797b326b2730.jpeg";
$source2= explode(',',$source);
//foreach ($source2 as $key => $value) {
//    echo "aaaaaa{$value}";
//}
//
//array_walk(
//    $source2,
//    function (&$s, $k, $prefix = 'http://localhost') {
//        $s = str_pad($s, strlen($prefix) + strlen($s), $prefix, STR_PAD_LEFT);
//    }
//);
$index=2;
function cube($n)
{


    return ([

    'url'=>"http://localhost".$n
   ]);
}

$a = [1, 2, 3, 4, 5];
$b = array_map('cube', $source2);
$index="33";
foreach ($source2 as $key  => $value){
    $c[$key]=[
        'name'=>$index,
     'url'=> "http://localhost". $value
    ];
};
//print_r($b);
print_r($c);