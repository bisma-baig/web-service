<html>
<head>
<title>Bond Web Service Demo</title>
<style>
body {font-family:georgia;}


.film{
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
			success: bondJSON

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
	$('#filmtitle').html(data.title);
	$("#films").html("");//clears
	$.each(data.films,function(i,item){//reloads
		let myFilm = bondTemplate(item);

		$('<div></div>').html(myFilm).appendTo('#films');
	});
	/*
	//$("#output").text(json.stringify(data));
	let myData = JSON.stringify(data,null,4);
	myData = "<pre>" + myData + "</pre>";
	$("#output").html(myData);
	*/
}	
	
function bondTemplate(film){

	return `
	<div class="film">
		<b>Film: </b>${film.Film}<br/>
		<b>Title: </b>${film.Title}<br/>
		<b>Year: </b>${film.Year}<br/>
		<b>Director: </b>${film.Director}<br/>
		<b>Producers: </b>${film.Producers}<br/>
		<b>Writer: </b>${film.Writer}<br/>
		<b>Composer: </b>${film.Composer}<br/>
		<b>Bond: </b>${film.Bond}<br/>
		<b>Budget: </b>${film.Budget}<br/>
		<b>Box Office: </b>${film.BoxOffice}<br/>
		
		<div class="pic"><img src="thumbnails/${film.Image}" /></div> 	
	</div>
	`;
}

</script>
</head>
	<body>
	<h1>Bond Web Service</h1>
		<a href="year" class="category">Bond Films By Year</a><br />
		<a href="box" class="category">Bond Films By International Box Office Totals</a>
		<h3 id="filmtitle">Title Will Go Here</h3>
		<div id="films">
		
		</div>
		<div id="output">Results go here</div>
	</body>
</html>