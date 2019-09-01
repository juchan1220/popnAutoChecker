<!doctype html>
<html lang="ko">
 <head>
  <meta charset="UTF-8">
  <title>팝픈뮤직 49레벨 서열표 자동색칠</title>
  
 </head>
 <body>
	<div style = "margin: auto; text-align:center">
	<div id = "chart" style = "position:relative; width:850px; margin:auto">
		<img src = "chart49.png"/>
		<!-- <div style = "position: absolute; top:232px; left:104px;">
			<img src = "base_pa.png" height = "18px"/>
		</div> -->
	</div>
	<input type = "button" value = "save" onclick = "save();">

	</div>

	<script type = "text/javascript" src = "ord49.js"></script>
	 <script>
		var postData = <?php print(urldecode($_POST['data'])); ?>;

		ordData = JSON.parse(ordData)

		for(var title in postData){
			if(postData[title] != "meda_none.png"){
				try{
					var div = document.createElement('div');
					div.style.position = "absolute";
					div.style.left = Number(ordData[title][0]) + 2 + "px"
					div.style.top = Number(ordData[title][1]) + 4 + "px"

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
	<script src = "html2canvas.min.js"></script>
 </body>
</html>
