<script>

    $(document).ready(function () {

        $('[data-toggle="tooltip"]').tooltip();

        jQuery.validator.addMethod("noSpace", function (value, element) {
            return value.indexOf(" ") < 0 && value != "";
        }, "No space please");

        $('#create-supporter').validate({ // initialize the plugin
            debug: true,
            rules: {
                username: {
                    required: true,
                    minlength: 5,
                    noSpace: true
                },
                password: {
                    required: true,
                    minlength: 5,
                    noSpace: true
                },
                password_confirm: {
                    minlength: 5,
                    equalTo: "#password",
                    noSpace: true
                },
                email_address: {
                    required: true,
                    email: true
                }
            },
            messages: {
                user_name: "Please enter your username",
                password: "Please enter your password",
                email_address: "Please enter your email address"
            },
            submitHandler: function (form) {
                form.submit();
            }
        });

    });

</script>

<p></p><p></p><p></p><p></p>

<section class="section" id="features">
    <div class="container">

        <div class="row">
            <?php

            $class = array();

            if ($path[1] == "get-started") {
                $class[1] = "class = 'highlighted'";
                $class[0] = "class = 'non-highlighted'";
            }
            ?>

            <p style="text-align:center">
                <a href="/get-started/supporter/register" <?php echo $class[1]; ?>>Supporter</a> 
                <a href="/producer/create-producer" <?php echo $class[0]; ?>>Producer</a>
            </p>

        </div>

        <div class="row alert alert-success ">
            By signing up as a supporter you can earn points that can be exchanged for rewards. After this, each time you log into ShareItCamp.com and share an initiative with to your social networks you earn reward points. 
        </div>

        <div class="row">

            <div class="col-sm-2"></div>

            <div class="col-sm-9 intro-form">

                <H3>CREATE A SUPPORTER ACCOUNT</H3>

                <span class="required">* </span> = Required fields

                <?php if (isset($success_info)) { ?>
                    <div class="alert alert-success"><?php echo $success_info; ?></div>
                <?php } ?>


                <form action="/save-supporter" method="POST" class="form-horizontal" role="form" id="create-supporter">
                    <div class="form-group">
                        <label class="control-label col-sm-4"><span class="required">* </span>Username</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="username" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4" style="text-align:right"><span class="required">* </span>Password</label>
                        <div class="col-sm-8"><input type="password" class="form-control" name="password" id="password"
                                                     />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4"><span class="required">* </span>Confirm Password</label>
                        <div class="col-sm-8"><input type="password" class="form-control"
                                                     name="password_confirm" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4" style="text-align:right"><span class="required">* </span>Email
                            Address</label>
                        <div class="col-sm-8" style="text-align:left"><input type="text" class="form-control"
                                                                             name="email_address"
                                                                             />
                        </div>
                    </div>

                    <!--<div class="form-group">
                        <label class="control-label col-sm-4" style="text-align:right">Interests:</label>
                        <SELECT NAME="interests" MULTIPLE SIZE=5>
                            <OPTION VALUE="sports">sports
                            <OPTION VALUE="music">music
                            <OPTION VALUE="outdoors">onions
                            <OPTION VALUE="culture">tomatoes
                            <OPTION VALUE="religion">olives
                        </SELECT>
                    </div>-->

                    <div class="form-group">
                        <label class="control-label col-sm-4" style="text-align:right">
                            <a href="#"
                               class="helptip"
                               title="We want to help the organizations understand how many people they are able to reach with their message; why it's important to collaborate. We do not share your name or any other identifying information about you.">
                                <img class="icon-3" src="/images/yellow-question-mark-icon.png">
                            </a>
                           
                        </label>
                        <div class="col-sm-4" style="text-align:left">
                        <span class="required">* </span>Facebook handle
                            <input type="text" class="form-control"
                                   name="fb_handle" />
                        </div>
                        <span class="required">* </span># of FB friends
                        <div class="col-sm-4" style="text-align:left">
                            <input type="text" class="form-control"
                                   name="followers_fb" />
                        </div>
                    </div>

                    <!-- Twitter -->
                    <div class="form-group">
                        <label class="control-label col-sm-4" style="text-align:right">                           
                        </label>
                        <div class="col-sm-4" style="text-align:left">
                        Twitter handle
                            <input type="text" class="form-control"
                                   name="twitter_handle" />
                        </div>
                        # of Twitter friends
                        <div class="col-sm-4" style="text-align:left">
                            <input type="text" class="form-control"
                                   name="followers_twitter" />
                        </div>
                    </div>

                    <!-- Linkedin -->
                    <div class="form-group">
                        <label class="control-label col-sm-4" style="text-align:right">                           
                        </label>
                        <div class="col-sm-4" style="text-align:left">
                        Linkedin handle
                            <input type="text" class="form-control"
                                   name="linkedin_handle" />
                        </div>
                        # of Linkedin friends
                        <div class="col-sm-4" style="text-align:left">
                            <input type="text" class="form-control"
                                   name="followers_linkedin" />
                        </div>
                    </div>


                    <!-- Instagram -->
                    <div class="form-group">
                        <label class="control-label col-sm-4" style="text-align:right">                           
                        </label>
                        <div class="col-sm-4" style="text-align:left">
                        Instagram handle
                            <input type="text" class="form-control"
                                   name="instagram_handle" />
                        </div>
                        # of Instagram friends
                        <div class="col-sm-4" style="text-align:left">
                            <input type="text" class="form-control"
                                   name="followers_instagram" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4">Location</label>
                        <select name="country">
                            <option value="Afghanistan">Afghanistan</option>
                            <option value="Albania">Albania</option>
                            <option value="Algeria">Algeria</option>
                            <option value="American Samoa">American Samoa</option>
                            <option value="Andorra">Andorra</option>
                            <option value="Angola">Angola</option>
                            <option value="Anguilla">Anguilla</option>
                            <option value="Antartica">Antarctica</option>
                            <option value="Antigua and Barbuda">Antigua and Barbuda</option>
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
                            <option value="Bosnia and Herzegowina">Bosnia and Herzegowina</option>
                            <option value="Botswana">Botswana</option>
                            <option value="Bouvet Island">Bouvet Island</option>
                            <option value="Brazil">Brazil</option>
                            <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                            <option value="Brunei Darussalam">Brunei Darussalam</option>
                            <option value="Bulgaria">Bulgaria</option>
                            <option value="Burkina Faso">Burkina Faso</option>
                            <option value="Burundi">Burundi</option>
                            <option value="Cambodia">Cambodia</option>
                            <option value="Cameroon">Cameroon</option>
                            <option value="Canada">Canada</option>
                            <option value="Cape Verde">Cape Verde</option>
                            <option value="Cayman Islands">Cayman Islands</option>
                            <option value="Central African Republic">Central African Republic</option>
                            <option value="Chad">Chad</option>
                            <option value="Chile">Chile</option>
                            <option value="China">China</option>
                            <option value="Christmas Island">Christmas Island</option>
                            <option value="Cocos Islands">Cocos (Keeling) Islands</option>
                            <option value="Colombia">Colombia</option>
                            <option value="Comoros">Comoros</option>
                            <option value="Congo">Congo</option>
                            <option value="Congo">Congo, the Democratic Republic of the</option>
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
                            <option value="Dominican Republic">Dominican Republic</option>
                            <option value="East Timor">East Timor</option>
                            <option value="Ecuador">Ecuador</option>
                            <option value="Egypt">Egypt</option>
                            <option value="El Salvador">El Salvador</option>
                            <option value="Equatorial Guinea">Equatorial Guinea</option>
                            <option value="Eritrea">Eritrea</option>
                            <option value="Estonia">Estonia</option>
                            <option value="Ethiopia">Ethiopia</option>
                            <option value="Falkland Islands">Falkland Islands (Malvinas)</option>
                            <option value="Faroe Islands">Faroe Islands</option>
                            <option value="Fiji">Fiji</option>
                            <option value="Finland">Finland</option>
                            <option value="France">France</option>
                            <option value="France Metropolitan">France, Metropolitan</option>
                            <option value="French Guiana">French Guiana</option>
                            <option value="French Polynesia">French Polynesia</option>
                            <option value="French Southern Territories">French Southern Territories</option>
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
                            <option value="Heard and McDonald Islands">Heard and Mc Donald Islands</option>
                            <option value="Holy See">Holy See (Vatican City State)</option>
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
                            <option value="Democratic People's Republic of Korea">Korea, Democratic People's Republic of
                            </option>
                            <option value="Korea">Korea, Republic of</option>
                            <option value="Kuwait">Kuwait</option>
                            <option value="Kyrgyzstan">Kyrgyzstan</option>
                            <option value="Lao">Lao People's Democratic Republic</option>
                            <option value="Latvia">Latvia</option>
                            <option value="Lebanon">Lebanon</option>
                            <option value="Lesotho">Lesotho</option>
                            <option value="Liberia">Liberia</option>
                            <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                            <option value="Liechtenstein">Liechtenstein</option>
                            <option value="Lithuania">Lithuania</option>
                            <option value="Luxembourg">Luxembourg</option>
                            <option value="Macau">Macau</option>
                            <option value="Macedonia">Macedonia, The Former Yugoslav Republic of</option>
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
                            <option value="Micronesia">Micronesia, Federated States of</option>
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
                            <option value="Netherlands Antilles">Netherlands Antilles</option>
                            <option value="New Caledonia">New Caledonia</option>
                            <option value="New Zealand">New Zealand</option>
                            <option value="Nicaragua">Nicaragua</option>
                            <option value="Niger">Niger</option>
                            <option value="Nigeria">Nigeria</option>
                            <option value="Niue">Niue</option>
                            <option value="Norfolk Island">Norfolk Island</option>
                            <option value="Northern Mariana Islands">Northern Mariana Islands</option>
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
                            <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                            <option value="Saint LUCIA">Saint LUCIA</option>
                            <option value="Saint Vincent">Saint Vincent and the Grenadines</option>
                            <option value="Samoa">Samoa</option>
                            <option value="San Marino">San Marino</option>
                            <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                            <option value="Saudi Arabia">Saudi Arabia</option>
                            <option value="Senegal">Senegal</option>
                            <option value="Seychelles">Seychelles</option>
                            <option value="Sierra">Sierra Leone</option>
                            <option value="Singapore">Singapore</option>
                            <option value="Slovakia">Slovakia (Slovak Republic)</option>
                            <option value="Slovenia">Slovenia</option>
                            <option value="Solomon Islands">Solomon Islands</option>
                            <option value="Somalia">Somalia</option>
                            <option value="South Africa">South Africa</option>
                            <option value="South Georgia">South Georgia and the South Sandwich Islands</option>
                            <option value="Span">Spain</option>
                            <option value="SriLanka">Sri Lanka</option>
                            <option value="St. Helena">St. Helena</option>
                            <option value="St. Pierre and Miguelon">St. Pierre and Miquelon</option>
                            <option value="Sudan">Sudan</option>
                            <option value="Suriname">Suriname</option>
                            <option value="Svalbard">Svalbard and Jan Mayen Islands</option>
                            <option value="Swaziland">Swaziland</option>
                            <option value="Sweden">Sweden</option>
                            <option value="Switzerland">Switzerland</option>
                            <option value="Syria">Syrian Arab Republic</option>
                            <option value="Taiwan">Taiwan, Province of China</option>
                            <option value="Tajikistan">Tajikistan</option>
                            <option value="Tanzania">Tanzania, United Republic of</option>
                            <option value="Thailand">Thailand</option>
                            <option value="Togo">Togo</option>
                            <option value="Tokelau">Tokelau</option>
                            <option value="Tonga">Tonga</option>
                            <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                            <option value="Tunisia">Tunisia</option>
                            <option value="Turkey">Turkey</option>
                            <option value="Turkmenistan">Turkmenistan</option>
                            <option value="Turks and Caicos">Turks and Caicos Islands</option>
                            <option value="Tuvalu">Tuvalu</option>
                            <option value="Uganda">Uganda</option>
                            <option value="Ukraine">Ukraine</option>
                            <option value="United Arab Emirates">United Arab Emirates</option>
                            <option value="United Kingdom">United Kingdom</option>
                            <option value="United States" selected>United States</option>
                            <option value="United States Minor Outlying Islands">United States Minor Outlying Islands
                            </option>
                            <option value="Uruguay">Uruguay</option>
                            <option value="Uzbekistan">Uzbekistan</option>
                            <option value="Vanuatu">Vanuatu</option>
                            <option value="Venezuela">Venezuela</option>
                            <option value="Vietnam">Viet Nam</option>
                            <option value="Virgin Islands (British)">Virgin Islands (British)</option>
                            <option value="Virgin Islands (U.S)">Virgin Islands (U.S.)</option>
                            <option value="Wallis and Futana Islands">Wallis and Futuna Islands</option>
                            <option value="Western Sahara">Western Sahara</option>
                            <option value="Yemen">Yemen</option>
                            <option value="Yugoslavia">Yugoslavia</option>
                            <option value="Zambia">Zambia</option>
                            <option value="Zimbabwe">Zimbabwe</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4" style="text-align:right">Organization affiliation (optional):</label>
                        <SELECT NAME="organization_affiliation">
                            <option VALUE="--">--</option>
                            <?php foreach($non_profits as $nonprofit) { ?>
                                <option VALUE="<?php echo $nonprofit->organization_id; ?>"><?php echo $nonprofit->name; ?></option>
                            <?php } ?>
                        </SELECT>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-sm-4" style="text-align:right">School (optional):</label>
                        <SELECT NAME="school_affiliation">
                            <option VALUE="--">--</option>	
                            <option VALUE="2">Alpha Tri-State New York Alumnae Association</option>
							<option VALUE="3">Ardenne Alumni Association (NY Chapter)</option>
							<option VALUE="4">Bethany Past Students Association</option>
							<option VALUE="5">Bethlehem Teachers College Alumni Association, NY</option>
							<option VALUE="6">Camperdown Past Students Association</option>
							<option VALUE="7">Charlemont High School Foundation</option>
							<option VALUE="8">Clarendon College Alumni Association of NY</option>
							<option VALUE="9">Cornwall College Old Boys' Association, NY</option>
							<option VALUE="10">Denham Town High School Alumni Association</option>
							<option VALUE="11">Dinthill Technical High School Alumni Association</option>
							<option VALUE="12">Eastern Hanover Alumni Association</option>
							<option VALUE="13">Edwin Allen High School Alumni Association Mid-Atlantic Chapter</option>
							<option VALUE="14">Excelsior Alumni Association</option>
							<option VALUE="15">Friends of Port Maria</option>
							<option VALUE="16">Garvey Maceo Past Students' Association</option>
							<option VALUE="17">Glenmuir Alumni Association - NY Chapter</option>
							<option VALUE="18">Godfrey Stewart HS Alumni Association International Inc.</option>
							<option VALUE="19">Grantham College Alumni Association</option>
							<option VALUE="20">Holmwood Technical HS PSA New York Chapter</option>
							<option VALUE="21">Immaculate Conception H S Alumnae Assn, NY</option>
							<option VALUE="22">Jamaican Civic & Cultural Association of Rockland</option>
							<option VALUE="23">Jamaica College Old Boys' Association</option>
							<option VALUE="24">Kingston College Old Boys' Association USA Inc.</option>
							<option VALUE="25">Kingston Technical High School Alumni Association</option>
							<option VALUE="26">Knox Association of Past Students</option>
							<option VALUE="27">Lime Hall Primary Alumni Association</option>
							<option VALUE="28">Manning's Past Students' Association, NY</option>
							<option VALUE="29">Manchester High School Alumni Association</option>
							<option VALUE="30">Meadowbrook High School Alumni Association NY</option>
							<option VALUE="31">Merl Grove High School Past Students Association NY</option>
							<option VALUE="32">Mico Old Students Association</option>
							<option VALUE="33">Morant Bay High School Alumni Association</option>
							<option VALUE="34">New Day School Alumni Association NY Chapter Inc</option>
							<option VALUE="35">Ole Farmers Association North America, Inc.</option>
							<option VALUE="36">Pike Past Students' Association – NY Chapter</option>
							<option VALUE="37">Rusea's Old Students Association</option>
							<option VALUE="38">Shortwood Past Students Association</option>
							<option VALUE="39">St. Andrew Alumnae Association, Inc., NY Chapter</option>
							<option VALUE="40">St. Andrew Technical H S Alumni Assn. NE Chapter</option>
							<option VALUE="41">St. Catherine HS Alumni Association Northeast Inc</option>
							<option VALUE="42">St. Elizabeth Technical HS Alumni Association</option>
							<option VALUE="43">St. George's College Old Boys Association of the North East</option>
							<option VALUE="44">St. Hugh's HS Alumnae Association USA Inc.</option>
							<option VALUE="45">St. Jago Alumni Association</option>
							<option VALUE="46">University of Technology Alumni Association</option>
							<option VALUE="47">Westwood Old Girls Association</option>
							<option VALUE="48">Wolmer's Alumni Association</option>
							<option VALUE="49">York Street Past Students' Association Inc.</option>
                        </SELECT>
                    </div>

                    <br/>

                    <p style="text-align: center">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </p>

                    <p style="text-align: center">
                        By submitting this form you agree to shareitcamp.com terms.
                    </p>

                </form>

            </div>

            <div class="col-sm-3"></div>

        </div>

    </div><!--end container -->
</section><!--end section -->
