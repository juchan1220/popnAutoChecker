<!doctype html>
<html lang="ko">
 <head>
  <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>팝픈뮤직 48레벨 서열표 자동색칠 - AutoChecker</title>
  	<link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR:300,400&display=swap&subset=korean" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
     <link rel="stylesheet" href="/assets/css/popn.css"/>
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
				<li class="nav-item active dropdown">
					<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" arai-haspopup="true" aria-expanded="false">
						pop'n
					</a>
					<div class = "dropdown-menu" aria-labelledby = "navbarDropdownMenuLink">
						<a class = "dropdown-item" href = "48.php">LV.48</a>
						<a class = "dropdown-item" href = "49.php">LV.49</a>
					</div>
				</li>
			</ul>
		</div>
	</nav>

	<div class = "container" style = "padding-top: 50px; margin: 0 auto;">
		<div class = "page-header">
			<h2>팝픈뮤직 48레벨 서열표</h2>
		</div>

		<p>
		팝픈뮤직 48레벨 서열표를 유저의 플레이 데이터를 기반으로 칠하도록 만들어진 사이트입니다. 사용법은 아래와 같습니다.
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
                    2. <code style = "word-break: break-all">javascript:var s=document.createElement("script");s.src="https://popn.nulldori.tech/assets/js/48.js";s.type="text/javascript";document.getElementsByTagName("body")[0].appendChild(s);</code> 를 주소창에 입력하고 실행합니다.<br><br>
                    PC Firefox, iOS Safari에서는 주소창 javascript를 사용할 수 없으므로 위의 방법이 아닌 다른 방법을 사용해야 합니다.<br>
                    2-1. iOS Safari의 경우, 임의의 사이트를 북마크에 추가하고나서 해당 북마크의 주소 적힌 코드로 수정합니다. 그 후, e-AMUSEMENT 사이트에서 해당 북마크를 엽니다.<br>
                    2-2. PC Firefox의 경우, e-AMUSEMENT 사이트에서 F12를 눌러 개발자 옵션을 킨 뒤, 콘솔 탭에 들어가 위에 적힌 코드를 입력합니다.
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
        <div id = "chart" style = "position:relative; margin:0 auto;">
            <canvas id='chartCanvas' style='width: 100%'>
        </div>
    </div>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src = "assets/js/ord48.js" type = "text/javascript"></script>
	<script src = "assets/js/html2canvas.min.js"></script>
	<script>
		let postData = <?php if(isset($_POST['data'])) print(urldecode($_POST['data'])); else print("\"\""); ?> ;

		// ordData from ordLV.js
		ordData = JSON.parse(ordData);

		function drawMedal(medalType){
			if(medalType > 107){
				document.querySelector("#chart").appendChild(canvas);
				return ;
			}

			let medal = new Image();
			medal.src = "/assets/images/meda_" + String.fromCharCode(medalType) + ".png";
			medal.onload = function(){
				for(let title in postData){
					if(postData[title] === "meda_" + String.fromCharCode(medalType) + ".png"){
						try{
							ctx.drawImage(medal, (Number(ordData[title][0]) * 850 / 1597) + 1, (Number(ordData[title][1]) * 850 / 1597) + 2, 18, 18)
						}
						catch(e){
							console.log(title + " 곡이 색칠되지 않았습니다.")
						}
					}
				}
				drawMedal(medalType + 1)
			}
		}

        let canvas = document.querySelector('#chartCanvas');
        canvas.width = 850;
        canvas.height = 1193;
        let ctx = canvas.getContext('2d');

		let chartBase = new Image();
		chartBase.src = "/assets/images/chart48.png";
		chartBase.onload = function(){
			ctx.drawImage(chartBase,0,0);
			drawMedal(97)
		};

        function save(){
            canvas.toBlob((blob) => {
                let a = document.createElement('a');
                a.href = URL.createObjectURL(blob);
                a.download = "48.png";
                a.style.display = "none";
                document.body.appendChild(a);
                a.click();
            });
        }
	</script>
</body>
</html>
