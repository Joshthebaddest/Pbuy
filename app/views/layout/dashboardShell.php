<?php
 require_once __DIR__ .'/../../../config/globalConfig.php';
    $loggedInUser = $_SESSION["user"];
    $profileImg = $_SESSION["profile_img"];
?>

<div class="flex h-screen bg-gray-100">
    <!-- sidebar -->
    <div class="flex flex-col h-screen w-64 bg-white text-gray-900 shadow-xl z-50 border-r border-gray-200">
        <div class="p-4 border-b">
            <h1 class="text-xl font-bold">PBUY</h1>
        </div>

        <nav class="flex-1 px-2 py-4">
            <ul class="space-y-2">
                <li class="rounded-lg">
                    <a class="flex gap-2 cursor-pointer items-center w-full px-4 py-2 rounded-lg font-semibold <?php echo (preg_match('#^'. BASE_PATH.'dashboard/?$#', $_SERVER['REQUEST_URI'])) ? 'border-l-4 border-orange-500 bg-orange-100 text-orange-600' : 'border-transparent text-gray-600  hover:bg-gray-200 hover:text-orange-600'; ?> transition-colors" href="<?= BASE_PATH ?>dashboard">
                        <i class="h-5 w-5 mt-1" data-lucide="layout-dashboard"></i>    
                        Dashboard
                    </a>
                </li>
                <?php if(in_array($_SESSION['role'], ['super_admin', 'admin'])): ?>
                <li class="rounded-lg">
                    <a class="flex gap-2 cursor-pointer items-center w-full px-4 py-2 rounded-lg font-semibold <?php echo (strpos($_SERVER['REQUEST_URI'], 'users') !== false) ? 'border-l-4 border-orange-500 bg-orange-100 text-orange-600' : 'border-transparent text-gray-600  hover:bg-gray-200 hover:text-orange-600'; ?> transition-colors" href="<?= BASE_PATH ?>dashboard/users">
                        <i class="h-5 w-5 mt-1" data-lucide="users"></i>    
                        Users
                    </a>
                </li>
                <?php endif; ?>
                <li class="rounded-lg">
                    <a class="flex gap-2 cursor-pointer items-center w-full px-4 py-2 rounded-lg font-semibold <?php echo (strpos($_SERVER['REQUEST_URI'], 'products') !== false) ? 'border-l-4 border-orange-500 bg-orange-100 text-orange-600' : 'border-transparent text-gray-600  hover:bg-gray-200 hover:text-orange-600'; ?> transition-colors" href="<?= BASE_PATH ?>dashboard/products">
                        <i class="h-5 w-5 mt-1" data-lucide="package"></i>    
                        Products
                    </a>
                </li>
                <li class="rounded-lg">
                    <a class="flex gap-2 cursor-pointer items-center w-full px-4 py-2 rounded-lg font-semibold <?php echo (strpos($_SERVER['REQUEST_URI'], 'orders') !== false) ? 'border-l-4 border-orange-500 bg-orange-100 text-orange-600' : 'border-transparent text-gray-600  hover:bg-gray-200 hover:text-orange-600'; ?> transition-colors" href="<?= BASE_PATH ?>dashboard/orders">
                        <i class="h-5 w-5 mt-1" data-lucide="clipboard"></i>    
                        Orders
                    </a>
                </li>
                <li class="rounded-lg">
                    <a class="flex gap-2 cursor-pointer items-center w-full px-4 py-2 rounded-lg font-semibold <?php echo (strpos($_SERVER['REQUEST_URI'], 'categories') !== false) ? 'border-l-4 border-orange-500 bg-orange-100 text-orange-600' : 'border-transparent text-gray-600  hover:bg-gray-200 hover:text-orange-600'; ?> transition-colors" href="<?= BASE_PATH ?>dashboard/categories">
                        <i class="h-5 w-5 mt-1" data-lucide="tag"></i>    
                        Categories
                    </a>
                </li>
            </ul>
        </nav>

        <div class="p-4 border-t">
            <?php if($_SESSION['role'] === 'vendor'): ?>
                <a class="flex gap-2 cursor-pointer items-center w-full px-4 py-2 rounded-lg font-semibold <?php echo (strpos($_SERVER['REQUEST_URI'], 'settings') !== false) ? 'border-l-4 border-orange-500 bg-orange-100 text-orange-600' : 'border-transparent text-gray-600  hover:bg-gray-200 hover:text-orange-600'; ?> transition-colors" href="<?= BASE_PATH ?>dashboard/settings">
                    <i class="h-5 w-5 mt-1" data-lucide="settings"></i>    
                    Store Settings
                </a>
            <?php else: ?>
                <a class="flex gap-2 cursor-pointer items-center w-full px-4 py-2 rounded-lg font-semibold <?php echo (strpos($_SERVER['REQUEST_URI'], 'settings') !== false) ? 'border-l-4 border-orange-500 bg-orange-100 text-orange-600' : 'border-transparent text-gray-600  hover:bg-gray-200 hover:text-orange-600'; ?> transition-colors" href="<?= BASE_PATH ?>dashboard/settings">  
                    <i class="h-5 w-5 mt-1" data-lucide="settings"></i>    
                    Settings
                </a>
            <?php endif; ?>


            <form action="../controllers/logoutController.php" method="post">
                <button 
                    class="flex gap-2 items-center w-full px-4 py-2 text-gray-600 font-semibold rounded-lg hover:bg-red-600 hover:text-white transition-colors"  
                >
                    <i class="w-5 h-5 mt-1" data-lucide="log-out"></i> Logout
                </button>
            </form>
        </div>
    </div>
    <!-- sidebar end -->

    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Header -->
        <header class="bg-white border-b border-gray-200 h-16">
            <div class="h-full px-4 py-4 flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <h1 class="text-xl font-semibold text-gray-900">PBUY</h1>
                </div>

                <div class="relative">
                    <button href="profile.html" class="flex items-center space-x-2 p-2 rounded-lg hover:bg-gray-100 transition-colors" id="userMenuButton">
                        <div class="w-8 h-8 <?php echo isset($_SESSION['user']) ? 'bg-primary' : 'bg-gray-300'; ?> rounded-full flex items-center justify-center">
                            <img
                                src="<?= !empty($profileImg) ? $profileImg : 'https://ui-avatars.com/api/?name='.urldecode($loggedInUser); ?>"
                                alt="<?= $loggedInUser ?>"
                                class="w-8 h-8 rounded-full"
                            />
                        </div>
                        <?php if(isset($_SESSION['user'])): ?>
                            <span class="hidden md:block text-sm font-medium">Hi, <?php echo $_SESSION['user']; ?></span>
                        <?php endif; ?>
                        <i data-lucide="chevron-down" class="h-4 w-4 text-gray-400"></i>
                    </button>
              
                    <!-- Dropdown Menu -->
                    <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 hidden z-50" id="userDropdown">
                        <div class="py-1">
                            <a href="<?php echo BASE_PATH; ?>profile" class="block px-4 py-2 text-sm text-text hover:bg-gray-200 transition-colors duration-200">
                                <i data-lucide="user" class="w-4 h-4 inline mr-2"></i>
                                profile
                            </a>
                            <hr class="my-1">
                            <a href="<?php echo BASE_PATH; ?>auth/logout" class="block px-4 py-2 text-sm text-text hover:bg-red-500 hover:text-gray-100 transition-colors duration-200">
                                <i data-lucide="log-out" class="w-4 h-4 inline mr-2"></i>
                                Logout
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Header end -->
        <div class="p-5 px-10 text-center w-full overflow-auto relative">
            <div class="text-left pb-10 px-10"> 
                <?php echo $content; ?>
            </div>
        </div>
    </div>
</div>