
function display(json_data){
  document.querySelectorAll('[key-data]').forEach(el => {
    const key = el.getAttribute('key-data')
    console.log(key)
  })
}

$.ajax({
  url:"./api_content.php",
  type:"POST",
  success: function(response){
    json_response = JSON.parse(response)
    console.log('API:',json_response)
    // for(var json in json_response){
    //   console.log('Key:',json,' - Data:',json_response[json])
    // }
    // display(json_response)
  }
})
