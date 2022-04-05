<?php

// 文字列を分割して配列として保存
$sArr = str_split(trim(fgets(STDIN)));

// データを1文字取得して整数化、変数として保存
$n = (int)trim(fgets(STDIN));

// 半角区切りのデータを取得して、変数として保存
$DataRowArr[] = explode(" ", trim(fgets(STDIN)));

// 半角区切りのデータを取得して、整数化して変数として保存
[$N,$K] = array_map('intval', explode(" ", trim(fgets(STDIN))));

// 半角区切りのデータを取得して、整数に変換。それを配列化
$arr = array_map('intval', explode(" ", trim(fgets(STDIN))));

?>