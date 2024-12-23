<?php
ob_start();
session_start();

// Configuración inicial
$csvFile = __DIR__ . '/../server_data.csv';
date_default_timezone_set('Europe/Madrid');

// Definir todas las funciones primero
function getVisitorCountry($ip) {
    try {
        if ($ip == '::1' || $ip == '127.0.0.1') {
            return 'Local';
        }
        $api_url = "http://ip-api.com/json/" . $ip;
        $response = @file_get_contents($api_url);
        if ($response) {
            $data = json_decode($response);
            if ($data && $data->status == 'success') {
                return $data->country;
            }
        }
        return 'Unknown';
    } catch (Exception $e) {
        return 'Unknown';
    }
}

function getRealIP() {
    $headers = [
        'HTTP_CF_CONNECTING_IP',
        'HTTP_X_REAL_IP',
        'HTTP_CLIENT_IP',
        'HTTP_X_FORWARDED_FOR',
        'HTTP_X_FORWARDED',
        'HTTP_FORWARDED_FOR',
        'HTTP_FORWARDED',
        'REMOTE_ADDR'
    ];

    foreach ($headers as $header) {
        if (!empty($_SERVER[$header])) {
            $ips = array_map('trim', explode(',', $_SERVER[$header]));
            foreach ($ips as $ip) {
                if (filter_var($ip, FILTER_VALIDATE_IP)) {
                    return $ip;
                }
            }
        }
    }
    return $_SERVER['REMOTE_ADDR'] ?? 'unknown';
}

function getBrowser() {
    $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? '';
    $browsers = [
        'Edge' => '/Edge|Edg/i',
        'Chrome' => '/Chrome/i',
        'Firefox' => '/Firefox/i',
        'Safari' => '/Safari/i',
        'Opera' => '/Opera|OPR/i',
        'Internet Explorer' => '/MSIE|Trident/i'
    ];

    foreach ($browsers as $browser => $pattern) {
        if (preg_match($pattern, $user_agent)) {
            if ($browser === 'Safari' && preg_match('/Chrome/i', $user_agent)) {
                continue;
            }
            if ($browser === 'Chrome' && preg_match('/Edge|Edg/i', $user_agent)) {
                return 'Edge';
            }
            return $browser;
        }
    }
    return 'Other';
}

function getOS() {
    $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? '';
    $os_array = [
        'Windows' => '/Windows/i',
        'Mac OS X' => '/Mac OS X/i',
        'Mac' => '/Mac/i',
        'Linux' => '/Linux/i',
        'Ubuntu' => '/Ubuntu/i',
        'Android' => '/Android/i',
        'iOS' => '/iPhone|iPad|iPod/i'
    ];

    foreach ($os_array as $os => $pattern) {
        if (preg_match($pattern, $user_agent)) {
            return $os;
        }
    }
    return 'Unknown';
}

function getVisitorId() {
    $data = '';
    $data .= $_SERVER['HTTP_USER_AGENT'] ?? '';
    $data .= $_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? '';
    $data .= getRealIP();
    return hash('sha256', $data);
}

function prepareServerData() {
    $real_ip = getRealIP();
    $visitor_id = getVisitorId();
    
    return [
        'REQUEST_TIME' => time(),
        'REQUEST_URI' => $_SERVER['REQUEST_URI'] ?? '/',
        'REMOTE_ADDR' => $real_ip,
        'VISITOR_ID' => $visitor_id,
        'COUNTRY' => getVisitorCountry($real_ip),
        'HTTP_USER_AGENT' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown',
        'BROWSER' => getBrowser(),
        'OS' => getOS(),
        'HTTP_ACCEPT_LANGUAGE' => $_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? '',
        'SESSION_ID' => session_id()
    ];
}

// Código principal
try {
    $serverData = prepareServerData();
    $fileExists = file_exists($csvFile);
    
    $fileHandle = fopen($csvFile, 'a');
    if ($fileHandle === false) {
        throw new Exception("No se puede abrir o crear el archivo.");
    }
    
    if (!$fileExists || filesize($csvFile) === 0) {
        $headers = array_keys($serverData);
        fputcsv($fileHandle, $headers, '|');
    }
    
    fputcsv($fileHandle, $serverData, '|');
    fclose($fileHandle);
    
    if (!$fileExists) {
        chmod($csvFile, 0666);
    }
} catch (Exception $e) {
    error_log("Error en registro.php: " . $e->getMessage(), 0);
}
ob_end_flush();
?>