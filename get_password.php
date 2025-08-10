<?php
header('Content-Type: text/plain; charset=utf-8');
header('Access-Control-Allow-Origin: *'); // 允许跨域

$folder = isset($_GET['folder']) ? trim($_GET['folder']) : '';
if(empty($folder)) {
    http_response_code(400);
    die("文件夹参数不能为空");
}

// 安全过滤：只允许字母、数字、下划线和减号
if(!preg_match('/^[a-zA-Z0-9_-]+$/', $folder)) {
    http_response_code(400);
    die("非法的文件夹名称");
}

$passwordFile = __DIR__ . "/password/$folder/password.txt";

if(file_exists($passwordFile)) {
    echo file_get_contents($passwordFile);
} else {
    http_response_code(404);
    echo "未找到该文件夹的密码文件";
}
?>
