<?php
	session_start();
	include("libs/bootstrap.php");
	$axtp = new XTemplate('view/layout.html');
	if($_POST['logout']){
		$_SESSION['user_login'] = '';
		$f -> redir("{$baseUrl}sign-in");
	}
	if($_POST['btnsearch']){
		$keyword=$_POST['search'];
		if(!empty($keyword) == TRUE){
			$f -> redir("{$baseUrl}search/keyword={$keyword}");
		}
	}
	$sql1 = "SELECT * FROM maintenance WHERE '1=1'";
	$rs1 = $db -> fetchOne($sql1);
	$sql_tov = "SELECT CL.*, CA.* FROM classify CL
				INNER JOIN categories CA ON CL.id_cate = CA.id_cate
				WHERE CA.cate_name = 'Type of Virus'";
	$rs_tov = $db -> fetchAll($sql_tov);
	if($_SESSION['user_login'] == ''){
		if($_SESSION['admin_login'] == '' && $_SESSION['owner_login'] == ''){
			if($rs1['status'] == 1){
				session_unset();
				session_destroy();
				$acontent ='';
				$a=$_GET['a'];
				if(file_exists("controller/home/{$a}.php")){
					include("controller/home/{$a}.php");
					foreach($rs_tov as $row){
						$id_class = $row['id_class'];
						$axtp -> assign('classify_name',$row['classify_name']);
						$sql_virus = "SELECT V.*, CL.* FROM virus V
									INNER JOIN classify CL ON V.id_class = CL.id_class
									WHERE V.id_class LIKE {$id_class}";
						$rs_virus = $db -> fetchAll($sql_virus);
						foreach($rs_virus as $row_virus){
							$virus_name = $row_virus['virus_name'];
							$axtp -> assign('virus_name',$virus_name);
							$axtp -> parse('LAYOUT.HOME.TOV.TOV1');
						}
						$axtp -> parse('LAYOUT.HOME.TOV');
					}
					$axtp -> parse('LAYOUT.HOME.OUTLOG');
					$axtp -> parse('LAYOUT.HOME');
					$axtp -> parse('LAYOUT.CONTACT');
				}
				if(file_exists("controller/{$a}.php")){
					include("controller/{$a}.php");
					foreach($rs_tov as $row){
						$id_class = $row['id_class'];
						$axtp -> assign('classify_name',$row['classify_name']);
						$sql_virus = "SELECT V.*, CL.* FROM virus V
									INNER JOIN classify CL ON V.id_class = CL.id_class
									WHERE V.id_class LIKE {$id_class}";
						$rs_virus = $db -> fetchAll($sql_virus);
						foreach($rs_virus as $row_virus){
							$virus_name = $row_virus['virus_name'];
							$axtp -> assign('virus_name',$virus_name);
							$axtp -> parse('LAYOUT.HOME.TOV.TOV1');
						}
						$axtp -> parse('LAYOUT.HOME.TOV');
					}
					$axtp -> parse('LAYOUT.HOME.OUTLOG');
					$axtp -> parse('LAYOUT.HOME');
					$axtp -> parse('LAYOUT.CONTACT');
				}
				if(file_exists("controller/menu/{$a}.php")){
					$f -> redir("{$baseUrl}home");
				}
				$axtp -> assign('acontent',$acontent);
				$axtp -> assign('baseUrl',$baseUrl);
				$axtp -> parse('LAYOUT');
				$axtp -> out('LAYOUT');
			}
			else if($rs1['status'] == 0){
				$f -> redir("{$baseUrl}maintenance");
			}
		}
		else{
			if($rs1['status'] == 1){
				$acontent ='';
				$a=$_GET['a'];
				if(file_exists("controller/home/{$a}.php")){
					include("controller/home/{$a}.php");
					foreach($rs_tov as $row){
						$id_class = $row['id_class'];
						$axtp -> assign('classify_name',$row['classify_name']);
						$sql_virus = "SELECT V.*, CL.* FROM virus V
									INNER JOIN classify CL ON V.id_class = CL.id_class
									WHERE V.id_class LIKE {$id_class}";
						$rs_virus = $db -> fetchAll($sql_virus);
						foreach($rs_virus as $row_virus){
							$virus_name = $row_virus['virus_name'];
							$axtp -> assign('virus_name',$virus_name);
							$axtp -> parse('LAYOUT.HOME.TOV.TOV1');
						}
						$axtp -> parse('LAYOUT.HOME.TOV');
					}
					$axtp -> parse('LAYOUT.HOME.OUTLOG');
					$axtp -> parse('LAYOUT.HOME');
					$axtp -> parse('LAYOUT.CONTACT');
				}
				if(file_exists("controller/{$a}.php")){
					include("controller/{$a}.php");
					foreach($rs_tov as $row){
						$id_class = $row['id_class'];
						$axtp -> assign('classify_name',$row['classify_name']);
						$sql_virus = "SELECT V.*, CL.* FROM virus V
									INNER JOIN classify CL ON V.id_class = CL.id_class
									WHERE V.id_class LIKE {$id_class}";
						$rs_virus = $db -> fetchAll($sql_virus);
						foreach($rs_virus as $row_virus){
							$virus_name = $row_virus['virus_name'];
							$axtp -> assign('virus_name',$virus_name);
							$axtp -> parse('LAYOUT.HOME.TOV.TOV1');
						}
						$axtp -> parse('LAYOUT.HOME.TOV');
					}
					$axtp -> parse('LAYOUT.HOME.OUTLOG');
					$axtp -> parse('LAYOUT.HOME');
					$axtp -> parse('LAYOUT.CONTACT');
				}
				if(file_exists("controller/menu/{$a}.php")){
					$f -> redir("{$baseUrl}home");
				}
				$axtp -> assign('acontent',$acontent);
				$axtp -> assign('baseUrl',$baseUrl);
				$axtp -> parse('LAYOUT');
				$axtp -> out('LAYOUT');
			}
			else if($rs1['status'] == 0){
				$f -> redir("{$baseUrl}maintenance");
			}
			
		}
	}else{
		if($rs1['status'] == 1){
			$acontent ='';
			$bcontent ='';
			$a=$_GET['a'];
			if(file_exists("controller/home/{$a}.php")){
				include("controller/home/{$a}.php");
				foreach($rs_tov as $row){
						$id_class = $row['id_class'];
						$axtp -> assign('classify_name',$row['classify_name']);
						$sql_virus = "SELECT V.*, CL.* FROM virus V
									INNER JOIN classify CL ON V.id_class = CL.id_class
									WHERE V.id_class LIKE {$id_class}";
						$rs_virus = $db -> fetchAll($sql_virus);
						foreach($rs_virus as $row_virus){
							$virus_name = $row_virus['virus_name'];
							$axtp -> assign('virus_name',$virus_name);
							$axtp -> parse('LAYOUT.HOME.TOV.TOV1');
						}
						$axtp -> parse('LAYOUT.HOME.TOV');
					}
				$axtp -> parse('LAYOUT.HOME.INLOG');
				$axtp -> parse('LAYOUT.HOME');
				$axtp -> parse('LAYOUT.CONTACT');
				$axtp -> assign('acontent',$acontent);
			}
			if(file_exists("controller/{$a}.php")){
				include("controller/{$a}.php");
				foreach($rs_tov as $row){
						$id_class = $row['id_class'];
						$axtp -> assign('classify_name',$row['classify_name']);
						$sql_virus = "SELECT V.*, CL.* FROM virus V
									INNER JOIN classify CL ON V.id_class = CL.id_class
									WHERE V.id_class LIKE {$id_class}";
						$rs_virus = $db -> fetchAll($sql_virus);
						foreach($rs_virus as $row_virus){
							$virus_name = $row_virus['virus_name'];
							$axtp -> assign('virus_name',$virus_name);
							$axtp -> parse('LAYOUT.HOME.TOV.TOV1');
						}
						$axtp -> parse('LAYOUT.HOME.TOV');
					}
				$axtp -> parse('LAYOUT.HOME.INLOG');
				$axtp -> parse('LAYOUT.HOME');
				$axtp -> parse('LAYOUT.CONTACT');
				$axtp -> assign('acontent',$acontent);
			}
			if(file_exists("controller/menu/{$a}.php")){
				include("controller/menu/{$a}.php");
				$sql = "SELECT * FROM accounts WHERE id_acc = {$_SESSION['user_id']}";
				$rs  = $db -> fetchOne($sql);
				$axtp -> assign('pro_img',$baseUrl.$rs['url_avatar']);
				$axtp -> assign('display_name',$rs['display_name']);
				$axtp -> assign('bcontent',$bcontent);
				$axtp -> parse('LAYOUT.CONTROL');
			}
			$axtp -> assign('baseUrl',$baseUrl);
			$axtp -> parse('LAYOUT');
			$axtp -> out('LAYOUT');
		}
		else if($rs1['status'] == 0){
			$f -> redir("{$baseUrl}maintenance");
		}
	}