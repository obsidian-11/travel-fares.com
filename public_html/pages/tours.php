<?php 
    $tours_file = file_get_contents('data/tour-packages.json');
    $tours = json_decode($tours_file);

    
    $filtered_countries = array_filter($tours->countries, function($country) {
        $slug = $_SERVER['REQUEST_URI'];
        return $country->slug == $slug;
    });

?>


<div class="pkjs-heading-container">
    <h1>
      <?php 
       echo array_values($filtered_countries)[0]->name
      ?>  
Tour Packages 
    </h1>
    
</div>

<div class="container">
    <div id="packages-list">
        <?php 
            
            foreach(array_values($filtered_countries)[0]->packages as $tour) {
       ?>

        <div class="package tour-package">
                <div class="cover">
                    <img class="tour-pkg-img" width="300px" height="100%" src="img/tour-feature-card.jpg" alt="">
                </div> 
                <div class="content">   
                    <div class="info">  
                        <h2><?php echo $tour->name ?></h2>
                        <div class="duration"><?php echo count($tour->itinerary) ?> Days</div>
                        <div class="inclusions"><p><?php echo $tour->inclusions ?></p></div>
                        <div class="itinerary hide">
                        <?php
                        foreach($tour->itinerary as $day){
                        ?>
                    <p><?php echo $day ?></p>
                        <?php
                        } 
                        ?>

</div>

                        <button onclick="toggleVisibility(<?php echo $tour->id ?>)" class="btn btn-show-more">SHOW MORE</button>
                    </div>
                    <div class="price-section">
                        <h1><?php echo $tour->cost ?></h1>
                        <p>per person</p>
                        <button class="btn btn-search btn-book-pkg">Book Now</button>
                    </div>
                </div>
        </div>
        <?php
             }

        ?>
    </div>
</div>

<script>
    const tours = document.querySelectorAll(".tour-package");

   const toggleVisibility = (id) => {
    const itinerary = tours[id-1].querySelector('.itinerary');
    const showMoreBtn = tours[id-1].querySelector(".btn-show-more")
    if(Array.from(itinerary.classList).includes("hide")){
        itinerary.classList.remove("hide");
        showMoreBtn.textContent = "SHOW LESS"
    }else{
        itinerary.classList.add("hide");
        showMoreBtn.textContent = "SHOW MORE"
    }
   }

</script>