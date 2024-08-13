<?php

declare(strict_types=1);
namespace App\Helpers;

use DateTime;
use App\Mail\OtpMail;
use App\Models\Practitioner;
use App\Models\Provider;
use App\Models\User;
use Exception;
use Illuminate\Encryption\Encrypter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

    class GlobalHelper {
        
        private const EMAIL_INFO = [
            'appointments' => [
                'subject' => 'Appointments',
                'view' => 'appointments',
            ],
            'forgot_password' => [
                'subject' => 'Forgot Password',
                'view' => 'forgot_password',
            ],
            'otp' => [
                'subject' => 'OTP',
                'view' => 'otp',
            ],
            'new_password' => [
                'subject' => 'Password Generated',
                'view' => 'password',
            ],
            'payments' => [
                'subject' => 'Payment Confirmaton',
                'view' => 'payments',
            ],
            'reminders' => [
                'subject' => 'Reminder',
                'view' => 'reminders',
            ],
            'test' => [
                'subject' => 'Big Dadi Mix',
                'view' => 'big_dadi_mix',
            ],

        ];
        
        public static function generateParentId() {
            $datetime = new DateTime();
            return base64_encode($datetime->format("YmdHisu"));
        }

        public static function generateDefaultPassword() {
            return substr(str_shuffle('1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz!@#$%^&*()_-+'), 0, 8);
        }

        public static function response($response, $status=200) {
            // Log::channel('daily')->info($response);
            return response()->json($response, $status);
        }

        public static function errorResponse($response, $status) {
            Log::channel('daily')->info($response);
            return response()->json($response, $status);
        }

        public static function encrypt($to_encrypt) {            
            return encrypt($to_encrypt);
        }

        public static function decrypt($to_decrypt) {
            return decrypt($to_decrypt);
        }

        public static function merge_practitioner_id($data) {
            $data['practitioner_id'] = Auth::id();

            return $data;
        }
        
        public static function send_email($type, $receiver,  $data, $sender="info@mydoctorsappt.com") {
            return;
            Log::channel('mailer')->info(json_encode([
                'type' => $type,
                'receiver' => $receiver,
                'subject' => self::EMAIL_INFO[$type]['subject'],
                'view' => self::EMAIL_INFO[$type]['view'],
                'data' => $data
            ]));

            if (!isset(self::EMAIL_INFO[$type])) {
                self::errorResponse(['message' => 'Invalid Email Type'], 400);
                return false;
            }
            
            try {

                $mail = Mail::to($receiver)->send(
                    new OtpMail([
                        'type' => $type,
                        'subject' => self::EMAIL_INFO[$type]['subject'],
                        'view' => self::EMAIL_INFO[$type]['view'],
                        'data' => $data
                    ])
                );
                self::response([
                    'message' => 'sent',
                    'data' => $mail,
                ], 200);

                return  true;
            } catch (Exception $e) {
                self::errorResponse([
                    'status' => 'error',
                    'message' => $e->getMessage()
                ], 500);
                return  false;
            }
        }

        public static function getParentId() {
            $practitioner_info = Practitioner::where('email', Auth::user()->email)->get()->first();

            $parent_id = $practitioner_info['profile_type'] === Practitioner::PROFILE_TYPE['provider'] ? 
                $practitioner_info['id'] :
                $practitioner_info['parent_id'];
                
            return $parent_id;
        }

        public static function validate($request_data, $rules_data) : mixed {
            
            $validator = Validator::make($request_data, $rules_data);
            
            if ($validator->fails()) {
                return false;
            }

            return ['data' => $validator->validated()];
        }
    }