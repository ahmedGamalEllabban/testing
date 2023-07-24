<?php
/*
    Create a user validation class to handle the validation
    Construct to take the Post data from form
    Check required 'fields to check' are present in the data
    Create methods to validate user inputs
    - a method to validate username
    - a method to validate email
    - a method to validate password
    Return an errors array once all check are done
*/

class user_validate
{
    private $data;
    private $errors = [];
    private static $fields = ['username', 'email', 'password', 'repeated_password'];

    public function __construct($post_data)
    {
        $this->data = $post_data;
    }

    public function validate_form()
    {
        foreach (self::$fields as $field) {
            if (!array_key_exists($field, $this->data)) {
                trigger_error("$field Is Missing");
                return;
            }
        }

        $this->validate_username();
        $this->validate_email();
        $this->validate_password();
        $this->validate_repeated_password();
        return $this->errors;
        header("location:crud.php");
        exit;
    }

    private function validate_username()
    {
        $val = trim($this->data['username']);

        if (empty($val)) {
            $this->add_error('username', 'Username Can\'t be empty');
        } else {
            if (!preg_match('/^[a-zA-Z0-9]{4,12}$/', $val)) {
                $this->add_error('username', 'The Username Must Be From 4 to 12 Characters');
            }
        }
    }

    private function validate_email()
    {
        $val = trim($this->data['email']);

        if (empty($val)) {
            $this->add_error('email', 'Email Can\'t be empty');
        } else {
            if (!filter_var($val, FILTER_VALIDATE_EMAIL)) {
                $this->add_error('email', 'Email Is Not Valid');
            }
        }
    }

    private function validate_password()
    {
        $val = trim($this->data['password']);

        if (empty($val)) {
            $this->add_error('password', 'Password Can\'t be empty');
        } else {
            if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/', $val)) {
                $this->add_error('password', 'Password Must Be At Least 8 Characters And Have Special Characters, Numbers And Capital Letters');
            }
        }
    }
    private function validate_repeated_password()
    {
        $val = trim($this->data['repeated_password']);

        if (empty($val)) {
            $this->add_error('repeated_password', 'This Field Can\'t be empty');
        } else {
            if ($this->data['password'] != $this->data['repeated_password']) {
                $this->add_error('repeated_password', 'Please Check The Repeated Password');
            }
        }
    }

    private function add_error($key, $value)
    {
        $this->errors[$key] = $value;
    }
}
