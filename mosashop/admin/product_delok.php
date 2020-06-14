<?php
                          $connect = mysqli_connect("localhost", "gaeun", "testtest", "z_mosashop") or die("fail");

                          $no = $_GET[id]; // 리뷰 식별번호

                          $query = "DELETE FROM product WHERE no = '$no'";
                          $result = mysqli_query($connect, $query); // 쿼리문과 DB 연결함수 연결함 업데이트 완료하는 코드

                          echo "삭제 완료되었습니다";
           ?>
