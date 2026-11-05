<?php
/**
 * Automated WhatsApp & SMS Dispatch Service
 * Handles server-side automated delivery of Praja Vani Tracking IDs
 */

function sanitizePhoneNumber($phone) {
    $cleaned = preg_replace('/\D/', '', (string)$phone);
    // Standard 10-digit Indian mobile number: prefix 91
    if (strlen($cleaned) === 10) {
        $cleaned = '91' . $cleaned;
    } elseif (strlen($cleaned) === 11 && str_starts_with($cleaned, '0')) {
        $cleaned = '91' . substr($cleaned, 1);
    }
    return $cleaned;
}

function sendAutomatedWhatsAppGrievance($citizenData) {
    $configFile = __DIR__ . '/../config/whatsapp.php';
    $config = file_exists($configFile) ? include $configFile : ['active' => false];

    $name = $citizenData['name'] ?? 'Citizen';
    $rawPhone = $citizenData['phone'] ?? '';
    $trackingId = $citizenData['id'] ?? 'VR-BV-XXXX';
    $ward = $citizenData['ward'] ?? 'Bhimavaram Municipality';
    $category = $citizenData['category'] ?? 'Civic Service';
    $timestamp = $citizenData['timestamp'] ?? date('Y-m-d H:i:s');

    $cleanPhone = sanitizePhoneNumber($rawPhone);
    if (empty($cleanPhone)) {
        return [
            'sent' => false,
            'reason' => 'Invalid phone number provided'
        ];
    }

    // Determine current portal base URL for the tracking link
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || ($_SERVER['SERVER_PORT'] ?? 80) == 443) ? "https://" : "http://";
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
    $baseUri = rtrim(dirname($_SERVER['PHP_SELF'] ?? '/'), '/\\');
    $trackUrl = "{$protocol}{$host}{$baseUri}/#grievance";

    // Build the official WhatsApp message
    $message = "🏛️ *Vegesna Rohini Office - Praja Vani (భీమవరం)*\n\n"
             . "Namaste *{$name}* garu,\n\n"
             . "Your civic grievance has been successfully registered with Vegesna Rohini's office.\n\n"
             . "📋 *Tracking ID:* *{$trackingId}*\n"
             . "📍 *Ward:* {$ward}\n"
             . "🏷️ *Category:* {$category}\n"
             . "📅 *Date:* {$timestamp}\n\n"
             . "🔍 *Check Live Status Online:*\n{$trackUrl}\n\n"
             . "Our ward coordination team will review the issue and initiate action promptly.\n"
             . "Thank you for contributing to *Swachh & Swarna Bhimavaram*.";

    $result = [
        'sent' => false,
        'provider' => $config['provider'] ?? 'none',
        'recipient' => $cleanPhone,
        'tracking_id' => $trackingId,
        'timestamp' => date('Y-m-d H:i:s'),
        'details' => ''
    ];

    // If live provider is active, send via selected gateway
    if (!empty($config['active'])) {
        $provider = $config['provider'] ?? 'ultramsg';

        switch ($provider) {
            case 'ultramsg':
                $instanceId = $config['ultramsg']['instance_id'] ?? '';
                $token = $config['ultramsg']['token'] ?? '';
                if (!empty($instanceId) && !empty($token)) {
                    $url = "https://api.ultramsg.com/{$instanceId}/messages/chat";
                    $postData = http_build_query([
                        'token' => $token,
                        'to' => $cleanPhone,
                        'body' => $message,
                        'priority' => 10
                    ]);

                    $ch = curl_init($url);
                    curl_setopt_array($ch, [
                        CURLOPT_POST => true,
                        CURLOPT_POSTFIELDS => $postData,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_TIMEOUT => 8,
                        CURLOPT_SSL_VERIFYPEER => false
                    ]);
                    $resp = curl_exec($ch);
                    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                    curl_close($ch);

                    if ($httpCode >= 200 && $httpCode < 300) {
                        $result['sent'] = true;
                        $result['details'] = 'Sent via UltraMsg API: ' . $resp;
                    } else {
                        $result['details'] = "UltraMsg HTTP {$httpCode}: " . $resp;
                    }
                }
                break;

            case 'meta':
                $phoneId = $config['meta']['phone_number_id'] ?? '';
                $accessToken = $config['meta']['access_token'] ?? '';
                if (!empty($phoneId) && !empty($accessToken)) {
                    $url = "https://graph.facebook.com/v18.0/{$phoneId}/messages";
                    $body = json_encode([
                        'messaging_product' => 'whatsapp',
                        'to' => $cleanPhone,
                        'type' => 'text',
                        'text' => ['body' => $message]
                    ]);

                    $ch = curl_init($url);
                    curl_setopt_array($ch, [
                        CURLOPT_POST => true,
                        CURLOPT_POSTFIELDS => $body,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_HTTPHEADER => [
                            "Authorization: Bearer {$accessToken}",
                            "Content-Type: application/json"
                        ],
                        CURLOPT_TIMEOUT => 8,
                        CURLOPT_SSL_VERIFYPEER => false
                    ]);
                    $resp = curl_exec($ch);
                    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                    curl_close($ch);

                    if ($httpCode >= 200 && $httpCode < 300) {
                        $result['sent'] = true;
                        $result['details'] = 'Sent via Meta Cloud API';
                    } else {
                        $result['details'] = "Meta API HTTP {$httpCode}: " . $resp;
                    }
                }
                break;

            case 'fast2sms':
                $apiKey = $config['fast2sms']['api_key'] ?? '';
                if (!empty($apiKey)) {
                    $url = "https://www.fast2sms.com/dev/bulkV2";
                    // Fast2SMS supports direct SMS to Indian 10-digit mobile
                    $tenDigit = substr($cleanPhone, -10);
                    $smsText = "Vegesna Rohini Office: Namaste {$name}, your grievance {$trackingId} for {$ward} is registered. Check status at {$trackUrl}";

                    $postData = http_build_query([
                        'authorization' => $apiKey,
                        'route' => 'v3',
                        'sender_id' => $config['fast2sms']['sender_id'] ?? 'TXTIND',
                        'message' => $smsText,
                        'language' => 'english',
                        'flash' => 0,
                        'numbers' => $tenDigit
                    ]);

                    $ch = curl_init($url);
                    curl_setopt_array($ch, [
                        CURLOPT_POST => true,
                        CURLOPT_POSTFIELDS => $postData,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_TIMEOUT => 8,
                        CURLOPT_SSL_VERIFYPEER => false
                    ]);
                    $resp = curl_exec($ch);
                    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                    curl_close($ch);

                    if ($httpCode >= 200 && $httpCode < 300) {
                        $result['sent'] = true;
                        $result['details'] = 'SMS Sent via Fast2SMS';
                    } else {
                        $result['details'] = "Fast2SMS HTTP {$httpCode}: " . $resp;
                    }
                }
                break;
        }

        // Optional: Alert Office
        if (!empty($config['office_alert']['enabled']) && !empty($config['office_alert']['whatsapp_number'])) {
            $officeNum = sanitizePhoneNumber($config['office_alert']['whatsapp_number']);
            // can dispatch copy to office as well
        }
    } else {
        // Gateway simulated mode (ready for credentials)
        $result['sent'] = false;
        $result['simulated'] = true;
        $result['details'] = 'WhatsApp gateway configured in readiness mode. Enter credentials in config/whatsapp.php to enable automatic background SMS.';
    }

    // Persist dispatch logs to data/whatsapp_logs.json
    $logFile = __DIR__ . '/../data/whatsapp_logs.json';
    $logs = file_exists($logFile) ? json_decode(file_get_contents($logFile), true) ?: [] : [];
    array_unshift($logs, $result);
    if (count($logs) > 100) $logs = array_slice($logs, 0, 100);
    @file_put_contents($logFile, json_encode($logs, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    return $result;
}
