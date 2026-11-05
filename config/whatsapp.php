<?php
/**
 * Automated WhatsApp & SMS Notification Gateway Configuration
 * 
 * Supports:
 * - UltraMsg (Instant WhatsApp API - recommended for quick setup)
 * - Meta Official WhatsApp Business Cloud API
 * - WATI / Gupshup
 * - Twilio
 * - Fast2SMS (Indian SMS Gateway)
 */

return [
    // Set to true once you enter your provider credentials below
    'active' => false,

    // Preferred provider: 'ultramsg' | 'meta' | 'wati' | 'twilio' | 'fast2sms'
    'provider' => 'ultramsg',

    // 1. UltraMsg (Simplest: Register at ultramsg.com -> scan QR -> get instance & token)
    'ultramsg' => [
        'instance_id' => 'instance100000', // Replace with your UltraMsg Instance ID
        'token'       => 'your_token_here', // Replace with your UltraMsg Token
    ],

    // 2. Meta Official WhatsApp Cloud API (developers.facebook.com)
    'meta' => [
        'phone_number_id' => '', // Meta WhatsApp Phone Number ID (From WhatsApp > API Setup)
        'access_token'    => '', // System User Permanent Token (Never expires)
        'template_name'   => 'grievance_acknowledgment', // Name of approved template in WhatsApp Manager
        'language_code'   => 'en', // Template language code (e.g. 'en' or 'te')
    ],

    // 3. WATI WhatsApp Gateway
    'wati' => [
        'endpoint'     => 'https://live-server-XXXX.wati.io',
        'access_token' => '',
    ],

    // 4. Twilio WhatsApp / SMS
    'twilio' => [
        'account_sid' => '',
        'auth_token'  => '',
        'from_number' => 'whatsapp:+14155238886', // Twilio WhatsApp Sender Number
    ],

    // 5. Fast2SMS (Direct Indian SMS to Mobile)
    'fast2sms' => [
        'api_key' => '',
        'sender_id' => 'TXTIND',
    ],

    // Office Alert: Also send a copy of every new grievance to Rohini's office WhatsApp
    'office_alert' => [
        'enabled' => false,
        'whatsapp_number' => '919848012345',
    ]
];

