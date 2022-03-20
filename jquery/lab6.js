var score=0;

$(document).ready(function() {
    $("#score").text(score.toString());
});

$("img").click(function(){
    score=score+1;
    if(score==10)
    {
        alert("YOU WON!")
        score=0;
    }
    $("#score").text(score.toString());
  });

setInterval(function(){
    $("#img").css('left',Math.floor((Math.random() * 100) + 1).toString()+"%");
    $("#img").css('top',Math.floor((Math.random() * 100) + 1).toString()+"%");
}, 1500);