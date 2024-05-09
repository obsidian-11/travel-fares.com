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
                        <button onclick="toggleBookingForm(`<?php echo $tour->name ?>`)" class="btn btn-search btn-book-pkg">Book Now</button>
                    </div>
                </div>
        </div>
        <?php
             }

        ?>
    </div>
</div>

<div id="body-overlay" class="hide"></div>

<div id="booking-form" class="hide" >
    <div class="flex-row-space-between align-center">
        <h1 id="booking-heading">Tour Package Name</h1>
       <a onclick="toggleBookingForm(null)" href="javascript:;">
       <svg  xmlns="http://www.w3.org/2000/svg" width="2.5rem" height="2.5rem" viewBox="0 0 24 24" fill="none">
            <path d="M16 8L8 16M8.00001 8L16 16" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
       </a>

    </div>
    <form action="#">
                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                  <div class="field-label"><strong>Travellers</strong></div>
                    <div class="col-md-12  position-relative">
                        <div class="traveler" id="pax_inp">
                            <span class="icon-travelers">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#006ee3" class="bi bi-person-fill" viewBox="0 0 16 16">
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"></path>
                                </svg>
                            </span>
                            <input type="text" class="form-control ps-5 pes-txt" placeholder="1 Traveler, 0 Adults, 0 Child">
                        </div>

                        <div class="pess-pop bg-white shadow position-absolute p-3 box_px pop-box" style="display: none;">
                            <div class="pess-box ps-3 pe-3">
                                <small class="d-block">Passengers</small>
                                <div class="row my-3 align-items-center">
                                    <div class="col-5 pe-0">
                                        <div class="row py-2 align-items-center">
                                            <div class="col pe-0 text-center">
                                                <svg class="Icon__StyledIcon-sc-psgqgs-0 hlUuqk" width="16px" viewBox="0 0 24 24" preserveAspectRatio="xMidYMid meet">
                                            <path d="M21.083 17.577c-.583-1.25-2.666-2-5.583-3.084-.583-.166-.918-.25-1.083-.75-.167-.417-.167-.916.165-1.333 1.168-1.25 1.751-3.083 1.751-5.5 0-3.083-2.167-4.5-4.333-4.5-2.167 0-4.334 1.417-4.334 4.583 0 2.417.584 4.25 1.666 5.5.251.416.335.917.168 1.334-.168.416-.5.5-1.083.749-2.917 1.084-5 1.834-5.584 3.084-.5 1.082-.833 2.25-.833 3.5 0 .25.167.417.417.417h19.166c.25 0 .417-.167.417-.417 0-1.25-.334-2.418-.917-3.583Z"></path></svg>
                                            </div>
                                            <div class="col-9 ps-1">
                                                <small><b>Adults</b></small>
                                                <span class="small"><small class="small d-block">Over 11</small></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-7">
                                        <div class="row py-2 align-items-center number-spinner">
                                            <div class="col-4 pe-1 text-end">
                                                <span class="pm-clicks text-center down_count count" title="Down" disabled="">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="17px">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 12H6"></path>
                                            </svg></span>
                                            </div>
                                            <div class="col-4 ps-0 pe-0">
                                                <input readonly="" value="1" type="text" placeholder="0" name="adults" id="AdultsRT" class="counter bt_new quantity count text-center bt_new">
                                            </div>
                                            <div class="col-4 ps-1 text-start">
                                                <span class="pm-clicks up_count count text-center" title="Up" disabled="">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="17px">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6"></path>
                                            </svg>
                                        </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row my-3 align-items-center">
                                    <div class="col-5 pe-0">
                                        <div class="row py-2 align-items-center">
                                            <div class="col pe-0 text-center">
                                                <svg class="Icon__StyledIcon-sc-psgqgs-0 hlUuqk" width="16px" viewBox="0 0 24 24" preserveAspectRatio="xMidYMid meet">
                                            <path d="M9.917 11.99a1.042 1.042 0 1 0-2.084.001 1.042 1.042 0 0 0 2.084 0ZM16.167 11.99a1.042 1.042 0 1 0-2.084.001 1.042 1.042 0 0 0 2.084 0ZM10.466 15.192a2.514 2.514 0 0 0 3.068 0 .832.832 0 1 1 1.098 1.25 4.084 4.084 0 0 1-5.265 0 .833.833 0 0 1 1.099-1.25Z"></path><path d="M19.917 10.717v-.114a8.103 8.103 0 0 0-7.375-8.175 7.925 7.925 0 0 0-8.459 7.896v.257a.436.436 0 0 1-.221.357 2.916 2.916 0 0 0 .657 5.607c.07.009.13.054.157.12a7.918 7.918 0 0 0 14.648 0 .195.195 0 0 1 .157-.12 2.917 2.917 0 0 0 .574-5.638.202.202 0 0 1-.138-.19Zm-.834 4.189h-.312c-.4 0-.745.285-.82.678a4.304 4.304 0 0 1-1.51 2.75C12.175 21.521 7.26 19.51 6.026 15.5a.833.833 0 0 0-.797-.588h-.311a1.25 1.25 0 1 1 .017-2.5.823.823 0 0 0 .816-.828v-1.26a6.249 6.249 0 0 1 6.113-6.242.177.177 0 0 0 .018.008c.432.092.81.353 1.048.726a1.405 1.405 0 0 1-.279 1.988c-.464.291-1.074.181-1.407-.255a.834.834 0 1 0-1.5.727 2.812 2.812 0 0 0 2.281 1.381 2.9 2.9 0 0 0 2.764-2.237c.09-.427.095-.869.011-1.297a.21.21 0 0 1 .307-.213 6.241 6.241 0 0 1 3.144 5.413v1.25a.823.823 0 0 0 .812.833h.004a1.25 1.25 0 1 1 .017 2.499Z"></path></svg>
                                            </div>
                                            <div class="col-9 ps-1">
                                                <small><b>Children</b></small>
                                                <span class="small"><small class="small d-block">2 - 11</small></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-7">
                                        <div class="row py-2 align-items-center number-spinner">
                                            <div class="col-4 pe-1 text-end">
                                                <span class="pm-clicks text-center down_count count" title="Down">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="17px">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 12H6"></path>
                                            </svg></span>
                                            </div>
                                            <div class="col-4 ps-0 pe-0">
                                                <input type="text" value="0" name="childs" id="ChildrenRT" class="counter bt_new quantity count text-center bt_new" readonly="">
                                            </div>
                                            <div class="col-4 ps-1 text-start">
                                                <span class="pm-clicks text-centerup_count count" title="Up" disabled="">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="17px">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6"></path>
                                            </svg>
                                        </span>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="row my-3 align-items-center">
                                    <div class="col-5 pe-0">
                                        <div class="row py-2 align-items-center">
                                            <div class="col pe-0 text-center">
                                                <svg class="Icon__StyledIcon-sc-psgqgs-0 hlUuqk" width="16px" viewBox="0 0 24 24" preserveAspectRatio="xMidYMid meet">
                                            <path d="M9.192 12.041a1.104 1.104 0 1 1 0-2.208 1.104 1.104 0 0 1 0 2.208ZM13.464 10.937a1.104 1.104 0 1 1 2.209 0 1.104 1.104 0 0 1-2.209 0ZM11.875 15.27c1.105 0 1.975-.487 1.975-1.591 0-1.105-.895-1.122-2-1.122s-2 .017-2 1.122c0 1.104.92 1.592 2.025 1.592Z"></path><path d="M19.81 7.34a2.61 2.61 0 0 1 1.323.602c.396.349.867 1.01.867 2.181 0 .948-.404 1.53-.742 1.85-.456.432-1.02.62-1.467.701v.001a.448.448 0 0 0-.28.246c-1.661 3.215-4.204 5.301-7.652 6.282l-.064.017-.066.019c-3.247-1.074-5.65-3.123-7.23-6.148-.086-.166-.212-.269-.36-.278-.885-.163-1.813-.722-2.064-1.96-.242-1.189.147-1.976.516-2.428.454-.555 1.072-.855 1.64-.982.418-1.048 1.524-3.294 3.636-4.395 1.509-.787 3.022-1.168 4.497-1.138h.006a.673.673 0 0 0 .055 0c.398.011.797.054 1.186.126 3.063.567 5.425 3.02 6.198 5.303Zm-.673 3.621c.152.007.654-.033.906-.277.08-.076.186-.218.186-.56 0-.406-.088-.692-.26-.848-.264-.239-.723-.204-.742-.203a.896.896 0 0 1-.97-.706c-.25-1.255-1.492-3.166-3.5-4.114.028.295.018.63-.06 1.01-.32 1.562-1.54 2.073-2.503 2.073-.16 0-.314-.015-.454-.04a.886.886 0 0 1 .31-1.744c.502.076.808-.14.912-.644.074-.365.046-.65-.085-.846-.147-.222-.427-.339-.576-.381-1.166-.017-2.383.294-3.616.937-2.08 1.084-2.95 3.865-2.96 3.893a.888.888 0 0 1-.847.628c-.28 0-.687.127-.916.407-.186.228-.236.54-.152.954.131.647.852.61 1.07.583a.892.892 0 0 1 .995.766c.324 2.543 2.754 3.743 2.779 3.755a.895.895 0 0 1 .107.06c1.471.983 3.392.908 3.412.907.021-.001.045-.002.066-.001h.004c.097-.002 1.812-.024 3.52-1.319 2.088-1.583 2.449-3.525 2.452-3.545a.883.883 0 0 1 .922-.745Z"></path><path d="M4.06 14.35c-.142 4.728 2.321 7.745 7.94 7.745 1.938 0 3.502-.36 4.718-.993-5.873-.258-10.111-2.51-12.659-6.751Z"></path><path d="M18.107 20.125c1.552-1.45 2.14-3.584 1.893-5.996l-.002-.02c-1.547 2.638-3.721 4.508-6.508 5.6 1.373.285 2.874.424 4.504.417H18.107Z"></path></svg>
                                            </div>
                                            <div class="col-9 ps-1">
                                                <small><b>Infants</b></small>
                                                <span class="small"><small class="small d-block">Under 2</small></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-7">
                                        <div class="row py-2 align-items-center number-spinner">
                                            <div class="col-4 pe-1 text-end">
                                                <span class="pm-clicks text-center down_count count" title="Down" disabled="">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="17px">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 12H6"></path>
                                            </svg></span>
                                            </div>
                                            <div class="col-4 ps-0 pe-0">
                                                <input type="text" value="0" name="InfantsST" id="InfantsST" class="count text-center bt_new counter bt_new quantity" readonly="">
                                            </div>
                                            <div class="col-4 ps-1 text-start">
                                                <span class="pm-clicks text-center up_count count" title="Up" disabled="">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="17px">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6"></path>
                                            </svg>
                                        </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="border-top"></div>

                                <div class="text-end p-2 pe-0">
                                    <span type="button" onclick="all_pesenger()" class="pax_btn done">Done</span>
                                </div>

                            </div>
                    </div>
                </div>

                <div class="form-group col-lg-12">
                    <div class="field-label"><strong>Travel Date</strong></div>
                    <div class="date-range-left" >
                        <div class="date">
                            <span class="icon-travelers">
                                <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4.51589 1.83614H8.79411V0.688554C8.79411 0.308415 9.112 0 9.50714 0C9.90228 0 10.2202 0.308415 10.2202 0.688554V1.83614H11.4086C12.4573 1.83614 13.31 2.6581 13.31 3.67229V12.853C13.31 13.8658 12.4573 14.6891 11.4086 14.6891H1.90143C0.851186 14.6891 0 13.8658 0 12.853V3.67229C0 2.6581 0.851186 1.83614 1.90143 1.83614H3.08982V0.688554C3.08982 0.308415 3.40772 0 3.80286 0C4.198 0 4.51589 0.308415 4.51589 0.688554V1.83614ZM1.42607 12.853C1.42607 13.1055 1.63879 13.312 1.90143 13.312H11.4086C11.67 13.312 11.8839 13.1055 11.8839 12.853V5.50843H1.42607V12.853Z" fill="#006EE3"></path>
                                </svg>
                            </span>
                            <input style="padding-left:3rem;" type="text" name="daterange" placeholder="DD MM YYYY" class="form-control form-control-w-border bg-white" id="daterange" autocomplete="off" readonly="">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                <div class="field-label"><strong>Full Name</strong></div>
                  <div class="field-inner">
                    <input
                      class="form-control form-control-w-border"
                      type="text"
                      name="booking-name"
                      placeholder=""
                      required=""
                      value=""
                      id="input-name"
                    />
                  </div>
                </div>
                </div>

                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                  <div class="field-label"><strong>Email</strong></div>
                  <div class="field-inner">
                    <input
                      type="email"
                      name="booking-email"
                      placeholder=""
                      required=""
                      value=""
                      id="input-email"
                      class="form-control form-control-w-border"
                    />
                  </div>
                </div>

                <div class="row">
                <div class="form-group col-lg-6 col-md-6 col-sm-12">
                  <div class="field-label">
                    <strong>Nationality</strong>
                  </div>
                  <div class="field-inner">
                    <select
                      id="form-nationality-select"
                      class="form-control form-control-w-border"
                      name="booking-nationality"
                    >
                      <option value="Afghanistan">Afghanistan</option>
                      <option value="Albania">Albania</option>
                      <option value="Algeria">Algeria</option>
                      <option value="American Samoa">American Samoa</option>
                      <option value="Andorra">Andorra</option>
                      <option value="Angola">Angola</option>
                      <option value="Anguilla">Anguilla</option>
                      <option value="Antartica">Antarctica</option>
                      <option value="Antigua and Barbuda">
                        Antigua and Barbuda
                      </option>
                      <option value="Argentina">Argentina</option>
                      <option value="Armenia">Armenia</option>
                      <option value="Aruba">Aruba</option>
                      <option value="Australia">Australia</option>
                      <option value="Austria">Austria</option>
                      <option value="Azerbaijan">Azerbaijan</option>
                      <option value="Bahamas">Bahamas</option>
                      <option value="Bahrain">Bahrain</option>
                      <option value="Bangladesh">Bangladesh</option>
                      <option value="Barbados">Barbados</option>
                      <option value="Belarus">Belarus</option>
                      <option value="Belgium">Belgium</option>
                      <option value="Belize">Belize</option>
                      <option value="Benin">Benin</option>
                      <option value="Bermuda">Bermuda</option>
                      <option value="Bhutan">Bhutan</option>
                      <option value="Bolivia">Bolivia</option>
                      <option value="Bosnia and Herzegowina">
                        Bosnia and Herzegowina
                      </option>
                      <option value="Botswana">Botswana</option>
                      <option value="Bouvet Island">Bouvet Island</option>
                      <option value="Brazil">Brazil</option>
                      <option value="British Indian Ocean Territory">
                        British Indian Ocean Territory
                      </option>
                      <option value="Brunei Darussalam">
                        Brunei Darussalam
                      </option>
                      <option value="Bulgaria">Bulgaria</option>
                      <option value="Burkina Faso">Burkina Faso</option>
                      <option value="Burundi">Burundi</option>
                      <option value="Cambodia">Cambodia</option>
                      <option value="Cameroon">Cameroon</option>
                      <option value="Canada">Canada</option>
                      <option value="Cape Verde">Cape Verde</option>
                      <option value="Cayman Islands">Cayman Islands</option>
                      <option value="Central African Republic">
                        Central African Republic
                      </option>
                      <option value="Chad">Chad</option>
                      <option value="Chile">Chile</option>
                      <option value="China">China</option>
                      <option value="Christmas Island">Christmas Island</option>
                      <option value="Cocos Islands">
                        Cocos (Keeling) Islands
                      </option>
                      <option value="Colombia">Colombia</option>
                      <option value="Comoros">Comoros</option>
                      <option value="Congo">Congo</option>
                      <option value="Congo">
                        Congo, the Democratic Republic of the
                      </option>
                      <option value="Cook Islands">Cook Islands</option>
                      <option value="Costa Rica">Costa Rica</option>
                      <option value="Cota D'Ivoire">Cote d'Ivoire</option>
                      <option value="Croatia">Croatia (Hrvatska)</option>
                      <option value="Cuba">Cuba</option>
                      <option value="Cyprus">Cyprus</option>
                      <option value="Czech Republic">Czech Republic</option>
                      <option value="Denmark">Denmark</option>
                      <option value="Djibouti">Djibouti</option>
                      <option value="Dominica">Dominica</option>
                      <option value="Dominican Republic">
                        Dominican Republic
                      </option>
                      <option value="East Timor">East Timor</option>
                      <option value="Ecuador">Ecuador</option>
                      <option value="Egypt">Egypt</option>
                      <option value="El Salvador">El Salvador</option>
                      <option value="Equatorial Guinea">
                        Equatorial Guinea
                      </option>
                      <option value="Eritrea">Eritrea</option>
                      <option value="Estonia">Estonia</option>
                      <option value="Ethiopia">Ethiopia</option>
                      <option value="Falkland Islands">
                        Falkland Islands (Malvinas)
                      </option>
                      <option value="Faroe Islands">Faroe Islands</option>
                      <option value="Fiji">Fiji</option>
                      <option value="Finland">Finland</option>
                      <option value="France">France</option>
                      <option value="France Metropolitan">
                        France, Metropolitan
                      </option>
                      <option value="French Guiana">French Guiana</option>
                      <option value="French Polynesia">French Polynesia</option>
                      <option value="French Southern Territories">
                        French Southern Territories
                      </option>
                      <option value="Gabon">Gabon</option>
                      <option value="Gambia">Gambia</option>
                      <option value="Georgia">Georgia</option>
                      <option value="Germany">Germany</option>
                      <option value="Ghana">Ghana</option>
                      <option value="Gibraltar">Gibraltar</option>
                      <option value="Greece">Greece</option>
                      <option value="Greenland">Greenland</option>
                      <option value="Grenada">Grenada</option>
                      <option value="Guadeloupe">Guadeloupe</option>
                      <option value="Guam">Guam</option>
                      <option value="Guatemala">Guatemala</option>
                      <option value="Guinea">Guinea</option>
                      <option value="Guinea-Bissau">Guinea-Bissau</option>
                      <option value="Guyana">Guyana</option>
                      <option value="Haiti">Haiti</option>
                      <option value="Heard and McDonald Islands">
                        Heard and Mc Donald Islands
                      </option>
                      <option value="Holy See">
                        Holy See (Vatican City State)
                      </option>
                      <option value="Honduras">Honduras</option>
                      <option value="Hong Kong">Hong Kong</option>
                      <option value="Hungary">Hungary</option>
                      <option value="Iceland">Iceland</option>
                      <option value="India">India</option>
                      <option value="Indonesia">Indonesia</option>
                      <option value="Iran">Iran (Islamic Republic of)</option>
                      <option value="Iraq">Iraq</option>
                      <option value="Ireland">Ireland</option>
                      <option value="Israel">Israel</option>
                      <option value="Italy">Italy</option>
                      <option value="Jamaica">Jamaica</option>
                      <option value="Japan">Japan</option>
                      <option value="Jordan">Jordan</option>
                      <option value="Kazakhstan">Kazakhstan</option>
                      <option value="Kenya">Kenya</option>
                      <option value="Kiribati">Kiribati</option>
                      <option value="Democratic People's Republic of Korea">
                        Korea, Democratic People's Republic of
                      </option>
                      <option value="Korea">Korea, Republic of</option>
                      <option value="Kuwait">Kuwait</option>
                      <option value="Kyrgyzstan">Kyrgyzstan</option>
                      <option value="Lao">
                        Lao People's Democratic Republic
                      </option>
                      <option value="Latvia">Latvia</option>
                      <option value="Lebanon">Lebanon</option>
                      <option value="Lesotho">Lesotho</option>
                      <option value="Liberia">Liberia</option>
                      <option value="Libyan Arab Jamahiriya">
                        Libyan Arab Jamahiriya
                      </option>
                      <option value="Liechtenstein">Liechtenstein</option>
                      <option value="Lithuania">Lithuania</option>
                      <option value="Luxembourg">Luxembourg</option>
                      <option value="Macau">Macau</option>
                      <option value="Macedonia">
                        Macedonia, The Former Yugoslav Republic of
                      </option>
                      <option value="Madagascar">Madagascar</option>
                      <option value="Malawi">Malawi</option>
                      <option value="Malaysia">Malaysia</option>
                      <option value="Maldives">Maldives</option>
                      <option value="Mali">Mali</option>
                      <option value="Malta">Malta</option>
                      <option value="Marshall Islands">Marshall Islands</option>
                      <option value="Martinique">Martinique</option>
                      <option value="Mauritania">Mauritania</option>
                      <option value="Mauritius">Mauritius</option>
                      <option value="Mayotte">Mayotte</option>
                      <option value="Mexico">Mexico</option>
                      <option value="Micronesia">
                        Micronesia, Federated States of
                      </option>
                      <option value="Moldova">Moldova, Republic of</option>
                      <option value="Monaco">Monaco</option>
                      <option value="Mongolia">Mongolia</option>
                      <option value="Montserrat">Montserrat</option>
                      <option value="Morocco">Morocco</option>
                      <option value="Mozambique">Mozambique</option>
                      <option value="Myanmar">Myanmar</option>
                      <option value="Namibia">Namibia</option>
                      <option value="Nauru">Nauru</option>
                      <option value="Nepal">Nepal</option>
                      <option value="Netherlands">Netherlands</option>
                      <option value="Netherlands Antilles">
                        Netherlands Antilles
                      </option>
                      <option value="New Caledonia">New Caledonia</option>
                      <option value="New Zealand">New Zealand</option>
                      <option value="Nicaragua">Nicaragua</option>
                      <option value="Niger">Niger</option>
                      <option value="Nigeria">Nigeria</option>
                      <option value="Niue">Niue</option>
                      <option value="Norfolk Island">Norfolk Island</option>
                      <option value="Northern Mariana Islands">
                        Northern Mariana Islands
                      </option>
                      <option value="Norway">Norway</option>
                      <option value="Oman">Oman</option>
                      <option value="Pakistan">Pakistan</option>
                      <option value="Palau">Palau</option>
                      <option value="Panama">Panama</option>
                      <option value="Papua New Guinea">Papua New Guinea</option>
                      <option value="Paraguay">Paraguay</option>
                      <option value="Peru">Peru</option>
                      <option value="Philippines">Philippines</option>
                      <option value="Pitcairn">Pitcairn</option>
                      <option value="Poland">Poland</option>
                      <option value="Portugal">Portugal</option>
                      <option value="Puerto Rico">Puerto Rico</option>
                      <option value="Qatar">Qatar</option>
                      <option value="Reunion">Reunion</option>
                      <option value="Romania">Romania</option>
                      <option value="Russia">Russian Federation</option>
                      <option value="Rwanda">Rwanda</option>
                      <option value="Saint Kitts and Nevis">
                        Saint Kitts and Nevis
                      </option>
                      <option value="Saint LUCIA">Saint LUCIA</option>
                      <option value="Saint Vincent">
                        Saint Vincent and the Grenadines
                      </option>
                      <option value="Samoa">Samoa</option>
                      <option value="San Marino">San Marino</option>
                      <option value="Sao Tome and Principe">
                        Sao Tome and Principe
                      </option>
                      <option value="Saudi Arabia">Saudi Arabia</option>
                      <option value="Senegal">Senegal</option>
                      <option value="Seychelles">Seychelles</option>
                      <option value="Sierra">Sierra Leone</option>
                      <option value="Singapore">Singapore</option>
                      <option value="Slovakia">
                        Slovakia (Slovak Republic)
                      </option>
                      <option value="Slovenia">Slovenia</option>
                      <option value="Solomon Islands">Solomon Islands</option>
                      <option value="Somalia">Somalia</option>
                      <option value="South Africa">South Africa</option>
                      <option value="South Georgia">
                        South Georgia and the South Sandwich Islands
                      </option>
                      <option value="Span">Spain</option>
                      <option value="SriLanka">Sri Lanka</option>
                      <option value="St. Helena">St. Helena</option>
                      <option value="St. Pierre and Miguelon">
                        St. Pierre and Miquelon
                      </option>
                      <option value="Sudan">Sudan</option>
                      <option value="Suriname">Suriname</option>
                      <option value="Svalbard">
                        Svalbard and Jan Mayen Islands
                      </option>
                      <option value="Swaziland">Swaziland</option>
                      <option value="Sweden">Sweden</option>
                      <option value="Switzerland">Switzerland</option>
                      <option value="Syria">Syrian Arab Republic</option>
                      <option value="Taiwan">Taiwan, Province of China</option>
                      <option value="Tajikistan">Tajikistan</option>
                      <option value="Tanzania">
                        Tanzania, United Republic of
                      </option>
                      <option value="Thailand">Thailand</option>
                      <option value="Togo">Togo</option>
                      <option value="Tokelau">Tokelau</option>
                      <option value="Tonga">Tonga</option>
                      <option value="Trinidad and Tobago">
                        Trinidad and Tobago
                      </option>
                      <option value="Tunisia">Tunisia</option>
                      <option value="Turkey">Turkey</option>
                      <option value="Turkmenistan">Turkmenistan</option>
                      <option value="Turks and Caicos">
                        Turks and Caicos Islands
                      </option>
                      <option value="Tuvalu">Tuvalu</option>
                      <option value="Uganda">Uganda</option>
                      <option value="Ukraine">Ukraine</option>
                      <option selected value="United Arab Emirates">
                        United Arab Emirates
                      </option>
                      <option value="United Kingdom">United Kingdom</option>
                      <option value="United States">United States</option>
                      <option value="United States Minor Outlying Islands">
                        United States Minor Outlying Islands
                      </option>
                      <option value="Uruguay">Uruguay</option>
                      <option value="Uzbekistan">Uzbekistan</option>
                      <option value="Vanuatu">Vanuatu</option>
                      <option value="Venezuela">Venezuela</option>
                      <option value="Vietnam">Viet Nam</option>
                      <option value="Virgin Islands (British)">
                        Virgin Islands (British)
                      </option>
                      <option value="Virgin Islands (U.S)">
                        Virgin Islands (U.S.)
                      </option>
                      <option value="Wallis and Futana Islands">
                        Wallis and Futuna Islands
                      </option>
                      <option value="Western Sahara">Western Sahara</option>
                      <option value="Yemen">Yemen</option>
                      <option value="Serbia">Serbia</option>
                      <option value="Zambia">Zambia</option>
                      <option value="Zimbabwe">Zimbabwe</option>
                    </select>
                  </div>
                </div>

                <div class="form-group col-lg-6 col-md-6 col-sm-12">
                  <div class="field-label">
                    <strong>Country of Residence</strong>
                  </div>
                  <div class="field-inner">
                    <select
                      id="form-residence-select"
                      class="form-control form-control-w-border"
                      name="booking-countryOfResidence"
                    >
                      <option value="Afghanistan">Afghanistan</option>
                      <option value="Albania">Albania</option>
                      <option value="Algeria">Algeria</option>
                      <option value="American Samoa">American Samoa</option>
                      <option value="Andorra">Andorra</option>
                      <option value="Angola">Angola</option>
                      <option value="Anguilla">Anguilla</option>
                      <option value="Antartica">Antarctica</option>
                      <option value="Antigua and Barbuda">
                        Antigua and Barbuda
                      </option>
                      <option value="Argentina">Argentina</option>
                      <option value="Armenia">Armenia</option>
                      <option value="Aruba">Aruba</option>
                      <option value="Australia">Australia</option>
                      <option value="Austria">Austria</option>
                      <option value="Azerbaijan">Azerbaijan</option>
                      <option value="Bahamas">Bahamas</option>
                      <option value="Bahrain">Bahrain</option>
                      <option value="Bangladesh">Bangladesh</option>
                      <option value="Barbados">Barbados</option>
                      <option value="Belarus">Belarus</option>
                      <option value="Belgium">Belgium</option>
                      <option value="Belize">Belize</option>
                      <option value="Benin">Benin</option>
                      <option value="Bermuda">Bermuda</option>
                      <option value="Bhutan">Bhutan</option>
                      <option value="Bolivia">Bolivia</option>
                      <option value="Bosnia and Herzegowina">
                        Bosnia and Herzegowina
                      </option>
                      <option value="Botswana">Botswana</option>
                      <option value="Bouvet Island">Bouvet Island</option>
                      <option value="Brazil">Brazil</option>
                      <option value="British Indian Ocean Territory">
                        British Indian Ocean Territory
                      </option>
                      <option value="Brunei Darussalam">
                        Brunei Darussalam
                      </option>
                      <option value="Bulgaria">Bulgaria</option>
                      <option value="Burkina Faso">Burkina Faso</option>
                      <option value="Burundi">Burundi</option>
                      <option value="Cambodia">Cambodia</option>
                      <option value="Cameroon">Cameroon</option>
                      <option value="Canada">Canada</option>
                      <option value="Cape Verde">Cape Verde</option>
                      <option value="Cayman Islands">Cayman Islands</option>
                      <option value="Central African Republic">
                        Central African Republic
                      </option>
                      <option value="Chad">Chad</option>
                      <option value="Chile">Chile</option>
                      <option value="China">China</option>
                      <option value="Christmas Island">Christmas Island</option>
                      <option value="Cocos Islands">
                        Cocos (Keeling) Islands
                      </option>
                      <option value="Colombia">Colombia</option>
                      <option value="Comoros">Comoros</option>
                      <option value="Congo">Congo</option>
                      <option value="Congo">
                        Congo, the Democratic Republic of the
                      </option>
                      <option value="Cook Islands">Cook Islands</option>
                      <option value="Costa Rica">Costa Rica</option>
                      <option value="Cota D'Ivoire">Cote d'Ivoire</option>
                      <option value="Croatia">Croatia (Hrvatska)</option>
                      <option value="Cuba">Cuba</option>
                      <option value="Cyprus">Cyprus</option>
                      <option value="Czech Republic">Czech Republic</option>
                      <option value="Denmark">Denmark</option>
                      <option value="Djibouti">Djibouti</option>
                      <option value="Dominica">Dominica</option>
                      <option value="Dominican Republic">
                        Dominican Republic
                      </option>
                      <option value="East Timor">East Timor</option>
                      <option value="Ecuador">Ecuador</option>
                      <option value="Egypt">Egypt</option>
                      <option value="El Salvador">El Salvador</option>
                      <option value="Equatorial Guinea">
                        Equatorial Guinea
                      </option>
                      <option value="Eritrea">Eritrea</option>
                      <option value="Estonia">Estonia</option>
                      <option value="Ethiopia">Ethiopia</option>
                      <option value="Falkland Islands">
                        Falkland Islands (Malvinas)
                      </option>
                      <option value="Faroe Islands">Faroe Islands</option>
                      <option value="Fiji">Fiji</option>
                      <option value="Finland">Finland</option>
                      <option value="France">France</option>
                      <option value="France Metropolitan">
                        France, Metropolitan
                      </option>
                      <option value="French Guiana">French Guiana</option>
                      <option value="French Polynesia">French Polynesia</option>
                      <option value="French Southern Territories">
                        French Southern Territories
                      </option>
                      <option value="Gabon">Gabon</option>
                      <option value="Gambia">Gambia</option>
                      <option value="Georgia">Georgia</option>
                      <option value="Germany">Germany</option>
                      <option value="Ghana">Ghana</option>
                      <option value="Gibraltar">Gibraltar</option>
                      <option value="Greece">Greece</option>
                      <option value="Greenland">Greenland</option>
                      <option value="Grenada">Grenada</option>
                      <option value="Guadeloupe">Guadeloupe</option>
                      <option value="Guam">Guam</option>
                      <option value="Guatemala">Guatemala</option>
                      <option value="Guinea">Guinea</option>
                      <option value="Guinea-Bissau">Guinea-Bissau</option>
                      <option value="Guyana">Guyana</option>
                      <option value="Haiti">Haiti</option>
                      <option value="Heard and McDonald Islands">
                        Heard and Mc Donald Islands
                      </option>
                      <option value="Holy See">
                        Holy See (Vatican City State)
                      </option>
                      <option value="Honduras">Honduras</option>
                      <option value="Hong Kong">Hong Kong</option>
                      <option value="Hungary">Hungary</option>
                      <option value="Iceland">Iceland</option>
                      <option value="India">India</option>
                      <option value="Indonesia">Indonesia</option>
                      <option value="Iran">Iran (Islamic Republic of)</option>
                      <option value="Iraq">Iraq</option>
                      <option value="Ireland">Ireland</option>
                      <option value="Israel">Israel</option>
                      <option value="Italy">Italy</option>
                      <option value="Jamaica">Jamaica</option>
                      <option value="Japan">Japan</option>
                      <option value="Jordan">Jordan</option>
                      <option value="Kazakhstan">Kazakhstan</option>
                      <option value="Kenya">Kenya</option>
                      <option value="Kiribati">Kiribati</option>
                      <option value="Democratic People's Republic of Korea">
                        Korea, Democratic People's Republic of
                      </option>
                      <option value="Korea">Korea, Republic of</option>
                      <option value="Kuwait">Kuwait</option>
                      <option value="Kyrgyzstan">Kyrgyzstan</option>
                      <option value="Lao">
                        Lao People's Democratic Republic
                      </option>
                      <option value="Latvia">Latvia</option>
                      <option value="Lebanon">Lebanon</option>
                      <option value="Lesotho">Lesotho</option>
                      <option value="Liberia">Liberia</option>
                      <option value="Libyan Arab Jamahiriya">
                        Libyan Arab Jamahiriya
                      </option>
                      <option value="Liechtenstein">Liechtenstein</option>
                      <option value="Lithuania">Lithuania</option>
                      <option value="Luxembourg">Luxembourg</option>
                      <option value="Macau">Macau</option>
                      <option value="Macedonia">
                        Macedonia, The Former Yugoslav Republic of
                      </option>
                      <option value="Madagascar">Madagascar</option>
                      <option value="Malawi">Malawi</option>
                      <option value="Malaysia">Malaysia</option>
                      <option value="Maldives">Maldives</option>
                      <option value="Mali">Mali</option>
                      <option value="Malta">Malta</option>
                      <option value="Marshall Islands">Marshall Islands</option>
                      <option value="Martinique">Martinique</option>
                      <option value="Mauritania">Mauritania</option>
                      <option value="Mauritius">Mauritius</option>
                      <option value="Mayotte">Mayotte</option>
                      <option value="Mexico">Mexico</option>
                      <option value="Micronesia">
                        Micronesia, Federated States of
                      </option>
                      <option value="Moldova">Moldova, Republic of</option>
                      <option value="Monaco">Monaco</option>
                      <option value="Mongolia">Mongolia</option>
                      <option value="Montserrat">Montserrat</option>
                      <option value="Morocco">Morocco</option>
                      <option value="Mozambique">Mozambique</option>
                      <option value="Myanmar">Myanmar</option>
                      <option value="Namibia">Namibia</option>
                      <option value="Nauru">Nauru</option>
                      <option value="Nepal">Nepal</option>
                      <option value="Netherlands">Netherlands</option>
                      <option value="Netherlands Antilles">
                        Netherlands Antilles
                      </option>
                      <option value="New Caledonia">New Caledonia</option>
                      <option value="New Zealand">New Zealand</option>
                      <option value="Nicaragua">Nicaragua</option>
                      <option value="Niger">Niger</option>
                      <option value="Nigeria">Nigeria</option>
                      <option value="Niue">Niue</option>
                      <option value="Norfolk Island">Norfolk Island</option>
                      <option value="Northern Mariana Islands">
                        Northern Mariana Islands
                      </option>
                      <option value="Norway">Norway</option>
                      <option value="Oman">Oman</option>
                      <option value="Pakistan">Pakistan</option>
                      <option value="Palau">Palau</option>
                      <option value="Panama">Panama</option>
                      <option value="Papua New Guinea">Papua New Guinea</option>
                      <option value="Paraguay">Paraguay</option>
                      <option value="Peru">Peru</option>
                      <option value="Philippines">Philippines</option>
                      <option value="Pitcairn">Pitcairn</option>
                      <option value="Poland">Poland</option>
                      <option value="Portugal">Portugal</option>
                      <option value="Puerto Rico">Puerto Rico</option>
                      <option value="Qatar">Qatar</option>
                      <option value="Reunion">Reunion</option>
                      <option value="Romania">Romania</option>
                      <option value="Russia">Russian Federation</option>
                      <option value="Rwanda">Rwanda</option>
                      <option value="Saint Kitts and Nevis">
                        Saint Kitts and Nevis
                      </option>
                      <option value="Saint LUCIA">Saint LUCIA</option>
                      <option value="Saint Vincent">
                        Saint Vincent and the Grenadines
                      </option>
                      <option value="Samoa">Samoa</option>
                      <option value="San Marino">San Marino</option>
                      <option value="Sao Tome and Principe">
                        Sao Tome and Principe
                      </option>
                      <option value="Saudi Arabia">Saudi Arabia</option>
                      <option value="Senegal">Senegal</option>
                      <option value="Seychelles">Seychelles</option>
                      <option value="Sierra">Sierra Leone</option>
                      <option value="Singapore">Singapore</option>
                      <option value="Slovakia">
                        Slovakia (Slovak Republic)
                      </option>
                      <option value="Slovenia">Slovenia</option>
                      <option value="Solomon Islands">Solomon Islands</option>
                      <option value="Somalia">Somalia</option>
                      <option value="South Africa">South Africa</option>
                      <option value="South Georgia">
                        South Georgia and the South Sandwich Islands
                      </option>
                      <option value="Span">Spain</option>
                      <option value="SriLanka">Sri Lanka</option>
                      <option value="St. Helena">St. Helena</option>
                      <option value="St. Pierre and Miguelon">
                        St. Pierre and Miquelon
                      </option>
                      <option value="Sudan">Sudan</option>
                      <option value="Suriname">Suriname</option>
                      <option value="Svalbard">
                        Svalbard and Jan Mayen Islands
                      </option>
                      <option value="Swaziland">Swaziland</option>
                      <option value="Sweden">Sweden</option>
                      <option value="Switzerland">Switzerland</option>
                      <option value="Syria">Syrian Arab Republic</option>
                      <option value="Taiwan">Taiwan, Province of China</option>
                      <option value="Tajikistan">Tajikistan</option>
                      <option value="Tanzania">
                        Tanzania, United Republic of
                      </option>
                      <option value="Thailand">Thailand</option>
                      <option value="Togo">Togo</option>
                      <option value="Tokelau">Tokelau</option>
                      <option value="Tonga">Tonga</option>
                      <option value="Trinidad and Tobago">
                        Trinidad and Tobago
                      </option>
                      <option value="Tunisia">Tunisia</option>
                      <option value="Turkey">Turkey</option>
                      <option value="Turkmenistan">Turkmenistan</option>
                      <option value="Turks and Caicos">
                        Turks and Caicos Islands
                      </option>
                      <option value="Tuvalu">Tuvalu</option>
                      <option value="Uganda">Uganda</option>
                      <option value="Ukraine">Ukraine</option>
                      <option selected value="United Arab Emirates">
                        United Arab Emirates
                      </option>
                      <option value="United Kingdom">United Kingdom</option>
                      <option value="United States">United States</option>
                      <option value="United States Minor Outlying Islands">
                        United States Minor Outlying Islands
                      </option>
                      <option value="Uruguay">Uruguay</option>
                      <option value="Uzbekistan">Uzbekistan</option>
                      <option value="Vanuatu">Vanuatu</option>
                      <option value="Venezuela">Venezuela</option>
                      <option value="Vietnam">Viet Nam</option>
                      <option value="Virgin Islands (British)">
                        Virgin Islands (British)
                      </option>
                      <option value="Virgin Islands (U.S)">
                        Virgin Islands (U.S.)
                      </option>
                      <option value="Wallis and Futana Islands">
                        Wallis and Futuna Islands
                      </option>
                      <option value="Western Sahara">Western Sahara</option>
                      <option value="Yemen">Yemen</option>
                      <option value="Serbia">Serbia</option>
                      <option value="Zambia">Zambia</option>
                      <option value="Zimbabwe">Zimbabwe</option>
                    </select>
                  </div>
                </div>
                </div>

     

                <div class="row">
                  <div class="form-group col-lg-6 col-md-6 col-sm-12">
                    <div class="field-label">
                      <strong>Country Code</strong>
                    </div>
                    <div class="field-inner">
                      <select
                        id="input-countryCode"
                        class="form-control form-control-w-border"
                        name="booking-countryCode"
                      >
                        <option data-countryCode="DZ" value="213">
                          Algeria (+213)
                        </option>
                        <option data-countryCode="AD" value="376">
                          Andorra (+376)
                        </option>
                        <option data-countryCode="AO" value="244">
                          Angola (+244)
                        </option>
                        <option data-countryCode="AI" value="1264">
                          Anguilla (+1264)
                        </option>
                        <option data-countryCode="AG" value="1268">
                          Antigua &amp; Barbuda (+1268)
                        </option>
                        <option data-countryCode="AR" value="54">
                          Argentina (+54)
                        </option>
                        <option data-countryCode="AM" value="374">
                          Armenia (+374)
                        </option>
                        <option data-countryCode="AW" value="297">
                          Aruba (+297)
                        </option>
                        <option data-countryCode="AU" value="61">
                          Australia (+61)
                        </option>
                        <option data-countryCode="AT" value="43">
                          Austria (+43)
                        </option>
                        <option data-countryCode="AZ" value="994">
                          Azerbaijan (+994)
                        </option>
                        <option data-countryCode="BS" value="1242">
                          Bahamas (+1242)
                        </option>
                        <option data-countryCode="BH" value="973">
                          Bahrain (+973)
                        </option>
                        <option data-countryCode="BD" value="880">
                          Bangladesh (+880)
                        </option>
                        <option data-countryCode="BB" value="1246">
                          Barbados (+1246)
                        </option>
                        <option data-countryCode="BY" value="375">
                          Belarus (+375)
                        </option>
                        <option data-countryCode="BE" value="32">
                          Belgium (+32)
                        </option>
                        <option data-countryCode="BZ" value="501">
                          Belize (+501)
                        </option>
                        <option data-countryCode="BJ" value="229">
                          Benin (+229)
                        </option>
                        <option data-countryCode="BM" value="1441">
                          Bermuda (+1441)
                        </option>
                        <option data-countryCode="BT" value="975">
                          Bhutan (+975)
                        </option>
                        <option data-countryCode="BO" value="591">
                          Bolivia (+591)
                        </option>
                        <option data-countryCode="BA" value="387">
                          Bosnia Herzegovina (+387)
                        </option>
                        <option data-countryCode="BW" value="267">
                          Botswana (+267)
                        </option>
                        <option data-countryCode="BR" value="55">
                          Brazil (+55)
                        </option>
                        <option data-countryCode="BN" value="673">
                          Brunei (+673)
                        </option>
                        <option data-countryCode="BG" value="359">
                          Bulgaria (+359)
                        </option>
                        <option data-countryCode="BF" value="226">
                          Burkina Faso (+226)
                        </option>
                        <option data-countryCode="BI" value="257">
                          Burundi (+257)
                        </option>
                        <option data-countryCode="KH" value="855">
                          Cambodia (+855)
                        </option>
                        <option data-countryCode="CM" value="237">
                          Cameroon (+237)
                        </option>
                        <option data-countryCode="CA" value="1">
                          Canada (+1)
                        </option>
                        <option data-countryCode="CV" value="238">
                          Cape Verde Islands (+238)
                        </option>
                        <option data-countryCode="KY" value="1345">
                          Cayman Islands (+1345)
                        </option>
                        <option data-countryCode="CF" value="236">
                          Central African Republic (+236)
                        </option>
                        <option data-countryCode="CL" value="56">
                          Chile (+56)
                        </option>
                        <option data-countryCode="CN" value="86">
                          China (+86)
                        </option>
                        <option data-countryCode="CO" value="57">
                          Colombia (+57)
                        </option>
                        <option data-countryCode="KM" value="269">
                          Comoros (+269)
                        </option>
                        <option data-countryCode="CG" value="242">
                          Congo (+242)
                        </option>
                        <option data-countryCode="CK" value="682">
                          Cook Islands (+682)
                        </option>
                        <option data-countryCode="CR" value="506">
                          Costa Rica (+506)
                        </option>
                        <option data-countryCode="HR" value="385">
                          Croatia (+385)
                        </option>
                        <option data-countryCode="CU" value="53">
                          Cuba (+53)
                        </option>
                        <option data-countryCode="CY" value="90392">
                          Cyprus North (+90392)
                        </option>
                        <option data-countryCode="CY" value="357">
                          Cyprus South (+357)
                        </option>
                        <option data-countryCode="CZ" value="42">
                          Czech Republic (+42)
                        </option>
                        <option data-countryCode="DK" value="45">
                          Denmark (+45)
                        </option>
                        <option data-countryCode="DJ" value="253">
                          Djibouti (+253)
                        </option>
                        <option data-countryCode="DM" value="1809">
                          Dominica (+1809)
                        </option>
                        <option data-countryCode="DO" value="1809">
                          Dominican Republic (+1809)
                        </option>
                        <option data-countryCode="EC" value="593">
                          Ecuador (+593)
                        </option>
                        <option data-countryCode="EG" value="20">
                          Egypt (+20)
                        </option>
                        <option data-countryCode="SV" value="503">
                          El Salvador (+503)
                        </option>
                        <option data-countryCode="GQ" value="240">
                          Equatorial Guinea (+240)
                        </option>
                        <option data-countryCode="ER" value="291">
                          Eritrea (+291)
                        </option>
                        <option data-countryCode="EE" value="372">
                          Estonia (+372)
                        </option>
                        <option data-countryCode="ET" value="251">
                          Ethiopia (+251)
                        </option>
                        <option data-countryCode="FK" value="500">
                          Falkland Islands (+500)
                        </option>
                        <option data-countryCode="FO" value="298">
                          Faroe Islands (+298)
                        </option>
                        <option data-countryCode="FJ" value="679">
                          Fiji (+679)
                        </option>
                        <option data-countryCode="FI" value="358">
                          Finland (+358)
                        </option>
                        <option data-countryCode="FR" value="33">
                          France (+33)
                        </option>
                        <option data-countryCode="GF" value="594">
                          French Guiana (+594)
                        </option>
                        <option data-countryCode="PF" value="689">
                          French Polynesia (+689)
                        </option>
                        <option data-countryCode="GA" value="241">
                          Gabon (+241)
                        </option>
                        <option data-countryCode="GM" value="220">
                          Gambia (+220)
                        </option>
                        <option data-countryCode="GE" value="7880">
                          Georgia (+7880)
                        </option>
                        <option data-countryCode="DE" value="49">
                          Germany (+49)
                        </option>
                        <option data-countryCode="GH" value="233">
                          Ghana (+233)
                        </option>
                        <option data-countryCode="GI" value="350">
                          Gibraltar (+350)
                        </option>
                        <option data-countryCode="GR" value="30">
                          Greece (+30)
                        </option>
                        <option data-countryCode="GL" value="299">
                          Greenland (+299)
                        </option>
                        <option data-countryCode="GD" value="1473">
                          Grenada (+1473)
                        </option>
                        <option data-countryCode="GP" value="590">
                          Guadeloupe (+590)
                        </option>
                        <option data-countryCode="GU" value="671">
                          Guam (+671)
                        </option>
                        <option data-countryCode="GT" value="502">
                          Guatemala (+502)
                        </option>
                        <option data-countryCode="GN" value="224">
                          Guinea (+224)
                        </option>
                        <option data-countryCode="GW" value="245">
                          Guinea - Bissau (+245)
                        </option>
                        <option data-countryCode="GY" value="592">
                          Guyana (+592)
                        </option>
                        <option data-countryCode="HT" value="509">
                          Haiti (+509)
                        </option>
                        <option data-countryCode="HN" value="504">
                          Honduras (+504)
                        </option>
                        <option data-countryCode="HK" value="852">
                          Hong Kong (+852)
                        </option>
                        <option data-countryCode="HU" value="36">
                          Hungary (+36)
                        </option>
                        <option data-countryCode="IS" value="354">
                          Iceland (+354)
                        </option>
                        <option data-countryCode="IN" value="91">
                          India (+91)
                        </option>
                        <option data-countryCode="ID" value="62">
                          Indonesia (+62)
                        </option>
                        <option data-countryCode="IR" value="98">
                          Iran (+98)
                        </option>
                        <option data-countryCode="IQ" value="964">
                          Iraq (+964)
                        </option>
                        <option data-countryCode="IE" value="353">
                          Ireland (+353)
                        </option>
                        <option data-countryCode="IL" value="972">
                          Israel (+972)
                        </option>
                        <option data-countryCode="IT" value="39">
                          Italy (+39)
                        </option>
                        <option data-countryCode="JM" value="1876">
                          Jamaica (+1876)
                        </option>
                        <option data-countryCode="JP" value="81">
                          Japan (+81)
                        </option>
                        <option data-countryCode="JO" value="962">
                          Jordan (+962)
                        </option>
                        <option data-countryCode="KZ" value="7">
                          Kazakhstan (+7)
                        </option>
                        <option data-countryCode="KE" value="254">
                          Kenya (+254)
                        </option>
                        <option data-countryCode="KI" value="686">
                          Kiribati (+686)
                        </option>
                        <option data-countryCode="KP" value="850">
                          Korea North (+850)
                        </option>
                        <option data-countryCode="KR" value="82">
                          Korea South (+82)
                        </option>
                        <option data-countryCode="KW" value="965">
                          Kuwait (+965)
                        </option>
                        <option data-countryCode="KG" value="996">
                          Kyrgyzstan (+996)
                        </option>
                        <option data-countryCode="LA" value="856">
                          Laos (+856)
                        </option>
                        <option data-countryCode="LV" value="371">
                          Latvia (+371)
                        </option>
                        <option data-countryCode="LB" value="961">
                          Lebanon (+961)
                        </option>
                        <option data-countryCode="LS" value="266">
                          Lesotho (+266)
                        </option>
                        <option data-countryCode="LR" value="231">
                          Liberia (+231)
                        </option>
                        <option data-countryCode="LY" value="218">
                          Libya (+218)
                        </option>
                        <option data-countryCode="LI" value="417">
                          Liechtenstein (+417)
                        </option>
                        <option data-countryCode="LT" value="370">
                          Lithuania (+370)
                        </option>
                        <option data-countryCode="LU" value="352">
                          Luxembourg (+352)
                        </option>
                        <option data-countryCode="MO" value="853">
                          Macao (+853)
                        </option>
                        <option data-countryCode="MK" value="389">
                          Macedonia (+389)
                        </option>
                        <option data-countryCode="MG" value="261">
                          Madagascar (+261)
                        </option>
                        <option data-countryCode="MW" value="265">
                          Malawi (+265)
                        </option>
                        <option data-countryCode="MY" value="60">
                          Malaysia (+60)
                        </option>
                        <option data-countryCode="MV" value="960">
                          Maldives (+960)
                        </option>
                        <option data-countryCode="ML" value="223">
                          Mali (+223)
                        </option>
                        <option data-countryCode="MT" value="356">
                          Malta (+356)
                        </option>
                        <option data-countryCode="MH" value="692">
                          Marshall Islands (+692)
                        </option>
                        <option data-countryCode="MQ" value="596">
                          Martinique (+596)
                        </option>
                        <option data-countryCode="MR" value="222">
                          Mauritania (+222)
                        </option>
                        <option data-countryCode="YT" value="269">
                          Mayotte (+269)
                        </option>
                        <option data-countryCode="MX" value="52">
                          Mexico (+52)
                        </option>
                        <option data-countryCode="FM" value="691">
                          Micronesia (+691)
                        </option>
                        <option data-countryCode="MD" value="373">
                          Moldova (+373)
                        </option>
                        <option data-countryCode="MC" value="377">
                          Monaco (+377)
                        </option>
                        <option data-countryCode="MN" value="976">
                          Mongolia (+976)
                        </option>
                        <option data-countryCode="MS" value="1664">
                          Montserrat (+1664)
                        </option>
                        <option data-countryCode="MA" value="212">
                          Morocco (+212)
                        </option>
                        <option data-countryCode="MZ" value="258">
                          Mozambique (+258)
                        </option>
                        <option data-countryCode="MN" value="95">
                          Myanmar (+95)
                        </option>
                        <option data-countryCode="NA" value="264">
                          Namibia (+264)
                        </option>
                        <option data-countryCode="NR" value="674">
                          Nauru (+674)
                        </option>
                        <option data-countryCode="NP" value="977">
                          Nepal (+977)
                        </option>
                        <option data-countryCode="NL" value="31">
                          Netherlands (+31)
                        </option>
                        <option data-countryCode="NC" value="687">
                          New Caledonia (+687)
                        </option>
                        <option data-countryCode="NZ" value="64">
                          New Zealand (+64)
                        </option>
                        <option data-countryCode="NI" value="505">
                          Nicaragua (+505)
                        </option>
                        <option data-countryCode="NE" value="227">
                          Niger (+227)
                        </option>
                        <option data-countryCode="NG" value="234">
                          Nigeria (+234)
                        </option>
                        <option data-countryCode="NU" value="683">
                          Niue (+683)
                        </option>
                        <option data-countryCode="NF" value="672">
                          Norfolk Islands (+672)
                        </option>
                        <option data-countryCode="NP" value="670">
                          Northern Marianas (+670)
                        </option>
                        <option data-countryCode="NO" value="47">
                          Norway (+47)
                        </option>
                        <option data-countryCode="OM" value="968">
                          Oman (+968)
                        </option>
                        <option data-countryCode="PW" value="680">
                          Palau (+680)
                        </option>
                        <option data-countryCode="PA" value="507">
                          Panama (+507)
                        </option>
                        <option data-countryCode="PG" value="675">
                          Papua New Guinea (+675)
                        </option>
                        <option data-countryCode="PY" value="595">
                          Paraguay (+595)
                        </option>
                        <option data-countryCode="PE" value="51">
                          Peru (+51)
                        </option>
                        <option data-countryCode="PH" value="63">
                          Philippines (+63)
                        </option>
                        <option data-countryCode="PL" value="48">
                          Poland (+48)
                        </option>
                        <option data-countryCode="PT" value="351">
                          Portugal (+351)
                        </option>
                        <option data-countryCode="PR" value="1787">
                          Puerto Rico (+1787)
                        </option>
                        <option data-countryCode="QA" value="974">
                          Qatar (+974)
                        </option>
                        <option data-countryCode="RE" value="262">
                          Reunion (+262)
                        </option>
                        <option data-countryCode="RO" value="40">
                          Romania (+40)
                        </option>
                        <option data-countryCode="RU" value="7">
                          Russia (+7)
                        </option>
                        <option data-countryCode="RW" value="250">
                          Rwanda (+250)
                        </option>
                        <option data-countryCode="SM" value="378">
                          San Marino (+378)
                        </option>
                        <option data-countryCode="ST" value="239">
                          Sao Tome &amp; Principe (+239)
                        </option>
                        <option data-countryCode="SA" value="966">
                          Saudi Arabia (+966)
                        </option>
                        <option data-countryCode="SN" value="221">
                          Senegal (+221)
                        </option>
                        <option data-countryCode="CS" value="381">
                          Serbia (+381)
                        </option>
                        <option data-countryCode="SC" value="248">
                          Seychelles (+248)
                        </option>
                        <option data-countryCode="SL" value="232">
                          Sierra Leone (+232)
                        </option>
                        <option data-countryCode="SG" value="65">
                          Singapore (+65)
                        </option>
                        <option data-countryCode="SK" value="421">
                          Slovak Republic (+421)
                        </option>
                        <option data-countryCode="SI" value="386">
                          Slovenia (+386)
                        </option>
                        <option data-countryCode="SB" value="677">
                          Solomon Islands (+677)
                        </option>
                        <option data-countryCode="SO" value="252">
                          Somalia (+252)
                        </option>
                        <option data-countryCode="ZA" value="27">
                          South Africa (+27)
                        </option>
                        <option data-countryCode="ES" value="34">
                          Spain (+34)
                        </option>
                        <option data-countryCode="LK" value="94">
                          Sri Lanka (+94)
                        </option>
                        <option data-countryCode="SH" value="290">
                          St. Helena (+290)
                        </option>
                        <option data-countryCode="KN" value="1869">
                          St. Kitts (+1869)
                        </option>
                        <option data-countryCode="SC" value="1758">
                          St. Lucia (+1758)
                        </option>
                        <option data-countryCode="SD" value="249">
                          Sudan (+249)
                        </option>
                        <option data-countryCode="SR" value="597">
                          Suriname (+597)
                        </option>
                        <option data-countryCode="SZ" value="268">
                          Swaziland (+268)
                        </option>
                        <option data-countryCode="SE" value="46">
                          Sweden (+46)
                        </option>
                        <option data-countryCode="CH" value="41">
                          Switzerland (+41)
                        </option>
                        <option data-countryCode="SI" value="963">
                          Syria (+963)
                        </option>
                        <option data-countryCode="TW" value="886">
                          Taiwan (+886)
                        </option>
                        <option data-countryCode="TJ" value="7">
                          Tajikstan (+7)
                        </option>
                        <option data-countryCode="TH" value="66">
                          Thailand (+66)
                        </option>
                        <option data-countryCode="TG" value="228">
                          Togo (+228)
                        </option>
                        <option data-countryCode="TO" value="676">
                          Tonga (+676)
                        </option>
                        <option data-countryCode="TT" value="1868">
                          Trinidad &amp; Tobago (+1868)
                        </option>
                        <option data-countryCode="TN" value="216">
                          Tunisia (+216)
                        </option>
                        <option data-countryCode="TR" value="90">
                          Turkey (+90)
                        </option>
                        <option data-countryCode="TM" value="7">
                          Turkmenistan (+7)
                        </option>
                        <option data-countryCode="TM" value="993">
                          Turkmenistan (+993)
                        </option>
                        <option data-countryCode="TC" value="1649">
                          Turks &amp; Caicos Islands (+1649)
                        </option>
                        <option data-countryCode="TV" value="688">
                          Tuvalu (+688)
                        </option>
                        <option data-countryCode="UG" value="256">
                          Uganda (+256)
                        </option>
                        <option data-countryCode="GB" value="44">
                          UK (+44)
                        </option>
                        <option data-countryCode="UA" value="380">
                          Ukraine (+380)
                        </option>
                        <option selected data-countryCode="AE" value="971">
                          United Arab Emirates (+971)
                        </option>
                        <option data-countryCode="UY" value="598">
                          Uruguay (+598)
                        </option>
                        <option data-countryCode="US" value="1">
                          USA (+1)
                        </option>
                        <option data-countryCode="UZ" value="7">
                          Uzbekistan (+7)
                        </option>
                        <option data-countryCode="VU" value="678">
                          Vanuatu (+678)
                        </option>
                        <option data-countryCode="VA" value="379">
                          Vatican City (+379)
                        </option>
                        <option data-countryCode="VE" value="58">
                          Venezuela (+58)
                        </option>
                        <option data-countryCode="VN" value="84">
                          Vietnam (+84)
                        </option>
                        <option data-countryCode="VG" value="84">
                          Virgin Islands - British (+1284)
                        </option>
                        <option data-countryCode="VI" value="84">
                          Virgin Islands - US (+1340)
                        </option>
                        <option data-countryCode="WF" value="681">
                          Wallis &amp; Futuna (+681)
                        </option>
                        <option data-countryCode="YE" value="969">
                          Yemen (North)(+969)
                        </option>
                        <option data-countryCode="YE" value="967">
                          Yemen (South)(+967)
                        </option>
                        <option data-countryCode="ZM" value="260">
                          Zambia (+260)
                        </option>
                        <option data-countryCode="ZW" value="263">
                          Zimbabwe (+263)
                        </option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group col-lg-6 col-md-6 col-sm-12">
                    <div class="field-label">
                      <strong>Phone Number</strong>
                    </div>
                    <div class="field-inner">
                      <input
                        type="tel"
                        maxlength="15"
                        name="booking-phone"
                        placeholder=""
                        required=""
                        value=""
                        id="input-phone"
                        class="form-control form-control-w-border"
                      />
                    </div>
                  </div>
                </div>

                <div class="form-group mt-3">
                  <button
                    id="inquiry-form-submit-btn"
                    type="submit"
                    class="btn btn-search rounded"
                  >
                    Submit
                  </button>
                </div>
              </form>
</div>

<script>
    const tours = document.querySelectorAll(".tour-package");
    const body = document.querySelector("body")
    const bookingFormPopup = document.querySelector("#booking-form")
    const overlay = document.querySelector("#body-overlay");
    const heading = document.querySelector("#booking-heading")

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

   const toggleBookingForm = (tourName) => {


    if(Array.from(bookingFormPopup.classList).includes("hide")){
        console.log(tourName);
        bookingFormPopup.classList.remove("hide")
        overlay.classList.remove("hide")
        body.classList.add("noscroll")
        heading.textContent = `Booking Form - ${tourName}`

    } else {
        document.querySelector("#booking-form>form").reset();
        overlay.classList.add("hide")
        bookingFormPopup.classList.add("hide")
        body.classList.remove("noscroll")
    }
   }


</script>