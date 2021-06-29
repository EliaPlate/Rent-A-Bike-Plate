
$(document).ready(function(){

    $(".image__container__two").mouseenter(function(){
        hide("image__container__one");
    }).mouseleave(function(){
        show("image__container__one");
    })
    
    $(".image__container__three").mouseenter(function(){
        hide("image__container__one");
        hide("image__container__two");
    }).mouseleave(function(){
        show("image__container__one");
        show("image__container__two");
    })
    
    $(".image__container__four").mouseenter(function(){
        hide("image__container__one");
        hide("image__container__two");
        hide("image__container__three");
    }).mouseleave(function(){
        show("image__container__one");
        show("image__container__two");
        show("image__container__three");
    })
    
    $(".image__container__five").mouseenter(function(){
        hide("image__container__one");
        hide("image__container__two");
        hide("image__container__three");
        hide("image__container__four");
    }).mouseleave(function(){
        show("image__container__one");
        show("image__container__two");
        show("image__container__three");
        show("image__container__four");
    })
});


function hide(id){
    $("."+id).animate({"opacity": "0"}, "fast");
}
function show(id){
    $("."+id).animate({"opacity": "1"}, "fast");
}