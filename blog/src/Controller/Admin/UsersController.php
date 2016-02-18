<?php
namespace App\Controller\Admin;

use Cake\Network\Exception\NotFoundException;

class UsersController extends \App\Controller\UsersController {
  
  public function dashboard() {
    $this->_dashboard();
  }

  public function profile() {
    $this->_profile();
  }

  public function index() {
    
    $conditions = [
      'Users.status' => 'A'
    ];
    
    if(isset($this->request->query['search_users'])) {
      $this->request->data['search_users'] = $this->request->query['search_users'];
      
      if(in_array(strtolower($this->request->query['search_users']), ['manager', 'administrator', 'admin', 'salesman', 'salesmen', 'sales'])) {
        $role = strtoupper(substr($this->request->query['search_users'], 0,1));
        $conditions['Users.role'] = $role;
      }
      else {
        
        $conditions['OR']['Users.first_name LIKE'] = $this->request->query['search_users'] . '%';
        $conditions['OR']['Users.last_name LIKE'] = $this->request->query['search_users'] . '%';
        $conditions['OR']['Users.email LIKE'] = $this->request->query['search_users'] . '%';
      }
    }
    
    $this->paginate = [
      'sortWhitelist' => ['Users.first_name', 'email', 'role'],
      'conditions' => $conditions
    ];
    
    $users = $this->paginate();
    
    $title = 'Users';
    $breadcrumbs = [
      ['name' => $title, 'active' => true]
    ];
    
    $this->set(compact('title', 'breadcrumbs', 'users'));
  }
  
  public function loginAs($id){
    $this->request->allowMethod(['post']);
    
    //Set current login user ID into the session
    $previousLogin = $this->Auth->user('id');
    $this->request->session()->write('previousLogin', $previousLogin);
    
    //Login as the selected user
    $user = $this->Users->get($id);
    $this->Auth->setUser($user->toArray());
    
    return $this->redirect($user->home_route);
  }

  public function add() {
    $user = $this->Users->newEntity();
    $this->_form($user);
  }
  
  public function edit($id) {
    $user = $this->Users->get($id);
    
    if(!$user)
      throw new NotFoundException();
    
    unset($user->password);
    
    $this->_form($user);
  }

  public function delete($id) {

    $this->request->allowMethod(['post', 'delete']);
    $user = $this->Users->get($id);
    
    if(!$user)
      throw new NotFoundException();
    
    $user->status = 'D';
    
    if ($this->Users->save($user))
      $this->Flash->success($user->name . ' has been deleted.');
    else
      $this->Flash->error($user->name . ' couldn\'t be deleted.');
    
    return $this->redirect(['action' => 'index']);
  }
  
}