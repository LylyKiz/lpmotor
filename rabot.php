<?
	$sp=@$_GET['sp'];
	echo "<h2>Поиск на сайте</h2>";
	echo "Вы искали <font color=red>".$sp."</font> найдено: <br><br>";


	$rez=mysql_query("select id,name,pn from t_menu where (vidimost=1) order by pn asc");
	while($rs=mysql_fetch_array($rez)){


		if(f_sqlrezult("select count(*) as sqlresult from t_menu where (id=".$rs['id'].")and(content like '%$sp%')")!=0){
			echo "<b><a href='index.php?r=".$rs["id"]."&sp=$sp'>".$rs["name"]."</a></b>";		
			echo "<br>";	

		}

		

		$rez2=mysql_query("select id,name,pn from t_podmenu where (menu_id=".$rs['id'].") order by pn asc");
		while($rs2=mysql_fetch_array($rez2)){


			if(f_sqlrezult("select count(*) as sqlresult from t_podmenu where (menu_id=".$rs['id'].")and(content like '%$sp%')")!=0){

				echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				echo "<a href='index.php?r=".$rs["id"]."&pm=".$rs2["id"]."&sp=$sp'>".$rs2["name"]."</a>";
				echo "<br>";	
			}else{

				if(f_sqlrezult("select count(*) as sqlresult from t_stranica where (podmenu_id=".$rs2['id'].")and(content like '%$sp%')")!=0){
				echo "<b>".$rs2["name"]."</b>";		
				echo "<br>";	
				};


			};



			if(f_sqlrezult("select count(*) as sqlresult from t_stranica where (podmenu_id=".$rs2['id'].")and(content like '%$sp%')")!=0){

				$rez3=mysql_query("select id,name,pn from t_stranica where (podmenu_id=".$rs2['id'].") order by pn asc");
				while($rs3=mysql_fetch_array($rez3)){
					
					echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
					echo "<a href='index.php?r=-2&pm=".$rs2["id"]."&idstanica=".$rs3["id"]."&make=stranica&sp=$sp'>".$rs3["name"]."</a>";
					echo "<br>";	

				};
	
		

			};



		};
	};




?>