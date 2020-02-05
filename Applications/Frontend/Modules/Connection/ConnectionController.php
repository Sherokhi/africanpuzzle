<?php


namespace Applications\Frontend\Modules\Connection;

use Library\Sly\Controller\BackController;
use Library\Sly\Network\HTTPRequest;

use PHPMailer\PHPMailer\PHPMailer;


class ConnectionController extends BackController
{
    protected $link;
    protected $login;
    protected $password;

    public function executeLogin(HTTPRequest $request) 
    {
        
        $errors = array();

		if ($request->postsExists(array('login', 'password'))) 
        {

            if ($this->app->user()->isAuthenticated()) 
            {
               
                $errors['userconnected'] = 'Vous êtes déjà connecté';
            } 
            elseif ($request->postsEmpty(array('login', 'password'))) 
            {
              
                $errors['userformfields'] = 'Tous les champs ne sont pas renseignés';
            } 
            else 
            {
                $this->login = $request->postData('login');
                $this->password = $request->postData('password');  //password_hash($request->postData('password'),PASSWORD_BCRYPT);


                //$manager = $this->managers->getManagerOf('User')->updateLoginUser($this->login, $this->password);
					                
                //$in_db = true;
                $in_db = $this->check_indb($this->login, $this->password);
                
                if ($in_db == null || !$in_db) 
                {
                   
                    $errors['userok'] = "La connexion  a échouée  ou identifiant inconnu !";
                    error_log("[ERROR  null] La connexion  a échouée pour ".$this->login.PHP_EOL);

                } 
                else 
                {
                    
                    $manager = $this->managers->getManagerOf('User');
                    $user = $manager->getUniqueLogin($this->login);
                    					
					if (!$user) 
					{

                             error_log("[INFO] Accès refusé : ".$this->login.PHP_EOL);
                           
                         
                             $errors['userok'] = "Vous n\'avez pas accès à cette application !";
       
						
					} 
                    
                    // se souvenir de moi
                    if ($request->postsExists(array('remember'))) {
                        $remember_token = $this->app()->str_random(250);
                        $manager->updateRememberTokenLogin($this->login,$remember_token); 
                        setcookie('remember', $user->idUser() . '==' . $remember_token . sha1($user->idUser() . 'ratonlaveurs'), time() + 60 * 60 * 24 * 7);
                    }

                    $group = $user->useGroup();

                    //on verifie si l'utilisqateur connecté fait partie du comité de l'association
                    $isInCD  = ($group == GRP_DIRECTION or $group == GRP_SECRETARY or $group == GRP_COMPTABLE or $group == GRP_SUPPLEANT or $group == GRP_DEVELOPER )? 1 : 0;

                    $this->app->user()->setAttribute('user', $user);
                    $this->app->user()->setAttribute('isInCD', $isInCD);
					$this->app->user()->setAttribute('group', $group);

					$this->app->user()->setAuthenticated();

                    $this->app->httpResponse()->redirect($request->httpHome());
                    error_log("[INFO] Utilisateur authentifié : ".$this->login.PHP_EOL);
                    error_log("[INFO] Utilisateur isInCD : ".$isInCD);
                      
                }
            }

        }

/*
        // si il y a des erreurs on les affiches et on ne fait rien
        if( $msgError!="" ){

            $this->app->user()->setFlash($msgError,'danger');

            $this->app->httpResponse()->redirect($request->httpReferer());
        }
*/
        if( !empty($errors) ){

            $this->app->user()->setFlash($errors,'danger','Connection pour : '.$this->login.PHP_EOL);

            $this->app->httpResponse()->redirect($request->httpReferer());
        }

    }

    public function executeLogout(HTTPRequest $request) 
    {
        $this->app->user()->setAuthenticated(false);
        $this->app->user()->unsetAttribute('user');

        $this->app->user()->unsetAttribute('group');

         $this->app->user()->unsetAttribute('isInCD'); 

         // on supprime le cookie
         setcookie('remember', NULL, -1);

        $this->app->httpResponse()->redirect($request->httpHome());
              
    }

    public function executeSignup(HTTPRequest $request) 
    {

        $errors = array();

        if(empty($_POST['username']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['username'])){
            $errors['username'] = "Votre pseudo n'est pas valide (alphanumérique)";
        } else {
            $req = $pdo->prepare('SELECT id FROM users WHERE username = ?');
            $req->execute([$_POST['username']]);
            $user = $req->fetch();
            if($user){
                $errors['username'] = 'Ce pseudo est déjà pris';
            }
        }

        if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $errors['email'] = "Votre email n'est pas valide";
        } else {
            $req = $pdo->prepare('SELECT id FROM users WHERE email = ?');
            $req->execute([$_POST['email']]);
            $user = $req->fetch();
            if($user){
                $errors['email'] = 'Cet email est déjà utilisé pour un autre compte';
            }
        }

        if(empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']){
            $errors['password'] = "Vous devez rentrer un mot de passe valide";
        }

        if(empty($errors)){

            $req = $pdo->prepare("INSERT INTO users SET username = ?, password = ?, email = ?, confirmation_token = ?");
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $token = $this->app()->str_random(60);
            $req->execute([$_POST['username'], $password, $_POST['email'], $token]);
            $user_id = $pdo->lastInsertId();
            mail($_POST['email'], 'Confirmation de votre compte', "Afin de valider votre compte merci de cliquer sur ce lien\n\nhttp://localhost/01-template/GestionMembre/confirm.php?id=$user_id&token=$token");
            $_SESSION['flash']['success'] = 'Un email de confirmation vous a été envoyé pour valider votre compte';
            header('Location: login.php');
            exit();
        }
        $websiteMail = 'passionlectureetml@gmail.com';

        $email='test dimi';
        $subject="voici un sujet";

        $body = '<p>'.$email.'</p>';
        $body .= '<p>coucou</p>';
        $body.= '<p>salut</p>';

        $mail = new PHPMailer();
        $mail->IsSMTP(); // enable SMTP
    
        $mail->SMTPDebug = 2; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
        $mail->Host = "bluefire.easygiga.com"; //"smtp.gmail.com";
        $mail->Port = 465; // or 587
        $mail->IsHTML(true);
        $mail->Username = 'info@africanpuzzle.ch'; //'african.puzzle@gmail.com';
        $mail->Password = '.inf_afr19-'; //'-african.puzzle2013';
        $mail->SetFrom('info@africanpuzzle.ch');
        $mail->Subject = $subject;
        $mail->msgHTML($body, null, false);
        $mail->AddAddress('info@africanpuzzle.ch');

        if($mail->send()){            
            $success = true;
        }else{
            $errors = 'Une erreur est survenue phpmailer';
        }      
        
        // si il y a des erreurs on les affiches et on ne fait rien
        if( $errors!="" ){

            $this->app->user()->setFlash($errors." ".$mail->ErrorInfo,'danger');

            $this->app->httpResponse()->redirect($request->httpReferer());
        }else
        {
            $this->app->user()->setFlash($success,'info');
        }
    }

    private function check_indb($login,$password) 
    {
        $users=$this->managers->getManagerOf('User')->checkLoginUser($login,$password);
        error_log(!empty($users)) ;
        return (!empty($users));
        
        
    }
}
