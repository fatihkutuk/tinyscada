var do1;
function getTagValues(){
    $.ajax({
        type: "GET",
        url:  "/nodes/getTagValues?serialnolist="+nodes,
        dataType: "json",
        success: function(data){
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
        $(colorid).attr("data-val",1)

    }else{
        $(colorid).removeClass('text-success')
        $(colorid).addClass('text-danger')
        $(iconid).removeClass('fa-ban')
        $(iconid).removeClass('fa-toggle-on')
        $(iconid).addClass('fa-toggle-off')
        $(colorid).attr("data-val",0)
    }
    if(value == do1){
        $(colorid).css("opacity",1);
    }
    $(titleid).text(title)
}
function changedValue(e){
    console.log(e)
}
function setBool(serino,tagname,e){
    var val = $(e).attr("data-val") == 0 ? 1 : 0;
    do1 = val;
    $(e).css("opacity",0.5);
    $(e).change(function(event) {
        console.log("changed")
         $(e).css("opacity",1);
     });
    var data = { 
        serialNumber : serino,
        tagName: tagname,
        tagValue: val
    };
    $.ajax({
        type: "POST",
        url:  "/nodes/setBoolValues",
        dataType: "json",
        data: data,
        success: function(data){

        },
        error: function(){
        }
    })
}
$(function() {
    $('#nodestable').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    getTagValues();
    setInterval(getTagValues, 1000);
});
