<?php
return [
    'brand' => 'Task Organizer',
    'nav' => [
        'login' => 'Log In',
        'register' => 'Sign Up',
        'spanish' => 'Spanish',
        'english' => 'English',
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
    'auth' => [
        'login' => [
            'title' => 'Log In',
            'email' => 'Email Address',
            'password' => 'Password',
            'submit' => 'Log In',
            'register_link' => "Don't have an account? Sign Up",
            'remember_me' => 'Remember me',
            'error' => [
                'invalid_credentials' => 'Invalid credentials',
                'inactive_user' => 'Inactive user. Please check your email.',
            ]
        ],
        'register' => [
            'title' => 'Create Account',
            'name' => 'Full Name',
            'email' => 'Email Address',
            'password' => 'Password',
            'password_confirm' => 'Confirm Password',
            'submit' => 'Create Account',
            'login_link' => 'Already have an account? Log In',
            'success' => 'Registration successful! You can now log in.',
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