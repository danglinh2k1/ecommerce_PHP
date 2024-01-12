<?php
	session_start();
 include('../db/connect.php'); 
?>
<?php
	// session_destroy();
	// unset('dangnhap');
	if(isset($_POST['dangnhap'])) {
		$taikhoan = $_POST['taikhoan'];
		$matkhau = md5($_POST['matkhau']);
		if($taikhoan=='' || $matkhau ==''){
			echo '<p>Xin nhập đủ</p>';
		}else{
			$sql_select_admin = mysqli_query($con,"SELECT * FROM tbl_admin WHERE email='$taikhoan' AND password='$matkhau' LIMIT 1");
			$count = mysqli_num_rows($sql_select_admin);
			$row_dangnhap = mysqli_fetch_array($sql_select_admin);
			if($count>0){
				$_SESSION['dangnhap'] = $row_dangnhap['admin_name'];
				$_SESSION['admin_id'] = $row_dangnhap['admin_id'];
				header('Location: dashboard.php');
			}else{
				echo '<p>Tài khoản hoặc mật khẩu sai</p>';
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Đăng nhập Admin</title>
	<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="col-md-6 mx-auto">
            <h2 class="text-center mb-4">Đăng nhập Admin</h2>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="taikhoan">Tài khoản</label>
                    <input type="text" id="taikhoan" name="taikhoan" placeholder="Điền Email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="matkhau">Mật khẩu</label>
                    <input type="password" id="matkhau" name="matkhau" placeholder="Điền mật khẩu" class="form-control">
                </div>
                <button type="submit" name="dangnhap" class="btn btn-primary btn-block">Đăng nhập Admin</button>
            </form>
        </div>
    </div>
</html>