<?php  /// 메인 이미지선택 1개
 $target_dir = "../picture_review/"; // 이미지 파일을 저장할 경로
// $target_dir = "../review/";

echo $_FILES['imagee']['name'];

$uploadnam = explode('.', $_FILES["imagee"]["name"]); // 업로드할 파일의 이름을 '.'를 기준으로 2부분으로 쪼갬. [0]앞부분은 파일의 이름, [1]뒷부분은 파일의 확장자명
$upload_name = time().'.'.$uploadnam[1]; // 서버폴더에 업로드할 파일의 이름을 새로 설정하여 변수에 담음. (현재시간~~.확장자명)

$target_file = $target_dir . $upload_name; // 파일경로 지정

  // 브라우저에서 읽을 때 http://localhost/~~경로 로 읽기 때문에, DB에 경로를 저장할 때는 localhost에 해당하는 var/www/html은 제외하고 저장해야 함
  $file_dir = explode('/', $target_dir);  // 앞서 변수에 저장한 이미지저장경로를 다시 '/' 기준으로 쪼갬


  if( $uploadnam[1] != ""){
    $file_name = '/mosashop/picture_review/'.$upload_name; // 'var/www/html' 뒷부분부터 저장해서 파일경로를 저장함
  } else {
    $file_name = ""; // 'var/www/html' 뒷부분부터 저장해서 파일경로를 저장함
  }



  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); // strolower() 문자열에서 모든 영문자를 소문자로 변환함
  // pathinfo() 파일경로에 관한 정보를 반환함, 옵션에 따라 관련된 정보가 반환됨 (경로이름PATHINFO_DIRNAME, 베이스이름PATHINFO_BASENAME, 확장자PATHINFO_EXTENSION 등..)

  // Check if image file is a actual image or fake image
  if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["imagee"]["tmp_name"]); // getimagesize() 이 함수는 이미지 크기/타입에 대한 정보를 출력해주는 함수로, 7개의 element를 배열로 제공함.
      // 이미지가 아닌 파일이 제공되더라도 이미지로 잘못 감지되어 함수가 반환되나 배열에 의미없는 값이 포함될 수 있음. 따라서 파일이 유효한 이미지인지 확인하기 위해 사용하지 말 것

      if($check !== false) {
      //    echo "File is an image - " . $check["mime"] . ".";
          $uploadOk = 1;
      } else {
    //      echo "File is not an image.";
          $uploadOk = 0;
      }
  }
  // Check if file already exists
  if (file_exists($target_file)) {
  //    echo "Sorry, file already exists.";
      $uploadOk = 0;
  }
  // Check file size
  if ($_FILES["imagee"]["size"] > 500000) {
  //    echo "Sorry, your file is too large.";
      $uploadOk = 0;
  }
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
  //    echo $_FILES["image"]["error"];
      //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
  }
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
  } else {
      if (move_uploaded_file($_FILES["imagee"]["tmp_name"], $target_file)) {

      } else {
      }
  }


                          $connect = mysqli_connect("localhost", "gaeun", "testtest", "z_mosashop") or die("fail");

                          $no = $_GET[no];

                          $title = $_POST[title];
                          $customer_name = $_POST[customer_name];
                          $product_id = $_POST[product_id];
                          $date = $_POST[date];
                          $contents = $_POST[contents];

                          $starrate = $_POST[starrate];
                    //      echo $starrate;

                          $query = "INSERT INTO review (title, customer_name, product_id, rate, date, contents, image)
                                      values ('$title', '$customer_name', '$product_id', '$starrate', '$date', '$contents', '$file_name')";
                          $result = mysqli_query($connect, $query); // 쿼리문과 DB 연결함수 연결함 업데이트 완료하는 코드
           ?>
