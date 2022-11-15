<?php
$con=mysqli_connect("127.0.0.1","root","newpasswd","speedtest"); //连接数据库，且定位到数据库web1
if(!$con){die("error:".mysqli_connect_error());} //如果连接失败就报错并且中断程序
$user=$_POST['user'];
// $pass=$_POST['pass'];
if($user==null){
    echo "<script>alert('你不是员工吧！')</script>";
    die("请输入手机号码!");
}
function check_param($value=null) {  //过滤注入所用的字符，防止sql注入    
    $str = 'select|insert|and|or|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile';    
    if(preg_match($str,$value)){        
        exit('参数非法！');    
    }    
    return true;
}
if(check_param($user)==true&&check_param($pass)==true){
    $sql='select * from aurth_user where user='."'{$user}';";
    $res=mysqli_query($con,$sql);
    $row=$res->num_rows; //将获取到的用户名和密码拿到数据库里面去查找匹配
    if($row!=0)
    {
        header('location:speedtest.html?'."{$user}");
    }
    else
    {
        echo "无权限登录";
        header('location:index.html');
    }
}
?>