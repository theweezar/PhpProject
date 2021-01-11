function ClickExit(){
    document.querySelectorAll(".overlay").forEach( function(x) {
        x.classList.add('dnone');
    })
}
function ClicktoOpenContactOverlay(){
    document.querySelectorAll(".overlay").forEach( function(x){
        x.classList.add('dnone');
    });
    document.querySelector(".contact").classList.remove('dnone');
}
function ClicktoOpenFormoreOverlay(){
    document.querySelectorAll(".overlay").forEach( function(x){
        x.classList.add('dnone');
    });
    const x = screen.width;
    if( x <= 1100)
    document.querySelector(".formore-mobile").classList.remove('dnone');
    else
    document.querySelector(".formore").classList.remove('dnone');
}
// ytb_video + id to run
function RunVideo(x){
    const id = "https://www.youtube.com/embed/"+x.getAttribute("vid");
    var youtube = document.querySelector(".youtube iframe");
    if( screen.width <= 1100) {
        youtube = document.querySelector(".youtube-mobile iframe");
        youtube.setAttribute("width","100%")
        youtube.setAttribute("height","40%")
        youtube.setAttribute("style","margin:40% 0;display:flex;align-items: center;")
        document.querySelector(".youtube-mobile").classList.remove("dnone");
        document.querySelector(".youtube-mobile iframe").setAttribute("src",id);
    }
    document.querySelector(".youtube").classList.remove("dnone");
    youtube.setAttribute("src",id);
}
function ClickExitYoutube(){
    document.querySelectorAll(".overlay").forEach( function(x){
        x.classList.add('dnone');
    });
    var youtube = document.querySelector(".youtube iframe");
    if( screen.width <= 1100){
        youtube = document.querySelector(".youtube-mobile iframe");
        youtube.setAttribute("src","#");
    }
    youtube.setAttribute("src","#");
}

(function(){
    let iter = 0
    const image_list = ['Med-vid.png', 'Med-vid2.png', 'Med-vid3.png']
    const vid_list = ['rPBL2sSy7O4', 'Qb_t_mdEK-E', 'HR42lbbPjTg']
    const image = document.querySelector('.md-video img[alt="med-vid"]')
    image.src = "./img/"+image_list[iter]  
    image.setAttribute('vid',vid_list[iter])
    const next = document.getElementById('add-video')
    next.onclick = function(){
      iter = iter == image_list.length - 1 ? 0:++iter
      image.src = "./img/"+image_list[iter]
      image.setAttribute('vid',vid_list[iter])
    }
  })()