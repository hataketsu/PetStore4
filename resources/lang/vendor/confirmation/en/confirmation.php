<?php

return [
    'email-title' => 'Please verify your email address',
    'email-intro'=> 'To finalize the creation of your new PetStore account, please follow the link below to confirm your email address:',
    'email-button' => 'Confirm Email Address',
    'message' => ' Thank you for registering, please verify your email.',
    'success' => 'You have successfully verified your account! You can now login.',
    'again' => 'You must verify your email before you can access the site. ' .
                '<br>If you have not received the confirmation email check your spam folder.'.
                '<br>To get a new confirmation email please <a href="' . url('confirmation/resend') . '" class="alert-link">click here</a>.',
    'resend' => 'A confirmation message has been sent. Please check your email.'
];
