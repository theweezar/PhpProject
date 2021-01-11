
const id = [ "home", "lang", "contact" ]
const en = {
    navitem: ["Home", "Language","Contact"],
    content: "Dien Quang was established in <b>1973</b>, is the only National Brand in the lighting industry; is transforming strongly towards becoming a multinational technology corporation specializing in lighting, electrical equipment and smart control.",
    formore: "See more",
    language: ["Vietnamese","English"]
}
const vi = {
    navitem: ["Trang chủ", "Ngôn ngữ","Liên hệ"],
    content: "Điện Quang được thành lập từ năm <b>1973</b>, là Thương Hiệu Quốc gia duy nhất trong ngành chiếu sáng; đang chuyển mình mạnh mẽ theo định hướng trở thành tập đoàn công nghệ đa quốc gia chuyên sâu trong lĩnh vực chiếu sáng, thiết bị điện và điều khiển thông minh.",
    formore: "Xem thêm",
    language: ["Tiếng Việt","Tiếng Anh"]
}

function TranslatetoVietNamese(){
    document.getElementById('home').innerHTML = vi.navitem[0];
    
    document.getElementById('lang').innerHTML = vi.navitem[1];
    
    document.getElementById('contact').innerHTML = vi.navitem[2];

    document.getElementById('vi').innerHTML = vi.language[0];
    
    document.getElementById('en').innerHTML = vi.language[1];

    document.getElementById('content').innerHTML = vi.content;

    document.getElementById('formore').innerHTML = vi.formore;
}
function TranslatetoVietNamese2(){
    document.getElementById('content').innerHTML = vi.content;

    document.getElementById('formore').innerHTML = vi.formore;
}

function TranslatetoEnglish(){
    document.getElementById('home').innerHTML = en.navitem[0];
    
    document.getElementById('lang').innerHTML = en.navitem[1];
    
    document.getElementById('contact').innerHTML = en.navitem[2];

    document.getElementById('vi').innerHTML = en.language[0];
    
    document.getElementById('en').innerHTML = en.language[1];

    document.getElementById('content').innerHTML = en.content;

    document.getElementById('formore').innerHTML = en.formore;

}
function TranslatetoEnglish2(){
    document.getElementById('content').innerHTML = en.content;

    document.getElementById('formore').innerHTML = en.formore;
}

