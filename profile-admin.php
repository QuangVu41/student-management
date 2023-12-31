<!-- Main -->
<main class="profile">
    <div class="container">
        <!-- Mobile Search bar -->
        <div class="profile-container">
            <div class="search-bar d-none d-md-flex">
                <input type="text" name="" id="" placeholder="Search for item" class="search-bar__input" />
                <button class="search-bar__submit">
                    <img src="./assets/icons/search.svg" alt="" class="search-bar__icon icon" />
                </button>
            </div>
        </div>

        <!-- profile content -->
        <div class="profile-container">
            <div class="row gy-md-3">
                <div class="col-9 col-xl-8 col-lg-7 col-md-12">
                    <div class="cart-info">
                        <div class="row gy-3">
                            <!-- Account Info -->
                            <div class="col-12">
                                <div class="account__heading">
                                    <h2 class="cart-info__heading">Thông tin admin</h2>
                                </div>
                                <div class="row row-cols-1">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col-4">
                                                <p class="account__info">Mã SV</p>
                                            </div>
                                            <div class="col-8">
                                                <p class="account__info"><?= $_SESSION['admin']['admin_id'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col-4">
                                                <p class="account__info">Họ và tên</p>
                                            </div>
                                            <div class="col-8">
                                                <p class="account__info"><?= $_SESSION['admin']['admin_name'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col-4">
                                                <p class="account__info">Ngày sinh</p>
                                            </div>
                                            <div class="col-8">
                                                <p class="account__info"><?= $_SESSION['admin']['date_of_birth'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col-4">
                                                <p class="account__info">Số điệm thoại</p>
                                            </div>
                                            <div class="col-8">
                                                <p class="account__info"><?= $_SESSION['admin']['phonenumber'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col-4">
                                                <p class="account__info">Email</p>
                                            </div>
                                            <div class="col-8">
                                                <p class="account__info"><?= $_SESSION['admin']['email'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col-4">
                                                <p class="account__info">Địa chỉ</p>
                                            </div>
                                            <div class="col-8">
                                                <p class="account__info"><?= $_SESSION['admin']['address'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                require_once './sidebar-admin.php';
                ?>
            </div>
    <div class="profile-container">                                    
        <div class="row gy-md-3">
            <div class="col-9 col-xl-8 col-lg-7 col-md-12">
                <div class="cart-info">
                    <div class="row gy-3">
                        <!-- Admin Info -->
                        <div class="col-12">
                                <div class="account__heading">
                                    <h2 class="cart-info__heading">Bảng thông tin admin</h2>
                                    <form method = "post">
                                        <label>Admin Name: </label><input type="text" name="admin_name" id = "admin_name" placeholder="Admin Name">
                                        <label>Email: </label><input type="email" name="email" id="email" placeholder="Email">
                                        <label>Address: </label><input type="text" name="address" id="address" placeholder="Address">
                                        <input type="submit" name = "search-admin" value="Search"/>
                                        <a style = "padding-left: 200px;" href ='add-admin.php'>Add</a>
                                    </form>      
                                </div>
                                <?php
                                require_once './model/connect.php';
                                $conn = connectdb();
                                if(isset($_POST["search-admin"])){
                                    $admin_name = $_POST['admin_name'];
                                    $email = $_POST['email'];
                                    $address = $_POST['address'];
                                    echo '<form method="post">';
                                    mysqli_set_charset($conn, 'UTF8');
                                    $sql = "SELECT * FROM `admin` WHERE admin_name = '$admin_name'";
                                    $result = $conn->query($sql);
                                ?>  
                                    <div>
                                        <table>
                                            <tr>
                                                <th>Select</th>
                                                <th>admin_id</th>
                                                <th>admin_name</th>
                                                <th>date_of_birth</th>
                                                <th>phonenumber</th>
                                                <th>email</th>
                                                <th>address</th>
                                                <th>user_name</th>
                                                <th>password</th>
                                                <th>role_id</th>
                                                <th>Update | Delete </th>
                                            </tr>
                                            <tr>
                                                <?php
                                                    while($row = $result->fetch_assoc()){
                                                ?>        
                                                <td><input type = "checkbox" name='checkbox[]' value='<?= $row["admin_id"] ?>'></td>
                                                <td><?= $row["admin_id"] ?></td>
                                                <td><?= $row["admin_name"] ?></td>
                                                <td><?= $row["date_of_birth"] ?></td> 
                                                <td><?= $row["phonenumber"] ?></td>
                                                <td><?= $row["email"]?></td>
                                                <td><?=$row["address"]?></td>
                                                <td><?=$row["user_name"]?></td>
                                                <td><?=$row["password"]?></td>
                                                <td><?=$row["role_id"]?></td>
                                                <td><a href ='update-admin.php'>Update</a>| <input type ='submit' name='delete' value ='Delete'/></td>
                                            </tr>
                                            <?php  
                                            }  
                                            echo '</form>';
                                        }    
                                            ?>         
                                        </table>
                                        <?php
                                                if (isset($_POST['delete'])) {
                                                if (isset($_POST['checkbox'])) {
                                                $chkarr = $_POST['checkbox'];
                                                foreach ($chkarr as $admin_id) {
                                                $sql = "DELETE FROM `admin` WHERE admin_id ='$admin_id'";
                                                $result = $conn->query($sql);
                                                        }
                                                    }
                                                }?>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>        
    <div class="profile-container">                                    
        <div class="row gy-md-3">
            <div class="col-9 col-xl-8 col-lg-7 col-md-12">
                <div class="cart-info">
                    <div class="row gy-3">
                        
                        <!-- Role Info -->
                        <div class="col-12">
                            <div class="account__heading">
                                        <h2 class="cart-info__heading">Bảng role</h2>
                                        <form method = "post">
                                        <label>Role Name: </label><input type="text" name="role_name" id = "role_name" placeholder="Role Name">
                                        <input type="submit" name = "search-role" value="search"/>
                                        <a style = "padding-left: 200px;" href ='add-role.php'>Add</a>
                                    </form>      
                                </div>
                                <?php
                                require_once './model/connect.php';
                                $conn = connectdb();
                                if(isset($_POST["search-role"])){
                                    $role_name = $_POST['role_name'];
                                    echo '<form method="post">';
                                    mysqli_set_charset($conn, 'UTF8');
                                    $sql = "SELECT * FROM `role` WHERE role_name = '$role_name'";
                                    $result = $conn->query($sql);
                                ?>  
                                    <div>
                                        <table>
                                            <tr>
                                                <th>Select</th>
                                                <th>role_id</th>
                                                <th>role_name</th>
                                                <th>Add | Update | Delete </th>
                                            </tr>
                                            <tr>
                                                <?php
                                                    while($row = $result->fetch_assoc()){
                                                ?>        
                                                <td><input type = "checkbox" name='checkbox-role[]' value='<?= $row["role_id"] ?>'></td>
                                                <td><?= $row["role_id"] ?></td>
                                                <td><?= $row["role_name"] ?></td>
                                                <td><a href ='update-role.php'>Update</a>| <input type ='submit' name='delete-role' value ='Delete'/></td>
                                            </tr>
                                            <?php  
                                            }  
                                            echo '</form>';
                                        }    
                                
                                    ?>       
                                            </table>
                                            <?php
                                                if (isset($_POST['delete-role'])) {
                                                if (isset($_POST['checkbox-role'])) {
                                                $chkarr = $_POST['checkbox-role'];
                                                foreach ($chkarr as $role_id) {
                                                $sql = "DELETE FROM `role` WHERE role_id ='$role_id'";
                                                $result = $conn->query($sql);
                                                        }
                                                    }
                                                }?>  
                                        </div>
                                    </div>
                                </div>    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="profile-container">                                    
        <div class="row gy-md-3">
            <div class="col-9 col-xl-8 col-lg-7 col-md-12">
                <div class="cart-info">
                    <div class="row gy-3">
                        <!-- Academic Info -->
                        <div class="col-12">
                            <div class="account__heading">
                                        <h2 class="cart-info__heading">Bảng academic transcript</h2>
                                        <form method = "post">
                                            <label>Student: </label><select name="student_id">
                                                    <?php
                                                        
                                                        $sql = "SELECT student_id, student_name FROM `student`";
                                                        $result = $conn->query($sql);
                                                        while ($row = $result->fetch_assoc()) {
                                                            $student_id = $row['student_id']; 
                                                            $student_name = $row["student_name"];
                                                            echo "<option value='$student_id'>" . $student_id . ": " . $student_name . "</option>";
                                                        }
                                                            ?>
                                                        </select>
                                                        <input type="submit" style = "padding-left: 50px;" name = "search-academic-stranscript" value="Search"/>
                                                        <a style = "padding-left: 170px;" href ='add-academic-transcript.php'>Add</a>       
                                                        </form> 
                                </div>
                                <?php
                                require_once './model/connect.php';
                                $conn = connectdb();
                                if(isset($_POST["search-academic-stranscript"])){
                                    $student_id = $_POST['student_id'];
                                    echo '<form method="post">';
                                    mysqli_set_charset($conn, 'UTF8');
                                    $sql = "SELECT * FROM `academic_transcript` WHERE student_id = '$student_id'";
                                    $result = $conn->query($sql);
                                ?>  
                                    <div>
                                        <table>
                                            <tr>
                                                <th>Select</th>
                                                <th>transcript_id</th>
                                                <th>gpa</th>
                                                <th>student_id</th>
                                                <th>Delete</th>
                                            </tr>
                                            <tr>
                                                <?php
                                                    while($row = $result->fetch_assoc()){
                                                ?>        
                                                <td><input type = "checkbox" name='checkbox-academic[]' value='<?= $row["transcript_id"] ?>'></td>
                                                <td><?= $row["transcript_id"] ?></td>
                                                <td><?= $row["gpa"] ?></td>
                                                <td><?= $row["student_id"] ?></td>
                                                <td><input type ='submit' name='delete-academic' value ='Delete'/></td>
                                            </tr>
                                            <?php  
                                            }  
                                            echo '</form>';
                                        }    
                                
                                    ?>         
                                            </table>
                                            <?php
                                    if (isset($_POST['delete-academic'])) {
                                    if (isset($_POST['checkbox-academic'])) {
                                    $chkarr = $_POST['checkbox-academic'];
                                    foreach ($chkarr as $transcript_id) {
                                    $sql = "DELETE FROM `academic_transcript` WHERE transcript_id ='$transcript_id'";
                                    $result = $conn->query($sql);
                                            }
                                        }
                                    }?>
                                        </div>
                                    </div>
                                </div>    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- Footer -->
<?php require_once './templates/footer.php' ?>
