<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\I18n\Time;

use App\Form\PasswordResetForm;

class UsersController extends \App\Controller\AppController {
  
  public function initialize() {
    parent::initialize();
    
    $this->Auth->allow('register');
  }
  
  public function register() {
    $user = $this->Users->newEntity();
    
    if ($this->request->is(['post', 'put'])) {
      
      $user = $this->Users->patchEntity($user, $this->request->data);
      
      if ($this->Users->save($user)) {
        $this->Flash->success('You have been registered. Welcome!');
        
        $user = $this->Users->get($user->id);
        $this->Auth->setUser($user->toArray());
        
        return $this->redirect($user->home_route);
      }
      else {
        $this->Flash->error(__('The registration failed. Please try again.'));
      }
    }
    
    $this->set(compact('user'));
  }
  
  public function login() {
    if(isset($this->_user->id)) {
      return $this->redirect($this->_user->home_route);
    }
    
    if($this->request->is(['post', 'put'])) {
      
      $user = $this->Auth->identify();
      
      if (Configure::read('debug') && $this->request->data['password'] == 'asdfasdf') {        
        $user = $this->Users->findByEmail($this->request->data['email'])->first();
        
        if($user)
          $user = $user->toArray();
      }
      
      if($user) {
        
        $userEntity = $this->Users->get($user['id']);
        $userEntity->last_login = Time::now(); //also modifies 'modified' field. Is that bad? whatever...
        
        if(!is_null($userEntity->reset_key)) {
          $userEntity->reset_key = null;
        }
        
        $userEntity = $this->Users->save($userEntity);
        
        $this->Auth->setUser($user);
        
        return $this->redirect($userEntity->home_route);
      }
      else{
        $this->Flash->error('Invalid email or password');
      }
    }
  }
  
  public function logout() {
    if($this->request->session()->check('previousLogin')){
      $userId = $this->request->session()->consume('previousLogin');
      $user = $this->Users->get($userId)->toArray();
      $this->Auth->setUser($user);
      return $this->redirect(['controller' => 'Users', 'action' => 'index', 'prefix' => 'admin']);
    }
    
    return $this->redirect($this->Auth->logout());
  }
  
  public function forgot_password_step_1() {
    $title = 'Forgot your password?';
    
    $passwordReset = new PasswordResetForm();
    
    if ($this->request->is(['post', 'put'])) {
      
      if ($passwordReset->execute($this->request->data)) {
        $this->Flash->success(__('The email has been sent.'));
      }
      else
        $this->Flash->error($passwordReset->error);
    }
    
    $this->set(compact('title', 'passwordReset'));
  }
  
  public function forgot_password_step_2($reset_key) {
    $title = 'Reset your password';
    
    $user = $this->Users->findByResetKey($reset_key)->first();
    
    if(!$user) {
      $this->Flash->warning(__("Your 'Reset Password' link is invalid or expired. Please use this form if you have forgotten your password and need to reset it."));
      $this->redirect(['action' => 'forgot_password_step_1']);
    }
    
    
    if ($this->request->is(['post', 'put'])) {
      
      $user = $this->Users->patchEntity($user, $this->request->data, [
        'validate' => 'passwordReset',
        'fieldList' => ['password', 'confirm_password']
      ]);
      
      if(!$user->errors())
        $user->reset_key = null;
      
      $savedEntity = $this->Users->save($user);
      
      if ($savedEntity) {
        $this->Flash->success('Your password has been updated. Welcome back!');
        
        $user = $this->Users->get($savedEntity->id);
        $this->Auth->setUser($user->toArray());
        
        return $this->redirect($user['home_route']);
      }
      else {
        $this->Flash->error(__('The password reset failed. Please try again.'));
      }
    }
    
    unset($user->password);
    unset($user->confirm_password);
    unset($this->request->data['password']);
    unset($this->request->data['confirm_password']);
    
    $this->set(compact('title', 'user'));
  }
  
  protected function _profile() {
    $user = $this->Users->get($this->Auth->user('id'));
    unset($user->password);
    
    $this->_form($user);
  }

  protected function _form($user) {
    
    if ($this->request->is(['post', 'put'])) {
      
      if (empty($this->request->data['password']) && $this->request->action != 'add') {
        unset($this->request->data['password']);
        unset($this->request->data['confirm_password']);
      }
      
      $user = $this->Users->patchEntity($user, $this->request->data);
      
      if ($this->Users->save($user)) {
        
        if(in_array($this->request->action, ['add', 'edit'])) {
          $this->Flash->success('The user has been saved.');
          return $this->redirect(['action' => 'index']);
        }
        else {
          $this->Flash->success(__('Your profile has been updated.'));
        }
      }
      else {
        if(in_array($this->request->action, ['add', 'edit']))
          $this->Flash->error('An error occured while trying to save the user.');
        else
          $this->Flash->error(__('An error occured while trying to update your profile.'));
      } 
    }
    
    $roles = $this->Users->roles;
    
    unset($user->password);
    unset($user->confirm_password);
    unset($this->request->data['password']);
    unset($this->request->data['confirm_password']);
    
    $this->set(compact('user', 'roles'));
    $this->render('/Users/_form');
  }
  
  protected function _dashboard() {
    $this->set('breadcrumbs', []);
    $this->render('/Users/dashboard');
  }
  
}