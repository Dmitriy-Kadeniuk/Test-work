<?php
class UserController {
    private $userModel;
    
    public function __construct() {
        require_once 'models/UserModel.php';
        $this->userModel = new UserModel();
    }
    
    public function index() {
        $users = $this->userModel->getAllUsers();
        include 'views/user/index.php';
    }
    
    public function show($id) {
        $user = $this->userModel->getUserById($id);
        include 'views/user/show.php';
    }
    
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $name = $_POST['name'];
            $address = $_POST['address'];
            $phone = $_POST['phone'];
            $comments = $_POST['comments'];
            $department_id = $_POST['department_id'];
            
            $this->userModel->addUser($email, $name, $address, $phone, $comments, $department_id);
            header('Location: /users');
            exit;
        }
        
        require_once 'models/DepartmentModel.php';
        $departmentModel = new DepartmentModel();
        $departments = $departmentModel->getAllDepartments();
        
        include 'views/user/add.php';
    }
}
?>