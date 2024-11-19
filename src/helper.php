<?php

function error(string $field): string {
    return isset($_SESSION["error"][$field]) ? $_SESSION["error"][$field]: "";
}

function old(string $field): string {
    return isset($_SESSION["old"][$field]) ? $_SESSION["old"][$field] : "";
}

function escape(string $data): string {
    return stripslashes(trim(htmlspecialchars($data)));
}

function slugify(string $str): string {
    // replace non letter or digits by -
    $str = preg_replace('~[^\pL\d]+~u', '-', $str);
    // transliterate
    $str = iconv('utf-8', 'us-ascii//TRANSLIT', $str);
    // remove unwanted characters
    $str = preg_replace('~[^-\w]+~', '', $str);
    // trim
    $str = trim($str, '-');
    // remove duplicate -
    $str = preg_replace('~-+~', '-', $str);
    // lowercase
    $str = strtolower($str);
    if (empty($str)) {
        return 'n-a';
    }
    return $str;
}

function getRequestCorps(): array {
    $contentType = $_SERVER['CONTENT_TYPE'] ?? '';
    if (strpos($contentType, 'application/json') !== false) {
        $data = file_get_contents('php://input');
        $jsonData = json_decode($data, true);
        if ($jsonData === null) {
            respond(400, ['error' => 'Invalid JSON']);
        }
        return $jsonData;
    }
    if (strpos($contentType, 'multipart/form-data') !== false) {
        return [
            'post' => $_POST,
            'files' => $_FILES
        ];
    }
    if (strpos($contentType, 'application/x-www-form-urlencoded') !== false) {
        return $_POST;
    }
    if (strpos($contentType, 'text/xml') !== false) {
        $data = file_get_contents('php://input');
        $xmlData = simplexml_load_string($data);
        if ($xmlData === false) {
            respond(400, ['error' => 'Invalid XML']);
        }
        return json_decode(json_encode($xmlData), true);
    }

    respond(415, ['error' => 'Unsupported Content-Type']);
    return [];
}

function respond(int $code, array $data): void {
    echo json_encode($data);
    http_response_code($code);
    exit;
}
