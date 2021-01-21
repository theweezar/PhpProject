<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/database/web_content.php');

$web_content = new WebContent();

// $result = $web_content->load_content_with_name("nav_1_trang_chu");

function fetch_content_with_name($database, $name){
    try {
        $result = $database->load_content_with_name($name);
        if ($result != null){
            $content = mysqli_fetch_assoc($result);
            return $content["content"];
        }
        else return "";
    } catch (Exception $e) {
        return "Lỗi kết nối database";
    }
}

// fetch_content_with_name($web_content, "nav_1_trang_chu");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Dien Quang</title>
    <link rel="shortcut icon" href="./img/left-nav-dienquang-logo.png" type="image/x-icon">
    <link rel="stylesheet" href="css/animation.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/splide.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js"></script>
    <script id="iframe_api"></script>
</head>
<body>
    <div class="container">
        <!---------------NAV----------------------------------------------- -->
        <nav>
            <!-- --------------------------------------- -->
            <div class="logo">
                <img class="dienquang desktop" src="/dashboard<?php echo fetch_content_with_name($web_content, "logo_1"); ?>" 
                alt="Dien Quang">
                <img class="dienquang-logo desktop" src="/dashboard<?php echo fetch_content_with_name($web_content, "logo_3"); ?>" 
                alt="dienquang-logo">
                <img class="dienquang mobile" src="/dashboard<?php echo fetch_content_with_name($web_content, "logo_1"); ?>" 
                alt="Dien Quang">
                <img class="dienquang-logo mobile" src="/dashboard<?php echo fetch_content_with_name($web_content, "logo_3"); ?>" 
                alt="dienquang-logo">
            </div>
            <!-- ---  -->
            <div class="navlink">
                <div class="nl-item">
                    <a href="#" id="home" ><?php echo fetch_content_with_name($web_content, "nav_1_trang_chu"); ?></a>
                </div>
                <div class="nl-item" id="language">
                    <a href="#" id="lang" ><?php echo fetch_content_with_name($web_content, "nav_2_ngon_ngu"); ?></a>
                    <ul class="language-dropbox">
                        <li id="vi" onclick="TranslatetoVietNamese()">Tiếng Việt</li>
                        <li id="en" onclick="TranslatetoEnglish()">Tiếng Anh</li>
                    </ul>
                </div>
                <div class="nl-item" onclick="ClicktoOpenContactOverlay()">
                    <a href="#" id="contact" ><?php echo fetch_content_with_name($web_content, "nav_3_lien_he"); ?></a>
                </div>
            </div>
            <!-- --------------------------------------- -->
        </nav>
        <!-- ----------MAIN------------------------------------ -->
        <div class="overlay formore-mobile dnone"  onclick="ClickExit()">
            <h2>Lorem ipsum dolor sit amet</h2>
            
            <p><span></span> Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deserunt quia eveniet cumque neque, distinctio tempora excepturi voluptatum modi veritatis animi pariatur cum perspiciatis ullam facilis commodi quos blanditiis nam adipisci.
            Aperiam qui rerum a atque! Obcaecati magni dolorum rem repellendus sit suscipit reiciendis necessitatibus, quidem corrupti exercitationem vel nulla dolorem repellat autem nobis laudantium earum natus quo. Nemo, alias maxime.
           </p>
            
            <p><span></span> Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deserunt quia eveniet cumque neque, distinctio tempora excepturi voluptatum modi veritatis animi pariatur cum perspiciatis ullam facilis commodi quos blanditiis nam adipisci.
            Aperiam qui rerum a atque! Obcaecati magni dolorum rem repellendus sit suscipit reiciendis necessitatibus, quidem corrupti exercitationem vel nulla dolorem repellat autem nobis laudantium earum natus quo. Nemo, alias maxime.
            </p>
            
            <!-- <p><span></span> Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deserunt quia eveniet cumque neque, distinctio tempora excepturi voluptatum modi veritatis animi pariatur cum perspiciatis ullam facilis commodi quos blanditiis nam adipisci.
            Aperiam qui rerum a atque! Obcaecati magni dolorum rem repellendus sit suscipit reiciendis necessitatibus, quidem corrupti exercitationem vel nulla dolorem repellat autem nobis laudantium earum natus quo. Nemo, alias maxime.
            </p> -->
            <button class="exit" onclick="ClickExit()">
                <img src="./img/exit-icon.png" alt="exit-icon">
            </button>
        </div>
        <div class="overlay youtube-mobile dnone" onclick="ClickExitYoutube()" style="animation-duration: 1s;" >
            <iframe style="margin: 0 5%;box-sizing: border-box;" width="89%" height="100%" src="https://www.youtube.com/embed/rPBL2sSy7O4" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <button class="exit" onclick="ClickExitYoutube()">
                <img src="./img/exit-icon.png" alt="exit-icon">
            </button>
        </div>
        <main>
            <!-- ---------OVERLAY------------------------------ -->
            <div class="overlay youtube dnone" onclick="ClickExitYoutube()" style="animation-duration: 1s;">
                <iframe style="margin: 0 5%;box-sizing: border-box;" width="89%" height="100%" src="https://www.youtube.com/embed/rPBL2sSy7O4" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                <button class="exit" onclick="ClickExitYoutube()">
                    <img src="./img/exit-icon.png" alt="exit-icon">
                </button>
            </div>
            <div class="overlay contact dnone" onclick="ClickExit()">
                <h2><?php echo fetch_content_with_name($web_content, "company_name"); ?></h2>
                <p><?php echo fetch_content_with_name($web_content, "address"); ?></p>
                    <p>Hotline: <?php echo fetch_content_with_name($web_content, "hotline"); ?> 
                    - Email: <?php echo fetch_content_with_name($web_content, "email"); ?></p>
                    <p>Website: <?php echo fetch_content_with_name($web_content, "website"); ?></p>
                <button class="exit" onclick="ClickExit()">
                    <img src="./img/exit-icon.png" alt="exit-icon">
                </button>
            </div>
            <div class="overlay formore dnone " onclick="ClickExit()">
                <h2>Lorem ipsum dolor sit amet</h2>
                
                <p><span></span> Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deserunt quia eveniet cumque neque, distinctio tempora excepturi voluptatum modi veritatis animi pariatur cum perspiciatis ullam facilis commodi quos blanditiis nam adipisci.
                Aperiam qui rerum a atque! Obcaecati magni dolorum rem repellendus sit suscipit reiciendis necessitatibus, quidem corrupti exercitationem vel nulla dolorem repellat autem nobis laudantium earum natus quo. Nemo, alias maxime.
               </p>
                
                <p><span></span> Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deserunt quia eveniet cumque neque, distinctio tempora excepturi voluptatum modi veritatis animi pariatur cum perspiciatis ullam facilis commodi quos blanditiis nam adipisci.
                Aperiam qui rerum a atque! Obcaecati magni dolorum rem repellendus sit suscipit reiciendis necessitatibus, quidem corrupti exercitationem vel nulla dolorem repellat autem nobis laudantium earum natus quo. Nemo, alias maxime.
                </p>
                
                <!-- <p><span></span> Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deserunt quia eveniet cumque neque, distinctio tempora excepturi voluptatum modi veritatis animi pariatur cum perspiciatis ullam facilis commodi quos blanditiis nam adipisci.
                Aperiam qui rerum a atque! Obcaecati magni dolorum rem repellendus sit suscipit reiciendis necessitatibus, quidem corrupti exercitationem vel nulla dolorem repellat autem nobis laudantium earum natus quo. Nemo, alias maxime.
                </p> -->
                <button class="exit" onclick="ClickExit()">
                    <img src="./img/exit-icon.png" alt="exit-icon">
                </button>
            </div>
            <!-- ---------------------------------------------- -->
            <!-- ----------VISUAL------------------------------- -->
            <div class="visual">
                <!-- ----------TOP FOR MOB ----------------- -->
                <div class="top">
                    <div class="video big-video">
                        <img vid="5mhasaD8jzg" src="./img/big-vid-mobile.png" onclick="RunVideo(this)" alt="big-vid">
                        <div class="play-btn" onclick="RunVideoBut(this)">
                            &#x25B6;
                        </div>
                    </div>
                    
                    <div id="splide" class="splide slider">
                        <div class="splide__track">
                            <ul class="splide__list" style="color: white">
                                <li class="splide__slide slide">
                                    <div>
                                        <img vid="Qb_t_mdEK-E" src="./img/med-vid-mobile.png" onclick="RunVideo(this)" alt="Med vid">
                                        <div class="play-btn" onclick="RunVideoBut(this)">
                                            &#x25B6;
                                        </div>
                                    </div>
                                    <div>
                                        <img vid="Qb_t_mdEK-E" src="./img/med-vid-mobile.png" onclick="RunVideo(this)" alt="Med vid">
                                        <div class="play-btn" onclick="RunVideoBut(this)">
                                            &#x25B6;
                                        </div>
                                    </div>
                                    <div>
                                        <img vid="Qb_t_mdEK-E" src="./img/med-vid-mobile.png" onclick="RunVideo(this)" alt="Med vid">
                                        <div class="play-btn" onclick="RunVideoBut(this)">
                                            &#x25B6;
                                        </div>
                                    </div>
                                </li>
                                <li class="splide__slide slide">
                                    <div>
                                        <img vid="Qb_t_mdEK-E" src="./img/med-vid-mobile.png" onclick="RunVideo(this)" alt="Med vid">
                                        <div class="play-btn" onclick="RunVideoBut(this)">
                                            &#x25B6;
                                        </div>
                                    </div>
                                    <div>
                                        <img vid="Qb_t_mdEK-E" src="./img/med-vid-mobile.png" onclick="RunVideo(this)" alt="Med vid">
                                        <div class="play-btn" onclick="RunVideoBut(this)">
                                            &#x25B6;
                                        </div>
                                    </div>
                                    <div>
                                        <img vid="Qb_t_mdEK-E" src="./img/med-vid-mobile.png" onclick="RunVideo(this)" alt="Med vid">
                                        <div class="play-btn" onclick="RunVideoBut(this)">
                                            &#x25B6;
                                        </div>
                                    </div>
                                </li>
                                <li class="splide__slide slide">
                                    <div>
                                        <img vid="Qb_t_mdEK-E" src="./img/med-vid-mobile.png" onclick="RunVideo(this)" alt="Med vid">
                                        <div class="play-btn" onclick="RunVideoBut(this)">
                                            &#x25B6;
                                        </div>
                                    </div>
                                    <div>
                                        <img vid="Qb_t_mdEK-E" src="./img/med-vid-mobile.png" onclick="RunVideo(this)" alt="Med vid">
                                        <div class="play-btn" onclick="RunVideoBut(this)">
                                            &#x25B6;
                                        </div>
                                    </div>
                                    <div>
                                        <img vid="Qb_t_mdEK-E" src="./img/med-vid-mobile.png" onclick="RunVideo(this)" alt="Med vid">
                                        <div class="play-btn" onclick="RunVideoBut(this)">
                                            &#x25B6;
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                </div>
                <!-- --------LEFT FOR DES & MOB ----------------- -->
                <div class="left">
                    <div class="certi">
                        <img src="./img/VietNam-Value-logo.png" alt="VietNam-Value-logo">
                        <p><?php echo fetch_content_with_name($web_content, "slogan"); ?></p>
                    </div>
                    <div class="intro">
                        <p id="content">
                        <?php echo fetch_content_with_name($web_content, "introduce"); ?>
                        </p>
                    </div>
                    <div class="formore">
                        <button id="formore-btn" onclick="ClicktoOpenFormoreOverlay()">
                            <p id="formore">Xem Thêm</p>
                            <img src="./img/formore-icon.png" alt="formore-icon">
                        </button>
                    </div>
                    <div class="logo5">
                        <img src="./img/logo-5-nganh-hang.png" alt="logo-5-nganh-hang">
                    </div>
                </div>
                <!-- ---------RIGHT FOR DES ----------------- -->
                <div class="right">
                    <div class="big-video video">
                        <img vid="5mhasaD8jzg" 
                        src="dashboard<?php echo fetch_content_with_name($web_content, "embed_thumbnail_1"); ?>" 
                        alt="big-vid" onclick="RunVideo(this)">
                        <div class="play-btn" onclick="RunVideoBut(this)">
                            &#x25B6;
                        </div>
                    </div>
                    <div class="med-video video">
                        <div class="md-video video">
                            <img vid="rPBL2sSy7O4" src="./img/Med-vid.png" alt="med-vid" onclick="RunVideo(this)">
                            <div class="play-btn" onclick="RunVideoBut(this)">
                                &#x25B6;
                            </div>
                        </div>
                        <div class="add-video" id="add-video">
                            <img src="./img/addVideo.png" alt="addVideo">
                        </div>
                    </div>
                </div>
            </div>
            <div class="interact">
                <div>
                    <a href="https://dienquang.com/"><img src="./img/home_24px.png" alt="Home"></a>
                </div>
                <div>
                    <a href="tel:19001257"><img src="./img/call_24px.png" alt="Call"></a>
                </div>
                <div onclick="TranslatetoVietNamese2()">
                    <img src="./img/VI.png" alt="VI" >
                </div>
                <div onclick="TranslatetoEnglish2()"> 
                    <img src="./img/EN.png" alt="EN">
                </div>
            </div>
        </main>
        <!-- ------BUTTON FOR MOBILE------------------- -->
        
    </div>
    

</body>

<script>
    // Load từ các đường link embed tại đây
    // const image_list = ['Med-vid.png', 'Med-vid2.png', 'Med-vid3.png']
    // const vid_list = ['rPBL2sSy7O4','Qb_t_mdEK-E', 'HR42lbbPjTg']

    const vid_list = [
        <?php 
            $embed_rs = $web_content->load_content_with_type(3);
            if ($embed_rs != null){
                for($i = 0; $i < mysqli_num_rows($embed_rs); $i++){
                    $embed_content = mysqli_fetch_assoc($embed_rs);
                    echo "'".$embed_content['content']."',";
                }
            }    
        ?>
    ]

    const image_list = [
        <?php 
            $thumbnail_rs = $web_content->load_all_thumbnail_order_embed_id();
            if ($thumbnail_rs != null){
                for($i = 0; $i < mysqli_num_rows($thumbnail_rs); $i++){
                    $thumbnail = mysqli_fetch_assoc($thumbnail_rs);
                    echo "'".$thumbnail['thumbnail_link']."',";
                }
            }    
        ?>
    ]
    
    // 'Qb_t_mdEK-E', 'HR42lbbPjTg'
</script>

<script src="./js/TranslateHandler.js"></script>
<!-- <script src="./js/IframeAPIforMobile.js"></script> -->
<script src="./js/ClickHandler.js"></script>
<script>
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
    
  </script>
</html>

