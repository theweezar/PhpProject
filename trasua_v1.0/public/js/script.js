document.getElementById("accountblock").addEventListener("click",function(){
  document.getElementById("more").classList.toggle("unactive");
  
});
let giohang = document.getElementById("index");
let sl = document.getElementById("index").innerText;

if(sl <='0') giohang.style.display = 'none';
else
if(sl > 0) giohang.style.display = "block";   

function createProduct(i) {
    return `<div class="product">
            
    <div class="imgbox">
        <img src="img/p1.png" alt="">
    </div>
    <div class="infor">
            <div class="name">Trà sữa trân châu</div>
            <div class="price">Giá: <span>30.000đ</span></div>
    </div> 
    <div class="btn" id="p${i}">Order </div>
    </div>`
}
function event(i){
  document.getElementById(`p${i}`).addEventListener("click",function(){
    // console.log(this);
    this.classList.toggle("active");
    this.parentElement.classList.toggle("chosen");
});
}
let main = document.getElementById("main");
for(let i=1;i<=10;i++){
  main.innerHTML += createProduct(i);
}
for(let i=1;i<=10;i++){
  event(i);
}
