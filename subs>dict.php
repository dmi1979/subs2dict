<?php


//сканировать папку
$dir=scandir(__DIR__.'/texts');
// echo $dir;
unset($dir[0]);
unset($dir[1]);
print_r($dir);
//TODO оставить в $dir только измененнные файлы.Имеет ли доступ PHP К метаинформации??


// создать массив из строк всех файлов
$result_array=[];
foreach($dir as $value){
    $result_array=array_merge($result_array,file(__DIR__.'/texts/'.$value));
}
//удалить пустые строки и строки где первый символ-/
foreach($result_array as $key=>$line){
    if(trim($line)==='' or trim($line)==='\n'or substr(trim($line),0,1)==='/') {
        unset ($result_array[$key]);
//         $line='^'.$line.'^';
//     $result_array[$key]="<".trim($line).'>';
        continue;
    }
    $result_array[$key]=trim($line);
}
//сортировать
asort($result_array);
print_r($result_array);
// file_put_contents('array',$result_array);

//создать файл словарь
$current_letter='';
$current_letter_view='';
$dictionary='';

foreach($result_array as $article){
$first_letter=strtolower(substr($article,0,1));
    if ($current_letter!==$first_letter){
    $current_letter_view="\n".strtoupper($first_letter)."\n";
    $current_letter=$first_letter;
    } 
    else $current_letter_view="\n";
    // echo $current_letter;
    $dictionary=$dictionary."$current_letter_view $article";
}
// echo $dictionary;
file_put_contents('dictionary.txt',$dictionary);