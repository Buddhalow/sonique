<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {
	var $components = array('Auth', 'Email');

          public function beforeFilter() {
            parent::beforeFilter();
            $this->Auth->allow('forgetpwd', 'login', 'resetpw');
          }
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
		$courseClasses = $this->User->CourseClass->find('list');
		$this->set(compact('courseClasses'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
		$courseClasses = $this->User->CourseClass->find('list');
                    $roles = $this->User->Role->find('list');
		$this->set(compact('courseClasses', 'roles'));
	}

            public function admin_changePassword($id = NULL) {
                        if($this->request->is('post')) {
                            $user = $this->User->read(null, $id);

                            $data = $this->request->data['Login'];

                            if($data['password'] == $data['password2']) {

                            $this->User->set('password', $data['password']);

                            if($this->User->save()) {

                                $this->Session->setFlash('Password changed');

                            }

                        } else {
                            $this->Session->setFlash(__('Passwords must be equal'));
                        }

                    }
                    $user = $this->User->findById($this->Auth->user('id'));
                    $this->set('user', $user);
            }

        /**
         * admin_delete method
         *
         * @throws NotFoundException
         * @param string $id
         * @return void
         */
	public function admin_delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

        function forgetpwd(){

            //$this->layout="signup";

            $this->User->recursive=-1;

            if(!empty($this->data))

            {

                if(empty($this->data['User']['email']))

                {

                    $this->Session->setFlash('Please Provide Your Email Adress that You used to Register with Us');

                }

                else

                {

                    $email=$this->data['User']['email'];

                    $fu=$this->User->find('first',array('conditions'=>array('User.email'=>$email)));

                    if($fu)

                    {

                        //debug($fu);

                        if($fu['User']['active'])

                        {

                            $key = Security::hash(String::uuid(),'sha512',true);

                            $hash=sha1($fu['User']['username'].rand(0,100));

                            $url = Router::url( array('controller'=>'users','action'=>'reset'), true ).'/'.$key.'#'.$hash;

                            $ms=$url;

                            $ms=wordwrap($ms,1000);

                            //debug($url);

                            $fu['User']['tokenhash']=$key;

                            $this->User->id=$fu['User']['id'];
                            if($this->User->saveField('tokenhash',$fu['User']['tokenhash'])){

           

                                //============Email================//

                                /* SMTP Options */

                                $this->Email->smtpOptions = array(

                                    'port'=>'25',

                                    'timeout'=>'30',

                                    'host' => 'mail.citynetwork.se',

                                    'username'=>'accounts+example.com',

                                    'password'=>'your password'

                                    );

                                  $this->Email->template = 'resetpw';

                                $this->Email->from    = 'Artistconnector.tv <info@kreeragruppen.se>';

                                $this->Email->to      = $fu['User']['username'].'<'.$fu['User']['email'].'>';

                                $this->Email->subject = 'Reset Your password to kreera group';

                                $this->Email->sendAs = 'both';

     

                                    $this->Email->delivery = 'mail';
                                     $this->Email->delivery = 'debug';  
                                    $this->set('ms', $ms);

                                    $this->Email->send();

                                    $this->set('smtp_errors', $this->Email->smtpError);

                                $this->Session->setFlash(__('Check Your Email To Reset your password', true));

     

                                //============EndEmail=============//

                            }

                            else{

                                $this->Session->setFlash("Error Generating Reset link");

                            }

                        }

                        else

                        {

                            $this->Session->setFlash('This Account is not Active yet.Check Your mail to activate it');

                        }

                    }

                else

                {

                    $this->Session->setFlash('Email does Not Exist');

                }

            }

        }



    }



    function resetpw($token=null) {

             //$this->layout="Login";
            $this->User->recursive=-1;
            if(!empty($token)){
                $u=$this->User->findBytokenhash($token);
                if($u){
                    $this->User->id=$u['User']['id'];
                    if(!empty($this->data)){
                        $this->User->data=$this->data;
                        $this->User->data['User']['username']=$u['User']['username'];
                        $new_hash=sha1($u['User']['username'].rand(0,100));//created token
                        $this->User->data['User']['tokenhash']=$new_hash;

                        if($this->User->validates(array('fieldList'=>array('password','password_confirm')))){
                            if($this->User->save($this->User->data))
                            {
                                $this->Session->setFlash('Password Has been Updated');
                                $this->redirect(array('controller'=>'users','action'=>'login'));
                            }
     
                        }
                        else{
     
                            $this->set('errors',$this->User->invalidFields());
                        }
                    }
                }
                else
                {
                    $this->Session->setFlash('Token Corrupted,,Please Retry.the reset link work only for once.');
                }
            }
     
            else{
                $this->redirect('/');
            }
    }


    public function changeEmail() {
        if($this->request->is('post')) {
            $this->User->read(null, $this->Auth->user('id'));
            $this->User->set('email', $this->request->data['User']['email']);
            if($this->User->save()) {
                $this->Session->setFlash(__('E-mail changed!'));
                $this->redirect('/users/changePassword');
            }
        }
    }
    public function changePassword() {

        if($this->request->is('post')) {
            $user = $this->User->read(null, $this->Auth->user('id'));

            $data = $this->request->data['User'];

            if($data['password1'] == $data['password2']) {

                $this->User->set('password', $data['password1']);

                if($this->User->save()) {

                    $this->Session->setFlash('Password changed');

                }

            } else {
                $this->Session->setFlash(__('Passwords must be equal'));
            }

        }
        $user = $this->User->findById($this->Auth->user('id'));
        $this->set('user', $user);

    }
    public function password($id) {

        if(!$this->isGroup(1)) {
            die('error');
        }
        if($this->request->is('post')) {
            $password = $this->request->data['Password'];
            if($password['password1'] == $password['password2']) {
                $this->User->read(null, $id);
                $this->User->set('password', $password['password1']);
                $this->User->save();
                $this->Session->setFlash(__("Password changed"), 'flash_success');
            } else {
                $this->Session->setFlash(__('Passwords doesnt match'), 'flash_error');
            }
            $this->User->read(null, $id);
            
        }
    }
    public function login() {
        // die(AuthComponent::password('123'));

        if ($this->request->is('post')) {

                debug($this->Auth->login());

            if ($this->Auth->login()) {
                 if($this->Session->read('Joyify.token')) {
              
                    $query = $this->User->query("INSERT INTO joyify_session (access_token, user_id, expires) VALUES ('".$this->Session->read('Joyify.token')."', ".$this->Auth->user('id').", 3600)");
                    $this->Session->setFlash(__('Account connected'), 'flash_success');
                    $this->Session->write('Joyify.token', NULL);
                }
                $user = $this->User->findById($this->Auth->user('id'));
                $this->Session->write('User.group', $user['User']['group_id']);


                $this->redirect('/');

            } else {

                $this->Session->setFlash(__('Invalid username or password, try again'));

            }

        }

    }
    public function logout() {
        $this->Session->write('User.group', FALSE);
        $this->Auth->logout();
        $this->redirect($this->Auth->logout());

    }
}
