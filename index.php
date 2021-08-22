<html>
<head>
<title> Hike Web Service </title>
<style>
body {font-family:georgia;}


.hike{
	border:1px solid #E77DC2;
	border-radius: 5px;
	padding: 5px;
	margin-bottom:5px;
	position:relative;	
}

.pic{
	position:absolute;
	right:10px;
	top:10px;
}

</style>
<script src="https://code.jquery.com/jquery-latest.js" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function() {  

	$('.category').click(function(e){
        e.preventDefault(); //stop default action of the link
		cat = $(this).attr("href");  //get category from URL
		loadAJAX(cat);  //load AJAX and parse JSON file
	});
});	


function loadAJAX(cat)
{
		$.ajax({
			type: "GET",
			dataType: "json",
			url: "api.php?cat=" + cat,
			success: bondJSON,
			error: function(xhr, status, error){
        	let errorMessage = xhr.status + ': ' + xhr.statusText
        	alert('Error - ' + errorMessage);
    }

	});
	//AJAX connection will go here
    //alert('cat is: ' + cat);
}
    
function toConsole(data)
{//return data to console for JSON examination
	console.log(data); //to view,use Chrome console, ctrl + shift + j
}

function bondJSON(data){
	console.log(data);
	//identifies the type of data returned
	$('#hiketitle').html(data.title);
	$("#hike").html("");//clears

	//loops throught films and add template
	
	$.each(data.hikes,function(i,item){//reloads
		let myHike = hikeTemplate(item);
		$('<div></div>').html(myHike).appendTo('#films');
	});
	
		//this creates a map of the jSON on our page
	//$("#output").text(json.stringify(data));
	let myData = JSON.stringify(data,null,4);
	myData = "<pre>" + myData + "</pre>";
	$("#output").html(myData);
	
}	
	
function hikeTemplate(hike){

	return `
	<div class="hike">
		<b>Hike: </b>${hike.Hike}<br/>
		<b>Location: </b>${hike.Location}<br/>
		<b>Difficulty: </b>${hike.Difficulty}<br/>
		<b>Elevation: </b>${hike.Elevation}<br/>
		<b>Length: </b>${hike.Length}<br/>
		<b>RouteType: </b>${hike.RouteType}<br/>
		<b>Activity: </b>${hike.Activity}<br/>

		
		<div class="pic"><img src="thumbnails/${hike.Image}" /></div> 	
	</div>
	`;
}

</script>
</head>
	<body>
	<h1>Hikes Web Service</h1>
		<a href="hikes" class="elevation">Hikes By elevation</a><br />
		<a href="hikes" class="hike">Hikes By alphabetical order</a>
		<h3 id="hiketitle">Title Will Go Here</h3>
		<div id="hikes">
		
		</div>
		<div id="output">Results go here</div>
	</body>
</html>