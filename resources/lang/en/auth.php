<?php

return [
    'register' => 'Register',
    'login' => 'Login',
    'reset_password' => 'Reset Password',
    'email' => 'Email address',
    'send_reset_link' => 'Send Reset Link',
    'password' => 'Password',
    'password_confirmation' => 'Password Confirmation',
    'forgot_password' => 'Forgot Password',
    'remember' => 'Remember',
    'name' => 'Name',
    'register_successfully' => 'You have successfully registered. An email is sent to you for verification.',
    'verify_successfully' => 'Your e-mail is verified successfully. You can now login.',
    'already_verified' => 'Your e-mail is already verified. You can now login.',
    'not_verified' => 'Your e-mail is not verified. Please confirm your email before signing in
                        <br>Resend confirmation link: <a href=":resendlink">Click here</a>',
    'confirm_resent' => 'An email with a confirmation link has been sent. Please check both spam',
    'confirm_email_content' => [
        'title' => 'Verify your email',
        'message' => 'Dear **:name**, Thank you for your registration with :app_name. To active your account, please confirm your account by clicking
button or copy and paste the following link into your browser',
        'confirm_button' => 'Confirm Now',
        'thanks' => 'Thanks,',
    ],
    'failed' => 'These credentials do not match our records.',
    'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',
];
