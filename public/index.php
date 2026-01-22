<?php
session_start();

use App\Core\Router;
use App\Controllers\AuthController;
use App\Controllers\StudentController;
use App\Controllers\TeacherController;
use App\Controllers\ClassController;

require_once __DIR__ . '/../app/Core/Database.php';
require_once __DIR__ . '/../app/Core/BaseController.php';
require_once __DIR__ . '/../app/Core/BaseModel.php';
require_once __DIR__ . '/../app/Core/Auth.php';
require_once __DIR__ . '/../app/Core/Router.php';

require_once __DIR__ . '/../app/Models/Entities/User.php';
require_once __DIR__ . '/../app/Models/Entities/ClassEntity.php';

require_once __DIR__ . '/../app/Models/Repositories/UserRepository.php';
require_once __DIR__ . '/../app/Models/Repositories/ClassRepository.php';

require_once __DIR__ . '/../app/Models/Services/AuthService.php';
require_once __DIR__ . '/../app/Models/Services/ClassService.php';

require_once __DIR__ . '/../app/Controllers/AuthController.php';
require_once __DIR__ . '/../app/Controllers/StudentController.php';
require_once __DIR__ . '/../app/Controllers/TeacherController.php';
require_once __DIR__ . '/../app/Controllers/ClassController.php';

$router = new Router();

$router->get('/', [AuthController::class, 'loginForm']);
$router->get('/login', [AuthController::class, 'loginForm']);
$router->post('/login', [AuthController::class, 'login']);

$router->get('/register', [AuthController::class, 'registerForm']);
$router->post('/register', [AuthController::class, 'register']);

$router->get('/logout', [AuthController::class, 'logout']);

$router->get('/student/dashboard', [StudentController::class, 'dashboard']);
$router->get('/teacher/dashboard', [TeacherController::class, 'dashboard']);

$router->get('/teacher/classes', [ClassController::class, 'index']);
$router->get('/teacher/classes/createclass', [ClassController::class, 'create']);
$router->post('/teacher/classes/createclass', [ClassController::class, 'create']);
$router->get('/teacher/classes/showclasse/{id}', [ClassController::class, 'show']);


$router->dispatch();
