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
    if( x <= 1000)
    document.querySelector(".formore-mobile").classList.remove('dnone');
    else
    document.querySelector(".formore").classList.remove('dnone');
}
// ytb_video + id to run
function RunVideo(x){
    // const id = "https://www.youtube.com/embed/"+x.getAttribute("vid")+"?autoplay=1";
    const id = x.getAttribute("vid") + "?autoplay=1";
    let youtube = document.querySelector(".youtube iframe");
    if( screen.width <= 1000) {
        youtube = document.querySelector(".youtube-mobile iframe");
        document.querySelector(".youtube-mobile").classList.remove("dnone");
        document.querySelector(".youtube-mobile iframe").setAttribute("src",id);
        youtube.setAttribute("width","100%")
        youtube.setAttribute("height","40%")
        youtube.setAttribute("style","margin:40% 0;")
        return;
    }
    document.querySelector(".youtube").classList.remove("dnone");
    youtube.setAttribute("src",id);
        
}
function RunVideoBut(x){
    // const id = "https://www.youtube.com/embed/"+x.previousSibling.previousSibling.getAttribute('vid')+"?autoplay=1";
    const id = x.previousSibling.previousSibling.getAttribute('vid')+"?autoplay=1";
    let youtube = document.querySelector(".youtube iframe");
    if( screen.width <= 1000) {
        youtube = document.querySelector(".youtube-mobile iframe");
        document.querySelector(".youtube-mobile").classList.remove("dnone");
        document.querySelector(".youtube-mobile iframe").setAttribute("src",id);
        youtube.setAttribute("width","100%")
        youtube.setAttribute("height","40%")
        youtube.setAttribute("style","margin:40% 0;")
        return;
    }
    document.querySelector(".youtube").classList.remove("dnone");
    youtube.setAttribute("src",id);
}
function ClickExitYoutube(){
    document.querySelectorAll(".overlay").forEach( function(x){
        x.classList.add('dnone');
    });
    var youtube = document.querySelector(".youtube iframe");
    if( screen.width <= 1000){
        youtube = document.querySelector(".youtube-mobile iframe");
        youtube.setAttribute("src","https://www.youtube.com/embed/rPBL2sSy7O4");
        return;
    }
    youtube.setAttribute("src","https://www.youtube.com/embed/rPBL2sSy7O4");
}

function get_image_url(url = ""){
    const params = url.match(/embed\/(.*)/g)
    if (params != null) {
        return `https://img.youtube.com/vi/${params[0].split("/")[1]}/0.jpg`
    }
    else return ""
}


(function(){
    let iter = 1
    // console.log('vid_list',vid_list)
    // let image_list = vid_list.map(el => {
    //     return get_image_url(el)
    // })
    // console.log('image_list',image_list)
    // js for php
    const image = document.querySelector('.md-video img[alt="med-vid"]')
    // update 25/1/2020 - create next_image
    const next_image = document.querySelector('.add-video img[alt="addVideo"]')
    const plus = document.querySelector('.add-video .plus')
    const play = document.querySelector('.md-video .play-btn')
    image.src = "dashboard"+image_list[iter]
    // update 25/1/2020 - if next_image
    if(image_list.length <= 1) next_image.src="./img/no-video.png";
    else if(iter+1 <= image_list.length-1 )
        next_image.src = "dashboard"+image_list[iter+1]
    else 
        next_image.src = "dashboard"+image_list[1]  
    image.setAttribute('vid',vid_list[iter])
    const next = document.getElementById('add-video')
    next.onclick = function(){
      iter = iter == image_list.length - 1 ? 1:++iter
      image.src = "dashboard"+image_list[iter]
      // update 25/1/2020 - if next_image 
      if(image_list.length <= 1) next_image.src="./img/no-video.png";
      else
        if(iter+1 <= image_list.length-1 )
        next_image.src = "dashboard"+image_list[iter+1]
        else 
        next_image.src = "dashboard"+image_list[1]
      image.animate([
        // keyframes
        { opacity: 0,
        transform: 'translate(0)' },
        { opacity: 1,
        transform: 'translate(0)' }
      ], {
        // timing options
        duration: 1000,
      })
      next_image.animate([
        // keyframes
        { opacity: 0,
        transform: 'translate(0)' },
        { opacity: 1,
        transform: 'translate(0)' }
      ], {
        // timing options
        duration: 1000,
      })
      plus.animate([
        // keyframes
        { opacity: 0,},
        { opacity: 1,}
      ], {
        // timing options
        duration: 1000,
      })
      play.animate([
        // keyframes
        { opacity: 0,
        transform: 'translate(-50%,-50%)' },
        { opacity: 1,
        transform: 'translate(-50%,-50%)' }
      ], {
        // timing options
        duration: 1000,
      })
      image.setAttribute('vid',vid_list[iter])
    }
    
  })()