<?php
  try{
    require_once __DIR__ . '/../../../../models/category.php';
    $data = Category::query()
      ->select('*')
      ->get();
    $categories = [];
    foreach ($data as $row) {
      $categories[] = [
        'id' => $row['id'],
        'slug' => $row['slug'],
        'name' => $row['name'],
        'count' =>  "120 products",
      ];
    }
  }catch(Exception $e) {
    // Handle query preparation error
    echo('error: ');
    echo $e -> getMessage();
  }
?>

<section class="py-16 bg-gray-50">
  <div class="container mx-auto px-4">
    <div class="text-center mb-12">
      <h2 class="text-3xl font-bold mb-4">Shop by Category</h2>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-8 gap-4">
      <?php
        if(isset($categories) && !empty($categories)):
          foreach ($categories as $category): 
            $slug = $category['slug'];
      ?>
        <a href="/category/<?= $slug ?>" class="block hover:shadow-lg transition-shadow cursor-pointer">
          <div class="category-card">
            <div class="bg-white rounded-lg p-6 text-center hover:shadow-lg transition-shadow cursor-pointer">
              <div class="w-16 h-16 bg-primary bg-opacity-10 rounded-full flex items-center justify-center mx-auto mb-4">
                <!-- <i data-lucide="smartphone" class="h-8 w-8 text-primary"></i> -->
                <img src="" alt="<?= htmlspecialchars($category['name']) ?>" width="80" height="80" class="mx-auto mb-3 rounded-lg" />
              </div>
              <h4 class="font-semibold"><?= htmlspecialchars($category['name']) ?></h4>
            </div>
          </div>  
        </a>
      <?php 
        endforeach; 
      ?>
      <?php else: ?>
        <p>No Categories Available</p>
      <?php endif; ?>
    </div>
  </div>
</section>