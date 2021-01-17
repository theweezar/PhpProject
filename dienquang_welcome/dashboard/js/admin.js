// Điều chỉnh kích thước của ảnh

const IMAGE = {
  width: '300',
  height: 'auto'
}

function load_image_from_server(){

}

// Đọc data của ảnh vừa được upload
function load_image(input){
  const file = input.files[0]
  const reader = new FileReader()
  reader.onloadend = function(){
    input.nextElementSibling.firstElementChild.setAttribute('width',IMAGE.width)
    input.nextElementSibling.firstElementChild.setAttribute('height',IMAGE.height)
    input.nextElementSibling.firstElementChild.src = this.result
  }
  if (file != null) reader.readAsDataURL(file)
}

// Load dữ liệu đường link embed
function load_embed(input){
  try {
    const url = new URL(input.parentElement.previousElementSibling.value)
    const params = url.search;
    const link = `https://www.youtube.com/embed/${params}`
    // const link = input.parentElement.previousElementSibling.value
    input.parentElement.parentElement.nextElementSibling.firstElementChild.src = link
  } catch (error) {
    input.parentElement.parentElement.nextElementSibling.firstElementChild.src = ""
  }
}

function switch_option(){
  const mode = this.selectedIndex
  // Text mode
  if (mode == 0){
    this.parentElement.parentElement.nextElementSibling.setAttribute('contenteditable','true')
    this.parentElement.parentElement.nextElementSibling.innerHTML = ''
  }
  // Image mode
  else if (mode == 1){
    this.parentElement.parentElement.nextElementSibling.removeAttribute('contenteditable')
    this.parentElement.parentElement.nextElementSibling.innerHTML = `
      <input type="file" name="" accept="image/png, image/jpeg, image/jpg" onchange="load_image(this)" id="upload-image">
      <div class="text-center">
          <img src="" alt="">
      </div>
    `
  }
  // Embed mode
  else if (mode == 2){
    this.parentElement.parentElement.nextElementSibling.removeAttribute('contenteditable')
    this.parentElement.parentElement.nextElementSibling.innerHTML = `
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Embed Link">
        <div class="input-group-append">
            <span onclick="load_embed(this)" class="input-group-text bg-info text-white pointer">Load</span>
        </div>
      </div>
      <div class="text-center">
        <iframe width="560" height="315" src="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
    ` 
  }
}

function save_content(){
  const content = document.querySelectorAll('div[content-id]')
  var ok = true;
  content.forEach(el => {
    // Lấy dư liệu
    const mode = el.previousElementSibling.lastElementChild.firstElementChild.selectedIndex
    var data = undefined
    // Text
    if (mode == 0){
      data = el.innerText.trim()
      if (data.length == 0) ok = false
    }
    // Image
    else if (mode == 1){
      // data = el.querySelector('img').getAttribute('src').trim()
      // if (data.length == 0) ok = false
      var files = el.querySelector('input').files
      if (files.length > 0){
        var form = new FormData()
        // Image data
        form.append('image_to_upload',files[0])
        // type
        form.append('id', el.getAttribute('content-id'))
        data = form
      }
      else data = null;
    }
    // Embed
    else if (mode == 2){
      data = el.querySelector('iframe').getAttribute('src').trim()
      if (data.length == 0) ok = false
    }
    // console.log('Mode:',mode,'Length:',data == null ? 'null':data.length,'Data:',data)
    // AJAX
    if (ok) {
      if (mode == 0 || mode == 2){
        $.ajax({
          url:'./save_text.php',
          type:'POST',
          data:{
            id: el.getAttribute('content-id'),
            data: data,
            type: mode + 1
          },
          success: function(response){
            console.log(response)
          },
          error: function(error){
            // console.error(error)
          }
        })
      }
      else if (mode == 1 && data != null){
        $.ajax({
          url:'./save_image.php',
          type:'POST',
          data: data,
          contentType: false,
          processData: false,
          success: function(response){
            console.log(response)
          },
          error: function(error){
            // console.error(error)
          }
        })
      }
    }
  })
  if (ok) alert('Lưu dữ liệu thành công')
  else alert('Lưu dữ liệu thất bại. Vui lòng nhập đủ các thông tin, không được để trống')
}

(function(){
  document.querySelectorAll('select').forEach(el => {
    el.addEventListener('change', switch_option)
  })
  document.getElementById('savebtn').addEventListener('click', save_content)
  document.querySelectorAll('div[content-id]').forEach(el => {
    try {
      const image = el.querySelector('img')
      image.setAttribute('width', IMAGE.width) 
      image.setAttribute('height', IMAGE.height)
    } catch (error) {
      
    }
  })
})()