
<?php

///// 메인 이미지
$target_dir = "../picture"; // 이미지 파일을 저장할 경로

// 이미지 파일 이름 현재시간으로 지정
$uploadnam = explode('.', $_FILES["product_image"]["name"]); // 업로드한 파일의 이름을 '.'를 기준으로 2부분으로 쪼갬. [0]앞부분은 파일의 이름, [1]뒷부분은 파일의 확장자명
$upload_name = time().'.'.$uploadnam[1]; // 서버폴더에 업로드할 파일의 이름을 새로 설정하여 변수에 담음. (현재시간~~.확장자명)

$target_file = $target_dir . "/" .$upload_name; // 파일경로 지정
// $target_file_ext = $target_dir . "/". basename($_FILES["product_image"]["name"]);

// DB에 저장할 경로와 이름
$db_mainname = "/mosashop/picture" . "/" . $upload_name;

$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["product_image"]["tmp_name"]);
    if($check !== false) {
        // echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        // echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    // echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["product_image"]["size"] > 5000000) {
    // echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    // echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
    //     echo "<p>The file ". basename( $_FILES["product_image"]["name"]). " has been uploaded.</p>";
		// echo "<br><img src=/uploads/". basename( $_FILES["product_image"]["name"]). ">";
		// echo "<br><button type='button' onclick='history.back()'>돌아가기</button>";
    } else {
    //     echo "<p>Sorry, there was an error uploading your file.</p>";
		// echo "<br><button type='button' onclick='history.back()'>돌아가기</button>";
    }
}


// 세부 이미지
$uploadBase = '../picture/';

// DB에 저장할 경로를 위해 변수 설정
$db_detailname = "";

foreach ($_FILES['upload']['name'] as $f => $name) {

    $name = $_FILES['upload']['name'][$f];
    $uploadName = explode('.', $name);

    $uploadname = time().$f.'.'.$uploadName[1];
    $uploadFile = $uploadBase.$uploadname;

    if(move_uploaded_file($_FILES['upload']['tmp_name'][$f], $uploadFile)){
        // echo 'success';
				$db_detailname = $db_detailname. "/mosashop/picture/". $uploadname.',';

    } else {
        // echo 'error';
    }
}

// print_r($_FILES['upload']) // 확인용
?>


<?php
               $connect = mysqli_connect("localhost", "gaeun", "testtest", "z_mosashop") or die("fail");

               $name = $_POST[product_name];
               $brand = $_POST[product_brand];
               // $pw=md5($_POST[inputpw]);
               $number = $_POST[product_number];
               $size = $_POST[product_size];
               $material = $_POST[product_material];
               $washing = $_POST[product_washing];

               $type_b = $_POST[product_type];
               $type = trim($type_b); // 문자열 앞뒤 공백제거

               $price = $_POST[product_price];
               $detail_text = $_POST[product_detail_text];

                $query = "INSERT INTO product (name, brand, numberr, size, material, washing, type, price, detail_text, image_main, image_detail)
                 VALUES ('$name', '$brand', '$number', '$size', '$material', '$washing', '$type', '$price', '$detail_text', '$db_mainname', '$db_detailname')";
              mysqli_query($connect, $query);
              echo "상품이 등록되었습니다";

              // echo "mysqli 에러";
              // echo mysqli_error($connect); // 에러가 뭔지 찍어보기
              // echo $ar;
               ?>

       <?php
              if(mysqli_connect_errno()) { // DB 연결이 잘 되었는지 확인
              } else {
              }
               mysqli_close($connect);
       ?>
