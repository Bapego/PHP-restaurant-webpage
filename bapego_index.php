
<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>Honest Food a Hotels and Restaurants Category  Flat Bootstrap Responsive Website Template</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Honest Food Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola web design" />
<script type="applisalonion/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<link href="css/iconeffects.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />	
<link rel="stylesheet" href="css/swipebox.css">
<script src="js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<!--/web-font-->
	<link href='//fonts.googleapis.com/css?family=Italianno' rel='stylesheet' type='text/css'>
	<link href='//fonts.googleapis.com/css?family=Merriweather+Sans:400,300,700' rel='stylesheet' type='text/css'>
<!--/script-->

<script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){		
					event.preventDefault();
					$('html,body').animate({scrollTop:$(this.hash).offset().top},900);
				});
			});
</script>

<!-- swipe box js -->
	<script src="js/jquery.swipebox.min.js"></script> 
	    <script type="text/javascript">
			jQuery(function($) {
				$(".swipebox").swipebox();
			});
	</script>
<!-- //swipe box js -->
<!--animate-->
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
	<script>
		 new WOW().init();
	</script>
	
 <style>
#h12 {
  padding: 50px 0;
  font-weight: 400;
  text-align: center;
}

#p2 {
  margin: 0 0 0px;
  line-height: 1.5;
}

#main2 {
  min-width: 320px;
  max-width: 1000px;
  padding: 50px;
  margin: 0 auto;
  background: #fff;
}

section {
  display: none;
  padding: 20px 0 0;
  border-top: 1px solid #ddd;
}

#label2 {
  display: inline-block;
  margin: 0 0 -1px;
  padding: 15px 25px;
  font-weight: 600;
  text-align: right;
  color: #bbb;
  border: 1px solid transparent;
}



#label2:hover {
  color: #888;
  cursor: pointer;
}

input:checked + #label2 {
  color: #555;
  border: 1px solid #ddd;
  border-top: 2px solid orange;
  border-bottom: 1px solid #fff;
}
#tab1, #tab2, #tab3,#tab4, #tab5, #tab6,#tab7{
  display: none;}
#tab1:checked ~ #content1,
#tab2:checked ~ #content2,
#tab3:checked ~ #content3,
#tab4:checked ~ #content4,
#tab5:checked ~ #content5,
#tab6:checked ~ #content6,
#tab7:checked ~ #content7 {
  display: block;
}	

  #label2:before {
    margin: 0;
    font-size: 18px;
  }

#cookieConsent {
    background-color: rgba(20,20,20,0.8);
    min-height: 26px;
    font-size: 14px;
    color: white;
    line-height: 26px;
    padding: 8px 0 8px 30px;
    font-family: "Trebuchet MS",Helvetica,sans-serif;
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    display: block;
    z-index: 9999;
}
#cookieConsent a {
    color: white;
    text-decoration: none;
	background-color: #F1D600;
    color: #000;
    display: inline-block;
    border-radius: 5px;

}
#closeCookieConsent {
    float: right;
    display: inline-block;
    cursor: pointer;
    margin: -15px 10px 0 0;
    font-weight: bold;
}
#closeCookieConsent:hover {
    color: white;
}

</style>

<?php
	session_start();
	require_once('bapego_functions.php');
	$connect=dbconnect();
	
?>
<?php
	if(isset($_COOKIE["userID"]))
	{
		
		$cookie = 1;
		$sql='SELECT * FROM bapego_trackings WHERE userID=\''.$_COOKIE["userID"].'\'';
		$query=pg_query($connect, $sql);
		$record=pg_fetch_all($query);
		
		//print "<script>alert(\"".$record["\"counter\""]."\")</script>";
		//print ("<script>alert(\"".$counter."\")</script>");
		foreach($record as $admin)
		{
			$a = 0;
			foreach($admin as $ertek)
			{
				
				$a++;
				if($a===2) $counter = $ertek;
			}
		}
		$counter++;
		$sql ='UPDATE bapego_trackings SET counter=(\''.$counter.'\') WHERE userID=\''.$_COOKIE["userID"].'\'';
		pg_query($connect, $sql);
		
			
		setcookie("visitCount", $counter, time()+1000000);
	
	}
	else
	{
			$connect=dbconnect();
					$cookie=0;
					$success = true;
					while($success)
					{
						//id generálás
						$karakterek='0123456789';
						$hossz=mb_strlen($karakterek);
						$id="";
						$darab=rand(30,40);
						for ($i=0;$i<$darab;$i++)
						{
							$id.=mb_substr($karakterek,rand(0,$hossz-1),1);
						}
						
						$sql='SELECT * FROM bapego_trackings WHERE userID=\''.$id.'\'';
						$query=pg_query($connect, $sql);
						

						if(pg_numrows($query)===0){
							$sql='INSERT INTO bapego_trackings (userID, counter) VALUES (\''.$id.'\',\'1\')';
							pg_query($connect,$sql);
						

							setcookie("userID", $id, time()+1000000);	
							setcookie("visitCount", 1, time()+1000000);
							$success = false;
						}
					}
					
				}

?>

</head>

<body>	
<!--start-home-->
	<div <?php if($cookie==1)print 'style="display:none;"';else print 'id="cookieConsent"'; ?> >
			<div id="closeCookieConsent">x</div>  
			Ez a weblap Cookie-kat használ az ön kényelmesebb böngészése érdekében. Ezen kívül névtelen adatokat gyűjtünk a böngészési szokások feltérképezése miatt. Ezen adatokat név nélkül táruljok és csak is statisztikai célokra. Soha nem adjuk oda harmadik félnek. A honlap használatával elfogadja a felsoroltakar. A cookie-kat bármikor törölheti a böngészőjén keresztül.   <a style="padding: 0 20px;color: black;cursor: pointer;float: right;margin: 0 60px 0 10px;" href="https://www.adatvedelmiszakerto.hu/2010/10/cookie-es-adatvedelem-felhasznalok-nyomokovetese-az-interneten/">Tudj meg többet!</a>
			<input style="padding: 0 20px;color:black;cursor: pointer;float: right;margin: 0 60px 0 10px;" type="submit" value="Rendben" id="closeCookieConsent">
		</div>

		<div class="banner" id="home">
		<div class="header-bottom wow slideInDown"  data-wow-duration="1s" data-wow-delay=".3s">
		
		     <div class="container">
			  <div class="fixed-header">
			  <!--cookie-->
			  
		<!--cookieEND-->
			      <!--logo-->
			       <div class="logo">
                      <a href="index.html"><h1>H<span>onest Food</span></h1></a>
					  <p>A valódi íz</p>
				   </div>
					<!--//logo-->
					<div class="top-menu">
							<span class="menu"> </span>
							<nav class="link-effect-4" id="link-effect-4">
                              <ul>
								 <li class="active"><a data-hover="Kezdőlap" href="index.html">Kezdőlap</a></li>
								<li><a data-hover="Rólunk" href="#about" class="scroll">Rólunk</a></li>
								<li><a data-hover="Szolgáltatásaink" href="#services" class="scroll">Szolgáltatásaink</a></li>
								<li><a data-hover="Séfeink" href="#team" class="scroll">Séfeink</a></li>
								<li><a data-hover="Menü" href="#menu" class="scroll">Menü</a></li>
							    <li><a data-hover="Foglalás" href="#reservation" class="scroll">Foglalás</a></li>
							    <li><a data-hover="Galéria" href="#gallery" class="scroll">Galéria</a></li>
								<li><a data-hover="Kapcsolat" href="#contact" class="scroll">Kapcsolat</a></li>

								</ul>
							</nav>
							</div>
							<!-- script-for-menu -->
								<script>
									$("span.menu").click(function(){
										$(".top-menu ul").slideToggle("slow" , function(){
										});
									});
								</script>
								<!-- script-for-menu -->

				 <div class="clearfix"></div>
					<script>
				$(document).ready(function() {
					 var navoffeset=$(".header-bottom").offset().top;
					 $(window).scroll(function(){
						var scrollpos=$(window).scrollTop(); 
						if(scrollpos >=navoffeset){
							$(".header-bottom").addClass("fixed");
						}else{
							$(".header-bottom").removeClass("fixed");
						}
					 });
					 
				});
				</script>
			 </div>
		</div>
	</div>
		<div class="banner-slider">
				<div class="callbacks_container">
					<ul class="rslides" id="slider4">
					    <li>
						   <div class="banner-info">
							      <h3 class="wow slideInUp"  data-wow-duration="1s" data-wow-delay=".3s">Üdvözöli Önt a</h3>
								  <p class="wow slideInDown"  data-wow-duration="1s" data-wow-delay=".3s">HONEST FOOD</p>
								     <div class="arrows wow slideInDown"  data-wow-duration="1s" data-wow-delay=".2s"><img src="images/border.png" alt="border"/></div>
								 <span class="wow slideInUp"  data-wow-duration="1s" data-wow-delay=".3s">LÉGY NYITOTT AZ ÚJRA</span>
							  </div>
						</li>
						<li>
						   <div class="banner-info">
							    <h3 class="wow slideInUp"  data-wow-duration="1s" data-wow-delay=".3s">Csodálatos</h3>
								 <p class="wow slideInDown"  data-wow-duration="1s" data-wow-delay=".3s">FŰSZER KEVERÉKEK</p>
								  <div class="arrows wow slideInDown"  data-wow-duration="1s" data-wow-delay=".2s"><img src="images/border.png" alt="border"/></div>
								 <span class="wow slideInUp"  data-wow-duration="1s" data-wow-delay=".3s">LÉGY NYITOTT AZ ÚJRA</span>
							  </div>
						</li>
						<li>
						   <div class="banner-info">
							      <h3 class="wow slideInUp"  data-wow-duration="1s" data-wow-delay=".3s">Ínycsiklandozó</h3>
								  <p class="wow slideInDown"  data-wow-duration="1s" data-wow-delay=".3s">ÉTEL KÜLÖNLEGESSÉGEK</p>
								   <div class="arrows wow slideInDown"  data-wow-duration="1s" data-wow-delay=".2s"><img src="images/border.png" alt="border"/></div>
								   <span class="wow slideInUpslideInLeft"  data-wow-duration="1s" data-wow-delay=".3s">LÉGY NYITOTT AZ ÚJRA</span>
						   </div>
					  </li>
					</ul>
			  </div>
		<!--banner Slider starts Here-->
	  	<script src="js/responsiveslides.min.js"></script>
			 <script>
			    // You can also use "$(window).load(function() {"
			    $(function () {
			      // Slideshow 4
			      $("#slider4").responsiveSlides({
			        auto: true,
			        pager:true,
			        nav:false,
			        speed: 500,
			        namespace: "callbacks",
			        before: function () {
			          $('.events').append("<li>before event fired.</li>");
			        },
			        after: function () {
			          $('.events').append("<li>after event fired.</li>");
			        }
			      });
			
			    });
			  </script>
	      <!--banner Slider starts Here-->
		 </div>

		 <div class="down"><a class="scroll" href="#services"><img src="images/down.png" alt=""></a></div>
	</div>

<!--/products-->
		  <div class="about" id="about">
		     <div class="container">
			 <!--/about-section-->
			   <div class="about-section">
				<div class="col-md-7 ab-left">
				  <div class="grid">
			        <div class="h-f wow slideInLeft"  data-wow-duration="1s" data-wow-delay=".2s">
					<figure class="effect-jazz">
					<img src="images/s1.jpg" alt="img25"/>
						<figcaption>
							<h4>Honest <span>Food</span></h4>
							<p>"Az étel arra van, hogy jókedvűek legyünk tőle."<br>	Virginia Macgregor</p>
							
						</figcaption>			
					</figure>
					
				 </div>
				 <div class="h-f wow slideInLeft"  data-wow-duration="1s" data-wow-delay=".2s">
					<figure class="effect-jazz">	
						<img src="images/s2.jpg" alt="img25"/>
						<figcaption>
							<h4>Honest <span>Food</span></h4>
							<p>"Amikor a bátorság fogyóban, a fűszeres étel a legkiválóbb utánpótlás, mert feltüzeli a lelket."<br>Murakami Rjú</p>
							
						</figcaption>			
					</figure>
					
				 </div>
				 <div class="clearfix"> </div>
				 </div>
			   </div>
			   <div class="col-md-5 ab-text">
			             <h3 class="tittle wow slideInDown"  data-wow-duration="1s" data-wow-delay=".3s">Üdvözöljük</h3>
						  <div class="arrows-two wow slideInDown"  data-wow-duration="1s" data-wow-delay=".5s"><img src="images/border.png" alt="border"/></div>
						  <p class="wow slideInUp"  data-wow-duration="1s" data-wow-delay=".3s">Üdvözöljük éttermünkben, ahol az izlelőbinbóké a főszerep. Jöjjen el kényeztesse magát...a legfinomabb ételeinkel. Legyen nyitott és kezdjen bele egy fantasztikus utazásba, az ízek birodalmában!</p>

					</div>
					<div class="clearfix"> </div>
			 </div>
			  <!--//about-section-->
			  <!--/about-section2-->
			   <div class="about-section">
			        <div class="col-md-5 ab-text two">
			             <h3 class="tittle wow slideInDown"  data-wow-duration="1s" data-wow-delay=".3s">Rólunk</h3>
						 <div class="arrows-two wow slideInDown"  data-wow-duration="1s" data-wow-delay=".5s"><img src="images/border.png" alt="border"/></div>
						  <p class="wow slideInUp"  data-wow-duration="1s" data-wow-delay=".3s">Éttermünk, még 1882-ben alakult azzal a céllal, hogy a különleges ételeivel lenyűgözze az embereket. Csak igazi ízek, igazi ínyenceknek! Minden meegtalál itt, ami, csak, hogy párat említsek, szem, szájnak ingere.</p>

					</div>
						<div class="col-md-7 ab-left">
				  <div class="grid">
			        <div class="h-f  wow slideInRight"  data-wow-duration="1s" data-wow-delay=".2s">
					<figure class="effect-jazz">
					<img src="images/s4.jpg" alt="img25"/>
						<figcaption>
							<h4>Honest <span>Food</span></h4>
							<p>"Az étel ha jól néz ki, az jó. Ha finom is az még jobb. És ha mind a kettő, az a legjobb."<br>Baráth Péter</p>
							
						</figcaption>			
					</figure>
					
				 </div>
				 <div class="h-f  wow slideInRight"  data-wow-duration="1s" data-wow-delay=".2s">
					<figure class="effect-jazz">
						<img src="images/s3.jpg" alt="img25"/>
						<figcaption>
							<h4>Honest <span>Food</span></h4>
							<p>"A szerelem olyan, mint az étel vagy az ital. Lehet ezek nélkül élni?"<br>Henri Charriére</p>
						
						</figcaption>			
					</figure>
					
				 </div>
				 <div class="clearfix"> </div>
				 </div>
			   </div>
					<div class="clearfix"> </div>
			 </div>
			  <!--//about-section2-->
			</div>
	     </div>
<!--//products-->
<!-- service-type-grid -->
	<div class="service" id="services">
		<div class="container">
		    <h3 class="tittle">Szolgáltatásaink</h3>
			<div class="arrows-serve"><img src="images/border.png" alt="border"></div>
				<div class="inst-grids">
					<div class="col-md-3 services-gd text-center wow slideInLeft"  data-wow-duration="1s" data-wow-delay=".3s">
						<div class="hi-icon-wrap hi-icon-effect-9 hi-icon-effect-9a">
							<a href="#" class="hi-icon"><img src="images/serve1.png" alt=" " /></a>
						</div>
						<h4>Ínycsiklandozó ételek</h4>
						 <p>Tekintse meg ételeinket és válasszon már azelőtt, hogy idejön.</p>
					</div>
					<div class="col-md-3 services-gd text-center wow slideInDown"  data-wow-duration="1s" data-wow-delay=".2s">
						<div class="hi-icon-wrap hi-icon-effect-9 hi-icon-effect-9a">
							<a href="#" class="hi-icon"><img src="images/serve2.png" alt=" " /></a>
						</div>
						<h4>Asztal foglalás</h4>
						 <p>Foglaljon asztalt. Ajánlott 4 héttel az étkezés előtt lefoglalni az asztalt!</p>
					</div>
					<div class="col-md-3 services-gd text-center wow slideInUp"  data-wow-duration="1s" data-wow-delay=".2s">
						<div class="hi-icon-wrap hi-icon-effect-9 hi-icon-effect-9a">
							<a href="#" class="hi-icon"><img src="images/serve3.png" alt=" " /></a>
						</div>
						<h4>Nagyszerű receptek</h4>
						 <p>Nálunk semmi nem titok! Ha Ön hozzánk jön, igény szerint, odaadjuk önnek a különleges recepteinkből egyet. </p>
					</div>
					<div class="col-md-3 services-gd text-center wow slideInRight"  data-wow-duration="1s" data-wow-delay=".3s">
						<div class="hi-icon-wrap hi-icon-effect-9 hi-icon-effect-9a">
							<a href="#" class="hi-icon"><img src="images/serve4.png" alt=" " /></a>
						</div>
						<h4>Fűszer receptek</h4>
						 <p>Ezen kívül, minden idelátogatónak ajándékozunk egy fűszercsomagot és egy ahhoz tartozó fűszerkeverési leírást.</p>
					</div>
					<div class="clearfix"> </div>		
				</div>

		</div>
	</div>
<!-- //service-type-grid -->
 <!--start-services-->
	<div class="team-section" id="team">
	 	  <div class="container">
		  <h3 class="tittle">Séfeink</h3>
		  <div class="arrows-serve"><img src="images/border.png" alt="border"></div>
	 		<div class="box2">
	 		   <div class="col-md-3 s-1 wow slideInLeft" data-wow-duration="1s" data-wow-delay=".3s">
			   <a href="#">
	 		   	<div class="view view-fifth">
                    <img src="images/chef1.jpg" alt="chef">
                    <div class="mask">
                        <h4>Wilson Jang</h4>
                        <p>15 éve nálunk dolgozó Jang, az ételek nagymestere. Ő a főséf. </p>
                     </div>
                   
				    </div>
				  </a>
			<h3>Wilson</h3>
				</div>
		<div class="col-md-3 s-2 wow slideInLeft" data-wow-duration="1s" data-wow-delay=".3s">
		<a href="#">
	 		   	<div class="view view-fifth">
                      <img src="images/chef2.jpg" alt="chef">
                       <div class="mask">
                        <h4>Blank Viktória</h4>
                        <p>A fűszerkeverékek királynője. Nincs olyan fűszer melyet ne ismerne vagy ne tudna bekeverni.</p>
                     </div>
               
				    </div>
				  </a>
				<h3>Viktória</h3>
				</div>
			  <div class="col-md-3 s-3 wow slideInRight" data-wow-duration="1s" data-wow-delay=".3s">
			  <a href="#">
	 		   	<div class="view view-fifth">
                     <img src="images/chef3.jpg" alt="chef">
                    <div class="mask">
                        <h4>Jazz József</h4>
                        <p>Mislen csillagos séf, melyet még a nagy Auguste Gusteau mellett szerzett meg.</p>                    
                     </div>
                  
				    </div>
				  </a>
					<h3>Mr.Jazz</h3>
				</div>
				<div class="col-md-3 s-4 wow slideInRight" data-wow-duration="1s" data-wow-delay=".3s">
				 <a href="#">
	 		   	 <div class="view view-fifth">
                      <img src="images/chef4.jpg" alt="chef">
                    <div class="mask">
                        <h4>Kováts Tünde</h4>
                        <p>Előző évben aranyséf nyertesünk, már 10 éve hű szolgája az igazi ízeknek.</p>
                     </div>
                   
				    </div>
				  </a>
					<h3>Tünde</h3>
				</div>
				<div class="clearfix"></div>
		     </div>
	 	    </div>
	 	</div>
<!--end-team-->

<!--start-banner-bottom-->
   <!--/reviews-->
	<div id="review" class="reviews">
			   <div class="col-md-6 test-left-img">
			   </div>
				<div class="col-md-6 test-monials">
					<h3 class="tittle">Visszajelzések</h3>
					<div class="arrows-serve test"><img src="images/border.png" alt="border"></div>
				<!--//screen-gallery-->
						<div class="sreen-gallery-cursual">
							 <!-- required-js-files-->
							<link href="css/owl.carousel.css" rel="stylesheet">
							    <script src="js/owl.carousel.js"></script>
							        <script>
							    $(document).ready(function() {
							      $("#owl-demo").owlCarousel({
							        items : 1,
							        lazyLoad : true,
							        autoPlay : true,
							        navigation : false,
							        navigationText :  false,
							        pagination : true,
							      });
							    });
							    </script>
								 <!--//required-js-files-->
						       <div id="owl-demo" class="owl-carousel">
					                 <div class="item-owl">
					                		<div class="test-review">
											   <p class="wow fadeInUp"  data-wow-duration=".8s" data-wow-delay=".4s"><img src="images/left-quotes.png" alt=""> Oh my god...This is fantastic. Én lenni nagyon elégedett.  <img src="images/right-quotes.png" alt=""></p>
						                	  <img src="images/t3.jpg" class="img-responsive" alt=""/>
											  <h5 class="wow bounceIn"  data-wow-duration=".8s" data-wow-delay=".2s">Gordon Rimsiy</h5>
					                	    </div>
					                </div>
					                 <div class="item-owl">
					                	<div class="test-review">
										 <p class="wow fadeInUp"  data-wow-duration=".8s" data-wow-delay=".4s"> <img src="images/left-quotes.png" alt="">Annyira fantasztikus, hogy nem tudok mit mondani. Gratulálok!<img src="images/right-quotes.png" alt=""></p>
						                	<img src="images/t2.jpg" class="img-responsive" alt=""/>
											 <h5 class="wow bounceIn"  data-wow-duration=".8s" data-wow-delay=".2s">Dennis A. Commis</h5>
					                	</div>
					                </div>
					                 <div class="item-owl">
					                	<div class="test-review">
										     <p class="wow fadeInUp"  data-wow-duration=".8s" data-wow-delay=".4s"><img src="images/left-quotes.png" alt="">Hihetetlenül finomak az ételek, a különlegességek pedig, hogy meglepően különlegesek! Mindenkinek teljes szívből ajánlom!<img src="images/right-quotes.png" alt=""></p>
						                	<img src="images/t1.jpg" class="img-responsive" alt=""/>
											 <h5 class="wow bounceIn"  id="menu" ata-wow-duration=".8s" data-wow-delay=".2s">Tom Hanks Junior</h5>
					                	</div>
					                </div>
				              </div>
						<!--//screen-gallery-->
					</div>
				</div>
				<div class="clearfix"> </div>
		</div>
<!--//reviews-->

<!--Heti menü-->	
	<div class="team-section" id="team">
	 	  <div class="container">
		  <h3 class="tittle">Heti menü</h3>
		  <div class="arrows-serve"><img src="images/border.png" alt="border"></div>
	 		<main id="main2">
  
  <input id="tab1" type="radio" name="tabs" <?php if(date("l")==="Monday") print 'checked'; ?>>
  <label id ="label2" for="tab1">Hétfő</label>
    
  <input id="tab2" type="radio" name="tabs" <?php if(date("l")==="Tuesday") print 'checked'; ?>>
  <label id ="label2" for="tab2">Kedd</label>
    
  <input id="tab3" type="radio" name="tabs" <?php if(date("l")==="Wednesday") print 'checked'; ?>>
  <label id ="label2" for="tab3">Szerda</label>
    
  <input id="tab4" type="radio" name="tabs" <?php if(date("l")==="Thursday") print 'checked'; ?>>
  <label id ="label2" for="tab4">Csütörtök</label>
  
  <input id="tab5" type="radio" name="tabs" <?php if(date("l")==="Friday") print 'checked'; ?>>
  <label id ="label2" for="tab5">Péntek</label>
  
  <input id="tab6" type="radio" name="tabs" <?php if(date("l")==="Saturday") print 'checked'; ?>>
  <label id ="label2" for="tab6">Szombat</label>
  
  <input id="tab7" type="radio" name="tabs" <?php if(date("l")==="Sunday") print 'checked'; ?>>
  <label id ="label2" for="tab7">Vasárnap</label>
    
  <section id="content1">
    <p id="p2">
	<?php
      $sql="SELECT * FROM bapego_menu WHERE id=1";
					$query=pg_query($connect, $sql);
					$result = pg_fetch_all($query);
					$dailyMenu = "";

						$dailyMenu = "<h1 style=\"font-weight: bold;\">Leves:</h1>";
						if(isset($result[0]["soup"])){
							$dailyMenu .= "<h2>".$result[0]["soup"]."  -  ".$result[0]["soupprice"]." Ft<h2><br>";
						}else{
							$dailyMenu .= "-<br>";
						}

						$dailyMenu .= "<h1 style=\"font-weight: bold;\">Főétel:</h1>";
						$dailyMenu .= "<h2>".$result[0]["main"]."  -  ".$result[0]["mainprice"]." Ft<h2><br>";

						$dailyMenu .= "<h1 style=\"font-weight: bold;\">Desszert:</h1>";
						if(isset($result[0]["dessert"])){
							$dailyMenu .= "<h2>".$result[0]["dessert"]."  -  ".$result[0]["dessertprice"]." Ft<h2><br>";
						}else{
							$dailyMenu .= "-<br>";
						}
					print '<div class="box">';
					print '<br>';
					print $dailyMenu;
					print '</div>';
	?>			
    </p>
  </section>    
  <section id="content2">
    <p id="p2">
      <?php
      $sql="SELECT * FROM bapego_menu WHERE id=2";
					$query=pg_query($connect, $sql);
					$result = pg_fetch_all($query);
					$dailyMenu = "";

						$dailyMenu = "<h1 style=\"font-weight: bold;\">Leves:</h1>";
						if(isset($result[0]["soup"])){
							$dailyMenu .= "<h2>".$result[0]["soup"]."  -  ".$result[0]["soupprice"]." Ft<h2><br>";
						}else{
							$dailyMenu .= "-<br>";
						}

						$dailyMenu .= "<h1 style=\"font-weight: bold;\">Főétel:</h1>";
						$dailyMenu .= "<h2>".$result[0]["main"]."  -  ".$result[0]["mainprice"]." Ft<h2><br>";

						$dailyMenu .= "<h1 style=\"font-weight: bold;\">Desszert:</h1>";
						if(isset($result[0]["dessert"])){
							$dailyMenu .= "<h2>".$result[0]["dessert"]."  -  ".$result[0]["dessertprice"]." Ft<h2><br>";
						}else{
							$dailyMenu .= "-<br>";
						}
					print '<div class="box">';
					print '<br>';
					print $dailyMenu;
					print '</div>';
	?>	
    </p>
  </section>    
  <section id="content3">
    <p id="p2">
      <?php
      $sql="SELECT * FROM bapego_menu WHERE id=3";
					$query=pg_query($connect, $sql);
					$result = pg_fetch_all($query);
					$dailyMenu = "";

						$dailyMenu = "<h1 style=\"font-weight: bold;\">Leves:</h1>";
						if(isset($result[0]["soup"])){
							$dailyMenu .= "<h2>".$result[0]["soup"]."  -  ".$result[0]["soupprice"]." Ft<h2><br>";
						}else{
							$dailyMenu .= "-<br>";
						}

						$dailyMenu .= "<h1 style=\"font-weight: bold;\">Főétel:</h1>";
						$dailyMenu .= "<h2>".$result[0]["main"]."  -  ".$result[0]["mainprice"]." Ft<h2><br>";

						$dailyMenu .= "<h1 style=\"font-weight: bold;\">Desszert:</h1>";
						if(isset($result[0]["dessert"])){
							$dailyMenu .= "<h2>".$result[0]["dessert"]."  -  ".$result[0]["dessertprice"]." Ft<h2><br>";
						}else{
							$dailyMenu .= "-<br>";
						}
					print '<div class="box">';
					print '<br>';
					print $dailyMenu;
					print '</div>';
	?>	
    </p>
  </section>   
  <section id="content4">
    <p id="p2">
      <?php
      $sql="SELECT * FROM bapego_menu WHERE id=4";
					$query=pg_query($connect, $sql);
					$result = pg_fetch_all($query);
					$dailyMenu = "";

						$dailyMenu = "<h1 style=\"font-weight: bold;\">Leves:</h1>";
						if(isset($result[0]["soup"])){
							$dailyMenu .= "<h2>".$result[0]["soup"]."  -  ".$result[0]["soupprice"]." Ft<h2><br>";
						}else{
							$dailyMenu .= "-<br>";
						}

						$dailyMenu .= "<h1 style=\"font-weight: bold;\">Főétel:</h1>";
						$dailyMenu .= "<h2>".$result[0]["main"]."  -  ".$result[0]["mainprice"]." Ft<h2><br>";

						$dailyMenu .= "<h1 style=\"font-weight: bold;\">Desszert:</h1>";
						if(isset($result[0]["dessert"])){
							$dailyMenu .= "<h2>".$result[0]["dessert"]."  -  ".$result[0]["dessertprice"]." Ft<h2><br>";
						}else{
							$dailyMenu .= "-<br>";
						}
					print '<div class="box">';
					print '<br>';
					print $dailyMenu;
					print '</div>';
	?>	
    </p>
	</section>
  <section id="content5">
    <p id="p2">
      <?php
      $sql="SELECT * FROM bapego_menu WHERE id=5";
					$query=pg_query($connect, $sql);
					$result = pg_fetch_all($query);
					$dailyMenu = "";

						$dailyMenu = "<h1 style=\"font-weight: bold;\">Leves:</h1>";
						if(isset($result[0]["soup"])){
							$dailyMenu .= "<h2>".$result[0]["soup"]."  -  ".$result[0]["soupprice"]." Ft<h2><br>";
						}else{
							$dailyMenu .= "-<br>";
						}

						$dailyMenu .= "<h1 style=\"font-weight: bold;\">Főétel:</h1>";
						$dailyMenu .= "<h2>".$result[0]["main"]."  -  ".$result[0]["mainprice"]." Ft<h2><br>";

						$dailyMenu .= "<h1 style=\"font-weight: bold;\">Desszert:</h1>";
						if(isset($result[0]["dessert"])){
							$dailyMenu .= "<h2>".$result[0]["dessert"]."  -  ".$result[0]["dessertprice"]." Ft<h2><br>";
						}else{
							$dailyMenu .= "-<br>";
						}
					print '<div class="box">';
					print '<br>';
					print $dailyMenu;
					print '</div>';
	?>	
    </p>
  </section>
  <section id="content6">
    <p id="p2">
      <?php
      $sql="SELECT * FROM bapego_menu WHERE id=6";
					$query=pg_query($connect, $sql);
					$result = pg_fetch_all($query);
					$dailyMenu = "";

						$dailyMenu = "<h1 style=\"font-weight: bold;\">Leves:</h1>";
						if(isset($result[0]["soup"])){
							$dailyMenu .= "<h2>".$result[0]["soup"]."  -  ".$result[0]["soupprice"]." Ft<h2><br>";
						}else{
							$dailyMenu .= "-<br>";
						}

						$dailyMenu .= "<h1 style=\"font-weight: bold;\">Főétel:</h1>";
						$dailyMenu .= "<h2>".$result[0]["main"]."  -  ".$result[0]["mainprice"]." Ft<h2><br>";

						$dailyMenu .= "<h1 style=\"font-weight: bold;\">Desszert:</h1>";
						if(isset($result[0]["dessert"])){
							$dailyMenu .= "<h2>".$result[0]["dessert"]."  -  ".$result[0]["dessertprice"]." Ft<h2><br>";
						}else{
							$dailyMenu .= "-<br>";
						}
					print '<div class="box">';
					print '<br>';
					print $dailyMenu;
					print '</div>';
	?>	
    </p>
  </section>
  <section id="content7">
    <p id="p2">
      <?php
      $sql="SELECT * FROM bapego_menu WHERE id=7";
					$query=pg_query($connect, $sql);
					$result = pg_fetch_all($query);
					$dailyMenu = "";

						$dailyMenu = "<h1 style=\"font-weight: bold;\">Leves:</h1>";
						if(isset($result[0]["soup"])){
							$dailyMenu .= "<h2>".$result[0]["soup"]."  -  ".$result[0]["soupprice"]." Ft<h2><br>";
						}else{
							$dailyMenu .= "-<br>";
						}

						$dailyMenu .= "<h1 style=\"font-weight: bold;\">Főétel:</h1>";
						$dailyMenu .= "<h2>".$result[0]["main"]."  -  ".$result[0]["mainprice"]." Ft<h2><br>";

						$dailyMenu .= "<h1 style=\"font-weight: bold;\">Desszert:</h1>";
						if(isset($result[0]["dessert"])){
							$dailyMenu .= "<h2>".$result[0]["dessert"]."  -  ".$result[0]["dessertprice"]." Ft<h2><br>";
						}else{
							$dailyMenu .= "-<br>";
						}
					print '<div class="box">';
					print '<br>';
					print $dailyMenu;
					print '</div>';
	?>	
    </p>
  </section>
    
</main>
	 		   </div>
		
				<div class="clearfix"></div>
		     </div>
	 	    </div>
	 	</div>
	<!--//Heti menü-->
<!--reservation-->
	<div class="reservation" id="reservation">
		<div class="container">
		<div class="reservation-info">
		  <h3 class="tittle reserve">Foglalj <br>
			Asztalt</h3>
			 <div class="arrows-reserve"><img src="images/border.png" alt="border"></div>
				<div class="book-reservation wow slideInUp" data-wow-duration="1s" data-wow-delay=".5s">
				
				
					
				<?php
				$a = rand(0,10);
				$b = rand(0,10);

				$operations = "+-*";
				$operation1 = $operations[rand(0, 2)];

				$problem = "$a $operation1 $b";
				$captcha = "Mennyi: $problem = ?";

				$_SESSION["solution"] = eval('return '.$problem.';');
				
			?>
					<form action="bapego_reservation.php" method="post">
					<div class="col-md-4 form-right">
							<label ><i></i>Név :</label>
							<input placeholder="Az ön neve" type="text" name = "name" required="">
						</div>
						<div class="col-md-4 form-left">
							<label><i></i>Vendégek száma :</label>
							<select class="form-control" type="text" name = "guestnumb">
								<option>1 Fő</option>
								<option>2 Fő</option>
								<option>3 Fő</option>
								<option>4 Fő</option>
								<option>5 Fő</option>
								<option>5+ Fő</option>
							</select>
						</div>
					<div class="col-md-4 form-right">
							<label><i></i>E-mail :</label>
							<input placeholder="pelda@email.com" type="text" name = "email" required="">
						</div>
					 <div class="col-md-4 form-left">
						<label><i></i>Dátum :</label>
						<input 	 type="date" name = "date" required="">
						</div>
						<div class="col-md-4 form-left">
						<label><i></i>Idő :</label>
						<input 	 type="time" name = "time" required="">
						</div>
						<div class="col-md-4 form-right">
							<label>Ön robot?</label>
							<input placeholder="<?php print $captcha; ?>" type="text" name = "robot" required="">
						</div>			
						<div class="clearfix"> </div>
						<div class="make wow shake" data-wow-duration="1s" data-wow-delay=".5s">
						  <input name="resoke" type="submit" value="Foglalás véglegesítése">
						</div>
					</form>
					<?php
						if (isset($_SESSION["error_reservation"]))
						{
							if(in_array(true,$_SESSION["error_reservation"]))
							{
								print '<script>alert("A foglalás sikertelen.");</script>';
							}
							else
							{
								print '<script>alert("Sikeres foglalás, önnek ma szerencsés napja van!");</script>';
							}
							unset($_SESSION["error_reservation"]);
						}
					?>

				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>	
	<!--//reservation-->
	

<!--Gallery-->
<div class="gallery" id="gallery">
	<div class="container">
		<h3 class="tittle">Galéria</h3>
		<div class="arrows-serve"><img src="images/border.png" alt="border"></div>
				<div class="gallery-grids">
					<div class="col-md-6 baner-top wow fadeInRight animated" data-wow-delay=".5s">
						<a href="images/g1.jpg" class="b-link-stripe b-animate-go  swipebox">
							<div class="gal-spin-effect vertical ">
								<img src="images/g1.jpg" alt=" " />
								<div class="gal-text-box">
									<div class="info-gal-con">
										<h4>Honest Food</h4>
										<span class="separator"></span>
										<p>Próbálja ki különleges előételeinket!</p>
										<span class="separator"></span>
										
									</div>
								</div>
							</div>
						</a>
					</div>
					<div class="col-md-6 baner-top wow fadeInLeft animated" data-wow-delay=".5s">
						<a href="images/g2.jpg" class="b-link-stripe b-animate-go  swipebox">
							<div class="gal-spin-effect vertical ">
								<img src="images/g2.jpg" alt=" " />
								<div class="gal-text-box">
									<div class="info-gal-con">
										<h4>Honest Food</h4>
										<span class="separator"></span>
										<p>Reggeli. A nap legfontosabb étkezése.</p>
										<span class="separator"></span>
										
									</div>
								</div>
							</div>
						</a>
					</div>
					<div class="col-md-3 baner-top ban-mar wow fadeInUp animated" data-wow-delay=".5s">
						<a href="images/c1.jpg" class="b-link-stripe b-animate-go  swipebox">
							<div class="gal-spin-effect vertical ">
								<img src="images/c1.jpg" alt=" " />
								<div class="gal-text-box">
									<div class="info-gal-con">
										<h4>Honest Food</h4>
										<span class="separator"></span>
										<p>Kóstolja meg diétás fánkjainkat!</p>
										<span class="separator"></span>
										
									</div>
								</div>
							</div>
						</a>
					</div>
					<div class="col-md-3 baner-top ban-mar wow fadeInDown animated" data-wow-delay=".5s">
						<a href="images/c2.jpg" class="b-link-stripe b-animate-go  swipebox">
							<div class="gal-spin-effect vertical ">
								<img src="images/c2.jpg" alt=" " />
								<div class="gal-text-box">
									<div class="info-gal-con">
										<h4>Honest Food</h4>
										<span class="separator"></span>
										<p>Kenguru. Mindenki tudja mi az. De az ízét is ismerjük?</p>
										<span class="separator"></span>
										
									</div>
								</div>
							</div>
						</a>
					</div>
					<div class="col-md-3 baner-top ban-mar wow fadeInUp animated" data-wow-delay=".5s">
						<a href="images/c3.jpg" class="b-link-stripe b-animate-go  swipebox">
							<div class="gal-spin-effect vertical ">
								<img src="images/c3.jpg" alt=" " />
								<div class="gal-text-box">
									<div class="info-gal-con">
										<h4>Honest Food</h4>
										<span class="separator"></span>
										<p>Tengeri herkentyű hegy. Megmásznád?</p>
										<span class="separator"></span>
										
									</div>
								</div>
							</div>
						</a>
					</div>
					<div class="col-md-3 baner-top ban-mar wow fadeInDown animated" data-wow-delay=".5s">
						<a href="images/c4.jpg" class="b-link-stripe b-animate-go  swipebox">
							<div class="gal-spin-effect vertical ">
								<img src="images/c4.jpg" alt=" " />
								<div class="gal-text-box">
									<div class="info-gal-con">
										<h4>Honest Food</h4>
										<span class="separator"></span>
										<p>Gyümölcstál és sültkacsamell. Nyamm!</p>
										<span class="separator"></span>
										
									</div>
								</div>
							</div>
						</a>
					</div>
					<div class="col-md-6 baner-top wow fadeInRight animated" data-wow-delay=".5s">
						<a href="images/g7.jpg" class="b-link-stripe b-animate-go  swipebox">
							<div class="gal-spin-effect vertical ">
								<img src="images/g7.jpg" alt=" " />
								<div class="gal-text-box">
									<div class="info-gal-con">
										<h4>Honest Food</h4>
										<span class="separator"></span>
										<p>Különleges teáink is világhírűek.</p>
										<span class="separator"></span>
										
									</div>
								</div>
							</div>
						</a>
					</div>
					<div class="col-md-6 baner-top wow fadeInLeft animated" data-wow-delay=".5s">
						<a href="images/g8.jpg" class="b-link-stripe b-animate-go  swipebox">
							<div class="gal-spin-effect vertical ">
								<img src="images/g8.jpg" alt=" " />
								<div class="gal-text-box">
									<div class="info-gal-con">
										<h4>Honest Food</h4>
										<span class="separator"></span>
										<p>Pizza. De, hogy pontosan milyen? Hogy megtudja, ahhoz egyszer el kell jönnie.</p>
										<span class="separator"></span>
										
									</div>
								</div>
							</div>
						</a>
					</div>
					<div class="clearfix"> </div>
				</div>
			</div>
	</div>
<!-- //gallery -->

<!--/contact-->
	 
					<?php
				$a2 = rand(0,10);
				$b2 = rand(0,10);

				$operations = "+-*";
				$operation2 = $operations[rand(0, 2)];

				$problem2 = "$a2 $operation2 $b2";
				$captcha2 = "Mennyi: $problem2 = ?";

				$_SESSION["solution2"] = eval('return '.$problem2.';');
			?>
	 <div class="section-contact" id="contact">
	    <div class="container">
           <div class="contact-main">
				    <div class="col-md-6 contact-grid wow fadeInUp"  data-wow-duration="1s" data-wow-delay=".3s">
					<h3 class="tittle wow bounceIn"  data-wow-duration=".8s" data-wow-delay=".2s">Kapcsolat</h3>
						<div class="arrows-three"><img src="images/border.png" alt="border"></div>
							<p class="wel-text wow fadeInDown"  data-wow-duration=".8s" data-wow-delay=".4s">Iratkozzon fel hírlevelünkre, hogy mindig a legfrissebb információkat tudjuk önnek küldeni az üres helyekről 2 hónapra előre!</p>
						    <form action="bapego_newsletter.php" method="post" id="filldetails">
					  
					  <div class="field email-box">
							<input name = "email" type="text" id="email" placeholder="pelda@email.com" required=""/>
							<label for="email">E-mail cím</label>
							<span class="ss-icon">check</span>
					  </div>
					  <div class="field email-box">
							<input name ="robot" type="text" id="email" placeholder="<?php print $captcha2; ?>" required=""/>
							<label for="email">Ön robot?</label>
							<span class="ss-icon">check</span>
					  </div>
						<div class="send wow shake"  data-wow-duration="1s" data-wow-delay=".3s">
											<input type="submit" value="Küldés" name="newsok">
										</div>
					 
			  </form>
			  <?php
						if (isset($_SESSION["error_newsletter"]))
						{
							if(in_array(true,$_SESSION["error_newsletter"]))
							{
								print '<script>alert("A feliratkozás sikertelen!");</script>';
							}
							else
							{
								print '<script>alert("Sikeres feliratkozás!");</script>';
							}
							unset($_SESSION["error_newsletter"]);
						}
					?>

					   </div>
					<div class="col-md-6 contact-in wow fadeInUp"  data-wow-duration="1s" data-wow-delay=".5s">
						<h4 class="info">Fontos információk</h4>
						<p class="para1"></p>
						<div class="con-top">
							<h4>Elérhetőség: </h4>
								<ul>
								<li></li> 
								<li>1023 Budapest</li>  
								<li>Dohány utca 1.</li> 
								<li>Pest Megye</li> 
								<li>Tel.:+36 60 234 1234</li>
								<li>Ügyfélszolgálat: 07:00 - 18:00</li>
								<li><a href="mailto:info@honestfood.com">info@honestfood.com</a></li>
							  </ul>
						</div>
					</div>
					
						<div class="clearfix"> </div>
			      </div>
				   <!--map-->
				   <div class="mapouter" style="width:100%"><div class="gmap_canvas"><iframe width="100%" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=Budapest%20Doh%C3%A1ny%20u.%201&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.crocothemes.net"></a></div><style>.mapouter{text-align:right;height:500px;width:100%;}.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:100%;}</style></div>
				   
				   
				<!--//map-->
			 </div>
		</div>
		<!--//contact-->
<!--footer-->
		<div class="footer text-center">
						<div class="container">
							<!--logo2-->
								   <div class="logo2 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
									  <a href="index.html"><h2>H<span>onest Food</span></h2></a>
									  <p>A valódi íz</p>
								   </div>
					<!--//logo2-->Itt is megtalálhatóak vagyunk!
									<ul class="social wow slideInDown" data-wow-duration="1s" data-wow-delay=".3s">
										<li><a href="#" class="tw"></a></li>
										<li><a href="#" class="fb"> </a></li>
										<li><a href="#" class="in"> </a></li>
										<li><a href="#" class="dott"></a></li>
										 <div class="clearfix"></div>
									</ul>
									<p class="copy-right wow fadeInUp"  data-wow-duration="1s" data-wow-delay=".3s">&copy; 2016 Honest Food. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p>

					 </div>
	     </div>
		<!--start-smooth-scrolling-->
						<script type="text/javascript">
									$(document).ready(function() {
										/*
										var defaults = {
								  			containerID: 'toTop', // fading element id
											containerHoverID: 'toTopHover', // fading element hover id
											scrollSpeed: 1200,
											easingType: 'linear' 
								 		};
										*/
										
										$().UItoTop({ easingType: 'easeOutQuart' });
										
									});
								</script>
								<!--end-smooth-scrolling-->
		<a href="#home" id="toTop" class="scroll" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
<script>
$(document).ready(function(){   
    setTimeout(function () {
        $("#cookieConsent").fadeIn(200);
     });
    $("#closeCookieConsent, .cookieConsentOK").click(function() {
        $("#cookieConsent").fadeOut(200);
    }); 
}); 

</script>
</body>
</html>