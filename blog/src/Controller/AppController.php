<?php
namespace App\Controller;

use Cake\Network\Exception\NotFoundException;
use Cake\Network\Exception\ForbiddenException;
use Cake\View\Exception\MissingTemplateException;

use Cake\Event\Event;
use Cake\I18n\Time;
use Cake\Utility\Inflector;
use Cake\Routing\Router;
use Cake\ORM\TableRegistry;

class AppController extends \Cake\Controller\Controller {
  
  public $Session = null;
  protected $_user;
  protected $_icons = [];
  
  public $helpers = [
    'Html' => [
      'className' => 'Bootstrap.BootstrapHtml'
    ],
    'Form' => [
      'className' => 'Bootstrap.BootstrapForm',
      'useCustomFileInput' => true
    ],
    'Paginator' => [
      'className' => 'Bootstrap.BootstrapPaginator'
    ],
    'Modal' => [
      'className' => 'Bootstrap.BootstrapModal'
    ]
  ];
  
  public function initialize() {
    
    $this->loadComponent('Flash');
    $this->loadComponent('Paginator');
    
    $this->loadComponent('Auth', [
      'authorize' => 'Controller',
      'authenticate' => [
        'Form' => [
          'fields' => ['username' => 'email'],
          'scope' => ['Users.status' => 'A'],
        ]
      ],
      'loginAction' => ['controller' => 'Users', 'action' => 'login', 'prefix' => false],
    ]);
    
    $this->loadComponent('Utilities', [
      'iconSets' => ['basic']
    ]);
  }
  
  public function isAuthorized($user = null) {
    
    // Any registered user can access public functions
    if (empty($this->request->params['prefix'])) {
      return true;
    }
    
    // Only admins can access admin functions
    if ($this->request->params['prefix'] === 'admin') {
      return (bool)($user['role'] === 'A');
    }

    // Default deny
    return false;
  }
  
  public function beforeFilter(Event $event) {
    parent::beforeFilter($event);
    
    Time::$defaultLocale = 'en-CA';
    Time::setToStringFormat('YYYY-MM-dd');
    
    $this->Session = $this->request->session();
    $this->set('Session', $this->Session);
    
    $this->_icons = $this->Utilities->setIcons();
    $this->set('icons', $this->_icons);
    
    $title = $this->Utilities->setDefaultTitle();
    $breadcrumbs = $this->Utilities->setDefaultBreadcrumbs();
    $this->set(compact('title', 'breadcrumbs'));
    
    if(empty($this->request->params['prefix'])) {
      $this->Auth->allow();
      $this->viewBuilder()->layout('empty');
    }

    // Set the user logged in
    if(!is_null($this->Auth->user('id'))) {
      $Users = TableRegistry::get('Users');
      $this->_user = $Users->get($this->Auth->user('id'));
      $this->set('authUser', $this->_user);
    }
    else {
      $this->set('authUser', false);
    }
    
    $nav = $this->_setNav();
    $this->set(compact('nav'));
  }
  
  private function _setNav() {
    
    //Public Nav
    
    $nav = [
      
    ];
    
    if(isset($this->request->params['prefix'])) {
      //Reset to different Nav for logged users
      
      if($this->request->params['prefix'] == 'admin') {

        $nav = [
          'user' => [
            'profile' => [
              'icon' => $this->_icons['user'],
              'name' => 'Profile',
              'route' => ['controller' => 'Users', 'action' => 'profile']
            ],
            'divider' => [
              'divider' => true
            ],
            'logout' => [
              'icon' => $this->_icons['logout'],
              'name' => 'Log Off',
              'route' => ['controller' => 'Users', 'action' => 'logout', 'prefix' => false]
            ]
          ],

          'main' => [
            'ckeditor' => [
              'icon' => $this->_icons['test'],
              'name' => 'CkEditor Test',
              'route' => ['controller' => 'App', 'action' => 'ckeditor', 'prefix' => 'admin']
            ],

            'blogs' => [
              'icon' => $this->_icons['pencil-square-o'],
              'name' => 'Blogs',
              'route' => ['controller' => 'Articles', 'action' => 'index', 'prefix' => 'admin']
            ],
            
            'users' => [
              'icon' => $this->_icons['users'],
              'name' => 'Users',
              'route' => ['controller' => 'Users', 'action' => 'index', 'prefix' => 'admin']
            ]
          ]
        ];
      }
    }
    
    $nav['active'] = Router::url($this->here);

    //pr($nav['active']);
    return $nav;
  }
  
}