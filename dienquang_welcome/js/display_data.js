
function display(json_data){
  vi.content = json_data["introduce"]
  en.content = json_data["introduce_en"]
  document.querySelectorAll('[key-data]').forEach(el => {
    const key = el.getAttribute('key-data')
    const data = json_data[key]
    switch(el.tagName.toLowerCase()){
      case 'img': 
        el.setAttribute('src', `dashboard${data}`);
        break
      default:
        el.innerHTML = data
        break
    }
    // if (el.tagName == "IMG") el.setAttribute("src", data)
    // else if (el.tagName == "")
  })

  let big_vid = json_data["embed"][0]
  document.getElementById('big-video').setAttribute('src',`dashboard${big_vid['thumbnail_link']}`)
  document.getElementById('big-video').setAttribute('vid',`${big_vid['iframe_link']}`)

  console.log(json_data["embed"])
  let med_vid = json_data["embed"].slice(1,)
  let length = med_vid.length
  const loop = Math.floor(length / 3)
  for(let i = 0; i <= loop; i++){
    const li = document.createElement('li')
    var to = undefined
    if (length >= 3) to = i * 3 + 3
    else to = i * 3 + length
    li.setAttribute('class','splide__slide slide')
    for(let j = i * 3; j < to; j++){
      li.innerHTML += 
        `<div>
          <img vid="${med_vid[j]["iframe_link"]}" 
          src="dashboard${med_vid[j]["thumbnail_link"]}" onclick="RunVideo(this)" alt="Med vid">
          <div class="play-btn" onclick="RunVideoBut(this)">
            &#x25B6;
          </div>
        </div>`
      
      console.log(med_vid[j])
    }
    if (length > 0) document.getElementById('phone-splide').appendChild(li)
    length -= 3;
  }
  new Splide( '#splide', {
    type    : 'loop',
    autoplay: true,
    } ).mount();
  document.querySelector('.splide__list').style.transform = 'none';
  document.querySelectorAll('.splide__arrows button').forEach((x)=>{
    x.style.display = 'none';
  })
  document.querySelectorAll('.splide__pagination__page').forEach((x)=>{
    x.style.width = '1.2vh';
    x.style.height = '1.2vh';
    x.style.transform = 'translateY(.9vh)';
  })
}

var json_response = undefined

$.ajax({
  url:"./api_content.php",
  type:"POST",
  success: function(response){
    json_response = JSON.parse(response)
    console.log('API:',json_response)
    // for(var json in json_response){
    //   console.log('Key:',json,' - Data:',json_response[json])
    // }
    display(json_response)
  }
})
