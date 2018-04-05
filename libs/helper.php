<?php 
function base_url($uri='') {
	return 'http://localhost:8080/monan/admin/'.$uri;
}
//hàm chuyển hướng
function redirect($url) {
	header("Location:{$url}");
	exit();
}
//hàm post
function input_post($key) {
	return isset($_POST[$key]) ? trim($_POST[$key]) : false;
}
//hàm get
function input_get($key) {
	return isset($_GET[$key]) ? trim($_GET[$key]) : false;
}
//kiểm tra submit
function is_submit($key) {
	return (isset($_POST['request_name']) && $_POST['request_name'] == $key);
}
//báo lỗi
function show_error($error,$key) {
	echo '<span style="color:red">'.(empty($error[$key]) ? "" : $error[$key]). '</span>';
}
//tạo link
function create_link($uri,$filter= array()) {
	$string='';
	foreach($filter as $key => $val) {
		if($val !='') {
			$string .= "&{$key}={$val}";
		}
	}
	return $uri .($string ? '?'.ltrim($string,'&') :'');
}
//$create_link =create_link(base_url('admin'),array('m'=>'common','a' => 'action'));
//echo $create_link;
//hàm phân trang 
function paging($link,$total_records,$current_page,$limit) {
	//echo 4;
	//tính tổng số trang
	//echo 5;
	//$total_records =30;
	//$limit = 5;
	//$total_page = ($total_records+$limit);
	$total_page = ceil($total_records / $limit);
	//giới hạn current_page đến 1 khoảng total_page

	//var_dump($total_page);
	if($current_page > $total_page) {
		$current_page = $total_page;
	}
	else if ($current_page <1) {
		$current_page = 1;
	}
	//echo $current_page;
	//var_dump($current_page);
	// nếu trang hiện hành lớn hơn tổng số trang thì trang hiện hành bằng tổng số trang
	// nếu trang hiện hành nhỏ hơn 1 thì trang hiện hành =1;

	//tìm start
	$start =($current_page - 1)* $limit;
	$html ='';
	//nếu trang hiện hành > 1 và tổng số trang > 1 mới hiện nút prev
	if ($current_page > 1 && $total_page > 1 ) {
		$html .= '<a href="'.str_replace('{page}',$current_page-1,$link).'">Prev</a>';
	}
	//var_dump($html);
	//lặp ở giữa
	for($i=1; $i<= $total_page; $i++) {
//nếu là trang hiện tại thì hiện thẻ span ngược lại hiện thẻ a
		if($i == $current_page) {
			$html .= '<span>' .$i.'</span>';
		}
		else {
			$html .='<a href="'.str_replace('{page}', $i, $link).'">'.$i. '</a>';
		}
	}
	//var_dump($i);
	// nếu current_page > total_page và current_page > 1 thì mới hiện nút next
	if ($current_page < $total_page && $total_page > 1){
        $html .= '<a href="'.str_replace('{page}', $current_page+1, $link).'">Next</a>';
    }
    // Trả kết quả
    return array(
    	'start'=>$start,
    	'limit' => $limit,
    	'html' => $html
    );
	//var_dump($array);
}

//paging($link,$total_records,$current_page,$limit));
//$paging = paging(base_url('admin'),55,2,10);
//var_dump($paging);
?>