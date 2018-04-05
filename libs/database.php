<?php
$conn = null;
 
function db_connect(){
    
    global $conn;
    if (!$conn){
        $conn = mysqli_connect('localhost', 'root', '', 'bai1') or die ('Không thể kết nối CSDL');
        mysqli_set_charset($conn, 'UTF-8');
    }
}
function db_close(){
    global $conn;
    if ($conn){
        mysqli_close($conn);
    }
}
 
function db_get_list($sql){
    db_connect();
    global $conn;
    $data  = array();
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)){
        $data[] = $row;
    }
    return $data;
}

function db_get_row($sql){
  // var_dump($sql);
    db_connect();

    global $conn;
    //var_dump($conn);
    $result = mysqli_query($conn, $sql);
    $row = array();
    if (mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
    }    
    return $row;

} 
function db_execute($sql){
    db_connect();
    global $conn;
    return mysqli_query($conn, $sql);
}
//var_dump(db_get_list('SELECT * FROM tb_user'));
//hàm tạo câu truy vấn có điều kiện where
function db_create_sql($sql,$filter=array()) {
//chuỗi 
    $where= '';
    //lặp biến $filter và bổ sung vào $where
    foreach($filter as $field => $value) {
        if($value != '') {
            $value = addslashes($value);
            $where .= "AND $field='$value',";
        }
    }
    //remove chữ and ở đầu
    $where = trim($where,'AND');
    //remove ký tự ở cuối
    $where = trim($where,',');
    //nếu có điều kiện where thì xóa chuỗi
    if($where) {
        $where ='WHERE'.$where;
    }
    //return câu truy vấn
    return str_replace('{where}',$where,$sql);
}

function db_insert($table, $data = array())
{
    // Hai biến danh sách fields và values
    $fields = '';
    $values = '';
     
    // Lặp mảng dữ liệu để nối chuỗi
    foreach ($data as $field => $value){
        $fields .= $field .',';
        $values .= "'".addslashes($value)."',";
    }
     
    // Xóa ký từ , ở cuối chuỗi
    $fields = trim($fields, ',');
    $values = trim($values, ',');
     
    // Tạo câu SQL
    $sql = "INSERT INTO {$table}($fields) VALUES ({$values})";
     
    // Thực hiện INSERT
    return db_execute($sql);
}