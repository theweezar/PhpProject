<?php 
    include_once($_SERVER['DOCUMENT_ROOT'].'./index.php');
?>

    <!-- Navbar go here  -->
    <div class="orange-line"></div>
    <div class="container-fluid px-all py-1 bg-light shadowbox">
         <div class=" row align-items-center">
             <div class="img-container btn my-0 p-0">
                 <img src="./img/logo-stackoverflow.png" alt="logo" width="75%" height="80%">
             </div>
             <div class="row align-items-center">
                <div class="nav-item ml-3 mr-4 p-1 btn small text-dark">
                    About
                </div>
                <div class="nav-item mr-4 p-1 btn small text-dark">
                    Products
                </div>
                <div class="nav-item mr-4 p-1 btn small text-dark">
                    For teams
                </div>
                
                <div class="search my-1 position-relative">
                    <div class="icon position-absolute">
                        <div class="fas fa-search"></div>
                    </div>
                    <input type="text" placeholder="Search.." >
                </div>
                <div>
                    <a class="btn border-info text-info ml-3 py-1 px-2 small" href="./login.php">Log in</a>
                    <a class="btn btn-info text-white py-1 px-2 small" href="./register.php">Sign up</a>
                </div>
             </div>
         </div>
    </div>
     <!-- Navbar end here -->
    <div class="container-fluid h-100 px-all row">
        <!-- Vùng bên trái go here  -->
        <aside class="ml-4 px-3  h-100 ">
            <div class="content py-5">
                
            </div>
        </aside>
        <!-- Vùng bên trái end here -->
        <!-- Vùng main chính go here -->
        <main class="h-100   p-4">
            <!-- Phần All questions, Ask question button, question_count  -->
            <div class="row  align-items-center mb-4"> 
                <div class="h3 font-weight-normal col-10">
                    All Questions
                </div>
                <div class="btn btn-info small">
                    Ask Question
                </div>
            </div>
            <div>
                <span id="count_questions">0</span> questions
            </div>
            <!-- Phần gạch chân ngang  -->
            
            <!-- 
                # PHẦN PHP GENERATOR
                # UPVOTE DOWNVOTE 
                # COUNT ANSWER
                # AUTHOR
                # TIME -->
            <div class="container">
                <!-- One Question -->
                <hr class="container-fluid">
                <div class="question-box row" id="1">
                    <div class="question-left">
                        <div class="question-left-item votes">
                            <div class="question-left-item-count count_votes" >0</div> 
                            votes
                        </div>
                        <div class="question-left-item answers">
                            <div class="question-left-item-count count_answers" >0</div> 
                            answers
                        </div>
                        <div class="question-left-item"> <span>2</span> views
                        </div>
                    </div>
                    <div class="question-right col-11 px-2">
                        <div class="header h6">
                            <a href="#" class="font-weight-normal link">Unclutter igraph network graphs in R</a>
                        </div>
                        <div class="content">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam commodi voluptas aspernatur ut architecto nobis eum dolores doloribus optio enim repellendus earum aut quidem, dignissimos voluptatem quo. Aut, laborum dicta?
                            Quo iure repellendus reiciendis iusto deserunt delectus eum illo repudiandae. Impedit voluptatum eius quia provident commodi, quae libero optio accusantium. Error iste ut alias ea nemo tenetur quo reprehenderit aliquid?
                            Modi distinctio, ab minus nisi quisquam unde a ad. Deleniti porro impedit fuga explicabo accusantium asperiores error minus, officia sed tenetur recusandae. Dolorum veniam harum cupiditate voluptas at mollitia aliquam.
                            Itaque inventore reprehenderit, nemo exercitationem cupiditate deserunt consequatur vero dicta similique nulla eum doloremque consectetur tenetur debitis fugiat necessitatibus obcaecati! Illo tenetur reprehenderit temporibus omnis beatae in est voluptates perferendis.
                            Sunt suscipit maxime soluta optio est doloremque ut cum dolor aspernatur facere vitae, perferendis praesentium, repudiandae itaque a rerum officiis modi tempore saepe tempora, ratione recusandae. Atque cumque et consequatur.
                            Maxime reiciendis, nesciunt reprehenderit perferendis quas quisquam iusto saepe incidunt ullam amet animi sit itaque. Itaque dolore veniam labore tempora earum perferendis, ipsum dignissimos! Deserunt vitae distinctio corporis. Iure, voluptate.
                            Vel, nam ipsum cumque impedit iure ut, harum, vitae expedita laudantium earum quia exercitationem accusantium rem ea natus provident sapiente corrupti culpa fuga cupiditate debitis magnam hic. Nemo, laborum quasi.
                            Fuga eligendi molestias provident facere, consequatur numquam, consequuntur ea, ipsa aliquam vero impedit repudiandae natus facilis obcaecati. Dolorum nam earum vitae non nesciunt expedita qui voluptate cum dolor magnam. Minus.
                            Laboriosam molestiae inventore consectetur necessitatibus porro. Quo error incidunt, at inventore, repellat fugiat sit voluptatum et praesentium cupiditate sed ipsa veritatis! Optio quisquam alias, quibusdam vitae dicta error necessitatibus saepe.
                            Tempore atque numquam deserunt sequi sapiente, magni totam dignissimos debitis officia animi fugit sunt dolorem incidunt! Consequuntur soluta veritatis facere sequi nulla at tenetur quod deleniti aspernatur, tempore laudantium corrupti.
                        </div>
                        <div class="author small mt-3 mr-5 float-right">
                            <div class="time">asked <span>1 min</span> ago</div>
                            <div class="about d-flex">
                                <img src="img/ava.png" alt="ava" width="35px" height="35px">
                                <a href="#" class="auther-name px-2 link">stats555</a>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <!-- End one Question -->
                <!-- One Question -->
                <hr class="container-fluid">
                <div class="question-box row" id="2">
                    <div class="question-left">
                        <div class="question-left-item votes">
                            <div class="question-left-item-count count_votes" >0</div> 
                            votes
                        </div>
                        <div class="question-left-item answers">
                            <div class="question-left-item-count count_answers" >0</div> 
                            answers
                        </div>
                        <div class="question-left-item"> <span>2</span> views
                        </div>
                    </div>
                    <div class="question-right col-11 px-2">
                        <div class="header h6">
                            <a href="#" class="font-weight-normal link">Unclutter igraph network graphs in R</a>
                        </div>
                        <div class="content">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam commodi voluptas aspernatur ut architecto nobis eum dolores doloribus optio enim repellendus earum aut quidem, dignissimos voluptatem quo. Aut, laborum dicta?
                            Quo iure repellendus reiciendis iusto deserunt delectus eum illo repudiandae. Impedit voluptatum eius quia provident commodi, quae libero optio accusantium. Error iste ut alias ea nemo tenetur quo reprehenderit aliquid?
                            Modi distinctio, ab minus nisi quisquam unde a ad. Deleniti porro impedit fuga explicabo accusantium asperiores error minus, officia sed tenetur recusandae. Dolorum veniam harum cupiditate voluptas at mollitia aliquam.
                            Itaque inventore reprehenderit, nemo exercitationem cupiditate deserunt consequatur vero dicta similique nulla eum doloremque consectetur tenetur debitis fugiat necessitatibus obcaecati! Illo tenetur reprehenderit temporibus omnis beatae in est voluptates perferendis.
                            Sunt suscipit maxime soluta optio est doloremque ut cum dolor aspernatur facere vitae, perferendis praesentium, repudiandae itaque a rerum officiis modi tempore saepe tempora, ratione recusandae. Atque cumque et consequatur.
                            Maxime reiciendis, nesciunt reprehenderit perferendis quas quisquam iusto saepe incidunt ullam amet animi sit itaque. Itaque dolore veniam labore tempora earum perferendis, ipsum dignissimos! Deserunt vitae distinctio corporis. Iure, voluptate.
                            Vel, nam ipsum cumque impedit iure ut, harum, vitae expedita laudantium earum quia exercitationem accusantium rem ea natus provident sapiente corrupti culpa fuga cupiditate debitis magnam hic. Nemo, laborum quasi.
                            Fuga eligendi molestias provident facere, consequatur numquam, consequuntur ea, ipsa aliquam vero impedit repudiandae natus facilis obcaecati. Dolorum nam earum vitae non nesciunt expedita qui voluptate cum dolor magnam. Minus.
                            Laboriosam molestiae inventore consectetur necessitatibus porro. Quo error incidunt, at inventore, repellat fugiat sit voluptatum et praesentium cupiditate sed ipsa veritatis! Optio quisquam alias, quibusdam vitae dicta error necessitatibus saepe.
                            Tempore atque numquam deserunt sequi sapiente, magni totam dignissimos debitis officia animi fugit sunt dolorem incidunt! Consequuntur soluta veritatis facere sequi nulla at tenetur quod deleniti aspernatur, tempore laudantium corrupti.
                        </div>
                        <div class="author small mt-3 mr-5 float-right">
                            <div class="time">asked <span>1 min</span> ago</div>
                            <div class="about d-flex">
                                <img src="img/ava.png" alt="ava" width="35px" height="35px">
                                <a href="#" class="auther-name px-2 link">stats555</a>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <!-- End one Question -->
                <!-- One Question -->
                <hr class="container-fluid">
                <div class="question-box row" id="3">
                    <div class="question-left">
                        <div class="question-left-item votes">
                            <div class="question-left-item-count count_votes" >0</div> 
                            votes
                        </div>
                        <div class="question-left-item answers">
                            <div class="question-left-item-count count_answers" >0</div> 
                            answers
                        </div>
                        <div class="question-left-item"> <span>2</span> views
                        </div>
                    </div>
                    <div class="question-right col-11 px-2">
                        <div class="header h6">
                            <a href="#" class="font-weight-normal link">Unclutter igraph network graphs in R</a>
                        </div>
                        <div class="content">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam commodi voluptas aspernatur ut architecto nobis eum dolores doloribus optio enim repellendus earum aut quidem, dignissimos voluptatem quo. Aut, laborum dicta?
                            Quo iure repellendus reiciendis iusto deserunt delectus eum illo repudiandae. Impedit voluptatum eius quia provident commodi, quae libero optio accusantium. Error iste ut alias ea nemo tenetur quo reprehenderit aliquid?
                            Modi distinctio, ab minus nisi quisquam unde a ad. Deleniti porro impedit fuga explicabo accusantium asperiores error minus, officia sed tenetur recusandae. Dolorum veniam harum cupiditate voluptas at mollitia aliquam.
                            Itaque inventore reprehenderit, nemo exercitationem cupiditate deserunt consequatur vero dicta similique nulla eum doloremque consectetur tenetur debitis fugiat necessitatibus obcaecati! Illo tenetur reprehenderit temporibus omnis beatae in est voluptates perferendis.
                            Sunt suscipit maxime soluta optio est doloremque ut cum dolor aspernatur facere vitae, perferendis praesentium, repudiandae itaque a rerum officiis modi tempore saepe tempora, ratione recusandae. Atque cumque et consequatur.
                            Maxime reiciendis, nesciunt reprehenderit perferendis quas quisquam iusto saepe incidunt ullam amet animi sit itaque. Itaque dolore veniam labore tempora earum perferendis, ipsum dignissimos! Deserunt vitae distinctio corporis. Iure, voluptate.
                            Vel, nam ipsum cumque impedit iure ut, harum, vitae expedita laudantium earum quia exercitationem accusantium rem ea natus provident sapiente corrupti culpa fuga cupiditate debitis magnam hic. Nemo, laborum quasi.
                            Fuga eligendi molestias provident facere, consequatur numquam, consequuntur ea, ipsa aliquam vero impedit repudiandae natus facilis obcaecati. Dolorum nam earum vitae non nesciunt expedita qui voluptate cum dolor magnam. Minus.
                            Laboriosam molestiae inventore consectetur necessitatibus porro. Quo error incidunt, at inventore, repellat fugiat sit voluptatum et praesentium cupiditate sed ipsa veritatis! Optio quisquam alias, quibusdam vitae dicta error necessitatibus saepe.
                            Tempore atque numquam deserunt sequi sapiente, magni totam dignissimos debitis officia animi fugit sunt dolorem incidunt! Consequuntur soluta veritatis facere sequi nulla at tenetur quod deleniti aspernatur, tempore laudantium corrupti.
                        </div>
                        <div class="author small mt-3 mr-5 float-right">
                            <div class="time">asked <span>1 min</span> ago</div>
                            <div class="about d-flex">
                                <img src="img/ava.png" alt="ava" width="35px" height="35px">
                                <a href="#" class="auther-name px-2 link">stats555</a>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <!-- End one Question -->
            </div>
        </main>
        <!-- Vùng main chính end here -->
    </div>

    
<?php 
    include_once($_SERVER['DOCUMENT_ROOT'].'./footer.php');
?>
