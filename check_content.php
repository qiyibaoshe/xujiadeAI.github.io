<?php
// 获取用户输入的内容
$userContent =$_POST['content'];

// 遍历./shuru目录中的所有文件
$shuruPath = './shuru';$shuchuPath = './shuchu';
$qitaPath = './qita/daihuifu.txt';$shuruFiles = scandir($shuruPath);$matchedContent = '输入的内容与任何文件都不匹配,但是别担心，虚伪的AI已经帮你记下来了，管理员会回复你的。。';

foreach ($shuruFiles as$file) {
    // 跳过目录中的.和..以及非.txt文件
    if ($file == '.' ||$file == '..' || pathinfo($file, PATHINFO_EXTENSION) != 'txt') {
        continue;
    }

    // 构建完整的文件路径
    $shuruFile =$shuruPath . '/' . $file;
    $shuchuFile =$shuchuPath . '/' . $file;

    // 检查用户输入的内容是否与文件内容匹配
    if (file_get_contents($shuruFile) ==$userContent) {
        // 如果匹配，读取对应的shuchu文件内容
        $shuchuLines = file($shuchuFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if (!empty($shuchuLines)) {
            // 随机选择一行进行输出
            $matchedContent =$shuchuLines[array_rand($shuchuLines)];
        }
        break;
    }
}

// 如果没有匹配的文件，将用户输入的内容追加到daihuifu.txt文件中
if ($matchedContent == '输入的内容与任何文件都不匹配。') {
    file_put_contents($qitaPath,$userContent . PHP_EOL, FILE_APPEND);
}

// 输出结果
echo $matchedContent;
?>















