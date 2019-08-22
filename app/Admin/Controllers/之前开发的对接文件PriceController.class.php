<?php
//首页显示
namespace Home\Controller;
use Think\Controller;
class PriceController extends CommonController {
	function _initialize() {
		parent::_initialize();
		$ip = get_client_ip();
		//验证地址是否来源正确
		//echo $ip;
		if( $ip !='127.0.0.1'){
			echo 'error';die();
		}
	}
	function index(){
		$html = '<ul>';
		$html .= '<li><a href="/Price/saveprice" target"_blank">vipmro</a></li>';
		$html .= '<li><a href="/Price/saveprice2" target"_blank">天宏</a></li>';
		$html .= '<li><a href="/Price/saveprice3" target"_blank">轴承巴士</a></li>';
		$html .= '<li><a href="/Price/saveprice3" target"_blank">http://www.vipmro.com</a></li>';
		$html .= '</ul>';
		echo '获取价格';	
	}
	 function curl_https($url, $data=null, $header=null, $timeout=30){

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 跳过证书检查
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, true);  // 从证书中检查SSL加密算法是否存在
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);

    $response = curl_exec($ch);

    if($error=curl_error($ch)){
        die($error);
    }

    curl_close($ch);

    return $response;

}  
	public function CURLRequest($url,$data=null,$cookie=null){
       $curl = curl_init(); // 启动一个CURL会话
       curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址
       curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 对认证证书来源的检查
       curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); // 从证书中检查SSL加密算法是否存在
       curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
	   curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie); //设置Cookie信息保存在指定的文件中  
       if($data != null){
           curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求
           curl_setopt($curl, CURLOPT_POSTFIELDS, $data); // Post提交的数据包
       }
       curl_setopt($curl, CURLOPT_TIMEOUT, 300); // 设置超时限制防止死循环
       curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
       curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回
       $info = curl_exec($curl); // 执行操作
       if (curl_errno($curl)) {
           echo 'Errno:'.curl_getinfo($curl);//捕抓异常
           dump(curl_getinfo($curl));
       }
       return $info;
   }
   
	function randFloat($min=0, $max=1){
		return $min + mt_rand()/mt_getrandmax() * ($max-$min);
	}
	
	function decodeUnicode($str){
		return preg_replace_callback('/\\\\u([0-9a-f]{4})/i',
			create_function(
				'$matches',
				'return mb_convert_encoding(pack("H*", $matches[1]), "UTF-8", "UCS-2BE");'
			),
			$str);
	}
	
	function unicode2utf8($str){ 
		if(!$str) {
			return $str; 
		}
		$decode = json_decode($str); 
		if($decode) {
			return $decode; 
		}
		$str = '["' . $str . '"]'; 
		$decode = json_decode($str); 
		if(count($decode) == 1){ 
			return $decode[0]; 
		} 
		return $str; 
	}
	
	function unicode_decode($name){
	  $json = '{"str":"'.$name.'"}';
	  $arr = json_decode($json,true);
	  if(empty($arr)) return '';
	  return $arr['str'];
	
	}
	
	function  decode($str=''){
		//$str='UpMUg5Mnzi/HS+vu7zyf+JCd8U6vIxeZEfsveyJmIeZf+TZiYWeiW9kMgS6hVx4xHW9Qdk2+HlyEI5UJRMNKyN3GoaTew7b2wS8Jo6Iiu6ikZrZDRxCgEQ==';
		//echo $str.'</br>';
		$data = array();
		$data['callCount']='1';
		$data['nextReverseAjaxIndex']='0';
		$data['c0-scriptName']='JEncrypt';
		$data['c0-methodName']='decoder';
		$data['c0-id']='0';
		$data['c0-param0']='string:'. urlencode($str);
		$data['batchId']='38';
		$data['instanceId']='0';
		$data['page']='%2FfacePrice';
		$data['scriptSessionId']='nBlyQSoPadrj3SNZt3kkK7DD3~dUvZh8yIl/zHh8yIl-c9drzzuoi';
		$serverUrl1 ='http://www.vipmro.net/dwr/call/plaincall/JEncrypt.decoder.dwr';
		$xmlString = $this->CURLRequest($serverUrl1,$data);
		//print_r($xmlString);
		preg_match('/handleCallback\((.*)\)/', $xmlString,$stringArray);
		//print_r($stringArray);
		$newArray = explode(',',str_replace('"','',$stringArray[1]));	
		//print_r($newArray);
		//echo $newArray[2].'</br>';
		$str = $this->unicode_decode($newArray[2]);
		//echo $str;
		//pt($xmlString);
		return $str;
	}
	/*模拟登录*/	
	function login_post($url, $cookie, $post) {   
		$curl = curl_init();//初始化curl模块   
		curl_setopt($curl, CURLOPT_URL, $url);//登录提交的地址   
		curl_setopt($curl, CURLOPT_HEADER, 0);//是否显示头信息   
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 0);//是否自动显示返回的信息   
		curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie); //设置Cookie信息保存在指定的文件中   
		curl_setopt($curl, CURLOPT_POST, 1);//post方式提交   
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post));//要提交的信息  
		curl_exec($curl);//执行cURL   
		curl_close($curl);//关闭cURL资源，并且释放系统资源   
	} 
	function get_content($url, $cookie) {   
		$ch = curl_init();   
		curl_setopt($ch, CURLOPT_URL, $url);   
		curl_setopt($ch, CURLOPT_HEADER, 0);   
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);   
		curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie); //读取cookie   
		$rs = curl_exec($ch); //执行cURL抓取页面内容   
		curl_close($ch);   
		return $rs;   
	}   
	
	static $startTime;	
	function autoLogin(){
		$post = array (   
		'User' => 'guzhijian',   
		'Password' => 'andy791027',  
		'Vcode'=> '', 
		'ismarkPwd' =>"T"
	);   
	//登录地址   
	$url = 'http://123.206.194.46/Buyweb/PC/Auth/Login';   
	//设置cookie保存路径   
	$cookie = dirname(__FILE__) . '/cookie_oschina.txt';   
	//登录后要获取信息的地址   
	//$url2 = 'http://123.206.194.46/Buyweb/PC/Prdt/Pro_details?_prd_no='.$id;
	//模拟登录
	//print_r cookie('cookie_oschina');
	//die();  
	//if(self::$startTime<time()-60*20){ 
	//	self::$startTime = time();
		$this->login_post($url, $cookie, $post);  
	//}
	return $cookie;
	}
	
	

function priceMb($id=0){
		//$pwd	=	I('get.pwd');
		//验证地址是否来源正确
	//	if( $pwd != 'gj515pwd' ){
//			urlSkip('','/');
//		}
//post数据
$post = array (   
    'pageNumber' => $id,   
    'pageSize' => '30',  
	'sortColumns'=> 'undefined'

);   
//pt($post);   
$url2 = 'http://zc.mrobay.com/getMenberAuthPage.do?MbType=sell';

//获取登录页的信息   
		$html = $this-> CURLRequest($url2, $post);  
		$html=preg_replace("/[\t\n\r]+/","",$html);  
		//print_r($html);
		$partern='/\<table width="100%"  cellspacing="0" cellpadding="0" border="0" class="Sctable" style="background-color: #fff;"\>(.*)\<div class="gd_pagination" \>/is';
	
		preg_match($partern, $html,$data1);
		$xmlString = preg_replace("/[\t\n\r]+/","",$data1[1]);  
		$data = array();
		$newData = array();
		preg_match_all('/<td.*?>\s*(.*?)\s*<\/td>.*?/is', $xmlString,$data);
	
		if($data[1]){
			$totalData = array();
			for($i=0;$i<30;$i++)
			{
			  $totalData[] = array_slice($data[1], $i * 7 ,7);
			}
			
			
			return $totalData;
		}
	}
function saveBay(){
		//$testurl='http://123.206.194.46/Buyweb/PC/Prdt/Pro_details?_prd_no=00000000000000030000';
		set_time_limit(0);   
 		ob_end_clean();
		$startID =1;//起始ID;
		$endID=25;//结束ID;
		echo str_pad('',1024);
		$mrobay = D('mrobay');
		$where = ' 1=1';
		if($startID){
			$where .=' AND id>='.$startID;
		}
		if($endID){
			$where .=' AND id<='.$endID;
		}
		$upNum=0;
		$addNum=0;
		//$this->autoLogin();
		//self::$startTime = time();
		for($i=$startID;$i<=$endID;$i++){
			$data = array();
			//$id = sprintf("%020d", $i);
			echo '开始：PAGEID：'.$id.' '.date('Y-m-d H:i:s',time()).'</br>';
			//echo $id;
			$data = $this->priceMb($i);
			//die();
			foreach($data as $k => $v){
				$newData = array();
				//foreach($v as $k1=>$v1){
					
					$newData['title'] = $v[1];	
					$newData['brand'] = $v[2];	
					$newData['city'] = $v[3];	
					$newData['classname'] = $v[4];	
					$newData['rz'] = $v[5];	
					$newData['rztime'] = $v[6];	
				//}
			
			if($newData['title']!=""){
	
			$current = $mrobay->where('title="'.$newData['title'].'"')->find();
			if($current){
					$result = $mrobay->where('id='.$current['id'])->save($newData);
					if($result !== false){
							echo '更新： ID:'.$current['id'].'成功</br>';
							$upNum++;
					}else{
							echo '更新：ID:'.$current['id'].'失败</br>';
					}
				}else{
					$result = $mrobay->add($newData);
					if($result !== false){
						echo '新增：   ID:'.$result.'成功</br>';
						$addNum++;
					}else{
						echo '新增：   ID:'.$result.'失败</br>';
					}			
				}
			}	
			}
			echo '结束：   PAGEID：'.$startID.' '.date('Y-m-d H:i:s',time()).'</br>';
			$rand = rand(3,5);
			echo '中断：'.$rand.'S</br>';
			echo '共 '.$total.' 条数据，本次采集更新 '.$upNum.' 条，新增 '.$addNum.' 条，共处理 '.($upNum+$addNum).' 条</br></br>';
			flush(); 
			sleep($rand);
		}		
			
	}	
function priceTHMRO($id){
		//$pwd	=	I('get.pwd');
		//验证地址是否来源正确
	//	if( $pwd != 'gj515pwd' ){
//			urlSkip('','/');
//		}
//post数据
//$post = array (   
//    'User' => 'guzhijian',   
//    'Password' => 'andy791027',  
//	'Vcode'=> '', 
//	'ismarkPwd' =>"T"
//);   
//登录地址   
//$url = 'http://123.206.194.46/Buyweb/PC/Auth/Login';   
//设置cookie保存路径   
$cookie = dirname(__FILE__) . '/cookie_oschina.txt';   
//登录后要获取信息的地址   
$url2 = 'http://123.206.194.46/Buyweb/PC/Prdt/Pro_details?_prd_no='.$id;
//模拟登录
//print_r cookie('cookie_oschina');
//die();  
if(self::$startTime<time()-60*20){ 
	self::$startTime = time();
	$this->autoLogin();
}
//获取登录页的信息   
$html = $this-> get_content($url2, $cookie);  
		//$serverUrl ='http://123.206.194.46/Buyweb/PC/Prdt/Pro_details?_prd_no='.$id;
		//$html = $this->CURLRequest($serverUrl,$data='',$rdata);
		//echo $xmlString;
		$html=preg_replace("/[\t\n\r]+/","",$html);  
		$partern='/\<div class="col-lg-5 col-md-5"\>(.*)\<\/div\>(.*)\<div class="btnBox"\>/is';
		//$partern='/<div class="goods"><a href="([^<>]+)" target="_blank"><img data-ks-lazyload="([^<>]+)" alt="([^<>]+)" width="" height=""\/><\/a><\/div>/';  
		//preg_match('/\<div class="col-lg-5 col-md-5"\>(.*)\<\/div>/is', $html,$matches);
		//$data1 = $matches[0];
		preg_match($partern, $html,$data1);
		//preg_replace("/[\t\n\r]+/","",$html);  
		$xmlString = preg_replace("/[\t\n\r]+/","",$data1[0]);  
		//preg_match('/\<ul class="details"\>(.*)\<\/ul>/is', $data1[0],$data2);
		//preg_match('/\库存:(.*))\<\/ul\>/', $xmlString,$data2);
		
		//print_r($data2);
		//print_r($data2);
		//print_r($xmlString);
		$data = array();
		$newData = array();
		preg_match_all('/\<li\><i\>.*\<\/i\>(.*)\<\/li\>/isU', $xmlString,$title);
		
		//preg_match_all('/\<i\>(.*)\<\/i\>(.*)/isU', $title[1],$title2);
		//foreach($title[1] as $k=>$v){
//			$newData[$k] =preg_match_all('/\<i\>.*\<\/i\>(.*)/isU', $v,$newData);
//		};
		preg_match_all('/\<span class="kuCun"(.*)\>(.*)\<\/span\>/isU', $xmlString,$title1);
		preg_match_all('/\<span .*\>(.*)\<\/span\>/isU', $xmlString,$title2);
		//print_r($title);
		//print_r($title2);
		//print_r($title1);
		//$data['title'] = $title;
		//print_r($data);
		//die();
		//$vipPrice = json_decode($xmlString,true);
		$goods = $title[1];
		$goods1 = $title2[1];
		//print_r($vipPrice);
		//$goodsList = array();
		//$goodsList = $vipPrice['data']['goodsList'][0];
		if($goods){
			$newArray = array();
			$newArray['proid'] = $id;
			$newArray['title'] = $goods[0];
			$newArray['agent'] = $goods[1];
			$newArray['classname'] = $goods[2];
			$newArray['brand'] = $goods[3];
			$newArray['bzxh'] = $goods[4];
			$newArray['weight'] = $goods[5];
			$newArray['price'] = $goods1[0];
			$newArray['oprice'] = $goods1[1];
			$newArray['num'] = $goods1[2];
			$newArray['addtime'] = time();
			return $newArray;
			
		}

	
	}	

function busPrice(){
		$hour = date('H',time());
		if($hour>=21 && $hour<=8){
			echo '8:00-21:00数据不更新';
			$this->display();
			die();
		}
		$startTime = time();
		set_time_limit(0);   
 		ob_end_clean();
		$upNum=0;
		$addNum=0;
		$serverUrl1 ='http://www.bearingbus.com/api_united.php';
		$data = array();
		$data['action'] = 'getAll';
		$data['code'] = 'gpmro1985';
		//$xmlString='';
		$xmlString = $this->CURLRequest($serverUrl1,$data);
		//$xmlString = preg_replace('/\s/', '', $xmlString);
		//$xmlString = '';
		$xmlString = trim($xmlString,chr(239).chr(187).chr(191));
		//$xmlString =iconv('GBK','utf-8//IGNORE',$xmlString);
		//print_r($xmlString);
		$busData = array();
		$busData =  json_decode($xmlString,TRUE);
		
		//print_r($busPrice);
		//die();
		$data = $busData['data'];
		//pt($data);
		//die();
		$busPrice = D('busprice');
		//清空busprie表
		M()->query('update yt_busprice set ishidden=1');
		$total = count($data);
		foreach($data as $k=>$v){
			$newData = array();
			$newData['goods_id']=$v['goods_id'];
			echo '开始：goods_id：'.$v['goods_id'].' '.date('Y-m-d H:i:s',time()).'</br>';
			$newData['brand']=$v['brand'];
			$newData['goods_name']=$v['goods_name'];
			$newData['price']=$v['price'];
			$newData['stock']=$v['stock'];
			$newData['wcode']=trim($v['wcode']);
			$newData['addtime']=time();
			$current = $busPrice->where('brand="'.trim($v['brand']).'" AND goods_name="'.trim($v['goods_name']).'" ')->find();
			echo M()->getLastSql();
			echo '</br>';
			if($current){
				$newData['ishidden']=0;
				$result =$busPrice->where('brand="'.trim($v['brand']).'" AND goods_name="'.trim($v['goods_name']).'"')->save($newData);
				$str = '更新';
			}else{
				$result = $busPrice->add($newData);
				$str = '新增';		
			}
			if($result !== false){
				echo $str.'： goods_id:'.$v['goods_id'].'成功</br>';
				$upNum++;
			}else{
				$addNum++;
				echo $str.'： goods_id:'.$v['goods_id'].'失败</br>';
			}
			echo '结束：goods_id：'.$v['goods_id'].' '.date('Y-m-d H:i:s',time()).'</br>';
			$rand = rand(200,500);
			echo '中断：'.$rand.'ms</br>';
			echo '共 '.$total.' 条数据，本次采集更新 '.$upNum.' 条，新增 '.$addNum.' 条，共处理 '.($upNum+$addNum).' 条</br></br>';
			flush(); 
			usleep($rand);
		}
		$endTime = time();
		echo '共用时'.Sec2Time($endTime-$startTime);
		//pt($busPrice);
		//die();
		$this->display();
		
}
//
function updatePriceNew(){
		$startTime = time();
		set_time_limit(0);   
 		ob_end_clean();
		$upNum=0;
		$addNum=0;
		$unup=0;
		$mallTicket = D('mallTicket');
		$busPrice = D('new_pro');
		$busData = $busPrice->where('')->select();
		
		$total = count($busData);
		foreach($busData as $k=>$v){
			$current = $mallTicket->where('ishidden=0 AND xh="'.$v['noid'].'" AND brand_id='.$v['brand_id'].' and huodongtype=0')->find();
			if($current){
				echo '开始：mall_id：'.$current['id'].' '.date('Y-m-d H:i:s',time()).'</br>';
				$newData = array();
				//$newData['id']=$current['id'];
				$newData['price']=$v['price'];
				$rand = rand(10,10);
				$upPrice = $v['price']*(100+$rand)/100;
				$newData['oprice']=$v['oprice'];
				$newData['oprice1']=$v['oprice'];
				$newData['num']=$v['num'];
				//$result =$mallTicket->where('id='.$current['id'])->save($newData);
				$str = '更新';
				
				if($result !== false){
					echo $str.'：mall_id:'.$current['id'].'成功</br>';
					$upNum++;
				}else{
					$addNum++;
					echo $str.'：mall_id:'.$current['id'].'失败</br>';
				}
			}else{
				//标记产品为上架
				$busPrice->where('id='.$v['id'])->setField('status','1');
				$unup++;
				echo '标记：ID：'.$v['id'].' '.date('Y-m-d H:i:s',time()).' ， 未上架</br>';
			}
			
			echo '结束：ID：'.$v['id'].' '.date('Y-m-d H:i:s',time()).'</br>';
			$rand = rand(200,500);
			echo '中断：'.$rand.'ms</br>';
			echo '共 '.$total.' 条数据，本次采集更新 '.$upNum.' 条，新增 '.$addNum.' 条，标记未上架 '.$unup.' 条，共处理 '.($upNum+$addNum).' 条</br></br>';
			flush(); 
			usleep($rand);
		}
		$endTime = time();
		echo '共用时'.Sec2Time($endTime-$startTime);
		//pt($busPrice);
		die();
		
}
//
function updateBusPrice(){
		$hour = date('H',time());
		if($hour>=21 && $hour<=8){
			echo '8:00-21:00数据不更新';
			$this->display();
			die();
		}
		
		$startTime = time();
		set_time_limit(0);   
 		ob_end_clean();
		$upNum=0;
		$addNum=0;
		$unup=0;
		$ticketArray=array();
		$mallTicket = D('mallTicket');
		$busPrice = D('busprice');
		$busData = $busPrice->where('(brand="NTN" OR brand="FAG") AND price>0 AND ishidden=0 ')->select();
		$stock = D('stockNum');
		$total = count($busData);
		foreach($busData as $k=>$v){
			$current = $mallTicket->where('ishidden=0 AND huodongtype=0 AND  (xh="'.trim($v['goods_name']).'" OR xh="'.str_replace("_"," ",trim($v['goods_name'])).'") ')->find();
			echo M()->getLastSql();
			echo '</br>';
			if($current ){
				if(trim($v['wcode'])=="CPD"){
					$stock_id=9;
				}else{
					$stock_id=2;
				}
				array_push($ticketArray,$current['id']);
				echo '开始：id：'.$v['id'].' '.date('Y-m-d H:i:s',time()).'</br>';
				echo '开始：mall_id：'.$current['id'].' '.date('Y-m-d H:i:s',time()).'</br>';
				$newData = array();
				//$newData['id']=$current['id'];
				//if($hour==8){
					$rand1 = rand(45,65);
					$newData['price']=$v['price']*(1000+$rand1)/1000;
					$rand = rand(15,20);
				
					$upPrice = $v['price']*(100+$rand)/100;
					$newData['oprice']=$upPrice;
					$newData['oprice1']=$upPrice;
					$newData['trueprice']=$upPrice;
				//}
				$newData['num']=$v['stock'];
				$newData['num_total']=$v['stock'];
				$result =$mallTicket->where('ishidden=0 AND id='.$current['id'])->save($newData);
				
				//$result1 =$stock->where('stock_id=2 AND ticket_id='.$current['id'])->save($newData);
				
				$currentStock = $stock->where('stock_id='.$stock_id.' AND ticket_id='.$current['id'])->find();
				echo M()->getLastSql();
				echo '</br>';
				if($currentStock){
					$result1 =$stock->where('stock_id='.$stock_id.'  AND ticket_id='.$current['id'])->save($newData);
					echo M()->getLastSql();
					echo '</br>';
				}else{
					$newData['ticket_id']=$current['id'];
					$newData['stock_id']=$stock_id;
					//$newData['skuid']=getMaxSKUID();
					$result1 =$stock->add($newData);
					echo M()->getLastSql();
					echo '</br>';
				}
				$str = '更新';
				
				if($result !== false){
					echo $str.'：mall_id:'.$current['id'].'成功</br>';
					if($v['status']==1){
						$busPrice->where('id='.$v['id'])->setField('status','0');
					}
					$upNum++;
				}else{
					$addNum++;
					echo $str.'：mall_id:'.$current['id'].'失败</br>';
				}
			}else{
				//标记产品为上架
				if($v['status']==0){
					$busPrice->where('id='.$v['id'])->setField('status','1');
				}
				$unup++;
				echo '标记：goods_id：'.$v['goods_id'].' '.date('Y-m-d H:i:s',time()).' ， 未上架</br>';
			}
			
			echo '结束：goods_id：'.$v['goods_id'].' '.date('Y-m-d H:i:s',time()).'</br>';
			echo '结束：id：'.$v['id'].' '.date('Y-m-d H:i:s',time()).'</br>';
			//$rand = rand(200,500);
			$rand = 150;
			echo '中断：'.$rand.'ms</br>';
			echo '共 '.$total.' 条数据，本次采集更新 '.$upNum.' 条，新增 '.$addNum.' 条，标记未上架 '.$unup.' 条，共处理 '.($upNum+$addNum).' 条</br></br>';
			flush(); 
			usleep($rand);
		}
		//统计平台id
		$total_id = $mallTicket->field('id')->where('ishidden=0 and huodongtype=0 AND brand_id IN (3,57)')->select();
		
		echo '平台ticket_id,共'.count($total_id).':</br>';
		$total_id = i_array_column($total_id, 'id');
		//print_r($total_id);
		echo '更新ticket_id,共'.count($ticketArray).':</br>';
		//print_r($ticketArray);
		$noTicket=array_diff($total_id,$ticketArray);
		echo '差异ticket_id:共'.count($noTicket).'</br>';
		//print_r($noTicket);
		$ticketStr = implode(",",$noTicket);
		echo $ticketStr.'</br>';

		
		M()->query('update yt_mall_ticket set num=0 where ishidden=0 AND brand_id IN (3,57) AND huodongtype=0 AND id IN('.$ticketStr.')');
		M()->query('update yt_stock_num set num=0 where  ticket_id IN (select a.id from (select id from yt_mall_ticket where ishidden=0 AND brand_id IN (3,57) AND huodongtype=0 AND id IN('.$ticketStr.')) a)');
		$endTime = time();
		echo '共用时'.Sec2Time($endTime-$startTime);
		//pt($busPrice);
		//die();
		$this->display();
		
}
//
function updateFyhPrice(){
		$startTime = time();
		set_time_limit(0);   
 		ob_end_clean();
		$upNum=0;
		$addNum=0;
		$unup=0;
		$mallTicket = D('mallTicket');
		$busPrice = D('fyh');
		$busData = $busPrice->where()->select();
		
		$total = count($busData);
		foreach($busData as $k=>$v){
			$current = $mallTicket->where('ishidden=0 AND  brand_id=17 AND  xh="'.$v['title'].'"')->find();
			if($current){
				echo '开始：mall_id：'.$current['id'].' '.date('Y-m-d H:i:s',time()).'</br>';
				$newData = array();
				//$newData['id']=$current['id'];
				$newData['price']=$v['price'];
				$rand = rand(5,10);
				//$upPrice = $v['price']*(100+$rand)/100;
				//$newData['oprice']=$upPrice;
				//$newData['oprice1']=$upPrice;
				$newData['oprice']=$v['oprice'];
				$newData['oprice1']=$v['oprice'];
				$newData['num']=intval($v['num']);
				$result =$mallTicket->where('ishidden=0 AND id='.$current['id'])->save($newData);
				$str = '更新';
				
				if($result !== false){
					echo $str.'：mall_id:'.$current['id'].'成功</br>';
					$upNum++;
				}else{
					$addNum++;
					echo $str.'：mall_id:'.$current['id'].'失败</br>';
				}
			}else{
				//标记产品为上架
				$busPrice->where('id='.$v['id'])->setField('status','1');
				$unup++;
				echo '标记：ID：'.$v['id'].' '.date('Y-m-d H:i:s',time()).' ， 未上架</br>';
			}
			
			echo '结束：ID：'.$v['id'].' '.date('Y-m-d H:i:s',time()).'</br>';
			$rand = rand(200,500);
			echo '中断：'.$rand.'ms</br>';
			echo '共 '.$total.' 条数据，本次采集更新 '.$upNum.' 条，新增 '.$addNum.' 条，标记未上架 '.$unup.' 条，共处理 '.($upNum+$addNum).' 条</br></br>';
			flush(); 
			usleep($rand);
		}
		$endTime = time();
		echo '共用时'.Sec2Time($endTime-$startTime);
		//pt($busPrice);
		die();
		
}
//
function updateFyhPrice2(){
		$startTime = time();
		set_time_limit(0);   
 		ob_end_clean();
		$upNum=0;
		$addNum=0;
		$unup=0;
		$mallTicket = D('mallTicket');
		$fyh = D('fyh');
		$newFyh = D('fyh_new');
		$busData = $newFyh->where()->select();
		
		$total = count($busData);
		foreach($busData as $k=>$v){
			$current = $fyh->where(' title="'.$v['title'].'"')->find();
			$currentMall = $mallTicket->where('ishidden=0 AND  brand_id=17 AND  xh="'.$v['title'].'"')->find();
			if($current){
				//标记产品为上架
				$newFyh->where('id='.$v['id'])->setField('status','0');
				if($currentMall){
					echo '开始：Mall_id：'.$currentMall['id'].' '.date('Y-m-d H:i:s',time()).'</br>';
					$newData = array();
					$newData['id']=$currentMall['id'];
					$newData['price']=$current['price'];
					$rand = rand(5,10);
					//$upPrice = $v['price']*(100+$rand)/100;
					//$newData['oprice']=$upPrice;
					//$newData['oprice1']=$upPrice;
					$newData['oprice']=$current['oprice'];
					$newData['oprice1']=$current['oprice'];
					$newData['num']=$v['num'];
					$result =$mallTicket->where('ishidden=0 AND id='.$currentMall['id'])->save($newData);
					$str = '更新';
					
					if($result !== false){
						echo $str.'：Mall_id:'.$currentMall['id'].'成功</br>';
						$upNum++;
					}else{
						$addNum++;
						echo $str.'：Mall_id:'.$currentMall['id'].'失败</br>';
					}
				}
			}else{
				//标记产品为上架
				$newFyh->where('id='.$v['id'])->setField('status','1');
				$unup++;
				echo '标记：ID：'.$v['id'].' '.date('Y-m-d H:i:s',time()).' ， 未上架</br>';
			}
			
			echo '结束：ID：'.$v['id'].' '.date('Y-m-d H:i:s',time()).'</br>';
			$rand = rand(200,500);
			echo '中断：'.$rand.'ms</br>';
			echo '共 '.$total.' 条数据，本次采集更新 '.$upNum.' 条，新增 '.$addNum.' 条，标记未上架 '.$unup.' 条，共处理 '.($upNum+$addNum).' 条</br></br>';
			flush(); 
			usleep($rand);
		}
		$endTime = time();
		echo '共用时'.Sec2Time($endTime-$startTime);
		//pt($busPrice);
		die();
		
}
//
function updateSndPriceBao(){
		$startTime = time();
		set_time_limit(0);   
 		ob_end_clean();
		$upNum=0;
		$addNum=0;
		$unup=0;
		$mallTicket = D('mallTicket');
		$snd = D('shinaide');
		$sndNew = D('shinaide_bao');
		$sndNewData = $sndNew->where()->select();
		
		$total = count($sndNewData);
		foreach($sndNewData as $k=>$v){
			echo '开始：ID：'.$v['id'].' '.date('Y-m-d H:i:s',time()).'</br>';
			$current = $snd->where(' noid="'.$v['noid'].'"')->find();
			$currentMall = $mallTicket->where('ishidden=0 AND huodongtype=0 AND brand_id=11 AND  noid="'.$v['noid'].'"')->find();
			if($current){
				//标记产品为上架
				if($v['status']==1){
					$sndNew->where('id='.$v['id'])->setField('status','0');
				}
				if($currentMall){
					echo '开始：Mall_id：'.$currentMall['id'].' '.date('Y-m-d H:i:s',time()).'</br>';
					$newData = array();
					$newData['id']=$currentMall['id'];
					$newData['price']=$current['price'];
					//$rand = rand(5,10);
					//$upPrice = $v['price']*(100+$rand)/100;
					//$newData['oprice']=$upPrice;
					//$newData['oprice1']=$upPrice;
					$newData['oprice']=$current['oprice'];
					$newData['oprice1']=$current['oprice'];
					$newData['num']=$v['num'];
					$result =$mallTicket->where('ishidden=0 AND id='.$currentMall['id'])->save($newData);
					$str = '更新';
					
					if($result !== false){
						echo $str.'：Mall_id:'.$currentMall['id'].'成功</br>';
						$upNum++;
					}else{
						$addNum++;
						echo $str.'：Mall_id:'.$currentMall['id'].'失败</br>';
					}
				}
			}else{
				if($v['status']==0){
					//标记产品为上架
					$sndNew->where('id='.$v['id'])->setField('status','1');
					$unup++;
					echo '标记：ID：'.$v['id'].' '.date('Y-m-d H:i:s',time()).' ， 未上架</br>';
				}
			}
			
			echo '结束：ID：'.$v['id'].' '.date('Y-m-d H:i:s',time()).'</br>';
			$rand = rand(200,500);
			echo '中断：'.$rand.'ms</br>';
			echo '共 '.$total.' 条数据，本次采集更新 '.$upNum.' 条，新增 '.$addNum.' 条，标记未上架 '.$unup.' 条，共处理 '.($upNum+$addNum).' 条</br></br>';
			flush(); 
			usleep($rand);
		}
		$endTime = time();
		echo '共用时'.Sec2Time($endTime-$startTime);
		//pt($busPrice);
		die();
		
}
//
function updateSndPriceNewStatus(){
		$startTime = time();
		set_time_limit(0);   
 		ob_end_clean();
		$upNum=0;
		$addNum=0;
		$unup=0;
		$mallTicket = D('mallTicket');
		$mallTicketContent = D('mallTicketContent');
		$snd = D('shinaide');
		$sndNew = D('shinaide_bao');
		$sndNewData = $sndNew->where()->select();
		
		$total = count($sndNewData);
		foreach($sndNewData as $k=>$v){
			echo '开始：ID：'.$v['id'].' '.date('Y-m-d H:i:s',time()).'</br>';
			$current = $snd->where(' noid="'.$v['noid'].'"')->find();
			$currentMall = $mallTicket->where('ishidden=0 AND huodongtype=0 AND brand_id=11 AND  noid="'.$v['noid'].'"')->find();
			
			if($current){
				//标记产品为上架
				if($v['status']==1){
					$sndNew->where('id='.$v['id'])->setField('status','0');
				}
				if($currentMall){
					$currentMallContent = $mallTicketContent->where('ticket_id="'.$currentMall['id'].'"')->find();
					$currentMallBao = $mallTicket->where('ishidden=0 AND huodongtype=97 AND brand_id=11 AND  noid="'.$v['noid'].'"')->find();
					
					//ticket
					$newData = array();
					$newData = $currentMall;
					unset($newData['id']);
					$newData['num'] =$v['num'];
					$newData['huodongtype'] ='97';
					//content
					$newContentData = array();
					$newContentData = $currentMallContent;
					unset($newContentData['id']);
					
					echo '开始：ID：'.$v['id'].' '.date('Y-m-d H:i:s',time()).'</br>';
					if($currentMallBao){
						$currentMallContentBao = $mallTicketContent->where('ticket_id="'.$currentMallBao['id'].'"')->find();
						$str = '更新 '.$currentMallBao['id'].' 基本信息';
						$result =$mallTicket->where('ishidden=0 AND huodongtype=97 AND brand_id=11 AND  noid="'.$v['noid'].'"')->save($newData);
						if($currentMallContentBao){
							$newContentData['ticket_id'] = $currentMallBao['id'];
							$str = '更新 '.$currentMallBao['id'].' 详情';
							$result1 =$mallTicketContent->where('ticket_id="'.$currentMallBao['id'].'"')->save($newContentData);
							
						}else{
							$newContentData['ticket_id'] = $currentMallBao['id'];
							$str = '新增 '.$currentMallBao['id'].' 详情';
							$result1 =$mallTicketContent->add($newContentData);
						}
						
						//$str = '更新 '.$currentMallBao['id'];
						$upNum++;
					}else{
						
						$result =$mallTicket->add($newData);
						$str = '新增	'.$result.'';
						$newContentData['ticket_id'] = $result;
						$result1 =$mallTicketContent->add($newContentData);
						$str = '新增	'.$result.'详情';
						$addNum++;
					}
	
					if($result !== false){
						echo $str.'：ID：'.$v['id'].'成功</br>';
						
					}else{
						
						echo $str.'：ID：'.$v['id'].'失败</br>';
					}
				}
			}else{
				if($v['status']==0){
					//标记产品为上架
					$sndNew->where('id='.$v['id'])->setField('status','1');
					$unup++;
					echo '标记：ID：'.$v['id'].' '.date('Y-m-d H:i:s',time()).' ， 未上架</br>';
				}
			}
			
			echo '结束：ID：'.$v['id'].' '.date('Y-m-d H:i:s',time()).'</br>';
			$rand = rand(200,500);
			echo '中断：'.$rand.'ms</br>';
			echo '共 '.$total.' 条数据，本次采集更新 '.$upNum.' 条，新增 '.$addNum.' 条，标记未上架 '.$unup.' 条，共处理 '.($upNum+$addNum).' 条</br></br>';
			flush(); 
			usleep($rand);
		}
		$endTime = time();
		echo '共用时'.Sec2Time($endTime-$startTime);
		//pt($busPrice);
		die();
		
}
function updateSndPriceNew(){
		$startTime = time();
		set_time_limit(0);   
 		ob_end_clean();
		$upNum=0;
		$addNum=0;
		$unup=0;
		$mallTicket = D('mallTicket');
		$snd = D('shinaide');
		$sndNew = D('shinaide_new');
		$sndNewData = $sndNew->where()->select();
		
		$total = count($sndNewData);
		foreach($sndNewData as $k=>$v){
			echo '开始：ID：'.$v['id'].' '.date('Y-m-d H:i:s',time()).'</br>';
			$current = $snd->where(' noid="'.$v['noid'].'"')->find();
			$currentMall = $mallTicket->where('ishidden=0 AND huodongtype=0 AND brand_id=11 AND  noid="'.$v['noid'].'"')->find();
			if($current){
				//标记产品为上架
				if($v['status']==1){
					$sndNew->where('id='.$v['id'])->setField('status','0');
				}
				if($currentMall){
					echo '开始：Mall_id：'.$currentMall['id'].' '.date('Y-m-d H:i:s',time()).'</br>';
					$newData = array();
					$newData['id']=$currentMall['id'];
					$newData['price']=$current['price'];
					//$rand = rand(5,10);
					//$upPrice = $v['price']*(100+$rand)/100;
					//$newData['oprice']=$upPrice;
					//$newData['oprice1']=$upPrice;
					$newData['oprice']=$current['oprice'];
					$newData['oprice1']=$current['oprice'];
					$newData['num']=$v['num'];
					$result =$mallTicket->where('id='.$currentMall['id'])->save($newData);
					$str = '更新';
					
					if($result !== false){
						echo $str.'：Mall_id:'.$currentMall['id'].'成功</br>';
						$upNum++;
					}else{
						$addNum++;
						echo $str.'：Mall_id:'.$currentMall['id'].'失败</br>';
					}
				}
			}else{
				if($v['status']==0){
					//标记产品为上架
					$sndNew->where('id='.$v['id'])->setField('status','1');
					$unup++;
					echo '标记：ID：'.$v['id'].' '.date('Y-m-d H:i:s',time()).' ， 未上架</br>';
				}
			}
			
			echo '结束：ID：'.$v['id'].' '.date('Y-m-d H:i:s',time()).'</br>';
			$rand = rand(200,500);
			echo '中断：'.$rand.'ms</br>';
			echo '共 '.$total.' 条数据，本次采集更新 '.$upNum.' 条，新增 '.$addNum.' 条，标记未上架 '.$unup.' 条，共处理 '.($upNum+$addNum).' 条</br></br>';
			flush(); 
			usleep($rand);
		}
		$endTime = time();
		echo '共用时'.Sec2Time($endTime-$startTime);
		//pt($busPrice);
		die();
		
}
//
function updateBaoKuanPrice(){
		$startTime = time();
		set_time_limit(0);   
 		ob_end_clean();
		$upNum=0;
		$addNum=0;
		$unup=0;
		$mallTicket = D('mallTicket');
		$bk = D('baokuan');
		
		$bkData = $bk->where('')->select();
		
		$total = count($bkData);
		foreach($bkData as $k=>$v){
			echo '开始：ID：'.$v['id'].' '.date('Y-m-d H:i:s',time()).'</br>';
			$current = $mallTicket->where(' ishidden=0 AND huodongtype=97 AND xh="'.$v['xh'].'" and brand_id='.$v['brand_id'])->find();
		
			if($current){
				if($v['status']==1){
				//标记产品为上架
					$bk->where('id='.$v['id'])->setField('status','0');
				}
				
				
				$newData = array();
				//$newData['id']=$v['id'];
				$newData['price']=$v['price'];
				$rand = rand(10,15);
				//$upPrice = $v['price']*(100+$rand)/100;
				//$newData['oprice']=$upPrice;
				//$newData['oprice1']=$upPrice;
				$newData['oprice']=$v['oprice'];
				$newData['oprice1']=$v['oprice'];
				$newData['num']=$v['num'];
				$result =$mallTicket->where('id='.$current['id'])->save($newData);
				$str = '更新';
				
				if($result !== false){
					echo $str.'：Mall_id:'.$current['id'].'成功</br>';
					$upNum++;
				}else{
					$addNum++;
					echo $str.'：Mall_id:'.$current['id'].'失败</br>';
				}
				
			}else{
				if($current['status']==0){
					//标记产品为上架
					$bk->where('id='.$v['id'])->setField('status','1');
					$unup++;
					echo '标记：ID：'.$v['id'].' '.date('Y-m-d H:i:s',time()).' ， 未上架</br>';
				}
			}
			
			echo '结束：ID：'.$v['id'].' '.date('Y-m-d H:i:s',time()).'</br>';
			$rand = rand(200,500);
			echo '中断：'.$rand.'ms</br>';
			echo '共 '.$total.' 条数据，本次采集更新 '.$upNum.' 条，新增 '.$addNum.' 条，标记未上架 '.$unup.' 条，共处理 '.($upNum+$addNum).' 条</br></br>';
			flush(); 
			usleep($rand);
		}
		$endTime = time();
		echo '共用时'.Sec2Time($endTime-$startTime);
		//pt($busPrice);
		die();
		
}
function updatePriceZhentai(){
		$startTime = time();
		set_time_limit(0);   
 		ob_end_clean();
		$upNum=0;
		$addNum=0;
		$unup=0;
		$mallTicket = D('mallTicket');
		$busPrice = D('zhentai');
		$busData = $busPrice->where()->select();
		
		$total = count($busData);
		foreach($busData as $k=>$v){
			$current = $mallTicket->where('ishidden=0 AND  brand_id=36 AND noid="'.$v['noid'].'"')->find();
			if($current){
				if($v['status']==1){
					$busPrice->where('id='.$v['id'])->setField('status','0');
				}
				echo '开始：mall_id：'.$current['id'].' '.date('Y-m-d H:i:s',time()).'</br>';
				$newData = array();
				//$newData['id']=$current['id'];
				//$newData['price']=$v['price'];
				//$rand = rand(5,10);
				//$upPrice = $v['price']*(100+$rand)/100;
				//$newData['oprice']=$upPrice;
				//$newData['oprice1']=$upPrice;
				$newData['trueprice']=$v['newprice'];
				$newData['oprice']=$v['oprice'];
				$newData['oprice1']=$v['newprice'];
				$result =$mallTicket->where('id='.$current['id'])->save($newData);
				$str = '更新';
				
				if($result !== false){
					echo $str.'：mall_id:'.$current['id'].'成功</br>';
					$upNum++;
				}else{
					$addNum++;
					echo $str.'：mall_id:'.$current['id'].'失败</br>';
				}
			}else{
				//标记产品为上架
				if($v['status']==0){
					$busPrice->where('id='.$v['id'])->setField('status','1');
					$unup++;
					echo '标记：ID：'.$v['id'].' '.date('Y-m-d H:i:s',time()).' ， 未上架</br>';
				}
				
			}
			
			echo '结束：ID：'.$v['id'].' '.date('Y-m-d H:i:s',time()).'</br>';
			$rand = rand(200,500);
			echo '中断：'.$rand.'ms</br>';
			echo '共 '.$total.' 条数据，本次采集更新 '.$upNum.' 条，新增 '.$addNum.' 条，标记未上架 '.$unup.' 条，共处理 '.($upNum+$addNum+$unup).' 条</br></br>';
			flush(); 
			usleep($rand);
		}
		$endTime = time();
		echo '共用时'.Sec2Time($endTime-$startTime);
		//pt($busPrice);
		die();
		
}
function updatePriceSND(){
		$startTime = time();
		set_time_limit(0);   
 		ob_end_clean();
		$upNum=0;
		$addNum=0;
		$unup=0;
		$mallTicket = D('mallTicket');
		$busPrice = D('shinaide');
		$busData = $busPrice->where()->select();
		
		$total = count($busData);
		foreach($busData as $k=>$v){
			$current = $mallTicket->where(' ishidden=0 AND noid="'.$v['noid'].'"')->find();
			if($current){
				if($v['status']==1){
					$busPrice->where('id='.$v['id'])->setField('status','0');
				}
				echo '开始：mall_id：'.$current['id'].' '.date('Y-m-d H:i:s',time()).'</br>';
				$newData = array();
				//$newData['id']=$current['id'];
				$newData['price']=$v['price'];
				$rand = rand(5,10);
				//$upPrice = $v['price']*(100+$rand)/100;
				//$newData['oprice']=$upPrice;
				//$newData['oprice1']=$upPrice;
				$newData['trueprice']=$v['trueprice'];
				$newData['oprice']=$v['oprice'];
				$newData['oprice1']=$v['trueprice'];
				$newData['price']=$v['price'];
				$newData['m_cut']=$v['m_cut'];
				$newData['n_cut']=$v['n_cut'];
				$result =$mallTicket->where('id='.$current['id'])->save($newData);
				$str = '更新';
				
				if($result !== false){
					echo $str.'：mall_id:'.$current['id'].'成功</br>';
					$upNum++;
				}else{
					$addNum++;
					echo $str.'：mall_id:'.$current['id'].'失败</br>';
				}
			}else{
				//标记产品为上架
				if($v['status']==0){
					$busPrice->where('id='.$v['id'])->setField('status','1');
					$unup++;
					echo '标记：ID：'.$v['id'].' '.date('Y-m-d H:i:s',time()).' ， 未上架</br>';
				}
				
			}
			
			echo '结束：ID：'.$v['id'].' '.date('Y-m-d H:i:s',time()).'</br>';
			$rand = rand(200,500);
			echo '中断：'.$rand.'ms</br>';
			echo '共 '.$total.' 条数据，本次采集更新 '.$upNum.' 条，新增 '.$addNum.' 条，标记未上架 '.$unup.' 条，共处理 '.($upNum+$addNum+$unup).' 条</br></br>';
			flush(); 
			usleep($rand);
		}
		$endTime = time();
		echo '共用时'.Sec2Time($endTime-$startTime);
		//pt($busPrice);
		die();
		
}
function updatePriceNachi(){
		$startTime = time();
		set_time_limit(0);   
 		ob_end_clean();
		$upNum=0;
		$addNum=0;
		$unup=0;
		$mallTicket = D('mallTicket');
		$busPrice = D('nachi');
		$busData = $busPrice->where()->select();
		
		$total = count($busData);
		foreach($busData as $k=>$v){
			$current = $mallTicket->where(' brand_id=18 AND xh="'.$v['noid'].'"')->find();
			if($current){
				if($v['status']==1){
					$busPrice->where('id='.$v['id'])->setField('status','0');
				}
				echo '开始：mall_id：'.$current['id'].' '.date('Y-m-d H:i:s',time()).'</br>';
				$newData = array();
				//$newData['id']=$current['id'];
				//$newData['price']=$v['price'];
				//$rand = rand(5,10);
				//$upPrice = $v['price']*(100+$rand)/100;
				//$newData['oprice']=$upPrice;
				//$newData['oprice1']=$upPrice;
				$newData['trueprice']=$v['oprice']*120/100;
				$newData['oprice1']=$v['oprice']*120/100;
				$newData['oprice']=$v['oprice'];

				$newData['price']=$v['price'];
				//$newData['m_cut']=$v['m_cut'];
				//$newData['n_cut']=$v['n_cut'];
				$result =$mallTicket->where('id='.$current['id'])->save($newData);
				$str = '更新';
				
				if($result !== false){
					echo $str.'：mall_id:'.$current['id'].'成功</br>';
					$upNum++;
				}else{
					$addNum++;
					echo $str.'：mall_id:'.$current['id'].'失败</br>';
				}
			}else{
				//标记产品为上架
				if($v['status']==0){
					$busPrice->where('id='.$v['id'])->setField('status','1');
					$unup++;
					echo '标记：ID：'.$v['id'].' '.date('Y-m-d H:i:s',time()).' ， 未上架</br>';
				}
				
			}
			
			echo '结束：ID：'.$v['id'].' '.date('Y-m-d H:i:s',time()).'</br>';
			$rand = rand(200,500);
			echo '中断：'.$rand.'ms</br>';
			echo '共 '.$total.' 条数据，本次采集更新 '.$upNum.' 条，新增 '.$addNum.' 条，标记未上架 '.$unup.' 条，共处理 '.($upNum+$addNum+$unup).' 条</br></br>';
			flush(); 
			usleep($rand);
		}
		$endTime = time();
		echo '共用时'.Sec2Time($endTime-$startTime);
		//pt($busPrice);
		die();
		
}
//
function savePrice2(){
		//$testurl='http://123.206.194.46/Buyweb/PC/Prdt/Pro_details?_prd_no=00000000000000030000';
		set_time_limit(0);   
 		ob_end_clean();
		$startID =35854;//起始ID;
		$endID=50000;//结束ID;
		echo str_pad('',1024);
		$thmro = D('thmro');
		$where = ' 1=1';
		if($startID){
			$where .=' AND id>='.$startID;
		}
		if($endID){
			$where .=' AND id<='.$endID;
		}
		$upNum=0;
		$addNum=0;
		$this->autoLogin();
		self::$startTime = time();
		for($i=$startID;$i<=$endID;$i++){
			$data = array();
			$id = sprintf("%020d", $i);
			echo '开始：PROID：'.$id.' '.date('Y-m-d H:i:s',time()).'</br>';
			//echo $id;
			$data = $this->priceTHMRO($id);
			if($data['title']!=""){
	
			$current = $thmro->where('proid='.$id)->find();
			if($current){
					$result = $thmro->where('proid='.$id)->save($data);
					if($result !== false){
							echo '更新： PROID:'.$id.'成功</br>';
							$upNum++;
					}else{
							echo '更新： PROID:'.$id.'失败</br>';
					}
				}else{
					$result = $thmro->add($data);
					if($result !== false){
						echo '新增： PROID:'.$id.'成功</br>';
						$addNum++;
					}else{
						echo '新增： PROID:'.$id.'失败</br>';
					}			
				}
			}	
			echo '结束：PROID：'.$id.' '.date('Y-m-d H:i:s',time()).'</br>';
			$rand = rand(3,5);
			echo '中断：'.$rand.'S</br>';
			echo '共 '.$total.' 条数据，本次采集更新 '.$upNum.' 条，新增 '.$addNum.' 条，共处理 '.($upNum+$addNum).' 条</br></br>';
			flush(); 
			sleep($rand);
		}	
	}
	
	function savePrice(){
		set_time_limit(0);   
 		ob_end_clean();
		$startID =0;//起始ID;
		$endID=0;//结束ID;
		$allUpdate = 1;//1全部更新，0只更新价格参数
		$upEmpty=0;//1只更新空价格，0全部更新
		$isUpdata=0;//修补模式，处理数据不全，1开启
		echo str_pad('',1024);
		$mallTicket = D('mallTicket');
		$vipMro = D('vipmro');
		$where = 'ishidden=0 AND noid<>"" AND type_id like "%,10,%"';
		if($startID){
			$where .=' AND id>='.$startID;
		}
		if($endID){
			$where .=' AND id<='.$endID;
		}
		if($isUpdata){
			$where = 'noid<>"" AND buyNo="" AND price<>""';
			$total = $vipMro->field('id,noid,gpid')->where($where)->count();
			$mallArray = $vipMro->field('id,noid,gpid')->where($where)->limit(10000)->select();	
		}else{
			$total = $mallTicket->field('id,noid')->where($where)->count();
			$mallArray = $mallTicket->field('id,noid')->where($where)->limit(10000)->select();	
		}
		
		//pt($mallArray);
		$upNum=0;
		$addNum=0;
		foreach($mallArray as $k =>$v){
			if($isUpdata){
				$v['id'] = $v['gpid'];
			}
			echo '开始：GPID：'.$v['id'].' '.date('Y-m-d H:i:s',time()).'</br>';
			
			$current = $vipMro->where('gpid='.$v['id'])->find();
			if($current['marketPrice']<>"" && $current['price']<>""  && $current['salePrice']<>"" && $upEmpty ){			
				continue;
			}
		
			
			//echo $v['noid'];
			
			$data = array();
			$data = $this->priceGPMRO($v['noid']);
			$data['gpid'] = $v['id'];
			$data['addtime'] = time();
			$data['noid'] = $v['noid'];
			//if($data){
				
				
				if($current){
					//开启全部更新，否则只检查价格变化
					
					//默认只更新价格参数
					if(!$allUpdate){
						if($current['marketPrice']=="" || $current['price']==""  || $current['salePrice']=="" || $current['marketPrice'] != $data['marketPrice'] ||  $current['price'] != $data['price'] || $current['salePrice'] != $data['salePrice']){
							$result = $vipMro->where('gpid='.$v['id'])->save($data);
						}else{
							echo '跳过： GPID:'.$v['id'].'</br>';
						}
					}else{
						$result = $vipMro->where('gpid='.$v['id'])->save($data);
					}
					
					if($result !== false){
							echo '更新： GPID:'.$v['id'].'成功</br>';
							$upNum++;
					}else{
							echo '更新： GPID:'.$v['id'].'失败</br>';
					}
					
				}else{
					$result = $vipMro->add($data);
					if($result !== false){
						echo '新增： GPID:'.$v['id'].'成功</br>';
						$addNum++;
					}else{
						echo '新增： GPID:'.$v['id'].'失败</br>';
					}			
				}
			//}
			echo '结束：GPID：'.$v['id'].' '.date('Y-m-d H:i:s',time()).'</br>';
			$rand = rand(3,6);
			echo '中断：'.$rand.'S</br>';
			echo '共 '.$total.' 条数据，本次采集更新 '.$upNum.' 条，新增 '.$addNum.' 条，共处理 '.($upNum+$addNum).' 条</br></br>';
			flush(); 
			sleep($rand);
		}
		echo '</br>共 '.$total.' 条数据，本次采集更新 '.$upNum.' 条，新增 '.$addNum.' 条，共处理 '.($upNum+$addNum).' 条</br></br>';
		die();
	}
	function priceGPMRO($keyword){
		//$pwd	=	I('get.pwd');
		//验证地址是否来源正确
	//	if( $pwd != 'gj515pwd' ){
//			urlSkip('','/');
//		}
		$serverUrl1 ='http://www.vipmro.net/sign/';
		$data = array();
		$data['keyword'] = $keyword;
		$data['channel'] = 'pc';
		$data['_cache'] = '0.'.rand(10000000,99999999).rand(1000000,9999999);
		//sign参数
		$dataPw = array();
		$dataPw['url'] = 'http://www.vipmro.net/emro_interface/goods/search/pcface/1/10';
		$dataPw['queryString'] = 'keyword='.$data['keyword'].'&channel=pc&_cache='.$data['_cache'];
		//获取sign
		$sign = $this->CURLRequest($serverUrl1,$dataPw);
		$sign = str_replace('"','',$sign);
		//echo $sign;
		$data['sign'] = $sign;
		//dump($data);
		$serverUrl2 ='http://www.vipmro.net/emro_interface/goods/search/pcface/1/10?keyword='.$data["keyword"].'&channel=pc&_cache='.$data["_cache"].'&sign='.$sign;
		//echo $serverUrl2; 
		
		$xmlString = $this->CURLRequest($serverUrl2);
		$vipPrice = json_decode($xmlString,true);
		//print_r($vipPrice);
		$goodsList = array();
		$goodsList = $vipPrice['data']['goodsList'][0];
		if($goodsList){
			$newArray = array();
			$newArray['batchQuantity'] = $goodsList['batchQuantity'];
			$newArray['marketPrice'] = $goodsList['marketPrice'];
			$newArray['model'] = $this->decode($goodsList['model']);
			$newArray['title_code'] = $goodsList['title'];
			$newArray['title'] = $this->decode($goodsList['title']);
			$newArray['price'] = $goodsList['price'];
			$newArray['sellerGoodsId'] = $goodsList['sellerGoodsId'];
			$newArray['image'] = $goodsList['image'];
			$newArray['salePrice'] = $goodsList['salePrice'];
			$newArray['orderQuantity'] = $goodsList['orderQuantity'];
			$newArray['buyNo'] = $this->decode($goodsList['buyNo']);
			return $newArray;
		}

	
	}
	/*vipmro.com*/
		function savePrice4(){
		set_time_limit(0);   
 		ob_end_clean();
		$startID =592812;//起始ID;
		$endID=7000000;//结束ID;
		$allUpdate = 1;//1全部更新，0只更新价格参数
		$upEmpty=0;//1只更新空价格，0全部更新
		$isUpdata=0;//修补模式，处理数据不全，1开启
		echo str_pad('',1024);
		//$mallTicket = D('mallTicket');
		$gphMro = D('gphmro');
		//$where = 'ishidden=0 AND noid<>"" AND type_id like "%,10,%"';
		if($startID){
			$where .=' AND id>='.$startID;
		}
		if($endID){
			$where .=' AND id<='.$endID;
		}
	//	if($isUpdata){
//			$where = 'noid<>"" AND buyNo="" AND price<>""';
//			$total = $gphMro->field('id,noid,gpid')->where($where)->count();
//			$mallArray = $gphMro->field('id,noid,gpid')->where($where)->limit(10000)->select();	
//		}else{
//			$total = $mallTicket->field('id,noid')->where($where)->count();
//			$mallArray = $mallTicket->field('id,noid')->where($where)->limit(10000)->select();	
//		}
		
		//pt($mallArray);
		$upNum=0;
		$addNum=0;
		//foreach($mallArray as $k =>$v){
		for($i=$startID;$i<=$endID;$i++){	
		//	if($isUpdata){
//				$v['id'] = $v['gpid'];
//			}
			echo '开始：sellerGoodsId：'.$i.' '.date('Y-m-d H:i:s',time()).'</br>';
			
			$current = $gphMro->where('sellerGoodsId='.$i)->find();
		//	if($current['marketPrice']<>"" && $current['price']<>""  && $current['salePrice']<>"" && $upEmpty ){			
//				continue;
//			}
//		
			
			//echo $v['noid'];
			
			$data = array();
			$data = $this->priceGPHMRO($i);
			//die();
			
		
			if($data){
				
				$data['addtime'] = time();
				//pt($data);
				if($current){
					//开启全部更新，否则只检查价格变化
					
					//默认只更新价格参数
				//	if(!$allUpdate){
//						if($current['marketPrice']=="" || $current['price']==""  || $current['salePrice']=="" || $current['marketPrice'] != $data['marketPrice'] ||  $current['price'] != $data['price'] || $current['salePrice'] != $data['salePrice']){
//							$result = $gphMro->where('gpid='.$v['id'])->save($data);
//						}else{
//							echo '跳过： GPID:'.$v['id'].'</br>';
//						}
//					}else{
						$result = $gphMro->where('sellerGoodsId='.$i)->save($data);
				//	}
					
					if($result !== false){
							echo '更新： sellerGoodsId:'.$i.'成功</br>';
							$upNum++;
					}else{
							echo '更新： sellerGoodsId::'.$i.'失败</br>';
					}
					
				}else{
					$result = $gphMro->add($data);
					if($result !== false){
						echo '新增： sellerGoodsId:'.$i.'成功</br>';
						$addNum++;
					}else{
						echo '新增： sellerGoodsId:'.$i.'失败</br>';
					}			
				}
			}
			echo '结束：sellerGoodsId：'.$i.' '.date('Y-m-d H:i:s',time()).'</br>';
			$rand = rand(3,5);
			echo '中断：'.$rand.'S</br>';
			echo '共 '.$total.' 条数据，本次采集更新 '.$upNum.' 条，新增 '.$addNum.' 条，共处理 '.($upNum+$addNum).' 条</br></br>';
			flush(); 
			sleep($rand);
		}
		echo '</br>共 '.$total.' 条数据，本次采集更新 '.$upNum.' 条，新增 '.$addNum.' 条，共处理 '.($upNum+$addNum).' 条</br></br>';
		die();
	}
	function priceGPHMRO($id){
		//$pwd	=	I('get.pwd');
		//验证地址是否来源正确
	//	if( $pwd != 'gj515pwd' ){
//			urlSkip('','/');
//		}
		$serverUrl1 ='http://www.vipmro.com/sign/';
		$data = array();
		//$data['keyword'] = $keyword;
		//$data['channel'] = 'pc';
		$data['_cache'] = '0.'.rand(10000000,99999999).rand(1000000,9999999);
		//sign参数
		$dataPw = array();
		$dataPw['url'] = 'http://www.vipmro.com/emro_interface/goods/mall/detail/'.$id;
		$dataPw['queryString'] = '_cache='.$data['_cache'];
		//获取sign
		$sign = $this->CURLRequest($serverUrl1,$dataPw);
		$sign = str_replace('"','',$sign);
	
		$data['sign'] = $sign;
		//dump($data);
		$serverUrl2='http://www.vipmro.com/emro_interface/goods/mall/detail/'.$id.'?_cache='.$data['_cache'].'&sign='.$data['sign'];
		//$serverUrl2 ='http://www.vipmro.net/emro_interface/goods/search/pcface/1/10?keyword='.$data["keyword"].'&channel=pc&_cache='.$data["_cache"].'&sign='.$sign;
		//echo $serverUrl2; 
		
		$xmlString = $this->CURLRequest($serverUrl2);
		$vipPrice = json_decode($xmlString,true);
		//print_r($vipPrice);
		$goodsList = array();
		$goodsList = $vipPrice['data'];
		//pt($goodsList);
		if($goodsList){
			$newArray = array();
			$newArray['goodsId'] = $goodsList['goodsId'];
			$newArray['sellerGoodsId'] = $goodsList['sellerGoodsId'];
			$newArray['isGroupon'] = $goodsList['isGroupon'];
			$newArray['isRate'] = $goodsList['isRate'];
			$newArray['isSale'] = $goodsList['isSale'];
			$newArray['isFullgive'] = $goodsList['isFullgive'];
			$newArray['isBean'] = $goodsList['isBean'];
			$newArray ['model'] = $goodsList['model'];
			$newArray['detail'] = $goodsList['detail'];
			$newArray['measure'] = $goodsList['measure'];
			$newArray['remark'] = $goodsList['remark'];
			$newArray['brandName'] = $goodsList['brandName'];
			$newArray ['brandId'] = $goodsList['brandId'];
			$newArray['grouponDesc'] = $goodsList['grouponDesc'];
			$newArray['title'] = $goodsList['title'];
			$newArray['batchQuantity'] = $goodsList['batchQuantity'];
			$newArray['rate'] = $goodsList['rate'];
			$newArray['stock'] = $goodsList['stock'];
			$newArray['qq'] = $goodsList['qq'];
			$newArray['dealerId'] = $goodsList['dealerId'];
			$newArray['marketPrice'] = $goodsList['marketPrice'];
			$newArray['alias'] = $goodsList['alias'];
			$newArray['image'] = $goodsList['image'];
			$newArray['goodsNo'] = $goodsList['goodsNo'];
			$newArray['leastQunantity'] = $goodsList['leastQunantity'];
			$newArray['isFullcut'] = $goodsList['isFullcut'];
			$newArray['price'] = $goodsList['price'];
			$newArray['sellerId'] = $goodsList['sellerId'];
			$newArray['shopName'] = $goodsList['shopName'];
			$newArray['isSupportGroupon'] = $goodsList['isSupportGroupon'];
			$newArray['salePrice'] = $goodsList['salePrice'];
			$newArray['orderQuantity'] = $goodsList['orderQuantity'];
			$newArray['isRebates'] = $goodsList['isRebates'];
			$newArray['telephone'] = $goodsList['telephone'];
			$newArray['buyNo'] = $goodsList['buyNo'];
    		$newArray['images'] = json_encode($goodsList['images']);
			$newArray['proxyCertificate'] = $goodsList['proxyCertificate'];
			$newArray['logo'] = $goodsList['logo'];
			$newArray['attrs'] = json_encode($goodsList['attrs']);
			$newArray['activityList'] = json_encode($goodsList['activityList']);
			$newArray['adverList'] = json_encode($goodsList['adverList']);
			$newArray['hotGoods'] = json_encode($goodsList['hotGoods']);
			$newArray['groupStartTime'] =$goodsList['groupStartTime'];
			$newArray['groupEndTime'] =$goodsList['groupEndTime'];
			$newArray['isSignUp'] =$goodsList['isSignUp'];
			$newArray['grouponId'] =$goodsList['grouponId'];
			$newArray['jdParam'] =$goodsList['jdParam'];
			$newArray['activityDesc'] =$goodsList['activityDesc'];
			$newArray['note'] =$goodsList['note'];
			$newArray['bean'] =$goodsList['bean'];
			$newArray['cateNo'] =$goodsList['cateNo'];
			$newArray['isBigCustomer'] =$goodsList['isBigCustomer'];
			$newArray['isCombination'] =$goodsList['isCombination'];
			$newArray['packageNum'] =$goodsList['packageNum'];
			return $newArray;
		}
	}
//20170605
function updateProductOne(){
		$startTime = time();
		set_time_limit(0);   
 		ob_end_clean();
		$upNum=0;
		$addNum=0;
		$unup=0;
		$mallTicket = D('mallTicket');
		$product = D('product_one');
		
		$productData = $product->where('')->select();
		
		$total = count($productData);
		foreach($productData as $k=>$v){
			echo '开始：ID：'.$v['id'].' '.date('Y-m-d H:i:s',time()).'</br>';
		
			$currentMall = $mallTicket->where('ishidden=0 AND huodongtype=97 AND   noid="'.$v['noid'].'"')->find();
			if($current){
				//标记产品为上架
				if($v['status']==1){
					$product->where('id='.$v['id'])->setField('status','0');
				}
				if($currentMall){
					echo '开始：Mall_id：'.$currentMall['id'].' '.date('Y-m-d H:i:s',time()).'</br>';
					$newData = array();
					//$newData['id']=$currentMall['id'];
					//$newData['price']=$current['price'];
					//$rand = rand(5,10);
					//$upPrice = $v['price']*(100+$rand)/100;
					//$newData['oprice']=$upPrice;
					//$newData['oprice1']=$upPrice;
					//$newData['oprice']=$current['oprice'];
					//$newData['oprice1']=$current['oprice'];
					$newData['num']=$v['num'];
					$result =$mallTicket->where('id='.$currentMall['id'])->save($newData);
					$str = '更新';
					
					if($result !== false){
						echo $str.'：Mall_id:'.$currentMall['id'].'成功</br>';
						$upNum++;
					}else{
						$addNum++;
						echo $str.'：Mall_id:'.$currentMall['id'].'失败</br>';
					}
				}
			}else{
				if($v['status']==0){
					//标记产品为上架
					$product->where('id='.$v['id'])->setField('status','1');
					$unup++;
					echo '标记：ID：'.$v['id'].' '.date('Y-m-d H:i:s',time()).' ， 未上架</br>';
				}
			}
			
			echo '结束：ID：'.$v['id'].' '.date('Y-m-d H:i:s',time()).'</br>';
			$rand = rand(200,500);
			echo '中断：'.$rand.'ms</br>';
			echo '共 '.$total.' 条数据，本次采集更新 '.$upNum.' 条，新增 '.$addNum.' 条，标记未上架 '.$unup.' 条，共处理 '.($upNum+$addNum).' 条</br></br>';
			flush(); 
			usleep($rand);
		}
		$endTime = time();
		echo '共用时'.Sec2Time($endTime-$startTime);
		//pt($busPrice);
		die();
		
}
//	
//	
function getSndTitle($index=0){
	$data = array(
		'0'=>'主要信息',
		'1'=>'补充信息',
		'2'=>'环境',
		'3'=>'可持续性',
	);	
	return $data[$index];
}
function skuSND(){
		//$testurl='http://123.206.194.46/Buyweb/PC/Prdt/Pro_details?_prd_no=00000000000000030000';
		set_time_limit(0);   
 		ob_end_clean();
		$startID =0;//起始ID;
		$endID=0;//结束ID;
		echo str_pad('',1024);
		$snd = D('shinaide');
		$where = ' 1=1 AND hasData=0';
		if($startID){
			$where .=' AND id>='.$startID;
		}
		if($endID){
			$where .=' AND id<='.$endID;
		}
		$ii=0;
		$upNum=0;
		$addNum=0;
		$jumpNum=0;
		$addAttrNum=0;
		$sndSku = D('sku_snd');
		$sndSkuAttr = D('sku_snd_attr');
		//$this->autoLogin();
		//self::$startTime = time();
		$sndData = $snd->where($where)->select();
		$total = $snd->where($where)->count();
		foreach($sndData as $k=>$v){
			$ii++;
			echo '开始：ID：	'.$v['id'].' ,订货号：'.$v['noid'].'		'.date('Y-m-d H:i:s',time()).'</br>';
			//检查是否有数据
			$current = $sndSku->where('noid="'.$v['noid'].'"')->find();
		//	if($current){
//				$sndData = $snd->where('noid="'.$v['noid'].'"')->setField('hasData','1');
//				echo 'ID：	'.$v['id'].' ,订货号：'.$v['noid'].'有数据，跳过</br>';
//				$jumpNum++;
//				continue;
//			}
			//$v['noid']='LC1E09008F7N';
			$data = array();
			//$id = sprintf("%020d", $i);
			
			//echo $id;
			$data = $this->infoSND($v['noid']);
			//die();
			//保存到sku
			if($data){
				//$current = $sndSku->where('noid="'.$v['noid'].'"')->find();
				$newData = array();
				$newData['noid'] = $v['noid'];
				$newData['attr'] = json_encode($data);
				$newData['addtime'] = time();
				
				if($current){
						$result = $sndSku->where('noid="'.$current['noid'].'"')->save($newData);
						$txt ='更新';
						$sku_id = $current['id'];
				}else{
						$result = $sndSku->add($newData);	
						$sku_id = $result;
						$txt ='新增';
				}
				if($result !== false){
						$sndData = $snd->where('noid="'.$v['noid'].'"')->setField('hasData','1');
						echo $txt.'：   ID：	'.$v['id'].'成功</br>';
						$addNum++;
						
				}else{
						echo  $txt.'：   ID：	'.$v['id'].'失败</br>';
				}	
				//保存到sku
				foreach($data as $k1 => $v1){
					foreach($v1['content'] as $k2 => $v2){
						$newData1 = array();
						$newData1['noid'] = $v['noid'];
						$strData = explode('|||',$v2);
						$newData1['title'] = $strData[0];
						$newData1['content'] = $strData[1];	
						$newData1['sku_id'] = $sku_id;
						$newData1['addtime'] = time();	
						$newData1['classname'] = $v1['title'];	
						$attr = $sndSkuAttr->where('sku_id ='.$sku_id.' AND noid="'.$newData1['noid'].'" AND title="'.$newData1['title'].'" AND classname="'.$newData1['classname'].'"')->find();	
						if($attr){
							$result2 = $sndSkuAttr->where('id='.$attr['id'])->save($newData1);
							$txt ='更新';
							$attrid = $attr['id'];
						}else{
							$result2 = $sndSkuAttr->add($newData1);
							$txt ='新增';
							$attrid = $result2;
						}
						if($result2 !== false){
							echo $txt.'：   ATTRID:'.$attrid .'成功</br>';
							$addAttrNum++;
						}else{
							echo  $txt.'：   ATTRID:'.$attrid .'失败</br>';
						}	
						
						
					}
				}
				if($result&&$result2){
					$snd->where('id='.$v['id'])->setField('isup',1);
					echo '标记:ID '.$v['id'] .'采集成功</br>';
				}else{
					$snd->where('id='.$v['id'])->setField('isup',0);
					echo '标记:ID '.$v['id'] .'采集失败</br>';
				}
			}else{
					echo 'ID：	'.$v['id'].' ,订货号：'.$v['noid'].'无数据，跳过</br>';
					$jumpNum++;
			}	
			
			echo '结束：   ID：'.$v['id'].' '.date('Y-m-d H:i:s',time()).'</br>';
			$rand = rand(2,3);
			echo '中断：'.$rand.'S</br>';
			echo '共 '.$total.' 条数据，执行 '.$ii.' 更新 '.$upNum.' 条，新增 '.$addNum.' 条，跳过 ' .$jumpNum.'条， 共处理 '.($upNum+$addNum+$jumpNum).' 条,剩余 '.($total-($upNum+$addNum+$jumpNum)).'</br></br>';
			flush(); 
			sleep($rand);
		}		
			
	}
function infoSND($id=0){
		//$pwd	=	I('get.pwd');
		//验证地址是否来源正确
	//	if( $pwd != 'gj515pwd' ){
//			urlSkip('','/');
//		}

$url = 'http://www.schneider-electric.cn/zh/product/'.$id;
//echo $url;
//获取登录页的信息   
		//$html = $this-> CURLRequest($url);  
		//print_r($html);
		$html = file_get_contents($url); 
		//print_r($html);
		$html=preg_replace("/[\t\n\r]+/","",$html);  
		//print_r($html);
		$partern='/\<table\>\s*(.*?)\s*\<\/table\>/is';
	
		preg_match_all($partern, $html,$data1);
		//print_r($data1);
		//$xmlString = preg_replace("/[\t\n\r]+/","",$data1[0]); 
		$xmlString = preg_replace('/\<div .*?\>/',"",$data1[0]); 
		$xmlString = preg_replace('/\<\/div\>/',"",$xmlString); 
		//print_r($xmlString);
		$data = array();
		$array = array();
		foreach($xmlString as $k=>$v){
			$attrData = array();
			preg_match_all('/\<tr.*?\>\s*(.*?)\s*\\<\/tr\>.*?/is', $v,$newData);
			//print_r($newData[1]);
			$newData1 = preg_replace('/\<td\>/',"",$newData[1]); 
			//preg_match_all('/\<td.*?\>\s*(.*?)\s*\\<\/td\>.*?/is', $v,$newData);
			$newData1 = preg_replace('/\<\/td\>/',"|||",$newData1); 
			//$newData1 = preg_replace('/\<a .*?\>/',"",$newData1);
			//$newData1 = preg_replace('/\<\/a\>/',"",$newData1); 
			//print_r($newData1);
			//$str = implode("|||",$newData[1]);
			//echo $str;
			//$strArray = explode("<td></tr><tr><td>",$str);
			//print_r($strArray);
			$attrData['title'] = $this->getSndTitle($k);
			$attrData['content'] =$newData1;
			array_push($array,$attrData);
		}
		//print_r($array);
		return $array;
	}
	function download_by_path($noid){
	$temp='';
	$path_name='http://www.schneider-electric.cn/zh/product/download-pdf/'.$noid;
	$save_name='pdf/'.$noid.'.pdf';
//	if(!file_exists($path_name)) {
//	return false;
//}
         ob_end_clean();
         $hfile = fopen($path_name, "rb");
		 if(!$hfile){
			echo "Can not find file: $path_name\n";
			return false;
		 }
         Header("Content-type: application/octet-stream");
         Header("Content-Transfer-Encoding: binary");
         Header("Accept-Ranges: bytes");
         Header("Content-Length: ".filesize($path_name));
         Header("Content-Disposition: attachment; filename=\"$save_name\"");
		 
         while (!feof($hfile)) {
            $temp .= fread($hfile, 32768000);
         }
		  if(@file_put_contents($save_name, $temp) ) {
			//echo $file;
			  return $save_name;
			} else {
			  return false;
			}
         fclose($hfile);
    }
function httpcopy($noid, $file="", $timeout=60) {
$url='http://www.schneider-electric.cn/zh/product/download-pdf/'.$noid;
if(!file_exists($url)) {
	return false;
}
$file='pdf/'.$noid.'.pdf';
  $file = empty($file) ? pathinfo($url,PATHINFO_BASENAME) : $file;
  $dir = pathinfo($file,PATHINFO_DIRNAME);
  !is_dir($dir) && @mkdir($dir,0755,true);
  $url = str_replace(" ","%20",$url);
 
  if(function_exists('curl_init')) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $temp = curl_exec($ch);
    if(@file_put_contents($file, $temp) && !curl_error($ch)) {
	//echo $file;
      return $file;
    } else {
      return false;
    }
  } else {
    $opts = array(
      "http"=>array(
      "method"=>"GET",
      "header"=>"",
      "timeout"=>$timeout)
    );
    $context = stream_context_create($opts);
    if(@copy($url, $file, $context)) {
      //$http_response_header
      return $file;
    } else {
      return false;
    }
  }
}	
	function sndPDF(){

		set_time_limit(0);   
 		ob_end_clean();
		$startID =6424;//起始ID;
		//$endID=8749;//结束ID;
		echo str_pad('',1024);
		//$snd = D('sku_snd');
		$where = ' 1=1 and hasfile=0';
		if($startID){
			$where .=' AND id>='.$startID;
		}
		if($endID){
			$where .=' AND id<='.$endID;
		}
		$upNum=0;
		$addNum=0;
		$addAttrNum=0;
		$sndSku = D('sku_snd');
		$sndData = $sndSku->where($where)->select();
		$total = $sndSku->where($where)->count();
		foreach($sndData as $k=>$v){
			//$v['noid']='LC1D18M7C';
			//$data='';
			echo '开始：ID：	'.$v['id'].' ,订货号：'.$v['noid'].'		'.date('Y-m-d H:i:s',time()).'</br>';
			//echo $id;
			$data = $this->download_by_path(trim($v['noid']));
			//echo $data;
			//die();
			//保存到sku
			if($data){
				if(file_exists($data)) {
					$result = $sndSku->where('noid="'.$v['noid'].'"')->setField('hasfile','1');	
					echo '标记:ID '.$v['id'] .'采集成功</br>';
					$addNum++;
				 } else{
				  echo '标记:ID '.$v['id'] .'采集失败</br>';
				 }
				
			}
			echo '结束：   ID：'.$v['id'].' '.date('Y-m-d H:i:s',time()).'</br>';
			$rand = rand(5,6);
			echo '中断：'.$rand.'S</br>';
			echo '共 '.$total.' 条数据，本次采集更新 '.$upNum.' 条，新增 '.$addNum.' 条，共处理 '.($upNum+$addNum).' 条,待处理 '.($total-($upNum+$addNum)).'</br></br>';
			//die();
			flush(); 
			sleep($rand);
		}
}	
	function updateSku(){
		set_time_limit(0);   
 		ob_end_clean();
			$stock = D('stock_num');
			$data = $stock->field('id,skuid')->select();
			foreach($data as $k=>$v){
				echo '开始：ID：	'.$v['id'].' 	'.date('Y-m-d H:i:s',time()).'</br>';
				$newdata=array();
				$max_sku = $stock->max('skuid');
				$newdata['skuid']=$max_sku+1;
				$stock->where('id='.$v['id'])->save($newdata);	
				echo '结束：   ID：'.$v['id'].' '.date('Y-m-d H:i:s',time()).'</br>';	
				$rand = rand(100,200);
				echo '中断：'.$rand.'MS</br>';	
				flush(); 
				usleep($rand);
		}
		$endTime = time();
		echo '共用时'.Sec2Time($endTime-$startTime);
		//pt($busPrice);
		die();
	}
	function bwcData(){
		$bwc = D('bwc');
		
		$bwcArray = $bwc->limit()->getField('goods_id',true);
		$serverUrl1 ='https://www.bwcmall.com/api/v1/thirdparty/goodsstockprice';
		$data = array();
		$data['appKey'] = 'fb15ab8c20f7e223fa0623b57e6102d2';
		$data['ids'] = $bwcArray;
		$data = json_encode($data);
		//pt($data);
		$header = array('Content-Type:application/json');  
		//$header = 'Content-Type:application/json'; 
		//die();
		//$xmlString = $this->CURLRequest($serverUrl1,$data,$cookie,$header);
		$xmlString = $this->curl_https($serverUrl1,$data,$header);
		//echo $xmlString;
		$bwcData = array();
		$bwcData =  json_decode($xmlString,TRUE);
		
		//下面是自己的
		//pt($bwcData);
		if($bwcData['success']==1){
			return $bwcData['result'];
			
		}else{
			return false;	
		}
		
}	
function bwcPrice(){
		$startTime = time();
		set_time_limit(0);   
 		ob_end_clean();
		$upNum=0;
		$addNum=0;
		$data = $this->bwcData();
		if(!$data){
			echo '数据错误';die();
		}
		//pt($data);
		//die();
		$bwcData = D('bwc_data');
		
		$total = count($data);
		//echo $total;
		//die();
		foreach($data as $k=>$v){
			$newData = array();
			$newData['goods_id']=$v['id'];
			echo '开始：goods_id：'.$v['id'].' '.date('Y-m-d H:i:s',time()).'</br>';
			$newData['price']=$v['price'];
			$newData['stockNum']=$v['stockNum'];
			$newData['addtime']=time();
			$current = $bwcData->where('goods_id='.$v['id'])->find();
			if($current){
				$result =$bwcData->where('goods_id='.$v['id'])->save($newData);
				$str = '更新';
				$ctype=0;
			}else{
				$result = $bwcData->add($newData);
				$str = '新增';
				$ctype=1;		
			}
			if($result !== false){
				echo $str.'： goods_id:'.$v['id'].'成功</br>';
				if($ctype==1){
					$addNum++;
				}else{
					$upNum++;
				}
				
			}else{
				
				echo $str.'： goods_id:'.$v['id'].'失败</br>';
			}
			echo '结束：goods_id：'.$v['id'].' '.date('Y-m-d H:i:s',time()).'</br>';
			$rand = rand(100,200);
			echo '中断：'.$rand.'ms</br>';
			echo '共 '.$total.' 条数据，本次采集更新 '.$upNum.' 条，新增 '.$addNum.' 条，共处理 '.($upNum+$addNum).' 条</br></br>';
			flush(); 
			usleep($rand);
		}
		$endTime = time();
		echo '共用时'.Sec2Time($endTime-$startTime);
		//pt($busPrice);
		die();
		
}
function msmPrice(){
		$hour = date('H',time());
		if($hour>=21 && $hour<=8){
			echo '8:00-21:00数据不更新';
			$this->display();
			die();
		}
		$startTime = time();
		set_time_limit(0);   
 		ob_end_clean();
		$upNum=0;
		$addNum=0;
		$serverUrl1 ='http://113.106.232.85:9090/api/Strong/querygetmsmprice';
		//$data = 'aKey:25548E460EC24150B324DB5139DB05E4';
		$data =array();
		$data['aKey'] = '25548E460EC24150B324DB5139DB05E4';
		$data['SKU'] = '';
		//$data['ids'] = $bwcArray;
		$data = json_encode($data);
		//pt($data);
//		$data = array(
//			'aKey'=>'25548E460EC24150B324DB5139DB05E4'
//		);
		//$data = http_build_query($data);
		$header = array('Content-Type:application/json'); 
		//$header = array('Content-Type: application/x-www-form-urlencoded');
		//$data = array('akey'=>'25548E460EC24150B324DB5139DB05E4');
		//$data['akey'] = '25548E460EC24150B324DB5139DB05E4';
		//$data['SKU'] = '';
		//$xmlString='';
		$xmlString = $this->curl_https($serverUrl1,$data,$header);
		//$xmlString = $this->CURLRequest($serverUrl1,$data);
		//$xmlString = preg_replace('/\s/', '', $xmlString);
		//$xmlString = '';
		$xmlString = trim($xmlString,chr(239).chr(187).chr(191));
		//$xmlString =iconv('GBK','utf-8//IGNORE',$xmlString);
		//print_r($xmlString);
		$msmData = array();
		$msmData =  json_decode($xmlString,TRUE);
		
		//print_r($busPrice);
		//die();
		$data = $msmData['data'];
		//pt($data);
		//die();
		$msmPrice = D('msmprice');
		
		$total = count($data);
		if($total){
			//清空yt_msmprice表
				M()->query('update yt_msmprice set ishidden=1');
		}
		foreach($data as $k=>$v){
			if($v['Brand']=='NSK'){
			$newData = array();
			$newData['SKU']=$v['SKU'];
			echo '开始：SKU：'.$v['SKU'].' '.date('Y-m-d H:i:s',time()).'</br>';
			$newData['Model']=preg_replace("/\s+/",' ',$v['Model']);
			$newData['Grease']=$v['Grease'];
			$newData['Brand']=$v['Brand'];
			$newData['Origin']=$v['Origin'];
			$newData['Storage_Num']=$v['Storage_Num'];
			$newData['Min_Order_Num']=$v['Min_Order_Num'];
			$newData['Price']=$v['Price'];
			$newData['Goods_Location']=$v['Goods_Location'];
			$newData['addtime']=time();
			$current = $msmPrice->where('SKU='.$v['SKU'])->find();
			if($current){
				$newData['ishidden']='0';
				$result =$msmPrice->where('SKU='.$v['SKU'])->save($newData);
				$str = '更新';
			}else{
				$result = $msmPrice->add($newData);
				$str = '新增';		
			}
			if($result !== false){
				echo $str.'： SKU:'.$v['SKU'].'成功</br>';
				$upNum++;
			}else{
				$addNum++;
				echo $str.'： SKU:'.$v['SKU'].'失败</br>';
			}
			echo '结束：SKU：'.$v['SKU'].' '.date('Y-m-d H:i:s',time()).'</br>';
			//$rand = rand(200,500);
			$rand = 100;
			echo '中断：'.$rand.'ms</br>';
			echo '共 '.$total.' 条数据，本次采集更新 '.$upNum.' 条，新增 '.$addNum.' 条，共处理 '.($upNum+$addNum).' 条</br></br>';
			flush(); 
			usleep($rand);
			}
		}
		$endTime = time();
		echo '共用时'.Sec2Time($endTime-$startTime);
		//pt($busPrice);
		//die();
		$this->display();
		
}	
function updateMsmPrice(){
		$hour = date('H',time());
		if($hour>=21 && $hour<=8){
			echo '8:00-21:00数据不更新';
			$this->display();
			die();
		}
		//清空NTN库存
		//M()->query('update yt_mall_ticket set num=0 where ishidden=0 AND brand_id=3 AND huodongtype=0');
		//M()->query('update yt_stock_num set num=0 where  ticket_id IN (select a.id from (select id from yt_mall_ticket where ishidden=0 AND brand_id=3 AND huodongtype=0) a)');
		$startTime = time();
		set_time_limit(0);   
 		ob_end_clean();
		$upNum=0;
		$addNum=0;
		$unup=0;
		$ticketArray=array();
		$mallTicket = D('mallTicket');
		$msmPrice = D('msmprice');
		$msmData = $msmPrice->where('ishidden=0 AND brand="NSK"')->select();

		$stock = D('stockNum');
		$total = count($msmData);
		foreach($msmData as $k=>$v){
			$noid = trim($v['Brand']).' '.trim($v['Model']);
			$current = $mallTicket->where('ishidden=0 AND brand_id=4  AND huodongtype=0 AND  xh="'.$noid.'"')->find();
			if($current){
				array_push($ticketArray,$current['id']);
				echo '开始：id：'.$v['id'].' '.date('Y-m-d H:i:s',time()).'</br>';
				$newData = array();
				//$newData['id']=$current['id'];
				//if($hour==8){
					$rand1 = rand(45,65);
					$newData['price']=$v['Price']*(1000+$rand1)/1000;
					$rand = rand(10,15);
					$upPrice = $v['Price']*(100+$rand)/100;
					$newData['oprice']=$upPrice;
					$newData['oprice1']=$upPrice;
				//}
				$newData['num']=$v['Storage_Num'];
				$result =$mallTicket->where('ishidden=0 AND id='.$current['id'])->save($newData);
				$result1 =$stock->where('stock_id=2  AND ticket_id='.$current['id'])->save($newData);
				$str = '更新';
				
				if($result !== false){
					echo $str.'：mall_id:'.$current['id'].'成功</br>';
					if($v['status']==1){
						$msmPrice->where('id='.$v['id'])->setField('status','0');
					}
					$upNum++;
				}else{
					$addNum++;
					echo $str.'：mall_id:'.$current['id'].'失败</br>';
				}
			}else{
				//标记产品为上架
				if($v['status']==0){
					$msmPrice->where('id='.$v['id'])->setField('status','1');
				}
				$unup++;
				echo '标记：id：'.$v['id'].' '.date('Y-m-d H:i:s',time()).' ， 未上架</br>';
			}
			
			echo '结束：id：'.$v['id'].' '.date('Y-m-d H:i:s',time()).'</br>';
			$rand = rand(200,300);
			$rand = 150;
			echo '中断：'.$rand.'ms</br>';
			echo '共 '.$total.' 条数据，本次采集更新 '.$upNum.' 条，新增 '.$addNum.' 条，标记未上架 '.$unup.' 条，共处理 '.($upNum+$addNum).' 条</br></br>';
			flush(); 
			usleep($rand);
		}
		//统计平台id
		$total_id = $mallTicket->field('id')->where('ishidden=0 and huodongtype=0 AND brand_id=4')->select();
		
		echo '平台ticket_id,共'.count($total_id).':</br>';
		$total_id = i_array_column($total_id, 'id');
		//print_r($total_id);
		echo '更新ticket_id,共'.count($ticketArray).':</br>';
		//print_r($ticketArray);
		$noTicket=array_diff($total_id,$ticketArray);
		echo '差异ticket_id:共'.count($noTicket).'</br>';
		//print_r($noTicket);
		$ticketStr = implode(",",$noTicket);
		echo $ticketStr.'</br>';
		M()->query('update yt_mall_ticket set num=0 where ishidden=0 AND brand_id=4 AND huodongtype=0 AND id IN('.$ticketStr.')');
		M()->query('update yt_stock_num set num=0 where  ticket_id IN (select a.id from (select id from yt_mall_ticket where ishidden=0 AND brand_id=4 AND huodongtype=0 AND id IN('.$ticketStr.')) a)');
		$endTime = time();
		echo '共用时'.Sec2Time($endTime-$startTime);
		//pt($busPrice);
		//die();
		$this->display();
		
}
//万马
function getWmData($data){
	
		$serverUrl1 ='http://wanma.online:8080/zcmis/QueryAgencyHpmlServlet?loginid=@GPM&&password=888888&&xh='.$data['xh'].'&&pp='.$data['pp'];
		//$data = 'aKey:25548E460EC24150B324DB5139DB05E4';
		//$data =array();
		//$data['aKey'] = '25548E460EC24150B324DB5139DB05E4';
		//$data['SKU'] = '';
		//$data['ids'] = $bwcArray;
		//$data = json_encode($data);
		//pt($data);
//		$data = array(
//			'aKey'=>'25548E460EC24150B324DB5139DB05E4'
//		);
		//$data = http_build_query($data);
		//$header = array('Content-Type:application/json'); 
		//$header = array('Content-Type: application/x-www-form-urlencoded');
		//$data = array('akey'=>'25548E460EC24150B324DB5139DB05E4');
		//$data['akey'] = '25548E460EC24150B324DB5139DB05E4';
		//$data['SKU'] = '';
		//$xmlString='';
		//$xmlString = $this->curl_https($serverUrl1);
		$xmlString = $this->CURLRequest($serverUrl1);
		//$xmlString = preg_replace('/\s/', '', $xmlString);
		//$xmlString = '';
		$xmlString = trim($xmlString,chr(239).chr(187).chr(191));
		//$xmlString =iconv('GBK','utf-8//IGNORE',$xmlString);
		//print_r($xmlString);
		$msmData = array();
		$msmData =  json_decode($xmlString,TRUE);
		
		//print_r($msmData);
		//die();
		if($msmData['total']){
			return $msmData['rows'];
		}else{
			return false;
		}
		
}
		//$data = $msmData['rows'];
		//pt($data);
		//die();
	function wmPrice(){
		$hour = date('H',time());
		if($hour>=21 && $hour<=8){
			echo '8:00-21:00数据不更新';
			$this->display();
			die();
		}
		$startID =I('get.startID')?I('get.startID'):1;//起始ID;
		$endID=I('get.endID')?I('get.endID'):1;;//结束ID;
		echo str_pad('',1024);
		$mrobay = D('mrobay');
		$where = ' 1=1';
		if($startID){
			$where .=' AND id>='.$startID;
		}
		if($endID){
			$where .=' AND id<='.$endID;
		}
		$startTime = time();
		set_time_limit(0);   
 		ob_end_clean();
		$upNum=0;
		$addNum=0;
		$wmPrice = D('wmprice');
		$wmPriceData = D('wmprice_data');
		$wmArray = $wmPrice->where($where)->select();
		$total = count($wmArray);
		//if($total){
			//清空yt_msmprice表
		//		M()->query('update yt_msmprice set ishidden=1');
		//}
		foreach($wmArray as $k=>$v){
			echo '开始：id：'.$v['id'].' '.date('Y-m-d H:i:s',time()).'</br>';
			//if($v['Brand']=='NSK'){
			$data =array();
			//$v['xh']='608';
			//$v['pp']='HRB';
			$data = $this->getWmData($v);
		
			if($data){
				//标记已匹配
				if($v['status']==0){
					$wmPrice->where('id='.$v['id'])->setField('status',1);
				}
				foreach($data as $k1=>$v1){
					$newData = array();
					$newData['hpxh']=$v1['hpxh'];
					
					$newData['xh']=preg_replace("/\s+/",' ',$v1['xh']);
					$newData['pp']=str_replace("*","",$v1['pp']);
					$newData['jgbh']=$v1['jgbh'];
					$newData['plsx']=$v1['plsx'];
					$newData['kcsl']=$v1['kcsl'];
					$newData['dj']=$v1['dj'];
					$newData['addtime']=time();
					$current = $wmPriceData->where('hpxh="'.$v1['hpxh'].'" AND xh="'.$v1['xh'].'" AND pp="'.$v1['pp'].'" AND jgbh="'.$v1['jgbh'].'"')->find();
					if($current){
						$newData['ishidden']='0';
						$result =$wmPriceData->where('id='.$current['id'])->save($newData);
						$str = '更新';
						$id  = $current['id']; 
						$typeid=0;
					}else{
						$result = $wmPriceData->add($newData);
						$str = '新增';
						$id  = $result; 	
						$typeid=1;	
					}
					if($result !== false){
						echo $str.'： id:'.$id.'成功</br>';
						if($typeid==0){
							$upNum++;
						}else{
							$addNum++;
						}
					}else{
						echo $str.'： id:'.$id.'失败</br>';
					}
				}
			}else{
				//标记未匹配
				if($v['status']==1){
					$wmPrice->where('id='.$v['id'])->setField('status',0);
				}	
			}
			echo '结束：id：'.$v['id'].' '.date('Y-m-d H:i:s',time()).'</br>';
			$rand = rand(2,3);
			//$rand = 150;
			echo '中断：'.$rand.'s</br>';
			echo '共 '.$total.' 条数据，本次采集更新 '.$upNum.' 条，新增 '.$addNum.' 条，共处理 '.($upNum+$addNum).' 条</br></br>';
			flush(); 
			sleep($rand);
			//die();
		}
		//	}
		
		//}
		$endTime = time();
		echo '共用时'.Sec2Time($endTime-$startTime);
		//pt($busPrice);
		die();
		//$this->display();
		
}	
function updateWmPrice(){
		$hour = date('H',time());
		if($hour>=21 && $hour<=8){
			echo '8:00-21:00数据不更新';
			$this->display();
			die();
		}
		//清空NTN库存
		//M()->query('update yt_mall_ticket set num=0 where ishidden=0 AND brand_id=3 AND huodongtype=0');
		//M()->query('update yt_stock_num set num=0 where  ticket_id IN (select a.id from (select id from yt_mall_ticket where ishidden=0 AND brand_id=3 AND huodongtype=0) a)');
		$startTime = time();
		set_time_limit(0);   
 		ob_end_clean();
		$upNum=0;
		$addNum=0;
		$unup=0;
		$ticketArray=array();
		$mallTicket = D('mallTicket');
		$wmPrice = D('wmprice_data');
		$wmData = $wmPrice->where('ishidden=0 ')->select();

		$stock = D('stockNum');
		$total = count($wmData);
		foreach($wmData as $k=>$v){
			$noid = trim($v['pp']).' '.trim($v['xh']);
			//$noid=str_replace('&','&amp;',$noid);
			$current = $mallTicket->where('ishidden=0   AND huodongtype=0 AND  xh="'.$noid.'"')->find();
			//echo '</br>'.M()->getLastSql().'</br>';
			if($current){
				array_push($ticketArray,$current['id']);
				echo '开始：id：'.$v['id'].' '.date('Y-m-d H:i:s',time()).'</br>';
				$newData = array();
				//$newData['id']=$current['id'];
				//if($hour==8){
					$rand1 = rand(45,65);
					$newData['price']=$v['dj']*(1000+$rand1)/1000;
					$rand = rand(10,15);
					$upPrice = $v['dj']*(100+$rand)/100;
					$newData['oprice']=$upPrice;
					$newData['oprice1']=$upPrice;
				//}
				$newData['num']=$v['kcsl'];
				$result =$mallTicket->where('ishidden=0 AND id='.$current['id'])->save($newData);
				$result1 =$stock->where('stock_id=2  AND ticket_id='.$current['id'])->save($newData);
				$str = '更新';
				
				if($result !== false){
					echo $str.'：mall_id:'.$current['id'].'成功</br>';
					if($v['status']==1){
						$wmPrice->where('id='.$v['id'])->setField('status','0');
					}
					$upNum++;
				}else{
					$addNum++;
					echo $str.'：mall_id:'.$current['id'].'失败</br>';
				}
			}else{
				//标记产品为上架
				if($v['status']==0){
					$wmPrice->where('id='.$v['id'])->setField('status','1');
				}
				$unup++;
				echo '标记：id：'.$v['id'].' '.date('Y-m-d H:i:s',time()).' ， 未上架</br>';
			}
			
			echo '结束：id：'.$v['id'].' '.date('Y-m-d H:i:s',time()).'</br>';
			$rand = rand(200,300);
			$rand = 150;
			echo '中断：'.$rand.'ms</br>';
			echo '共 '.$total.' 条数据，本次采集更新 '.$upNum.' 条，新增 '.$addNum.' 条，标记未上架 '.$unup.' 条，共处理 '.($upNum+$addNum).' 条</br></br>';
			flush(); 
			usleep($rand);
		}
		//统计平台id
		$total_id = $mallTicket->field('id')->where('ishidden=0 and huodongtype=0 AND brand_id=4')->select();
		
		echo '平台ticket_id,共'.count($total_id).':</br>';
		$total_id = i_array_column($total_id, 'id');
		//print_r($total_id);
		echo '更新ticket_id,共'.count($ticketArray).':</br>';
		//print_r($ticketArray);
		$noTicket=array_diff($total_id,$ticketArray);
		echo '差异ticket_id:共'.count($noTicket).'</br>';
		//print_r($noTicket);
		$ticketStr = implode(",",$noTicket);
		echo $ticketStr.'</br>';
		M()->query('update yt_mall_ticket set num=0 where ishidden=0 AND brand_id=4 AND huodongtype=0 AND id IN('.$ticketStr.')');
		M()->query('update yt_stock_num set num=0 where  ticket_id IN (select a.id from (select id from yt_mall_ticket where ishidden=0 AND brand_id=4 AND huodongtype=0 AND id IN('.$ticketStr.')) a)');
		$endTime = time();
		echo '共用时'.Sec2Time($endTime-$startTime);
		//pt($busPrice);
		die();
		//$this->display();
		
}
function gpmroData(){
	
		$serverUrl1 ='http://www.gpmro.com/public/gpmrodata';
		$data = array();
		$data['pwd'] = 'bwc20170519';
		
		$xmlString = $this->CURLRequest($serverUrl1,$data);
		$busData = array();
		$busData =  json_decode($xmlString,TRUE);
		//下面是自己的
		pt($busData);
}

function chazc($id=0){
  
$url2 = 'http://www.chazc.com/quanbu.asp?page='.$id;

//获取登录页的信息   
		//$html = $this-> CURLRequest($url2, $post);  
		$html = $this-> get_content($url2);  
		$html=preg_replace("/[\t\n\r]+/","",$html);  
		//print_r($html);
		$partern='/\<table cellspacing="1" cellpadding="0" width="780" bgcolor="#cccccc"\>(.*)\<\/table\>/is';
	
		preg_match($partern, $html,$data1);
		//print_r($data1);
		$xmlString = preg_replace("/[\t\n\r]+/","",$data1[1]);  
		$data = array();
		$newData = array();
		preg_match_all('/<td.*?>\s*(.*?)\s*<\/td>.*?/is', $xmlString,$data);
		//pt($data);
		//die();
		if($data[1]){
			$totalData = array();
			for($i=0;$i<51;$i++)
			{
			  $totalData[] = array_slice($data[1], $i * 9 ,9);
			}
			
			//pt($totalData);
			array_shift($totalData);
			//pt($totalData);
			//die();
			return $totalData;
		}
	}
	function saveChazc(){
		//$testurl='http://123.206.194.46/Buyweb/PC/Prdt/Pro_details?_prd_no=00000000000000030000';
		set_time_limit(0);   
 		ob_end_clean();
		$startID =1;//起始ID;
		$endID=1153;//结束ID;
		echo str_pad('',1024);
		$chazc = D('chazc');
		$where = ' 1=1';
		//if($startID){
//			$where .=' AND id>='.$startID;
//		}
//		if($endID){
//			$where .=' AND id<='.$endID;
//		}
		$upNum=0;
		$addNum=0;
		//$this->autoLogin();
		//self::$startTime = time();
		for($i=$startID;$i<=$endID;$i++){
			$data = array();
			//$id = sprintf("%020d", $i);
			echo '开始：PAGEID：'.$i.' '.date('Y-m-d H:i:s',time()).'</br>';
			//echo $id;
			$data = $this->chazc($i);
			//die();
			foreach($data as $k => $v){
				$newData = array();
				//foreach($v as $k1=>$v1){
					
					$newData['title'] = strip_tags($v[0]);	
					$newData['xh'] = strip_tags($v[1]);	
					$newData['old_xh'] = strip_tags($v[2]);	
					$newData['nj'] = $v[3];	
					$newData['wj'] = $v[4];	
					$newData['hd'] = $v[5];	
					$newData['brand'] = strip_tags($v[6]);	
					$newData['classname'] = strip_tags($v[7]);	
					$newData['content'] = $v[8];	
					$newData['addtime'] = time();	
				//}
			
			if($newData['title']!=""){
	
			$current = $chazc->where('title="'.$newData['title'].'" AND xh="'.$newData['xh'].'" AND brand="'.$newData['brand'].'" AND classname="'.$newData['classname'].'"')->find();
			if($current){
					$result = $chazc->where('id='.$current['id'])->save($newData);
					if($result !== false){
							echo '更新： ID:'.$current['id'].'成功</br>';
							$upNum++;
					}else{
							echo '更新：ID:'.$current['id'].'失败</br>';
					}
				}else{
					$result = $chazc->add($newData);
					if($result !== false){
						echo '新增：   ID:'.$result.'成功</br>';
						$addNum++;
					}else{
						echo '新增：   ID:'.$result.'失败</br>';
					}			
				}
			}	
			}
			echo '结束：   PAGEID：'.$i.' '.date('Y-m-d H:i:s',time()).'</br>';
			$rand = rand(3,5);
			echo '中断：'.$rand.'S</br>';
			echo '共 '.$total.' 条数据，本次采集更新 '.$upNum.' 条，新增 '.$addNum.' 条，共处理 '.($upNum+$addNum).' 条</br></br>';
			flush(); 
			sleep($rand);
		}		
			
	}	
	function vipmro(){
		set_time_limit(0);   
 		ob_end_clean();
		echo str_pad('',1024);
		$upNum=0;
		$addNum=0;
		echo 111;
		$data = file_get_contents('class2.txt');
		$data = trim($data,chr(239).chr(187).chr(191));
		$dataArray  = json_decode($data,true);
		//print_r($dataArray);
		//if($dataArray['status'] !="ok"){
//			echo '数据采集失败';die();
//		}
		//$zhonghang = D('vipmroClass');
		print_r($dataArray['data']);
		die();
		$total=count($dataArray['data']);
		foreach($dataArray['data'] as $k=>$v){
			echo '开始：cInvCode：'.$v['cInvCode'].' '.date('Y-m-d H:i:s',time()).'</br>';
			$skuData = array();
			$skuData['cInvCode'] =$v['cInvCode'];
			$skuData['cinvstd'] =$v['cinvstd'];
			$skuData['quantity'] =$v['quantity'];
			$skuData['pp'] =$v['pp'];
			$skuData['ck'] =$v['ck'];
			$skuData['price'] =$v['price'];
			$skuData['cinvname'] =$v['cinvname'];
			$skuData['addtime'] =time();
			$current = $zhonghang->where('cInvCode="'.$v['cInvCode'].'" AND cinvstd="'.$v['cinvstd'].'" AND cinvname="'.$v['cinvname'].'"')->find();
			if($current){
				$result = $zhonghang->where('cInvCode="'.$v['cInvCode'].'" AND cinvstd="'.$v['cinvstd'].'" AND cinvname="'.$v['cinvname'].'"')->save($skuData);
				if($result !== false){
							echo '更新： ID:'.$current['id'].'成功</br>';
							$upNum++;
				}else{
							echo '更新：ID:'.$current['id'].'失败</br>';
				}
			}else{
				$result = $zhonghang->add($skuData);
				if($result !== false){
						echo '新增：   ID:'.$result.'成功</br>';
						$addNum++;
				}else{
						echo '新增：   ID:'.$result.'失败</br>';
				}	
			}
			echo '结束：cInvCode：'.$v['cInvCode'].' '.date('Y-m-d H:i:s',time()).'</br>';
			//$rand = rand(200,300);
			$rand = 100;
			echo '中断：'.$rand.'ms</br>';
			echo '共 '.$total.' 条数据，本次采集更新 '.$upNum.' 条，新增 '.$addNum.' 条，标记未上架 '.$unup.' 条，共处理 '.($upNum+$addNum).' 条</br></br>';
			flush(); 
			usleep($rand);
		}
	}
	
	function zydData($id=1){
		$post = array(
			'keyname' => '施耐德',
			'psize' => '50',
			'page' => $id

		);
//pt($post);   
	$url2 = 'http://www.zydmall.com/ashx/search_list.ashx';

	//获取登录页的信息   
	$html = $this->CURLRequest( $url2, $post );
	$html = preg_replace( "/[\t\n\r]+/", "", $html );
	//print_r($html);
	$partern = '/\<tbody id="product_list"\>(.*)\<\/tbody\>/is';
			preg_match($partern, $html,$data1);
			$xmlString = preg_replace("/[\t\n\r]+/","",$data1[1]);  
			$data = array();
			$newData = array();
			preg_match_all('/<td.*?>\s*(.*?)\s*<\/td>.*?/is', $xmlString,$data);
			
			$newData = preg_replace("/<input.*?>/","",$data[1]);
			$newData = preg_replace("/<div.*?>|<\/div>/","",$newData);
			$newData = preg_replace("/\<p class='tipTime'\>填写数量\<\/p\>\<p class='tipTime'\>显示货期\<\/p\>/","",$newData);
			$newData = preg_replace('/\<a class="clear_num"\>清空\<\/a\>/','',$newData);
			$newData = preg_replace("/\<em.*?\>\s*(.*?)\s*\<\/em\>/","",$newData);
			$newData = preg_replace("/<b.*?>|<\/b>/","",$newData);
			$newData = preg_replace("/\<a.*?\><img.*?\/>\s*(.*?)\s*\<\/a\>/","",$newData);
			$newData = preg_replace("/&yen;/","",$newData);
			$newData = preg_replace('/target="_blank"|class="title c333"|title=".*?"/','',$newData);
			$newData = preg_replace("/\<a/","<p",$newData);
			$newData = preg_replace("/\<\/a>/","</p>",$newData);
			$newData = preg_replace("/<\/p>\<p>/","|||",$newData);
			$newData = preg_replace("/\<\/p>/","",$newData);
			$newData = preg_replace('/\<p href="(.*?)"\s*\>/',"$1|||",$newData);
			$newData = preg_replace("/\/detail\/product_|\.html/","",$newData);
			
			//pt($newData);
			
			//die();
			if($newData){
				$totalData = array();
				for($i=0;$i<50;$i++)
				{
				  $totalData[] = array_slice($newData, $i * 7 ,7);
				}

				//pt($totalData);
				//die();
				return $totalData;
			}

		}
	
	//
	function saveZyd(){
		//$testurl='http://123.206.194.46/Buyweb/PC/Prdt/Pro_details?_prd_no=00000000000000030000';
		set_time_limit(0);   
 		ob_end_clean();
		$startID =400;//起始ID;
		$endID=430;//结束ID;
		echo str_pad('',1024);
		$zyd= D('zyd');
		$where = ' 1=1';
		//if($startID){
//			$where .=' AND id>='.$startID;
//		}
//		if($endID){
//			$where .=' AND id<='.$endID;
//		}
		$upNum=0;
		$addNum=0;
		//$this->autoLogin();
		//self::$startTime = time();
		for($i=$startID;$i<=$endID;$i++){
			$data = array();
			//$id = sprintf("%020d", $i);
			echo '开始：PAGEID：'.$i.' '.date('Y-m-d H:i:s',time()).'</br>';
			//echo $id;
			$data = $this->zydData($i);
			//die();
			foreach($data as $k => $v){
				$newData = array();
				//foreach($v as $k1=>$v1){
					$array1 = explode('|||',$v[0]);
					$newData['goods_id'] = trim($array1[0]);
					$newData['title'] = trim($array1[1]);
					$newData['noid'] = trim($array1[2]);
					$newData['xh'] = trim($array1[3]);
					$newData['oprice'] = trim($v[1]);	
					$newData['price'] = trim($v[2]);	
					$newData['stock'] = trim($v[3]);	
					$newData['huoqi'] = trim($v[4]);	
					$newData['num'] = trim($v[5]);			
					$newData['content'] = trim($v[6]);		
					$newData['addtime'] = time();	
				//}
			
			if($newData['title']!=""){
	
			$current = $zyd->where('title="'.$newData['title'].'" AND xh="'.$newData['xh'].'" AND noid="'.$newData['noid'].'" AND goods_id="'.$newData['goods_id'].'"')->find();
			if($current){
					$result = $zyd->where('id='.$current['id'])->save($newData);
					if($result !== false){
							echo '更新： ID:'.$current['id'].'成功</br>';
							$upNum++;
					}else{
							echo '更新：ID:'.$current['id'].'失败</br>';
					}
				}else{
					$result = $zyd->add($newData);
					if($result !== false){
						echo '新增：   ID:'.$result.'成功</br>';
						$addNum++;
					}else{
						echo '新增：   ID:'.$result.'失败</br>';
					}			
				}
			}	
			}
			echo '结束：   PAGEID：'.$i.' '.date('Y-m-d H:i:s',time()).'</br>';
			$rand = rand(10,10);
			echo '中断：'.$rand.'S</br>';
			echo '共 '.$total.' 条数据，本次采集更新 '.$upNum.' 条，新增 '.$addNum.' 条，共处理 '.($upNum+$addNum).' 条</br></br>';
			flush(); 
			sleep($rand);
		}		
			
	}	
	//宜电
	function yidianPrice(){
		$hour = date('H',time());
		if($hour>=21 && $hour<=8){
			echo '8:00-21:00数据不更新';
			$this->display();
			die();
		}
		$startTime = time();
		set_time_limit(0);   
 		ob_end_clean();
		$upNum=0;
		$addNum=0;
		$serverUrl1 ='https://api.yidian-mall.com/interface/index';
		$data = array();
		$data['securityCode'] = 'YDGPM';
		//$data['code'] = 'gpmro1985';
		//$xmlString='';
		$xmlString = $this->CURLRequest($serverUrl1,$data);
		//$xmlString = preg_replace('/\s/', '', $xmlString);
		//$xmlString = '';
		$xmlString = trim($xmlString,chr(239).chr(187).chr(191));
		//$xmlString =iconv('GBK','utf-8//IGNORE',$xmlString);
		//print_r($xmlString);
		$busData = array();
		$busData =  json_decode($xmlString,TRUE);
		
		//print_r($busData);
		//die();
		$data = $busData;
		//pt($data);
		//die();
		$busPrice = D('yidian_price');
		//清空busprie表
		M()->query('update yt_yidian_price set ishidden=1');
		$total = count($data);
		
		foreach($data as $k=>$v){
			$newData = array();
			$newData['pnumber']=$v['pnumber'];
			echo '开始：pnumber：'.$v['pnumber'].' '.date('Y-m-d H:i:s',time()).'</br>';
			$newData['brand']=$v['brand'];
			$newData['model']=$v['model'];
			$newData['price']=$v['price'];//面价
			$newData['cost']=$v['cost'];//价格
			$newData['stock']=$v['stock'];
			$newData['addtime']=time();
			$current = $busPrice->where('brand="'.trim($v['brand']).'" AND pnumber="'.trim($v['pnumber']).'" AND model="'.trim($v['model']).'"')->find();
			echo M()->getLastSql();
			echo '</br>';
			if($current){
				$newData['ishidden']=0;
				$result =$busPrice->where('brand="'.trim($v['brand']).'" AND pnumber="'.trim($v['pnumber']).'" AND model="'.trim($v['model']).'" ')->save($newData);
				$str = '更新';
			}else{
				$result = $busPrice->add($newData);
				$str = '新增';		
			}
			if($result !== false){
				echo $str.'： pnumber:'.$v['pnumber'].'成功</br>';
				$upNum++;
			}else{
				$addNum++;
				echo $str.'： pnumber:'.$v['pnumber'].'失败</br>';
			}
			echo '结束：pnumber：'.$v['pnumber'].' '.date('Y-m-d H:i:s',time()).'</br>';
			$rand = rand(200,500);
			echo '中断：'.$rand.'ms</br>';
			echo '共 '.$total.' 条数据，本次采集更新 '.$upNum.' 条，新增 '.$addNum.' 条，共处理 '.($upNum+$addNum).' 条</br></br>';
			flush(); 
			usleep($rand);
		}
		$endTime = time();
		echo '共用时'.Sec2Time($endTime-$startTime);
		//pt($busPrice);
		die();
		//$this->display();
		
}
///宜电数据
	function dataYidian($id=1){
	
//pt($post);   
	$url = 'https://www.yidian-mall.com/search.html?keywords=%E6%96%BD%E8%80%90%E5%BE%B7&page='.$id;

	//获取登录页的信息   
	//$html = $this->CURLRequest( $url2, $post );
	$html = file_get_contents($url); 
	$html = preg_replace( "/[\t\n\r]+/", "", $html );
	//print_r($html);
	//die();
	$partern = '/\<tbody class="list"\>(.*)\<\/tbody\>/is';
			preg_match($partern, $html,$data1);
			$xmlString = preg_replace("/[\t\n\r]+/","",$data1[1]);  
			$data = array();
			$newData = array();
			preg_match_all('/<td.*?>\s*(.*?)\s*<\/td>.*?/is', $xmlString,$data);
			
			$newData = preg_replace("/<input.*?>/","",$data[1]);
			$newData = preg_replace("/<div.*?>/","",$newData);
			$newData = preg_replace("/<\/div>/","",$newData);
		
			//$newData = preg_replace("/\<p class='tipTime'\>填写数量\<\/p\>\<p class='tipTime'\>显示货期\<\/p\>/","",$newData);
			$newData = preg_replace('/\<a class="clear_num"\>清空\<\/a\>/','',$newData);
			$newData = preg_replace("/\<em.*?\>\s*(.*?)\s*\<\/em\>/","",$newData);
			$newData = preg_replace("/<b.*?>|<\/b>/","",$newData);
			$newData = preg_replace("/\<a.*?\><img.*?\/>\s*(.*?)\s*\<\/a\>/","",$newData);
			$newData = preg_replace("/&yen;/","",$newData);
			$newData = preg_replace('/target="_blank"|class="title c333"|title=".*?"/','',$newData);
			$newData = preg_replace("/\<a/","<p",$newData);
			$newData = preg_replace("/\<\/a>/","</p>",$newData);
			$newData = preg_replace("/<\/p>\<p>/","|||",$newData);
			$newData = preg_replace("/\<\/p>/","",$newData);
			$newData = preg_replace('/\<p href="(.*?)"\s*\>/',"$1|||",$newData);
			$newData = preg_replace("/\/detail\/product_|\.html/","",$newData);
			$newData = preg_replace("/<p.*?>/","",$newData);
			$newData = preg_replace("/<span.*?>/","",$newData);
			$newData = preg_replace("/<\/span>/","",$newData);
			$newData = preg_replace("/<\/button>/","",$newData);
			$newData = preg_replace("/&nbsp;/","",$newData);
			$newData = preg_replace("/\<\!\-\-/","",$newData);
			$newData = preg_replace("/\-\-\>/","",$newData);
			$newData = preg_replace("/订货号：|型号：/","",$newData);
			
			//pt($newData);
			
			//die();
			if($newData){
				$totalData = array();
				for($i=0;$i<10;$i++)
				{
				  $totalData[] = array_slice($newData, $i * 10 ,10);
				}

				//pt($totalData);
				//die();
				return $totalData;
			}

		}
	
	//
	function saveYidian(){
		//$testurl='http://123.206.194.46/Buyweb/PC/Prdt/Pro_details?_prd_no=00000000000000030000';
		set_time_limit(0);   
 		ob_end_clean();
		$startID =1;//起始ID;
		$endID=1112;//结束ID;
		echo str_pad('',1024);
		$zyd= D('data_yidian');
		$where = ' 1=1';
		//if($startID){
//			$where .=' AND id>='.$startID;
//		}
//		if($endID){
//			$where .=' AND id<='.$endID;
//		}
		$upNum=0;
		$addNum=0;
		//$this->autoLogin();
		//self::$startTime = time();
		for($i=$startID;$i<=$endID;$i++){
			$data = array();
			//$id = sprintf("%020d", $i);
			echo '开始：PAGEID：'.$i.' '.date('Y-m-d H:i:s',time()).'</br>';
			//echo $id;
			$data = $this->dataYidian($i);
			//die();
			foreach($data as $k => $v){
				$newData = array();
				//foreach($v as $k1=>$v1){
					$array1 = explode('|||',$v[1]);
					$newData['url'] = trim($array1[0]);
					$newData['title'] = trim($array1[1]);
					$newData['noid'] = trim($array1[2]);
					$newData['xh'] = trim($array1[3]);
					$newData['trueprice'] = trim($v[2]);	
					$newData['cut'] = trim($v[3]);	
					$newData['price'] = trim($v[4]);	
					$newData['num'] = trim($v[5]);
					$newData['qihuo'] = trim($v[6]);			
					$newData['addtime'] = time();	
				//}
			
			if($newData['title']!=""){
	
			$current = $zyd->where('title="'.$newData['title'].'" AND xh="'.$newData['xh'].'" AND noid="'.$newData['noid'].'" AND url="'.$newData['url'].'"')->find();
			if($current){
					$result = $zyd->where('id='.$current['id'])->save($newData);
					if($result !== false){
							echo '更新： ID:'.$current['id'].'成功</br>';
							$upNum++;
					}else{
							echo '更新：ID:'.$current['id'].'失败</br>';
					}
				}else{
					$result = $zyd->add($newData);
					if($result !== false){
						echo '新增：   ID:'.$result.'成功</br>';
						$addNum++;
					}else{
						echo '新增：   ID:'.$result.'失败</br>';
					}			
				}
			}	
			}
			echo '结束：   PAGEID：'.$i.' '.date('Y-m-d H:i:s',time()).'</br>';
			$rand = rand(10,10);
			echo '中断：'.$rand.'S</br>';
			echo '共 '.$total.' 条数据，本次采集更新 '.$upNum.' 条，新增 '.$addNum.' 条，共处理 '.($upNum+$addNum).' 条</br></br>';
			flush(); 
			sleep($rand);
		}		
			
	}	
}
