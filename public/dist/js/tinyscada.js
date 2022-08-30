function getTagValues(){
    $.ajax({
        type: "GET",
        url:  "/nodes/getTagValues?serialnolist="+nodes,
        dataType: "json",
        success: function(data){
            console.log(data);
            for(d in data){
                var tagid = "#"+data[d]["tagName"]+"-"+data[d]["serialNumber"];
                var titleid = "#title-"+data[d]["tagName"]+"-"+data[d]["serialNumber"];
                var value = data[d]["tagValue"];
                var title = data[d]["tagTitle"];
                var colorid = "#color-"+data[d]["tagName"]+"-"+data[d]["serialNumber"];
                var iconid = "#icon-"+data[d]["tagName"]+"-"+data[d]["serialNumber"];
                var unit = data[d]["tagUnit"];
                if(data[d]["tagType"]==8){
                    updateTextValues(tagid,titleid,value,title,unit);
                }else if(data[d]["tagType"]==1){
                    updateToggleValues(colorid,iconid,titleid,value,title,unit);
                }
            }
        },
        error: function(){
            console.log("error")
        }
    })
}
function updateTextValues(tagid,titleid,value,title,unit){

    $(tagid).empty();

    $(tagid).text(value+" "+unit);
    $(titleid).text(title);

}
function updateToggleValues(colorid,iconid,titleid,value,title,unit){
    if(value>=1){
        $(colorid).removeClass('text-danger')
        $(colorid).addClass('text-success')
        $(iconid).removeClass('fa-toggle-off')
        $(iconid).removeClass('fa-ban')
        $(iconid).addClass('fa-toggle-on')

    }else{
        $(colorid).removeClass('text-success')
        $(colorid).addClass('text-danger')
        $(iconid).removeClass('fa-ban')
        $(iconid).removeClass('fa-toggle-on')
        $(iconid).addClass('fa-toggle-off')
    }
    $(titleid).text(title)
}
$(function() {
    getTagValues();
    setInterval(getTagValues, 1000);
});
