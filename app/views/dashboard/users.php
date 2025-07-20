<?php  
    include_once __DIR__ . '/../../../config/globalConfig.php';
    include __DIR__ .'/../../controllers/usersController.php';
    $allowed_roles = ['admin', 'editor', 'user'];
    $role_hierarchy = [
        'super_admin' => 4,
        'admin'       => 3,
        'vendor'      => 2,
        'user'        => 1,
    ];

    if(isset($_GET['search'])){
        $searchField = htmlspecialchars($_GET['search']);
        if(!empty($searchField)){
            require_once __DIR__ .'/../../models/users.php';
            $users = [];
            $users = User::query()
                ->select('fullname', 'username', 'email', 'profileImg', 'email_verified', 'country', 'role')
                ->where('username', $searchField)
                ->orWhere('fullname', $searchField)
                ->get();
        }
    }
    $column = [
        'id' => 'ID',
        'image' => 'IMAGE',
        'fullname' => 'FULLNAME',
        'username' => 'USERNAME',
        'email' => 'EMAIL',
        'country' => 'COUNTRY',
        'role' => 'ROLE',
        'status' => 'STATUS',
        'action' => 'ACTION'
    ];
    $col = '';
    $sort = 'id';
    $order = 'asc';
    if(isset($_GET['sort'])){
        $sort = htmlspecialchars($_GET['sort']) ?? 'id';
        $order = htmlspecialchars($_GET['order']) ?? 'asc';

        include_once __DIR__ . '/../../utils/utilFunc.php';

        $users = sortArrayOfAssociativeArrays($users, $sort, $order);
    }
?>

<div class="space-y-6">
    <div class="space-y-4 sm:flex-row sm:items-center sm:justify-between gap-4">
        <div class="flex justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-900">User Management</h3>
                <p class="text-gray-600">Review and moderate products from vendors</p>
            </div>
            <button id="addProductBtn" class="flex gap-2 bg-gradient-to-br from-orange-500 to-orange-600 text-white px-6 py-3 rounded-lg font-semibold">
                <i class="w-6 h-6 text-white" data-lucide="user"></i> 
                Add User
            </button>
        </div>
        <div class="flex justify-end gap-5">
            <div class="relative">
                <input type="text" placeholder="Search users..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <select class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-transparent">
                <option>All Users</option>
                <option>Admin</option>
                <option>Vendor</option>
                <option>User</option>
            </select>
        </div>
    </div>

    <?php if(!empty($users)): ?>
        <div class="bg-white rounded-xl shadow border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto h-[400px]">
                <table class="w-full">
                    <thead class="bg-gray-200 text-gray-500 border-b text-sm font-normal border-gray-200 hover:bg-gray-50">
                        <tr>
                            <?php foreach($column as $key => $value): ?>
                                <?php if(isset($_SESSION["role"]) && $_SESSION["role"] !== "user" && ($key !== 'role' || $key !== 'action')):?>
                                <th class="py-5 px-6 text-left whitespace-nowrap">
                                    <a href="<?= BASE_PATH ?>dashboard/users?sort=<?= $key ?>&order=<?= $order === 'asc' ? 'desc' : 'asc' ?>" class="flex items-center gap-2 select-none">
                                        <?= htmlspecialchars($value) ?>
                                        <?php if ($key === $sort): ?>
                                            <?php if ($order === 'asc'): ?>
                                                <i data-lucide="arrow-up" class="w-4 h-4 text-gray-400 mt-1"></i>
                                            <?php else: ?>
                                                <i data-lucide="arrow-down" class="w-4 h-4 text-gray-400 mt-1"></i>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <i data-lucide="chevron-up-down" class="w-4 h-4 text-gray-200 mt-1"></i>
                                        <?php endif; ?>
                                        </a>
                                </th>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody class="">
                        <?php foreach($users as $row): ?>
                            <?php if(isset($_SESSION["user"]) && ($_SESSION["user"] !== $row['username']) && ($_SESSION["role"] !== "super_admin")): ?>
                                <tr class='text-sm text-gray-700 hover:bg-[#FEF3E2]'>
                                    <td class="py-3 px-6 text-left whitespace-nowrap"><?=$count++?></td>
                                    <td class="py-3 px-6 text-left whitespace-nowrap"><?=$row['profileImg']?></td>
                                    <td class="py-3 px-6 text-left whitespace-nowrap"><?=$row['fullname']?></td>
                                    <td class="py-3 px-6 text-left whitespace-nowrap"><?=$row['username']?></td>
                                    <td class="py-3 px-6 text-left whitespace-nowrap"><?=$row['email']?></td>
                                    <td class="py-3 px-6 text-left whitespace-nowrap"><?=$row['country']?></td>
                                    <?php if(isset($_SESSION["role"]) && ($_SESSION["role"] !== "user") || $_SESSION['role'] !== "vendor") : ?>
                                        <td class="py-3 px-6 text-left whitespace-nowrap">
                                            <div class='relative h-fit w-24 font-semibold'>
                                                <div class='h-fit rounded-xl dropdown-selector cursor-pointer <?= $row['role'] !== 'super_admin' || $row['role'] !== 'admin' ? 'border-2 hover:border-white' : '' ?>'>
                                                    <div class='flex justify-between p-2 w-full text-center'>
                                                        <p class='text-sm capitalize'><?= $row['role'] ?></p>
                                                        <div class='pt-1' >
                                                            <?php if($_SESSION['role'] === 'super_admin' || ($_SESSION['role'] === 'admin' && $row['role'] !== 'admin')): ?>
                                                                <i class="h-4 w-4" data-lucide="chevron-down"></i>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php if(isset($role_hierarchy[$_SESSION["role"]], $role_hierarchy[$row["role"]]) && $role_hierarchy[$_SESSION["role"]] > $role_hierarchy[$row["role"]]): ?>
                                                <div class="hidden absolute w-full z-10 dropdown">
                                                    <div class='p-1 rounded-xl border bg-white'> 
                                                        <?php foreach($allowed_roles as $role): ?> 
                                                        <div 
                                                            class="<?= isset($_SESSION["role"]) && $_SESSION["role"] === "editor" && $role === "admin" ? "hidden" : "flex" ?> gap-2 p-1 px-2 hover:bg-gray-300 rounded-xl cursor-pointer"
                                                        >
                                                            <form action="../controllers/roleController.php" method="POST" class="w-full">
                                                                <input type="hidden" name="username" value="<?= $row["username"] ?>">
                                                                <input type="hidden" name="role" value="<?= $role ?>">
                                                                <button type="submit" class="text-sm capitalize font-semibold w-full text-left <?= $row["role"] === $role ? "flex gap-2" : "block" ?>"><?= $role ?><?php if($row["role"] === $role): ?><i class="w-4 h-4 mt-1" data-lucide="check"></i><?php endif ?></button>
                                                            </form>
                                                        </div>
                                                        
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                        </td>

                                        <td class="py-3 px-6 text-left whitespace-nowrap">
                                            <div class='relative h-fit w-24 font-semibold'>
                                                <div class='h-fit rounded-xl dropdown-selector cursor-pointer <?= $row['role'] !== 'super_admin' || $row['role'] !== 'admin' ? 'border-2 hover:border-white' : '' ?>'>
                                                    <div class='flex justify-between p-2 w-full text-center'>
                                                        <p class='text-sm capitalize'><?= $row['role'] ?></p>
                                                        <div class='pt-1' >
                                                            <?php if($_SESSION['role'] === 'super_admin' || ($_SESSION['role'] === 'admin' && $row['role'] !== 'admin')): ?>
                                                                <i class="h-4 w-4" data-lucide="chevron-down"></i>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <?php if(isset($role_hierarchy[$_SESSION["role"]], $role_hierarchy[$row["role"]]) && $role_hierarchy[$_SESSION["role"]] > $role_hierarchy[$row["role"]]): ?>
                                                <div class="hidden absolute w-full z-10 dropdown">
                                                    <div class='p-1 rounded-xl border bg-white'> 
                                                        <?php foreach($allowed_roles as $role): ?> 
                                                        <div 
                                                            class="<?= isset($_SESSION["role"]) && $_SESSION["role"] === "editor" && $role === "admin" ? "hidden" : "flex" ?> gap-2 p-1 px-2 hover:bg-gray-300 rounded-xl cursor-pointer"
                                                        >
                                                            <form action="../controllers/roleController.php" method="POST" class="w-full">
                                                                <input type="hidden" name="username" value="<?= $row["username"] ?>">
                                                                <input type="hidden" name="role" value="<?= $role ?>">
                                                                <button type="submit" class="text-sm capitalize font-semibold w-full text-left <?= $row["role"] === $role ? "flex gap-2" : "block" ?>"><?= $role ?><?php if($row["role"] === $role): ?><i class="w-4 h-4 mt-1" data-lucide="check"></i><?php endif ?></button>
                                                            </form>
                                                        </div>
                                                        
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                        <?php if($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'super_admin'): ?>
                                            <td class="flex gap-2 py-3 px-6 text-left whitespace-nowrap"> 
                                                <button class="view-user-btn text-primary hover:text-orange-600 mr-2" title="View Details">
                                                    <i class="w-5 h-5" data-lucide="eye"></i>
                                                </button>
                                                <button type="button" class='edit btn hover:bg-gray-600 p-1' title="edit">
                                                    <i class="w-5 h-5 text-gray-600 hover:text-white" data-lucide="square-pen"></i>
                                                </button>
                                                <?php if($_SESSION["role"] === "super_admin"): ?>
                                                    <button type="submit" class='delete btn hover:bg-red-600 p-1' title="delete">
                                                        <i class="w-5 h-5 text-red-600 hover:text-white" data-lucide="trash-2"></i>
                                                    </button>
                                                <?php endif; ?>
                                            </td>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    

                                    <div id="popup" class="hidden w-full h-screen bg-gray-800 fixed left-0 opacity-60 top-0 z-50"></div>
                                    <div id="popup-message" style="width: fit-content; top: 35%; left: 25%; right: 25%" class="hidden z-50 opacity-100 fixed shadow-lg p-5 rounded-lg mx-auto bg-gray-200">
                                        <p>Are you sure you want to delete this user?</p>
                                        <div style="width: fit-content" class="flex gap-5 py-2 mx-auto">
                                            <form action="../controllers/userController.php?id=<?=$row['id']?>&type=delete" method="POST">
                                                <button type="submit" style="width: 50px; height: 25px" class="popup-btn bg-red-600 text-white rounded-lg text-sm">Yes</button>
                                            </form>
                                            <button style="width: 50px; height: 25px" class="popup-btn bg-gray-500 text-white rounded-lg text-sm">No</button>
                                        </div>
                                    </div>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="flex flex-col md:flex-row items-center justify-end gap-10 mt-4 space-y-2 md:space-y-0">
            <!-- Page Info -->
            <div class="text-sm text-gray-800">
                Showing page <span class="font-medium">1</span> of <span class="font-medium">1<span>
            </div>
            <!-- Pagination Buttons -->
            <div class="flex justify-end mt-4 space-x-1 text-sm">
                <a href="" class="px-3 py-2 border rounded-l bg-gray-800 text-white"><i class="w-5 h-5 text-white" data-lucide="chevron-left"></i></a>
                <a href="" class="px-3 py-2 border bg-gray-800 text-white">1</a>
                <!-- <a href="" class="px-3 py-2 border bg-white text-gray-600 hover:bg-gray-100">2</a>
                <a href="" class="px-3 py-2 border bg-white text-gray-600 hover:bg-gray-100">3</a> -->
                <a href="" class="px-3 py-2 border rounded-r bg-gray-800 text-white"><i class="w-5 h-5 text-white" data-lucide="chevron-right"></i></a>
            </div>
        </div>
    <?php else: ?>
        <p>No users found</p>
    <?php endif; ?>
</div>
                   