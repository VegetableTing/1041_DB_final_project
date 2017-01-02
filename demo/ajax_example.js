var http_request=false;
function test_ajax(variable){
 http_request=false;
 if(window.XMLHttpRequest){
  http_request=new XMLHttpRequest();
  if(http_request.overrideMimeType){
   http_request.overrideMimeType('text/xml');
  }
 }else if(window.ActiveXObject){
  try{ //6.0+
   http_request=new ActiveXObject("Msxml2.XMLHTTP");
  }catch(e){
   try{ //5.5+
    http_request=new ActiveXObject("Microsoft.XMLHTTP");
   }catch (e){}
  }
 }
 if(!http_request){
  alert('Giving up :( Cannot create a XMLHTTP instance');
  return false;
 }
 http_request.onreadystatechange=show_area;
 http_request.open('GET','recive.php?variable='+variable,true);//從這邊拿選資料庫
 http_request.send(null);
}

function show_area(){
 if(http_request.readyState==4){
  if(http_request.status==200){
	var result = new Array();
	var result = http_request.responseText.split(",");
	
	var No = document.getElementById( "No" );
    No.innerHTML = "No." + result[0];  //將結果顯示出來
	
	var name = document.getElementById( "name" );
    name.innerHTML = "Name: " + result[1];  //將結果顯示出來
	
	var type = document.getElementById( "type" );
    type.innerHTML = "Type: " + result[2];  //將結果顯示出來
  }
 }
}