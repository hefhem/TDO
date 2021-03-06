<!DOCTYPE html>
<html>
<head>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.js"></script>
<script type="text/javascript">
$(function(){
// part 1
$('menu a').click(function(){
location.hash=$(this).attr('href').match(/(^.*)\./)[1]
return false
})
// part 2
var originalTitle=document.title
function hashChange(){
var page=location.hash.slice(1)
if (page!=""){
$('#content').load(page+".html #sub-content")
document.title=originalTitle+' – '+page
}
}
// part 3
if ("onhashchange" in window){ // cool browser
$(window).on('hashchange',hashChange).trigger('hashchange')
}else{ // lame browser
var lastHash=''
setInterval(function(){
if (lastHash!=location.hash)
hashChange()
lastHash=location.hash
},100)
}
})
</script>
<title>main</title>
</head>
<body>
<menu>
<li><a class="menu_links" href="newproject.html">New Project</a></li>
<li><a class="menu_links" href="accord.html">Accordion</a></li>
<li><a class="menu_links" href="project_summary.html">Summary Table</a></li>
<li><a class="menu_links" href="detail_report.html">Detail Report</a></li>
<li><a class="menu_links" href="upload_data.html">Upload Data</a></li>
</menu>
<div id="content"></div>
</body>
</html>