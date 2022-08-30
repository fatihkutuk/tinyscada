

$(".nav-link").click(function () {
  activelink = $(row).text().split(' ')[1];
  
})

var activelink = window.location.href.split('/')[3];
$("."+activelink).attr("class","nav-link active")

