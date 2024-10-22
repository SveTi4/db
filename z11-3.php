<?php
$user_agent = $_SERVER['HTTP_USER_AGENT'];

// Extract browser information
$browser = "Unknown Browser";
$browser_version = "Unknown Version";

if (preg_match('/YaBrowser\/(.*?)\s/', $user_agent, $matches)) {
    $browser = "Yandex Browser";
    $browser_version = $matches[1];
} elseif (preg_match('/MSIE (.*?)\;/', $user_agent, $matches) || preg_match('/Trident\/.*rv:(.*?)\)/', $user_agent, $matches)) {
    $browser = "Internet Explorer";
    $browser_version = $matches[1];
} elseif (preg_match('/Firefox\/(.*?)\s/', $user_agent, $matches)) {
    $browser = "Firefox";
    $browser_version = $matches[1];
} elseif (preg_match('/OPR\/(.*?)\s/', $user_agent, $matches)) {
    $browser = "Opera";
    $browser_version = $matches[1];
} elseif (preg_match('/Chrome\/(.*?)\s/', $user_agent, $matches)) {
    $browser = "Chrome";
    $browser_version = $matches[1];
} elseif (preg_match('/Safari\/(.*?)\s/', $user_agent, $matches)) {
    $browser = "Safari";
    $browser_version = $matches[1];
}

// Extract OS information
$os = "Unknown OS";

if (preg_match('/Windows NT 10.0/', $user_agent)) {
    $os = "Windows 10";
} elseif (preg_match('/Windows NT 6.3/', $user_agent)) {
    $os = "Windows 8.1";
} elseif (preg_match('/Windows NT 6.2/', $user_agent)) {
    $os = "Windows 8";
} elseif (preg_match('/Windows NT 6.1/', $user_agent)) {
    $os = "Windows 7";
} elseif (preg_match('/Mac OS X (10[._]\d+)/', $user_agent, $matches)) {
    $os = "Mac OS X " . str_replace('_', '.', $matches[1]);
} elseif (preg_match('/Linux/', $user_agent)) {
    $os = "Linux";
} elseif (preg_match('/iPhone OS (.*?)\s/', $user_agent, $matches)) {
    $os = "iOS " . $matches[1];
} elseif (preg_match('/Android (.*?)\;/', $user_agent, $matches)) {
    $os = "Android " . $matches[1];
}

// Display the information
echo "<p>$user_agent</p>";
echo "<p>Browser: $browser $browser_version</p>";
echo "<p>Operating System: $os</p>";
?>