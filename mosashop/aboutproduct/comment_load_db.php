<?php
$conn = mysqli_connect("localhost", "gaeun", "testtest", "z_mosashop") or mysqli_error();
session_start();
        $id = $_GET['id'];

              $querycm = "SELECT * from comment_review where review_id ='$id'"; // 상품 고유id값(no)이 $id(get으로 받아온 값)와 일치하는 아이템을 모두 읽어옴
              $resultcm = mysqli_query($conn, $querycm) or die (mysqli_error($conn)); // 쿼리문과 DB 연결함수 연결함

              if($resultcm){

              while($rowcm = mysqli_fetch_array($resultcm)) { // 읽어온 아이템을 row변수에 전부 담아서 항목별로 가져올 수 있게 함

                 $data =  $rowcm[no]."@".$rowcm[content]."@".$rowcm[writer_name] ;

  ?>
                              <tr name="trStaff" class="comm">
                                  <!-- <td class="comid" name="comid"><php echo $rowcm['no'];?></td> 댓글 수정, 삭제할 때 넘길 수 있게 댓글의 식별번호를 input hidden값으로 넣어둠 -->
                                  <td><b><span class="comname"><?php echo $rowcm['writer_name'];?></span></b></td>
                                  <td class="chil" ><span class="comcont"><?php echo $rowcm['content'];?></span>&nbsp;(<span class="comtime"><?php echo $rowcm['date'];?></span>)</td>
                                  <td value="0">&nbsp;

                                    <button name="upd" type="javascript:" onclick="update_comment('  <?php echo $data;?>' )" <?php if( $rowcm[writer_name] == $_SESSION[name]){ // 댓글 작성자와, 세션접속자 이름이 같은 경우 아무 값도 출력하지 않음
                                                             } else { // 다른 경우 버튼을 숨기기 위해 hidden 값을 줌
                                                                echo 'hidden="true"';} ?>>수정</button>
                                    <button name="del" type="javascript:" onclick="delete_comment(<?php echo $rowcm[no];?>)" <?php if( $rowcm[writer_name] == $_SESSION[name]){ // 댓글 작성자와, 세션접속자 이름이 같은 경우 아무 값도 출력하지 않음
                                                            } else if( $_SESSION[name] == "관리자"){ }else { // 다른 경우 버튼을 숨기기 위해 hidden 값을 줌
                                                                echo 'hidden="true"';} ?>>삭제</button>
                                  </td>
                              </tr>
    <?php      }}
    else{
      // echo "fail";
    }  ?>
