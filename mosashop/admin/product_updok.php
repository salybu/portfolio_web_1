<?php  /// 메인 이미지선택 1개
 $target_dir = "../picture/"; // 이미지 파일을 저장할 경로
// $target_dir = "../review/";
//
// echo $_FILES['imagee']['name'];

$uploadnam = explode('.', $_FILES["imagee"]["name"]); // 업로드할 파일의 이름을 '.'를 기준으로 2부분으로 쪼갬. [0]앞부분은 파일의 이름, [1]뒷부분은 파일의 확장자명
$upload_name = time().'.'.$uploadnam[1]; // 서버폴더에 업로드할 파일의 이름을 새로 설정하여 변수에 담음. (현재시간~~.확장자명)

$target_file = $target_dir . $upload_name; // 파일경로 지정

$imageoriginal = $_POST[imageori];

// $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); // strolower() 문자열에서 모든 영문자를 소문자로 변환함
// pathinfo() 파일경로에 관한 정보를 반환함, 옵션에 따라 관련된 정보가 반환됨 (경로이름PATHINFO_DIRNAME, 베이스이름PATHINFO_BASENAME, 확장자PATHINFO_EXTENSION 등..)

  // 브라우저에서 읽을 때 http://localhost/~~경로 로 읽기 때문에, DB에 경로를 저장할 때는 localhost에 해당하는 var/www/html은 제외하고 저장해야 함
  $file_dir = explode('/', $target_dir);  // 앞서 변수에 저장한 이미지저장경로를 다시 '/' 기준으로 쪼갬

  if( $uploadnam[1] != ""){ // 이미지 파일 확장자가 ""가 아닌 경우, (jpg, gif 뭐든..)
    $file_name = '/mosashop/picture/'.$upload_name; // 'var/www/html' 뒷부분부터 저장해서 파일경로를 저장함
  } else { // 그 외. 이미지 파일 확장자가 ""인 경우, 파일이 없을 경우
    $file_name = $imageoriginal; // 파일명에 기존 파일경로 저장하기
  }

  $uploadOk = 1;
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
  } else {
      if (move_uploaded_file($_FILES["imagee"]["tmp_name"], $target_file)) {
      } else {
      }
  }


  $imageoriginaldetail = $_POST[image_detail];

  $uploadBase = '../picture/';
  // $ar = array();
  $br = "";

  foreach ($_FILES['upload']['name'] as $f => $name) { // foreach ($arr as key($f) => value($name)) { key($f), value($name)의 배열이 배열($arr)임

      $name = $_FILES['upload']['name'][$f]; // [$f]가 인덱스 역할! $_FILES['upload']['name']배열의 $f번째. $_FILES['upload']['name'][0], $_FILES['upload']['name'][1], $_FILES['upload']['name'][2]..
      $uploadName = explode('.', $name); /* explode()는 문자열을 분할해 배열로 저장하는 함수
      '.'을 기준으로 문자열을 잘라냄. $uploadName 변수에 대입하는 값은 파일의 확장자. (ex)image.jpg => [0]image [1]jpg */

      $uploadname = time().$f.'.'.$uploadName[1]; // 파일에 고유한 이름을 부여하기 위해 [time()(현재시간함수) + $f(인덱스값) + '.' + 가져온확장자명]해서 파일이름을 정함
      $uploadFile = $uploadBase.$uploadname; // 파일경로 지정

      $file0dir = explode('/', $uploadBase); // 브라우저에서 읽을 때 http://localhost/~~경로 로 읽기 때문에 localhost에 해당하는 var/www/html은 제외하고 저장해야 함


      if( $uploadName[1] != ""){ // 이미지 파일 확장자가 ""가 아닌 경우, (jpg, gif 뭐든..)
        $file0name = '/mosashop/picture/'.$uploadname; // 'var/www/html' 뒷부분부터 저장해서 파일경로를 저장함
      } else { // 그 외. 이미지 파일 확장자가 ""인 경우, 파일이 없을 경우
        $file0name = $imageoriginaldetail;
      }

      if(move_uploaded_file($_FILES['upload']['tmp_name'][$f], $uploadFile)) { // 임시폴더에 저장된 파일을 지정된 파일경로로 옮김
        //  array_push($ar, $file0name);
        $br = $br.$file0name.',';
          // echo 'success';
      } else {
        $br = $imageoriginaldetail;
          // echo 'error';
      }
  }


  $connect = mysqli_connect("localhost", "gaeun", "testtest", "z_mosashop") or die("fail");

  $no = $_POST[product_id]; // 리뷰 식별번호

  $name = $_POST[product_name];
  $brand = $_POST[product_brand];
  $number = $_POST[product_number];

  $size = $_POST[product_size];
  $material = $_POST[product_material];
  $washing = $_POST[product_washing];

  $type = $_POST[product_type];
  $price = $_POST[product_price];
  $detail_text = $_POST[product_detail_text];

    $query = "UPDATE product SET name = '$name', brand = '$brand', numberr = '$number', size = '$size', material = '$material', washing = '$washing',
                type = '$type', price = '$price', detail_text = '$detail_text', image_main = '$file_name', image_detail = '$br'  WHERE no = '$no'";
    $result = mysqli_query($connect, $query); // 쿼리문과 DB 연결함수 연결함 업데이트 완료하는 코드

    // echo "mysqli 에러";
    // echo mysqli_error($connect); // 에러가 뭔지 찍어보기

    echo "수정 완료되었습니다";

           ?>
