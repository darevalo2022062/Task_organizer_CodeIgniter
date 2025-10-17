<?php
return [
    'brand' => 'Task Organizer',
    'common' => [
        'view' => 'View Details',
        'save' => 'Save Changes',
        'cancel' => 'Cancel',
        'edit' => 'Edit',
        'delete' => 'Delete',
        'update' => 'Update',
        'create' => 'Create',
        'active' => 'Active',
        'desactive' => 'Inactive',
        'back' => 'Back',
        'actions' => 'Actions',
        'search' => 'Search...',
        'delete_success' => 'Deletion successful.',
        'loading' => 'Loading...',
        'user_not_found' => 'User not found.',
        'invalid_password' => 'Invalid password',
        'no_data' => 'No data available.',
        'confirm_delete' => 'Are you sure you want to delete this item?',
        'yes' => 'Yes',
        'no' => 'No',
        'sort_by' => 'Sort by',
        'ascending' => 'Ascending',
        'descending' => 'Descending',
        'showing' => 'Showing',
        'to' => 'to',
        'of' => 'of',
        'previous' => 'Previous',
        'next' => 'Next',
        'information' => 'Information',
        'quick_actions' => 'Quick Actions',
    ],
    // app/Language/en/App.php
'users' => [
    'title' => 'User Management',
    'subtitle' => 'Manage all system users',
    'create_new' => 'New User',
    'export' => 'Export',
    'updated_at' => 'Last Updated',
    'edit_user' => 'Edit User',
    'statistics' => 'Statistics',
    'enrolled_courses' => 'Enrolled Courses',
    
    // Filters and search
    'search' => 'Search',
    'search_placeholder' => 'Search by name or email...',
    'filter_by_role' => 'Filter by role',
    'filter_by_status' => 'Filter by status',
    'all_roles' => 'All roles',
    'all_status' => 'All statuses',
    
    // Roles
    'role_admin' => 'Administrator',
    'role_teacher' => 'Teacher',
    'role_student' => 'Student',
    
    // Statuses
    'status_active' => 'Active',
    'status_inactive' => 'Inactive',
    
    // Table
    'user' => 'User',
    'name' => 'Name',
    'email' => 'Email',
    'role' => 'Role',
    'status' => 'Status',
    'email_verified' => 'Email Verified',
    'created_at' => 'Registration Date',
    'verified' => 'Verified',
    'not_verified' => 'Not Verified',
    
    // Create modal
    'create_new_user' => 'Create New User',
    'password' => 'Password',
    'active_account' => 'Active account',
    
    // Messages
    'no_users_found' => 'No users found',
    'create_first_user' => 'Create the first user to get started',
    'confirm_delete' => 'Are you sure you want to delete this user? This action cannot be undone.',
    'users' => 'users',
],
    // app/Language/en/App.php
'tasks' => [
    'title' => 'Tasks',
    'subtitle' => 'Manage your tasks and assignments',
    'create_new' => 'New Task',
    'export' => 'Export',
    'description' => 'Description',
    'task_details' => 'Task Details',
    'grade' => 'Grade',
    'ponderation' => 'Ponderation',
    'points' => 'Points',
    'course_info' => 'Course Information',
    'progress' => 'Progress',
    'completion' => 'Completed in a',
    'back_to_list' => 'Back to Task List',
    'view_course' => 'View Course',
    'edit' => 'Edit Task',
    'delete' => 'Delete Task',

    //Submit
    'submit_instructions' => 'Submit your work for this task',
    'submission_warning' => 'Make sure all files are correct before submitting.',
    'notes_help' => 'Add any comments about your submission...',
    'selected_files' => 'Selected Files',

    // Filters
    'filter_by_teacher' => 'Filter by teacher',
    'filter_by_course' => 'Filter by course',
    'filter_by_status' => 'Filter by status',
    'filter_by_priority' => 'Filter by priority',
    'all_teachers' => 'All teachers',
    'all_courses' => 'All courses',
    'all_status' => 'All statuses',
    'all_priorities' => 'All priorities',
    
    // Statuses
    'status_pending' => 'Pending',
    'status_in_progress' => 'In Progress',
    'status_completed' => 'Completed',
    'status_overdue' => 'Overdue',
    
    // Priorities
    'priority_low' => 'Low',
    'priority_medium' => 'Medium',
    'priority_high' => 'High',
    'priority_urgent' => 'Urgent',
    
    // Table
    'task_name' => 'Task Name',
    'course' => 'Course',
    'teacher' => 'Teacher',
    'due_date' => 'Due Date',
    'priority' => 'Priority',
    'status' => 'Status',
    'students_assigned' => 'Students Assigned',
    'actions' => 'Actions',
    'created_at' => 'Creation Date',
    
    // Create modal
    'create_new_task' => 'Create New Task',
    'select_course' => 'Select course',
    'max_points' => 'Max Points',
    'assign_to_teacher' => 'Assign to teacher',
    'select_teacher' => 'Select teacher',
    'attachments' => 'Attachments',
    'attachments_help' => 'You can attach multiple files (PDF, Word, images)',
    
    // Submit modal (students)
    'submit_task' => 'Submit Task',
    'submission_notes' => 'Submission Notes',
    'notes_placeholder' => 'Add any comments about your submission...',
    'upload_files' => 'Upload Files',
    'files_help' => 'Upload your work files',
    'submit_work' => 'Submit Work',
    
    // Messages
    'no_tasks_found' => 'No tasks found',
    'task_created' => 'Task created successfully',
    'task_updated' => 'Task updated successfully',
    'task_deleted' => 'Task deleted successfully',
    'task_submitted' => 'Task submitted successfully',
    
    // Actions
    'view_task' => 'View Task',
    'edit_task' => 'Edit Task',
    'delete_task' => 'Delete Task',
    'grade_task' => 'Grade Task',
    'download_files' => 'Download Files',
],
    // app/Language/en/App.php
    'courses' => [
        'title' => 'Courses',
        'subtitle' => 'Manage your courses and materials',
        'create_new' => 'New Course',
        'export' => 'Export',
        
        // Filters
        'filter_by_teacher' => 'Filter by teacher',
        'filter_by_status' => 'Filter by status',
        'all_teachers' => 'All teachers',
        'all_status' => 'All statuses',
        
        // Statuses
        'status_active' => 'Active',
        'status_inactive' => 'Inactive',
        'status_archived' => 'Archived',
        
        // Create modal
        'create_new_course' => 'Create New Course',
        'course_name' => 'Course Name',
        'course_code' => 'Course Code',
        'description' => 'Description',
        'start_date' => 'Start Date',
        'end_date' => 'End Date',
        'assign_to_teacher' => 'Assign to teacher',
        'select_teacher' => 'Select teacher',
        'course_color' => 'Course Color',
        
        // Course card
        'view_course' => 'View Course',
        'edit_course' => 'Edit Course',
        'delete_course' => 'Delete Course',
        'enter_course' => 'Enter Course',
        'manage' => 'Manage',
        'students' => 'Students',
        
        // Messages
        'no_courses_found' => 'No courses found',
        'create_first_course' => 'Create your first course to get started',
        'course_created' => 'Course created successfully',
        'course_updated' => 'Course updated successfully',
        'course_deleted' => 'Course deleted successfully',
        
        // Actions
        'enroll_course' => 'Enroll in Course',
        'unenroll_course' => 'Unenroll',
        'view_students' => 'View Students',
        'view_assignments' => 'View Assignments',
    ],
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
        'courses' => 'Courses',
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
    'assignments' => [
        'title' => 'Assignments',
        'subtitle' => 'Manage your tasks and assignments',
        'create_new' => 'New Assignment',
        'export' => 'Export',
        
        // Filters
        'filter_by_teacher' => 'Filter by teacher',
        'filter_by_course' => 'Filter by course',
        'filter_by_status' => 'Filter by status',
        'all_teachers' => 'All teachers',
        'all_courses' => 'All courses',
        'all_status' => 'All statuses',
        
        // Statuses
        'status_pending' => 'Pending',
        'status_in_progress' => 'In Progress',
        'status_completed' => 'Completed',
        'status_graded' => 'Graded',
        
        // Table
        'assignment_name' => 'Assignment Name',
        'course' => 'Course',
        'teacher' => 'Teacher',
        'due_date' => 'Due Date',
        'status' => 'Status',
        'grade' => 'Grade',
        'students_assigned' => 'Students Assigned',
        'actions' => 'Actions',
        
        // Create modal
        'create_new_assignment' => 'Create New Assignment',
        'select_course' => 'Select course',
        'description' => 'Description',
        'select_student' => 'Select student',
        'max_points' => 'Max Points',
        'assign_to_teacher' => 'Assign to teacher',
        'select_teacher' => 'Select teacher',
        
        // Messages
        'no_assignments_found' => 'No assignments found',
        'assignment_created' => 'Assignment created successfully',
        'assignment_updated' => 'Assignment updated successfully',
        'assignment_deleted' => 'Assignment deleted successfully',
        
        // Actions
        'view_assignment' => 'View Assignment',
        'edit_assignment' => 'Edit Assignment',
        'delete_assignment' => 'Delete Assignment',
        'submit_assignment' => 'Submit Assignment',
        'grade_assignment' => 'Grade Assignment',
    ],
'dashboard' => [
    'title' => 'Dashboard - Task Organizer',
    'welcome' => 'Welcome',
    'intro' => 'Here you can manage your tasks and projects efficiently.',
],
'profile' => [
'title' => 'Profile - Task Organizer',
'back_to_dashboard' => 'Back to Dashboard',
'user_profile' => 'Personal Details',
'edit_profile' => 'Edit Profile',
'profile_picture' => 'Profile Picture',
'change_picture' => 'Change Picture',
'delete_picture' => 'Delete Picture',
'name' => 'Name',
'email' => 'Email',
'role' => 'Role',
'joined' => 'With us since',
'confirm_changes' => 'For your security, please enter your password to confirm changes.',
'enter_password_to_save' => 'Enter your password to save changes',
'security' => [
'title' => 'Security',
'description' => 'Update your password to keep your account secure.',
'change_password' => 'Change Password',
'current_password' => 'Current Password',
'new_password' => 'New Password',
'confirm_new_password' => 'Confirm New Password',
'password_help' => 'Password must be at least 8 characters long.',
],
'image' => [
'select' => 'Select Image',
'current' => 'Current Profile Picture',
'remove' => 'Remove Profile Picture',
'help' => 'Allowed formats: JPG, PNG, GIF. Max size 2MB.',
'save' => 'Save Picture',
'text_null' => 'No file selected.',
'delete_confirm' => 'Are you sure you want to delete your profile picture?',
'delete_success' => 'Profile picture deleted successfully.'
],
],  
'auth' => [
'logout' => [
'success' => 'You have been logged out successfully.',
],
'login' => [
'title' => 'Log In',
'email' => 'Email Address',
'password' => 'Password',
'submit' => 'Log In',
'register_link' => "Don't have an account? Sign Up",
'remember_me' => 'Remember me',
'welcome' => 'Welcome back!',
'success' => 'Login successful! Welcome back.',
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