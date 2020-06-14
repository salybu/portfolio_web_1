<?php
               $connect = mysqli_connect("localhost", "gaeun", "testtest", "z_mosashop") or die("fail");

               $email = $_POST[inputmail];
               $pw = $_POST[inputpw];
               // $pw=md5($_POST[inputpw]);
               $name = $_POST[inputname];
               $phonenum = $_POST[inputphonenum];
               $addr_num = $_POST[inputaddress_number];
               $addr_main = $_POST[inputaddress_main];
               $addr_det = $_POST[inputaddress_detail];
               $addr_ref = $_POST[inputaddress_ref];

/*              echo $email; echo $pw; */

               //입력받은 데이터를 DB에 저장
               $query = "INSERT INTO member_info (email, pw, name, phone_number, address_number, address_main, address_detail, address_ref)
                VALUES ('$email', '$pw', '$name', '$phonenum', '$addr_num', '$addr_main', '$addr_det', '$addr_ref')";
                mysqli_query($connect, $query);

               //저장이 됬다면 (result = true) 가입 완료
               if(mysqli_connect_errno()) {
                  // <h1 style=" margin-left: 700px; margin-top: 300px;">회원가입에 실패했습니다.</h1>
         } else{
         }
               mysqli_close($connect);
       ?>
