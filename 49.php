<!doctype html>
<html lang="ko">
 <head>
  <meta charset="UTF-8">
  <title>팝픈뮤직 49레벨 서열표 자동색칠 - AutoChecker</title>
  	<link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR:300,400&display=swap&subset=korean" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
 </head>
 <body style = "padding-top: 70px; padding-bottom: 70px; font-family: 'Noto Sans KR', sans-serif;">
	<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-primary" style = "margin: 0 auto">
		<a class = "navbar-brand" href = "#">AutoChecker</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    		<span class="navbar-toggler-icon"></span>
  		</button>

		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav bg-primary">
				<li class="nav-item">
					<a class="nav-link" href="index.php">Home</a>
				</li>
				<li class="nav-item active">
					<a class="nav-link" href="49.php">pop'n</a>
				</li>
				<li class="nav-item">
					<a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">SDVX</a>
				</li>
			</ul>
		</div>
	</nav>

	<div class = "container" style = "padding-top: 50px">
		<div class = "page-header">
			<h1>팝픈뮤직 49레벨 서열표 자동색칠도구</h1>
		</div>

		<p>
		팝픈뮤직 49레벨 서열표를 유저의 플레이 데이터를 기반으로 칠하도록 만들어진 사이트입니다. 사용법은 아래와 같습니다.
		</p>

		<div class = "card">
			<div class = "card-header">
				사용법
			</div>
				<ul class = "list-group">
					<li class = "list-group-item">
					1. <a href = "https://p.eagate.573.jp" target="_blank">e-AMUSEMENT 사이트</a>에서 e-AMUSEMENT 베이직 코스에 가입되어 있는 계정으로 로그인합니다.
					</li>
					<li class = "list-group-item">
					2. <code style = "word-break: break-all">javascript:var s=document.createElement("script");s.src="https://popn.nulldori.tk/49.js";s.type="text/javascript";document.getElementsByTagName("body")[0].appendChild(s);</code> 를 주소창에 입력하고 실행합니다.<br>
					</li>
					<li class = "list-group-item">
					3. 스크립트가 유저 데이터를 수집한 후, 현재 페이지로 돌아오게 됩니다. 서열표 위의 Download 버튼을 눌러 색칠된 서열표를 저장할 수 있습니다.
					</li>
				</ul>
		</div>

		<div style = "text-align:center; margin-top: 50px; margin-bottom:50px;">
			<button type="button" class="btn btn-primary btn-lg" onclick = "save();">Download</button>
		</div>
	</div>

	<div style = "margin: auto; text-align:center">
		<div id = "chart" style = "position:relative; width:850px; margin:auto">
			<img src = "chart49.png"/>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src = "ord49.js" type = "text/javascript"></script>
	<script src = "html2canvas.min.js"></script>
	<script>
		var postData = <?php if(isset($_POST['data'])) print(urldecode($_POST['data'])); else print("\"\""); ?>

		ordData = JSON.parse(ordData)

		for(var title in postData){
			if(postData[title] != "meda_none.png"){
				try{
					var div = document.createElement('div');
					div.style.position = "absolute";
					div.style.left = Number(ordData[title][0]) + 2 + "px"
					div.style.top = Number(ordData[title][1]) - 2 + "px"

					var img = document.createElement('img');
					img.src = postData[title];
					img.height = 18;

					div.appendChild(img);
					
					document.querySelector("#chart").appendChild(div);
				}
				catch(e){
					console.log(title + " 곡이 색칠되지 않았습니다.")
				}

			}
		}

		function save(){
			html2canvas(document.querySelector("#chart"), {width: 850, height: 975, x:document.querySelector("#chart").offsetLeft + 8, y:document.querySelector("#chart").offsetTop}).then(canvas => {
				var a = document.createElement('a');
				a.href = canvas.toDataURL();
				a.download = "49.png";
				a.click();
			});
		}
	</script>
</body>
</html>
