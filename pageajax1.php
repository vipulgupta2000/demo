<html>
<head>

    <link rel="stylesheet" type="text/css" href="css/templateblue.css">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">


 
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/apple-touch-icon-144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/apple-touch-icon-114-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/apple-touch-icon-72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-57-precomposed.png">
  <link rel="shortcut icon" href="img/favicon.png">

	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/scripts.js"></script>
         <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 <script>       
$(document).ready(function(){
     $("#livesearch").hide();
   $("#prj").keydown(function(){
       var spr=$("#prj").val();
       //alert(str);
 $("#livesearch").load("page3.php?QUAL="+spr, function(responseTxt, statusTxt, xhr){
            if(statusTxt == "success")
            $("#livesearch").show();
        //$("#livesearch").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
            //$("#livesearch").html(data);
	//$("#livesearch").css("background","#FFF");
//$('#prj').popover({content: responseTxt,});
//alert(responseTxt);
                 //$("#prj").popover({title: "Header", content: "responseTxt",});
            if(statusTxt == "error")
                alert("Error: " + xhr.status + ": " + xhr.statusText);
        });
    }); 
  
$("#close").click(function(){
   $("#list1").val($("#list0").val());
   $( "#dialog" ).dialog( "close" );
});        
  
$("#transfer").click(function(){
        var str="";
       $("#sweet option:selected").each(function(){
        str  = $(this).text();
        $(this).remove();
        var o = new Option("option text", "value");
/// jquerify the DOM object 'o' so we can use the html method
        $(o).html(str);
        $("#sour").append(o);
    });
      //$("#div1").text(str);
          var result = $('#sour option').map(function(i, opt) {return $(opt).text();}).toArray().join(', ');
    $("#list0").val(result);
    }); 
    
     $("#reverse").click(function(){
        var str="";
       $("#sour option:selected").each(function(){
        str = $(this).text();
        $(this).remove();
        var o = new Option("option text", "value");
/// jquerify the DOM object 'o' so we can use the html method
        $(o).html(str);
        $("#sweet").append(o);
    }); 
        var result = $('#sour option').map(function(i, opt) {return $(opt).text();}).toArray().join(', ');
    $("#list0").val(result);
    });


});
    
function setresult(str){
    $("#prj").val(str);
    $("#livesearch").hide();
}


//style="background: #fafafa;border: 1px solid;position: relative"
</script>
</head>
<body>

<form>
<div>
    <input id="prj" type="text" size="30" placeholder="Project Code">
    <div id="livesearch" style="display: none;position: fixed"></div>
</div>
</form>
    
 
<div id="dialog" title="Basic dialog">
 <select id="sweet" name="sweets" multiple="multiple">
  <option>Chocolate</option>
  <option selected="selected">Candy</option>
  <option>Taffy</option>
  <option >Caramel</option>
  <option>Fudge</option>
  <option>Cookie</option>
</select>
    <button id="transfer"> >> </button>
     <button id="reverse"> << </button>
<select id="sour" name="sour" multiple="multiple">
</select>
     <input type="text" id="list0" name="list0" value=""/> 
     <button id="close">Close</button>
</div>
     <input type="text" id="list1" name="list1" value=""/>  
     <button id="opener">Open Dialog</button>
 
</body>

</html>
 <script>
 $( function() {

    $( "#opener" ).on( "click", function() {
      $( "#dialog" ).dialog( "open" );
    });
  } );
  
 
  </script>
