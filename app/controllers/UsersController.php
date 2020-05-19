<?php

/**
 * Class UsersController
 */
class UsersController extends Controller
{
    private $userModel;
    private $isValidForm;

    /**
     * UsersController constructor.
     */
    public function __construct()
    {
        $this->userModel = $this->loadModel('User');
    }

    /**
     * @throws ErrorException
     */
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_error' => '',
                'email_error' => '',
                'password_error' => '',
                'confirm_password_error' => ''
            ];

            // Validate Email
            if (empty($data['email'])) {
                $data['email_error'] = 'Saisissez un Email';
            } else {
                // Check email
                if ($this->userModel->findUserByEmail($data['email'])) {
                    $data['email_error'] = 'Email déjà pris';
                }
            }

            // Validate Name
            if (empty($data['name'])) {
                $data['name_error'] = 'Saisissez un nom';
            }

            // Validate Password
            if (empty($data['password'])) {
                $data['password_error'] = 'Saisissez un mot de passe';
            } elseif (strlen($data['password']) < 6) {
                $data['password_error'] = 'Le mot de passe doit avoir au moins 6 caractères';
            }

            // Validate Confirm Password
            if (empty($data['confirm_password'])) {
                $data['confirm_password_error'] = 'Confirmez votre mot de passe';
            } else {
                if ($data['password'] != $data['confirm_password']) {
                    $data['confirm_password_error'] = 'Les mots de passe ne correspondent pas';
                }
            }

            // Make sure errors are empty
            if (empty($data['email_error']) && empty($data['name_error']) && empty($data['password_error']) && empty($data['confirm_password_error'])) {

                // Check CSRF Token
                if (!empty($_POST['csrf_token'])) {
                    $this->isValidForm = checkCSRFToken($_POST['csrf_token'], 'registerForm');
                }

                // Hash Password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // Register User
                if ($this->isValidForm) {
                    if ($this->userModel->register($data)) {
                        flashMessage('flash_message', 'Vous êtes enregistré et vous pouvez vous connecter');
                        redirectPage('users/login');
                    } else {
                        throw new ErrorException("Quelque chose c'est mal passé");
                    }
                } else {
                    flashMessage('flash_message', 'Violation CSRF', 'alert alert-danger');
                    redirectPage('users/register');
                }
            } else {
                // Load loadView with errors
                $this->loadView('users/register', $data);
            }
        } else {
            // Init data
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_error' => '',
                'email_error' => '',
                'password_error' => '',
                'confirm_password_error' => ''
            ];

            // Load loadView
            $this->loadView('users/register', $data);
        }
    }

    /**
     * @throws ErrorException
     */
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_error' => '',
                'password_error' => '',
            ];

            if (empty($data['email'])) {
                $data['email_error'] = 'Saisissez un Email';
            }

            if (empty($data['password'])) {
                $data['password_error'] = 'Saisissez votre mot de passe';
            }

            if ($this->userModel->findUserByEmail($data['email'])) {
                // utilisateur trouvé
            } else {
                $data['email_error'] = 'Utilisateur non trouvé';
            }

            if (empty($data['email_error']) && empty($data['password_error'])) {

                // Check CSRF Token
                if (!empty($_POST['csrf_token'])) {
                    if (!checkCSRFToken($_POST['csrf_token'], 'loginForm')) {
                        flashMessage('flash_message', 'Violation CSRF', 'alert alert-danger');
                        redirectPage('users/login');
                        return;
                    }
                }

                $loggedInUser = $this->userModel->login($data['email'], $data['password']);

                if ($loggedInUser) {
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['password_error'] = 'Mot de passe incorrect';

                    $this->loadView('users/login', $data);
                }
            } else {
                $this->loadView('users/login', $data);
            }
        } else {
            $data = [
                'email' => '',
                'password' => '',
                'email_error' => '',
                'password_error' => '',
            ];

            $this->loadView('users/login', $data);
        }
    }


    /**
     * @param $user
     */
    public function createUserSession($user)
    {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->name;

        redirectPage('pages/index');
    }

    /**
     *
     */
    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        session_destroy();

        redirectPage('users/login');
    }

    /**
     * @return bool
     */
    public function isLoggedIn()
    {
        if (isset($_SESSION['user_id'])) {
            return true;
        } else {
            return false;
        }
    }
}
