<div class="nav-bar">
            <nav class="navbar navbar-expand-lg ">
                <!-- <a class="navbar-brand" href="admin/users"><img src="asset/image/ư.webp" alt=""></a> -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <div class="fa fa-bars"></div>
             </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">TRANG CHỦ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php#about">VỀ TÔI</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php#resume">TIỂU SỬ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php#services">DỊCH VỤ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="blog.php">BÀI VIẾT</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php#contact">LIÊN HỆ</a>
                        </li>
                        <?php if(!isset($_SESSION['use'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="modal" data-target="#studentaddmodal1">ĐĂNG NHẬP</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="modal" data-target="#studentaddmodal">ĐĂNG KÝ</a>
                        </li>
                        <?php else: ?>
                        <ul class="navbar-nav ">
                  
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle mr-5 pr-3" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user" aria-hidden="true" style="color:white;top:10px"></i>  
                                <?php echo $_SESSION['use'] ?>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <?php if($_SESSION['adm']==1): ?>
                                    <a class="dropdown-item" href="admin/users/">Trang quản trị</a>
                                    <?php endif; ?>
                                    <a class="dropdown-item" href="?logout">Đăng xuất</a>
                                </div>
                            </li>
                        </ul>
                        <?php endif;?>
                    </ul>
                </div>
            </nav>
        </div>
     