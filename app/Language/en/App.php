<?php
return [
    'brand' => 'Task Organizer',
    'nav' => [
        'login' => 'Log In',
        'register' => 'Sign Up',
        'spanish' => 'Spanish',
        'english' => 'English',
        'hello' => 'Hello,',
        'menu' => 'Menu',
        'profile' => 'Profile',
        'users' => 'Users',
        'tasks' => 'Tasks',
        'assignments' => 'Assignments',
        'logout' => 'Logout',
    ],
    'footer' => [
        'copyright' => 'All rights reserved',
        'terms' => 'Terms of Service',
        'privacy' => 'Privacy Policy',
        'contact' => 'Contact Us',
    ],
    'home' => [
        'title' => 'Home - Task Organizer',
        'hero' => [
            'title' => 'Welcome 🎓 Teacher to Task Organizer!',
            'subtitle' => 'The all-in-one platform to manage your students',
            'cta_primary' => 'Get Started Free',
            'cta_secondary' => 'View Features',
        ],
        'features' => [
            'title' => 'Key Features',
            'subtitle' => 'Discover how we can help you be more productive',
            '1' => [
                'title' => 'Visual Management',
                'description' => 'Organize your tasks with intuitive, easy-to-use Kanban boards.',
            ],
            '2' => [
                'title' => 'Follow-up and tracking',
                'description' => 'Control and log documents and activities.',
            ],
            '3' => [
                'title' => 'Details',
                'description' => 'Clearly see relevant information about your tasks.',
            ],
        ],
    ],
    'dashboard' => [
        'title' => 'Dashboard - Task Organizer',
        'welcome' => 'Welcome',
        'intro' => 'Here you can manage your tasks and projects efficiently.',
    ],
    'auth' => [
        'login' => [
            'title' => 'Log In',
            'email' => 'Email Address',
            'password' => 'Password',
            'submit' => 'Log In',
            'register_link' => "Don't have an account? Sign Up",
            'remember_me' => 'Remember me',
            'welcome' => 'Welcome back!',
            'verified' => 'Your email has been successfully verified. You can now log in.',
            'forgot_password' => 'Forgot your password?',
            'error' => [
                'invalid_credentials' => 'Invalid credentials',
                'inactive_user' => 'Inactive user. Please check your email.',
                'email_not_verified' => 'Email not verified. Please check your email.',
                'email_verified_link' => 'Verification link is invalid or already used.',
            ]
        ],
        'forgot_password' => [
            'title' => 'Reset Password',
            'instructions' => 'Enter your email address and we\'ll send you a link to reset your password.',
            'email' => 'Email Address',
            'email_placeholder' => 'your@example.com',
            'submit' => 'Send Reset Link',
            'back_to_login' => 'Back to Login',
            'email_not_exists'=> 'Email address does not exist.',
            'sended' => 'Instructions have been sent to your email.',
            'password_reset_success' => 'Password updated successfully. You can now log in with your new password.',
            'password_reset_failed' => 'Failed to update password. Please try again.',
        ],
        'new_password' => [
            'title' => 'Set New Password',
            'instructions' => 'Enter your new password. Make sure it\'s secure and different from previous ones.',
            'password' => 'New Password',
            'password_placeholder' => 'Minimum 8 characters',
            'password_help' => 'Password must be at least 8 characters long.',
            'password_confirm' => 'Confirm Password',
            'password_confirm_placeholder' => 'Repeat your password',
            'submit' => 'Update Password',
            'back_to_login' => 'Back to Login'
        ],
        'register' => [
            'title' => 'Create Account',
            'name' => 'Full Name',
            'email' => 'Email Address',
            'password' => 'Password',
            'password_confirm' => 'Confirm Password',
            'submit' => 'Create Account',
            'login_link' => 'Already have an account? Log In',
            'success' => 'Registration successful! Please verify your email.',
        ],
        'mail_verify' => [
            'title' => 'Verify Your Email',
            'instruction' => 'A verification link has been sent to your email address.',
            'check_email' => 'Please check your email and click the link to verify your account.',
            'spam_notice' => 'If you don\'t see the email, please check your spam folder.',
            'resend_button' => 'Resend Verification Email',
        ],
    ]
];