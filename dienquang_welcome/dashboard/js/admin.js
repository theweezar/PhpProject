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

function insert_embed(){
  $('#page-content').append(
    `<div class="card shadow mb-4">
      <div class="card-header py-3">
          <h6 contenteditable="true" id="content-name" class="m-0 font-weight-bold text-primary">===> Edit name here <===</h6>
          <button id="delete" onclick="delete_embed(this)" 
          class="float-right btn btn-danger text-white border border-danger">&#10007;</button>
          <div class="my-2 d-none">
              <select name="" id="select-option">
                  <option value="1" disabled>Text</option>
                  <option value="2" disabled>Image</option>
                  <option value="3" selected="selected" >Embed</option>
              </select>
          </div>
      </div>
      <div new-content="true" class="card-body">
        <!-- HTML for Embed go here -->
        <div class="input-group mb-3">
            <input type="text" class="form-control" 
            placeholder="Dẫn đường link embed vào đầy và ấn Load">
            <div class="input-group-append">
                <span onclick="load_embed(this)" class="input-group-text bg-info text-white pointer">Load</span>
            </div>
        </div>
        <div class="text-center">
            <iframe width="300" height="auto" src="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <div>
            <div>Tải thumbnail</div>
            <input type="file" name="image_to_upload" onchange="load_image(this)" 
            accept="image/png, image/jpeg, image/jpg" id="upload-image">
            <div class="text-center">
                <img src="." alt="">
            </div>
        </div>
      </div>
  </div>`
  )
}

function delete_embed(input){
  const whole_content = input.parentElement.parentElement
  const content = whole_content.querySelector('div[content-id]')
  if (content){
    $.ajax({
      url:"./delete.php",
      type:"POST",
      data:{
        id:content.getAttribute("content-id")
      },
      success: function(response){
        console.log(response)
      }
    })
  }
  whole_content.parentElement.removeChild(whole_content)
}

// Load dữ liệu đường link embed
function load_embed(input){
  try {
    // const url = new URL(input.parentElement.previousElementSibling.value)
    // const params = url.search;
    // const link = `https://www.youtube.com/embed/${params}`
    // const link = input.parentElement.previousElementSibling.value
    const url = input.parentElement.previousElementSibling.value
    const params = url.match(/v=(.{11})/g)
    var youtube_id = ""
    var link = "https://www.youtube.com/embed/"
    if (params != null) youtube_id = params[0].split("=")[1]
    input.parentElement.parentElement.parentElement.querySelector("iframe").src = link + youtube_id
  } catch (error) {
    input.parentElement.parentElement.parentElement.querySelector("iframe").src = ""
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
      <input type="text" class="form-control" 
      placeholder="Dẫn đường link embed vào đầy và ấn Load">
      <div class="input-group-append">
          <span onclick="load_embed(this)" class="input-group-text bg-info text-white pointer">Load</span>
      </div>
    </div>
    <div class="text-center">
      <iframe width="300" height="auto" src="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
    <div>
      <div>Tải thumbnail</div>
      <input type="file" name="image_to_upload" onchange="load_image(this)" 
      accept="image/png, image/jpeg, image/jpg" id="upload-image">
      <div class="text-center">
        <img src="." alt="">
      </div>
    </div>
    ` 
  }
}

function ajax_save_text(url, data){
  $.ajax({
    url:url,
    type:'POST',
    data:data,
    success: function(response){
      console.log(response)
    },
    error: function(error){
      // console.error(error)
    }
  })
}

function ajax_save_image(url, data){
  $.ajax({
    url:url,
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

function save_content(){
  const content = document.querySelectorAll('div[content-id]')
  content.forEach(el => {
    // Lấy dư liệu
    const id = el.getAttribute('content-id')
    const mode = el.previousElementSibling.lastElementChild.firstElementChild.selectedIndex
    const name = el.parentElement.querySelector("h6").innerText
    var data = undefined
    // Text
    if (mode == 0){
      data = el.innerText.trim()
      ajax_save_text('./save_text.php',{
        id: id,
        name: name,
        data: data,
        type: mode + 1,
        status: 1
      })
    }
    // Image
    else if (mode == 1){
      // data = el.querySelector('img').getAttribute('src').trim()
      // if (data.length == 0) ok = false
      var files = el.querySelector('input').files
      var form = new FormData()
      if (files.length > 0){
        // Image data
        form.append('status',1)
        form.append('image_to_upload',files[0])
      }
      else form.append('status',0)
      form.append('id', el.getAttribute('content-id'))
      form.append('name', name)
      
      // Nếu data != null tức là đã upload 1 ảnh mới, thì mới ajax để save ảnh đó về
      ajax_save_image('./save_image.php',form) 
    }
    // Embed
    else if (mode == 2){
      data = el.querySelector('iframe').getAttribute('src').trim()
      var status = 1
      if (data.length == 0){
        status = 0
      }
      ajax_save_text('./save_text.php',{
        id: id,
        name: name,
        data: data,
        type: mode + 1,
        status: status
      })
      data_img = el.querySelector('input[type="file"]').files
      console.log('data:',data,'\ndata_img',data_img)
      if (data_img.length > 0){
        var form = new FormData()
        // Image data
        form.append('image_to_upload',data_img[0])
        form.append('id', el.getAttribute('content-id'))
        // Khúc lưu ảnh thumbnail ở đây
        ajax_save_image('./save_thumbnail.php',form)
      }
      
    }
    // console.log('Mode:',mode,'Length:',data == null ? 'null':data.length,'Data:',data)
  })
  alert('Lưu dữ liệu thành công')

  const new_content = document.querySelectorAll('div[new-content]')
  new_content.forEach(el => {
    const mode = el.previousElementSibling.lastElementChild.firstElementChild.selectedIndex
    const name = el.parentElement.querySelector("h6").innerText
    const data_src = el.querySelector('iframe').getAttribute('src').trim()
    const data_img = el.querySelector('input[type="file"]').files
  
    var form = new FormData()
    // Lưu content trong web_content và thumbnail trước, có thể 2 cái đó có null
    form.append('name',name)
    form.append('iframe',data_src)
    $.ajax({
      url:"./insert_embed.php",
      type:"POST",
      data: form,
      contentType: false,
      processData: false,
      success: function(response){
        response = JSON.parse(response)
        console.log(response)
        if (data_img.length > 0){
          form.append('image_to_upload',data_img[0])
          form.append('id', response.newest_embed_id)
          ajax_save_image('./save_thumbnail.php',form)
        }
        el.setAttribute("content-id",response.newest_embed_id)
        el.removeAttribute("new-content")
      }
    })

    console.log('name:',name,'\ndata:',data_src,'\ndata_img',data_img,'\nmode:',mode)
  })
}

(function(){

  document.querySelectorAll('select').forEach(el => {
    el.addEventListener('change', switch_option)
  })

  document.getElementById('savebtn').addEventListener('click', save_content)
  
  const insert_btn = document.getElementById('insert-btn')
  if (insert_btn != null) insert_btn.addEventListener('click', insert_embed)

  document.querySelectorAll('div[content-id]').forEach(el => {
    try {
      // Content nào là hình ảnh thì sẽ thực hiện được, còn ko phải thì sẽ ném ra ko thực thi trong try
      const image = el.querySelector('img')
      image.setAttribute('width', IMAGE.width) 
      image.setAttribute('height', IMAGE.height)
    } catch (error) {
      
    }
  })
})()