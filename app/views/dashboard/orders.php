<?php
    require_once __DIR__ . '/../../../config/globalConfig.php';
    require_once __DIR__ . '/../../models/product/products.php';
    require_once __DIR__ .'/../../models/users.php';

    $products = $data['products'] ?? [];
    $count = 1;
    $col = '';
    $sort = 'id';
    $order = 'asc';
    $column = [
        ['slug' => 'id', 'label' => 'ID', 'sortable' => true],
        ['slug' => 'image', 'label' => 'IMAGE', 'sortable' => false],
        ['slug' => 'customer', 'label' => 'CUSTOMER', 'sortable' => true],
        ['slug' => 'vendor', 'label' => 'VENDOR', 'sortable' => true],
        ['slug' => 'total', 'label' => 'TOTAL', 'sortable' => true],
        ['slug' => 'status', 'label' => 'STATUS', 'sortable' => false],
        ['slug' => 'date', 'label' => 'DATE', 'sortable' => true],
        ['slug' => 'action', 'label' => 'ACTION', 'sortable' => false],
    ];

    if(isset($_GET['sort'])){
        $sort = htmlspecialchars($_GET['sort']) ?? 'id';
        $order = htmlspecialchars($_GET['order']) ?? 'asc';

        include_once __DIR__ . '/../../utils/utilFunc.php';
        $products = sortArrayOfAssociativeArrays($products, $sort, $order);
    }


?>

<div class="space-y-4">
    <div class="space-y-10 sm:flex-row sm:items-center sm:justify-between gap-4">
        <div class="flex justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-900">Orders Oversight</h3>
                <p class="text-gray-600">Review and moderate orders from vendors</p>
            </div>

            <div class="flex gap-2">
                <div class="relative">
                    <input type="text" placeholder="Search orders..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <select class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-transparent">
                    <option>All Orders</option>
                    <option>Pending</option>
                    <option>Processing</option>
                    <option>Shipped</option>
                    <option>Delivered</option>
                    <option>Cancelled</option>
                </select>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto h-[400px]">
            <table class="w-full">
                <thead class="bg-gray-200 text-gray-500 border-b text-sm font-normal border-gray-200 hover:bg-gray-50">
                    <tr>
                        <?php foreach($column as $key): ?>
                            <th class="py-5 px-6 text-left whitespace-nowrap">
                                <?php if($key['sortable']): ?>
                                    <a href="<?= BASE_PATH ?>dashboard/products?sort=<?= $key['slug'] ?>&order=<?= $order === 'asc' ? 'desc' : 'asc'?>"
                                        class="flex items-center gap-2 select-none"
                                    >
                                        <?= htmlspecialchars($key['label']) ?>
                                        <?php if ($key['slug'] === $sort): ?>
                                            <?php if ($order === 'asc'): ?>
                                                <i data-lucide="arrow-up" class="w-4 h-4 text-gray-400 mt-1"></i>
                                            <?php else: ?>
                                                <i data-lucide="arrow-down" class="w-4 h-4 text-gray-400 mt-1"></i>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <i data-lucide="chevron-up-down" class="w-4 h-4 text-gray-200 mt-1"></i>
                                        <?php endif; ?>
                                    </a>
                                <?php else: ?>
                                    <?= htmlspecialchars($key['label']) ?>
                                <?php endif; ?>
                            </th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    <?php foreach($products as $row): ?>
                        <tr class='text-sm text-gray-700 hover:bg-[#FEF3E2]'>
                            <td class="py-3 px-6 text-left whitespace-nowrap"><?=$count++?></td>
                            <td class="py-3 px-6 text-left whitespace-nowrap"><img class="w-10 h-8" src="<?=$row['img_url']?>" alt="<?=$row['product_name']?>"/></td>
                            <td class="py-3 px-6 text-left whitespace-nowrap"><?=$row['product_name'] ?></td>
                            <td class="py-3 px-6 text-left whitespace-nowrap"><?=$row['product_size']?></td>
                            <td class="py-3 px-6 text-left whitespace-nowrap"><?=$row['price']?></td>
                            <td class="py-3 px-6 text-left whitespace-nowrap"><?=$row['quantity']?></td>
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                <div class='relative h-fit w-24 font-semibold'>
                                    <div class='h-fit rounded-xl dropdown-selector cursor-pointer <?= $_SESSION['role'] !== 'vendor' ? 'border-2 hover:border-white' : '' ?>'>
                                        <div class='flex justify-between p-2 w-full text-center'>
                                            <p class='text-sm capitalize <?= $row['status'] === 'approved' ? 'text-green-600' : ($row['status'] === 'rejected' ? 'text-red-600' : 'text-yellow-600') ?>'><?= $row['status'] ?></p>
                                            <div class='pt-1'>
                                                <?php if($_SESSION['role'] !== 'vendor'): ?>
                                                    <i class="h-4 w-4" data-lucide="chevron-down"></i>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'super_admin'): ?>
                                        <div class="hidden absolute w-full z-10 dropdown">
                                            <div class='p-1 rounded-xl border bg-white'> 
                                                <?php foreach(['approved', 'pending', 'rejected'] as $status): ?> 
                                                    <div class="flex gap-2 p-1 px-2 hover:bg-gray-300 rounded-lg cursor-pointer">
                                                        <form class="w-full">
                                                            <input type="hidden" name="username" value="<?= $row["username"] ?>">
                                                            <input type="hidden" name="role" value="<?= $status ?>">
                                                            <button type="submit" class="text-sm capitalize font-semibold w-full text-left <?= $row["status"] === $status ? "flex gap-2" : "block" ?>">
                                                                <span class="<?php echo $status === 'approved' ? 'text-green-600' : ($status === 'rejected' ? 'text-red-600' : 'text-yellow-600') ?>"><?php echo $status ?></span>
                                                                <?php if($row["status"] === $status): ?>
                                                                    <i class="w-4 h-4 mt-1" data-lucide="check"></i>
                                                                <?php endif ?>
                                                            </button>
                                                        </form>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </td>
                            
                            <td class="flex gap-2 py-3 px-6 text-left whitespace-nowrap"> 
                                <button class="view-product-btn text-primary hover:text-orange-600 mr-2" title="View Details">
                                    <i class="w-5 h-5" data-lucide="eye"></i>
                                </button>
                                <button class='edit-btn p-1'>
                                    <i class="w-5 h-5 text-gray-600 hover:text-white" data-lucide="square-pen"></i>
                                </button>
                                <button type="submit" class='delete btn p-1'>
                                    <i class="w-5 h-5 text-red-600 hover:text-white" data-lucide="trash-2"></i>
                                </button>
                            </td>
                            <!-- edit products modal -->
                            <?php //include __DIR__ . '/newProduct.php' ?>

                            <!-- view product details modal -->
                            <?php include __DIR__ . '/components/products/productDetails.php' ?>
                            

                            <div id="popup" class="hidden w-full h-screen bg-gray-800 fixed left-0 opacity-60 top-0 z-50"></div>
                            <div id="popup-message" style="width: fit-content; top: 35%; left: 25%; right: 25%" class="hidden z-50 opacity-100 fixed shadow-lg p-5 rounded-lg mx-auto bg-gray-200">
                                <p>Are you sure you want to delete this user?</p>
                                <div style="width: fit-content" class="flex gap-5 py-2 mx-auto">
                                    <form action="../../controllers/productController.php?id=<?=$row['product_id']?>&type=delete" method="POST">
                                        <button type="submit" style="width: 50px; height: 25px" class="popup-btn bg-red-600 text-white rounded-lg text-sm">Yes</button>
                                    </form>
                                    <button style="width: 50px; height: 25px" class="popup-btn bg-gray-500 text-white rounded-lg text-sm">No</button>
                                </div>
                            </div>
                        </tr>
                        <?php //include __DIR__ . '/newProduct.php' ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="flex flex-col md:flex-row items-center justify-end gap-10 mt-4 space-y-2 md:space-y-0">
        <!-- Page Info -->
        <div class="text-xs text-gray-800">
            Showing page <span class="font-medium">1</span> of <span class="font-medium">1<span>
        </div>
        <!-- Pagination Buttons -->
        <div class="flex justify-end mt-4 space-x-1 text-xs">
            <a href="<?=BASE_PATH ?>" class="px-3 py-2 border rounded-l bg-gray-500 text-white"><i class="w-5 h-5 text-white" data-lucide="chevron-left"></i></a>
            <a href="<?=BASE_PATH ?>" class="px-3 py-2 border bg-gray-800 text-white">1</a>
            <!-- <a href="" class="px-3 py-2 border bg-white text-gray-600 hover:bg-gray-100">2</a>
            <a href="" class="px-3 py-2 border bg-white text-gray-600 hover:bg-gray-100">3</a> -->
            <a href="<?=BASE_PATH ?>" class="px-3 py-2 border rounded-r bg-gray-500 text-white"><i class="w-5 h-5 text-white" data-lucide="chevron-right"></i></a>
        </div>
    </div>

    <?php include __DIR__. '/components/orders/orderDetails.php' ?>
</div>

<script>
    Array.from(document.getElementsByClassName('edit-btn')).forEach(function(btn) {
        btn.addEventListener('click', ()=>{
            document.getElementById('orderModal').classList.remove('hidden');
        });
    });

    Array.from(document.getElementsByClassName('dropdown-selector')).forEach(function(dropdown, index) {
        dropdown.addEventListener('click', function() {
            document.getElementsByClassName('dropdown')[index].classList.toggle('hidden');
        });
    });

    Array.from(document.getElementsByClassName('view-product-btn')).forEach(function(views, index){
        views.addEventListener('click', function(){
            Array.from(document.getElementsByClassName('product-details')).forEach(function(detail){
                detail.classList.add('hidden');
            });
            document.getElementsByClassName('product-details')[index].classList.remove('hidden');
        })
    })
    document.getElementById('close-product-details').addEventListener('click', ()=>{
        Array.from(document.getElementsByClassName('product-details')).forEach(function(detail){
            detail.classList.add('hidden');
        });
    })

</script>