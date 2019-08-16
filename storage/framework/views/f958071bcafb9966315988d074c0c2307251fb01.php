<?php $__env->startSection('content'); ?>

<div class="content" >

  <body>

      <div class="search_container">

        <div class="tab">
        <button class="tablinks" onclick="openTab(event, 'Name')" id="defaultOpen">Name</button>
        <button class="tablinks" onclick="openTab(event, 'Criteria')">Criteria </button>
        </div>


        <div id="Criteria" class="tabcontent">
          <table>
                        <col width="80">
                        <tr>
                            <th colspan="2" class="th" style="text-align:center">Volunteer Criteria</th>
                        </tr>

                        <tr>
                            <td><input type="checkbox" name="Skills" value="Entrepreneurship" onclick="Show()"></td>
                            <td>Entrepreneurship</td>
                        </tr>

                        <tr>
                            <td><input type="checkbox" name="Skills" value="Business" onclick="Show('business_div')"></td>
                            <td>Business
                                <div id ="business_div" class="hide">
                                    <input type="checkbox" value="Has Own Company" name="Skillset">Has Own Company
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td><input type="checkbox" name="Skills" value="Communication" onclick="Show('communication_div')"></td>
                            <td>Communication
                                <div id ="communication_div" class="hide">
                                    <input type="checkbox" value="Marketing"  name="Skillset">Marketing
                                    <br><input type="checkbox" value="Media"  name="Skillset">Media
                                    <br><input type="checkbox" value="Presentation skills"  name="Skillset">Presentation Skills
                               </div>
                            </td>
                        </tr>

                        <tr>
                            <td><input type="checkbox" name="Skills" value="Digital" onclick="Show('digital_div')"></td>
                            <td>Digital
                                <div id ="digital_div" class="hide">
                                    <input type="checkbox" value="IT"  name="Skillset">IT
                                    <br><input type="checkbox" value="Multimedia"  name="Skillset">Multimedia
                                    <br><input type="checkbox" value="Web"  name="Skillset">Web
                                    <br><input type="checkbox" value="Social Media"  name="Skillset">Social Media
                                    <br><input type="checkbox" value="Database Management"  name="Skillset">Database Management
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td><input type="checkbox" name="Skills" value="Creative" onclick="Show('creative_div')"></td>
                            <td>Creative
                                <div id ="creative_div" class="hide">
                                    <input type="checkbox" value="Arts"  name="Skillset">Arts
                                    <br><input type="checkbox" value="Drawing"  name="Skillset">Drawing
                                    <br><input type="checkbox" value="Dance"  name="Skillset">Dance
                                    <br><input type="checkbox" value="Theatre"  name="Skillset">Theatre
                                    <br><input type="checkbox" value="Music"  name="Skillset">Music
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td><input type="checkbox" name="Skills" value="Language" onclick="Show('language_div')"></td>
                            <td>Language
                                <div id ="language_div" class="hide">
                                    <input type="checkbox"  value="English"  name="Skillset">English
                                    <br><input type="checkbox" value="Mandarin"  name="Skillset">Mandarin
                                    <br><input type="checkbox" value="Hindi"  name="Skillset">Hindi
                                    <br><input type="checkbox" value="Malay"  name="Skillset">Malay
                                    <br><input type="checkbox" value="Burmese"  name="Skillset">Burmese (Myanmar)
                                    <br><input type="checkbox" value="Urdu"  name="Skillset">Urdu (Pakistan)
                                    <br><input type="checkbox" value="Vietnamese"  name="Skillset">Vietnamese
                                    <br><input type="checkbox" value="Thai"  name="Skillset">Thai
                                    <br><input type="checkbox" value="Bengali"  name="Skillset">Bengali (Bangladesh)
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td><input type="checkbox" name="Skills" value="Microsoft" onclick="Show('microsoft_div')"></td>
                            <td>Microsoft
                                <div id ="microsoft_div" class="hide">
                                    <input type="checkbox" value="Word"  name="Skillset">Word
                                    <br><input type="checkbox" value="Excel"  name="Skillset">Excel
                                    <br><input type="checkbox" value="PowerPoint"  name="Skillset">PowerPoint
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td><input type="checkbox" name="Skills" value="Programming" onclick="Show('programming_div')"></td>
                            <td>Programming
                                <div id ="programming_div" class="hide">
                                    <input type="checkbox" value="C++"  name="Skillset">C++
                                    <br><input type="checkbox" value="JavaScript"  name="Skillset">JavaScript
                                    <br><input type="checkbox" value="Python"  name="Skillset">Python
                                    <br><input type="checkbox" value="PHP"  name="Skillset">PHP
                                    <br><input type="checkbox" value="SQL"  name="Skillset">SQL
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td><input type="checkbox" name="Skills" value="Design" onclick="Show('design_div')"></td>
                            <td>Design
                                <div id ="design_div" class="hide">
                                    <input type="checkbox" value="PhotoShop"  name="Skillset">PhotoShop
                                    <br><input type="checkbox" value="Illustrator"  name="Skillset">Illustrator
                                    <br><input type="checkbox" value="PremiumPro"  name="Skillset">PremiumPro
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td><input type="checkbox" name="Skills" value="Engineering Design" onclick="Show('engineering_div')"></td>
                            <td>Engineering Design
                                <div id ="engineering_div" class="hide">
                                    <input type="checkbox" value="Autocad"  name="Skillset">Autocad
                                    <br><input type="checkbox" value="SolidWorks"  name="Skillset">SolidWorks
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td><input type="checkbox" name="Skills" value="FundRaising" onclick="Show()"></td>
                            <td>FundRaising</td>
                        </tr>

                         <tr>
                            <td><input type="checkbox" name="Skills" value="Branding" onclick="Show()"></td>
                            <td>Branding</td>
                        </tr>


                    </table>
          <input type="button" value="Submit" class="Select_btn btn btn-primary">
        </div>


        <div id="Name" class="tabcontent">
          <div class="new_view">

            <table class="name_table">
            <col width="80">
              <tr>
                <td>Name: </td>
                <td><input type="text">
              </tr>
            </table>
            <input type="button" value="Submit" class="Select_btn btn btn-primary">
          </div>
        </div>
</div>


  </body>


  <script>



    var division = ['business_div','communication_div','digital_div','creative_div','language_div','microsoft_div','programming_div','design_div','engineering_div'];

    function Show(name){

        for (var i =0 ;i<division.length;i++)
        {
            var all_div = document.getElementById(division[i]);
            all_div.style.display = 'none';
        }
    if(name!=null)
        {
        document.getElementById(name).style.display = 'block';
        }
    }

  function openTab(evt, TabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(TabName).style.display = "block";
    evt.currentTarget.className += " active";
  }

  document.getElementById("defaultOpen").click();

  </script>





  </html></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('event.master', ['title'=>'Search Volunteer'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>