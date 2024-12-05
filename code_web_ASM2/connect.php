<?php 
  $connect = mysqli_connect('localhost','root','','w_login_se06303');
  if($connect ==true){
  	echo "Kết nối thành công";
  }
  else{
  	echo "Kết nối thất bại";
  }
//XD câu truy vấn
  $sql ="SELECT * FROM users";
  //Thực thi truy vấn
  $result = mysqli_query($connect,$sql);
  //xử lý kết quả nhận được từ truy vấn
  $count_rows = mysqli_num_rows($result);
  $count_column = mysqli_num_fields($result);
  echo "<br>số dòng trong bảng users là ".$count_rows;
   echo "<br>số cột trong bảng users là ".$count_column;

   $row = mysqli_fetch_array($result); 
   //Hiển thị các phần tử trong mảng 
 
  do{
   	echo "<br> Các username là: ".$row['username']."<br>";
   	echo "<br> Các password là: ".$row['password']."<br>";
   }while($row = mysqli_fetch_array($result))
?>