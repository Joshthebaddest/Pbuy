<?php
    // if ($_SERVER["REQUEST_METHOD"] == "GET") {
    //     // Fetch dummy data from API
    //     $apiUrl = 'https://dummyjson.com/products/categories';
    //     $json = file_get_contents($apiUrl);
    //     $data = json_decode($json, true);
    //     require_once __DIR__ . '/../models/category.php' ;
    //     try{
    //         foreach ($data as $category) {
    //             $slug = $category['slug'];
    //             $name= $category['name'];
    //             $url = $category['url'];
    //             Category::create([
    //                 'name' => $name,
    //                 'url' => $url,
    //                 'slug' => $slug,
    //             ]);                        
    //         }
    //         exit();
    //     }catch(Exception $e){
    //         echo $e -> getMessage();
    //     }
        //         $sql = "INSERT INTO VendorProducts (product_name, img_url, quantity, product_size, descriptions, price, username) 
        //                 VALUES (?, ?, ?, ?, ?, ?, ?)";
        //         $stmt = $conn->prepare($sql);
        //         $stmt->bind_param("ssissds", $name, $img, $quantity, $size, $description, $price, $username);
        //         $stmt->execute();
        //         echo "Products inserted/updated successfully."; 
        //     }
           
            
           
        // } else {
        //     echo "No products found in API response.";
        // }
    // }

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        // Fetch dummy data from API
        $apiUrl = 'https://dummyjson.com/products/category/mens-shoes?limit=2';
        $json = file_get_contents($apiUrl);
        $data = json_decode($json, true);
        if (!empty($data['products'])) {
            try{
                require_once __DIR__ . '/../models/products.php' ;
                foreach ($data['products'] as $product) {
                    $name = $product['title'];
                    $quantity= $product['stock'];
                    $img = '/upload/img';
                    $size = 'xxl';
                    $description = $product['description'];
                    $price= $product['price'];
                    $username = "ayomideokubule";
                    Product::create([
                        'product_name' => $name,
                        'img_url' => $img,
                        'quantity' => $quantity,
                        'product_size' => $size,
                        'description' => $description,
                        'price' => $price,
                        'category_id' => 9,
                        'username' => $username,
                    ]);      
                }
            }catch(Exception $e){
                echo $e -> getMessage();
            }
           
        } else {
            echo "No products found in API response.";
        }
    }
?>