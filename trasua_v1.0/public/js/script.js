document.getElementById('accountblock').addEventListener('click',function(){
  document.getElementById('more').classList.toggle('unactive');
  
});

document.getElementById('thanhtoan').addEventListener('click',function(){
  if (confirm("Ban co chac chan khong ?")){
    window.location = `/thanhtoan/${this.getAttribute('total')}`;
  }
});