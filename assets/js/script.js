$(document).ready(function(){
    $(".card-img-container").on("mouseenter", function() {
        let text = $(this).find(".text-comment");
        text.fadeIn(200);
    })

    $(".card-img-container").on("mouseleave", function() {
        let text = $(this).find(".text-comment");
        text.fadeOut(200);
    })
})