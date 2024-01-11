@extends('frontend.layouts.frontLayout')
@section('content')
<style>
   * {
   box-sizing: border-box;
   }
   body {
   background-color: #fff;
   }

   .customFileInput input {
    display: none;
}

.customFileInput label {
    min-width: fit-content;
    white-space: nowrap;
    background: #520f69;
    font-weight: 600;
    font-size: 14px;
    margin: 0;
    border-radius: 5px;
    padding: 10px 15px;
    color: #fff;
    cursor: pointer;
}
   #regForm {
   /* background-color: #ffffff; */
   margin: 50px auto;
   /* font-family: Raleway; */
   padding: 40px;
   width: 70%;
   max-width: 900px;
   }
   h1 {
   text-align: center;
   }
   input {
   padding: 10px;
   width: 100%;
   font-size: 17px;
   font-family: Raleway;
   border: 1px solid #aaaaaa;
   }
   /* Mark input boxes that gets an error on validation: */
   input.invalid {
   background-color: #ffdddd;
   }
   /* Hide all steps by default: */
   .tab {
   display: none;
   }
   button:disabled {
   background: #bbbbbb !important;
   }
   button {
   background-color: #04AA6D;
   color: #ffffff;
   border: none;
   padding: 10px 20px;
   font-size: 17px;
   font-family: Raleway;
   cursor: pointer;
   }
   button:hover {
   opacity: 0.8;
   }
   #prevBtn {
   background-color: #bbbbbb;
   }
   /* Make circles that indicate the steps of the form: */
   .step {
   height: 15px;
   width: 15px;
   margin: 0 2px;
   background-color: #bbbbbb;
   border: none;
   border-radius: 50%;
   display: inline-block;
   opacity: 0.5;
   }
   .step.active {
   opacity: 1;
   }
   /* Mark the steps that are finished and valid: */
   .step.finish {
   background-color: #04AA6D;
   }
   .form-group {
   display: inline-block;
   /* padding: 20px; */
   }
   .StepOne img {
   width: 100%;
   }
   .step1stInput {
   display: flex;
   justify-content: center;
   flex-direction: column;
   align-items: center;
   margin-top: 50px;
   }
   .step1stInput input {
   width: 100%;
   max-width: 350px;
   margin: 2px auto;
   padding: 8px 16px;
   background-color: rgb(244, 244, 243);
   height: 44px;
   color: rgb(76, 82, 100);
   -webkit-text-fill-color: rgb(76, 82, 100);
   opacity: 1;
   border-radius: 5px;
   border: none;
   box-sizing: border-box;
   font-size: 16px;
   cursor: text;
   }
   .steps-button {
   display: flex;
   justify-content: center;
   align-items: center;
   margin-top: 30px;
   gap: 20px;
   }
   .steps-button button {
   width: 350px;
   display: inline;
   user-select: none;
   margin: 0px auto;
   max-width: 100%;
   padding: 0px 16px;
   background-color: #520F69;
   color: rgb(255, 255, 255);
   border-radius: 10px;
   border: none;
   height: 44px;
   font-size: 16px;
   cursor: pointer;
   transition: all 0.2s ease 0s;
   }
   .steps-button button:hover {
   background-color: rgb(47, 69, 139);
   }
   .FindCity input {
   -webkit-box-align: center;
   align-items: center;
   background-color: rgb(244, 244, 243);
   border-color: rgb(204, 204, 204);
   border-radius: 5px;
   border-style: none;
   border-width: 1px;
   cursor: default;
   display: flex;
   flex-wrap: wrap;
   -webkit-box-pack: justify;
   justify-content: space-between;
   min-height: 38px;
   position: relative;
   transition: all 100ms ease 0s;
   box-sizing: border-box;
   padding: 8px 15px;
   outline: 0px !important;
   font-family: 'HelveticaNeue-Regular';
   }
   .step2ndtext h2 {
   font-size: 26px;
   line-height: 1.3;
   color: rgb(38, 45, 68);
   margin-bottom: 8px;
   font-family: 'HelveticaNeue-Regular';
   margin-top: 0;
   }
   .step2ndtext {
   text-align: center;
   }
   .step2ndtext p {
   font-size: 16px;
   line-height: 1.3;
   color: rgb(38, 45, 68);
   font-family: 'HelveticaNeue-Regular';
   max-width: 500px;
   margin: auto;
   }
   .FindCity {
   margin-top: 48px;
   }
   h4.MojorCity {
   margin-top: 24px;
   font-size: 18px;
   }
   .FindCityes input {
   display: none;
   }
   /* .FindCityes {
   } */
   .FindRow {
   display: flex;
   justify-content: space-between;
   width: 100%;
   min-width: 100%;
   align-items: center;
   }
   .FindCityes label {
   display: flex;
   width: 100%;
   min-width: 100%;
   align-items: baseline;
   justify-content: flex-start;
   flex-direction: column;
   border-radius: 5px;
   border-style: solid;
   border-width: 1px;
   border-color: rgb(224, 229, 247);
   transition: all 0.2s ease 0s;
   background-color: rgb(255, 255, 255);
   cursor: pointer;
   padding-left: 24px;
   padding-right: 16px;
   padding-top: 20px;
   padding-bottom: 20px;
   }
   .placeImage p {
    margin: 0;
}
   .PlaceName {
   display: flex;
   align-items: center;
   gap: 15px;
   }
   .PlaceName p {
   margin: 0;
   }
   .FindCityes input:checked+label {
   border: 1px solid #520F69;
   }
   .ObjectivesMainBox input:checked+label {
   background-color: rgb(228, 228, 228);
   }
   .FindCityes {
   width: 100%;
   padding: 0;
   }
   .FindCityes label:hover {
   background: #eee;
   }
   .ObjectivesMainBox input {
   display: none;
   }
   .GridBox {
   display: grid;
   grid-template-columns: repeat(auto-fill, 168px);
   -webkit-box-pack: center;
   justify-content: center;
   /* width: 80%; */
   margin: 0px auto;
   margin-top: 30px;
   }
   .ObjectivesMainBox label {
   display: flex;
   flex-direction: column;
   -webkit-box-align: center;
   align-items: center;
   justify-content: center;
   border-radius: 5px;
   border-style: solid;
   border-width: 1px;
   border-color: rgb(224, 229, 247);
   transition: all 0.2s ease 0s;
   background-color: rgb(255, 255, 255);
   cursor: pointer;
   padding: 24px;
   height: 160px;
   width: 160px;
   margin-right: 4px;
   margin-bottom: 4px;
   text-align: center;
   }
   .ObjectivesMainBox label:hover {
   background-color: rgb(244, 244, 243);
   }
   .ObjectivesMainBox {
   padding: 0;
   margin: 0;
   }
   .objectivesTitle p {
   font-size: 14px;
   line-height: 1.3;
   color: rgb(76, 82, 100);
   margin: 0;
   }
   .CommenCheckbox label {
   color: #520F69;
   background-color: rgb(255, 255, 255);
   border: 1px solid #520F69;
   border-radius: 3px;
   padding: 8px;
   font-family: "Inter Regular", -apple-system, BlinkMacSystemFont, sans-serif;
   font-size: 16px;
   line-height: 1.45;
   text-transform: lowercase;
   overflow: hidden;
   white-space: nowrap;
   margin-bottom: 4px;
   margin-right: 4px;
   cursor: pointer;
   transition: all 0.2s ease 0s;
   }
   .CommenCheckbox input:checked+label {
   background-color: #520F69;
   color: #fff;
   }
   .CommenCheckbox input {
   display: none;
   }
   .form-group.CommenCheckbox {
   padding: 0 !important;
   margin: 0 !important;
   }
   .form-group.main.section h4 {
   /* margin-top: 24px; */
   margin-bottom: 16px;
   color: rgb(168, 171, 180);
   }
   .InstagramTab input {
   width: 100%;
   margin: 2px auto;
   padding: 8px 16px;
   background-color: rgb(244, 244, 243);
   height: 44px;
   color: rgb(76, 82, 100);
   -webkit-text-fill-color: rgb(76, 82, 100);
   opacity: 1;
   border-radius: 5px;
   border: none;
   box-sizing: border-box;
   font-family: "Inter Regular", -apple-system, BlinkMacSystemFont, sans-serif;
   font-size: 16px;
   cursor: text;
   }
   .InstagramTab {
   max-width: 500px;
   margin: auto;
   display: flex;
   justify-content: center;
   align-items: center;
   flex-direction: column;
   gap: 15px;
   border: 1px solid #ddd;
   padding: 30px;
   margin-top: 30px;
   }
   .steps-button {
   max-width: 500px;
   margin: 24px auto;
   }
   .objectivesImg img {
   width: 120px;
   }
   .InstagramTab .step2ndtext {
   margin-bottom: 30px;
   }
   .ProfilePic img {
   width: 100px;
   border-radius: 100%;
   margin: auto;
   display: block;
   }
   .BtnGroup {
   display: flex;
   margin-top: 20px;
   gap: 10px;
   }
   .BtnGroup button {
   border-radius: 10px;
   }
   button.UploadImg {
   background: #520f69;
   font-weight: 600;
   font-size: 14px;
   }
   button.RemoveImg {
   background: #f4f4f3;
   color: #520f69;
   font-weight: 600;
   font-size: 14px;
   }
   .typeFormBox textarea {
   width: 100%;
   padding: 8px 16px;
   background-color: rgb(244, 244, 243);
   color: rgb(76, 82, 100);
   -webkit-text-fill-color: rgb(76, 82, 100);
   opacity: 1;
   border-radius: 5px;
   border: none;
   box-sizing: border-box;
   font-size: 16px;
   cursor: text;
   }
   .typeFormBox textarea:focus-visible {
   outline: none !important;
   }
   input:focus-visible {
   outline: none !important;
   }
   .typeFormBox {
   width: 100%;
   }
   .SampleIntros p {
   margin: 0;
   color: #999;
   font-weight: 400;
   font-family: sans-serif;
   }
   .SampleIntros {
   border: 1px solid #ddd;
   margin-bottom: 10px;
   padding: 15px;
   font-size: 10px;
   }
   .Inlinedata {
    width: 100%;
    display: flex;
    align-items: center;
    gap: 10px;
    border: 1px solid rgb(224, 229, 247);
    padding: 15px;
    flex-direction: column;
}
.ConversationList {
    width: 100%;
}
.ListBlock {
    display: flex;
    flex-direction: column;
    gap: 4px;
}
.MesgData {
    width: 100%;
}
.InlineRow {
    width: 100%;
    display: flex;
    align-items: center;
    gap: 10px;
    cursor: pointer;
}
.IconIamge img {
    width: 150px;
    margin: auto;
    display: block;
}
.IconIamge p {
    font-size: 20px;
    text-align: center;
    margin: 20px 0px;
}
.OTPBox input {
    height: 48px;
    width: 48px;
    text-align: center;
    border-radius: 12px;
    margin-bottom: 0px;
    margin-right: 4px;
    font-size: 30px;
    line-height: 1.3;
    color: rgb(76, 82, 100);
    padding: 0px;
    border: 1px solid rgb(228, 228, 228);
}
.OTPBox {
    display: flex;
    align-items: center;
    justify-content: center;
}
.OTPNote p {
    font-size: 16px;
    line-height: 1.3;
    letter-spacing: -0.02em;
    color: rgb(168, 171, 180);
    margin: 20px 0px;
}
.OTPNote {
    text-align: center;
}
.ResndLinkMain {
    text-align: center;
    margin-top: 50px;
    display: block;
}
.ResndLinkMain a {
    font-size: 18px;
    line-height: 1.45;
    color: rgb(69, 106, 221);
    cursor: pointer;
    transition: all 0.2s ease 0s;
    font-weight: 800;
}
.ButtonContinue button {
    width: 60%;
    user-select: none;
    margin: 0px auto;
    max-width: 100%;
    padding: 0px 16px;
    background-color: #520F69;
    color: rgb(255, 255, 255);
    border-radius: 10px;
    border: none;
    height: 44px;
    font-size: 16px;
    cursor: default;
    transition: all 0.2s ease 0s;
    display: block;
}
.OtpInbox p {
    font-size: 16px;
    line-height: 1.3;
    letter-spacing: -0.02em;
    color: rgb(76, 82, 100);
    text-align: center;
    margin-top: 20px;
}
.ButtonContinue {
    margin-top: 20px;
}
</style>
<body>

   <form id="regForm" action="{{route('match-making-create')}}" method="post">
      @csrf
      <!-- <h1>Match:</h1> -->
      <!-- One "tab" for each step in the form: -->
      <div class="tab step1st" id="">
         <div class="StepOne">
            <img src="{{ asset('/frontend/match-making/citysbulding.png') }}" alt="">
         </div>
         
         <div class="step1stInput">
            <input placeholder="First name..." value="{{(isset($usermeta->first_name) && $usermeta->first_name!='') ? ucfirst($usermeta->first_name) : ''}}" class="fields_firststep" id="first_name" name="first_name" disabled>
            <input placeholder="Last name..." value="{{(isset($usermeta->last_name) && $usermeta->last_name!='') ? ucfirst($usermeta->last_name) : ''}}" class="fields_firststep" id="last_name" name="last_name" disabled>
         </div>
      </div>
      <div class="tab step2nd">
         <div class="step2ndtext">
            <h2>Where are you based?</h2>
            <p>Springverse can find you a match, wherever you are! Let us know where you call home.</p>
            <div class="FindCity">
               <input type="text" name="city" placeholder="Write Your City!">
            </div>
         </div>
         <h4 class="MojorCity">Some of our major cities...</h4>
         <div class="form-group FindCityes">
            <input oninput="this.className = ''" type="radio" id="SanFrancico" value="San Francisco Bay"
               name="city">
            <label for="SanFrancico">
               <div class="FindRow">
                  <div class="placeImage">
                     <p>San Francisco Bay</p>
                  </div>
                  <div class="PlaceName">
                     <span><i class="fa fa-chevron-right"></i></span>
                  </div>
               </div>
            </label>
         </div>
         <div class="form-group FindCityes">
            <input oninput="this.className = ''" type="radio" id="Greater" value="Greater Los Angeles" name="city">
            <label for="Greater">
               <div class="FindRow">
                  <div class="placeImage">
                     <p>Greater Los Angeles</p>
                  </div>
                  <div class="PlaceName">
                     <span><i class="fa fa-chevron-right"></i></span>
                  </div>
               </div>
            </label>
         </div>
         <div class="form-group FindCityes">
            <input oninput="this.className = ''" type="radio" id="NewYorkCity" value="New York City" name="city">
            <label for="NewYorkCity">
               <div class="FindRow">
                  <div class="placeImage">
                     <p>New York City</p>
                  </div>
                  <div class="PlaceName">
                     <span><i class="fa fa-chevron-right"></i></span>
                  </div>
               </div>
            </label>
         </div>
         <div class="form-group FindCityes">
            <input oninput="this.className = ''" type="radio" id="London" value="London" name="city">
            <label for="London">
               <div class="FindRow">
                  <div class="placeImage">
                     <p>London</p>
                  </div>
                  <div class="PlaceName">
                     <span><i class="fa fa-chevron-right"></i></span>
                  </div>
               </div>
            </label>
         </div>
         <div class="form-group FindCityes">
            <input oninput="this.className = ''" type="radio" id="banglore" value="banglore" name="city">
            <label for="banglore">
               <div class="FindRow">
                  <div class="placeImage">
                     <p>Bangalore</p>
                  </div>
                  <div class="PlaceName">
                     <span><i class="fa fa-chevron-right"></i></span>
                  </div>
               </div>
            </label>
         </div>
         
         
         <div id="error-message"></div>
      </div>
      <div class="tab ckecktab">
         <div class="step2ndtext">
            <h2>What are your objectives?</h2>
            <p>Select up to 3 objectives. These will be kept private from other users but help us find relevant
               matches.
            </p>
         </div>
         <div class="GridBox">
            <div class="form-group ObjectivesMainBox">
               <input class="fields" id="Brainstorm" type="checkbox" name="brainstorm_with_peers" value="1">
               <label for="Brainstorm">
                  <div class="ObjectivesBox">
                     <div class="objectivesImg">
                        <img src="{{ asset('/frontend/match-making/setup03/brainstorm with peers.png') }}"
                           alt="">
                     </div>
                     <div class="objectivesTitle">
                        <p>Brainstorm with peers</p>
                     </div>
                  </div>
               </label>
            </div>
            <div class="form-group ObjectivesMainBox">
               <input class="fields" type="checkbox" id="Grow" name="grow_your_team" value="1">
               <label for="Grow">
                  <div class="ObjectivesBox">
                     <div class="objectivesImg">
                        <img src="{{ asset('/frontend/match-making/setup03/grow-your-team.png') }}"
                           alt="">
                     </div>
                     <div class="objectivesTitle">
                        <p>Grow your team</p>
                     </div>
                  </div>
               </label>
            </div>
            <div class="form-group ObjectivesMainBox">
               <input class="fields" type="checkbox" id="company" name="start_a_company" value="1">
               <label for="company">
                  <div class="ObjectivesBox">
                     <div class="objectivesImg">
                        <img src="{{ asset('/frontend/match-making/setup03/start-a-company.png') }}"
                           alt="">
                     </div>
                     <div class="objectivesTitle">
                        <p>Start a company</p>
                     </div>
                  </div>
               </label>
            </div>
            <div class="form-group ObjectivesMainBox">
               <input class="fields" type="checkbox" id="Business" name="business_development" value="1">
               <label for="Business">
                  <div class="ObjectivesBox">
                     <div class="objectivesImg">
                        <img src="{{ asset('/frontend/match-making/setup03/business-development.png') }}"
                           alt="">
                     </div>
                     <div class="objectivesTitle">
                        <p>Business development</p>
                     </div>
                  </div>
               </label>
            </div>
            <div class="form-group ObjectivesMainBox">
               <input class="fields" type="checkbox" id="Invest" name="invest" value="1">
               <label for="Invest">
                  <div class="ObjectivesBox">
                     <div class="objectivesImg">
                        <img src="{{ asset('/frontend/match-making/setup03/invest.png') }}"
                           alt="">
                     </div>
                     <div class="objectivesTitle">
                        <p>Invest</p>
                     </div>
                  </div>
               </label>
            </div>
            <div class="form-group ObjectivesMainBox">
               <input class="fields" type="checkbox" id="Explore" name="explore_new_projects" value="1">
               <label for="Explore">
                  <div class="ObjectivesBox">
                     <div class="objectivesImg">
                        <img src="{{ asset('/frontend/match-making/setup03/explore-new-projects.png') }}"
                           alt="">
                     </div>
                     <div class="objectivesTitle">
                        <p>Explore new projects</p>
                     </div>
                  </div>
               </label>
            </div>
            <div class="form-group ObjectivesMainBox">
               <input class="fields" type="checkbox" id="Mentor" name="mentor_others" value="1">
               <label for="Mentor">
                  <div class="ObjectivesBox">
                     <div class="objectivesImg">
                        <img src="{{ asset('/frontend/match-making/setup03/mentor-others.png') }}"
                           alt="">
                     </div>
                     <div class="objectivesTitle">
                        <p>Mentor others</p>
                     </div>
                  </div>
               </label>
            </div>
            <div class="form-group ObjectivesMainBox">
               <input class="fields" type="checkbox" id="Organize" name="organize_events" value="1">
               <label for="Organize">
                  <div class="ObjectivesBox">
                     <div class="objectivesImg">
                        <img src="{{ asset('/frontend/match-making/setup03/organize-events.png') }}"
                           alt="">
                     </div>
                     <div class="objectivesTitle">
                        <p>Organize events</p>
                     </div>
                  </div>
               </label>
            </div>
            <div class="form-group ObjectivesMainBox">
               <input class="fields" type="checkbox" id="funding" name="raise_funding" value="1">
               <label for="funding">
                  <div class="ObjectivesBox">
                     <div class="objectivesImg">
                        <img src="{{ asset('/frontend/match-making/setup03/raise-funding.png') }}"
                           alt="">
                     </div>
                     <div class="objectivesTitle">
                        <p>Raise funding</p>
                     </div>
                  </div>
               </label>
            </div>
            <div class="form-group ObjectivesMainBox">
               <input class="fields" type="checkbox" id="cofounder" name="find_a_cofounder" value="1">
               <label for="cofounder">
                  <div class="ObjectivesBox">
                     <div class="objectivesImg">
                        <img src="{{ asset('/frontend/match-making/setup03/find-a-cofounder.png') }}"
                           alt="">
                     </div>
                     <div class="objectivesTitle">
                        <p>Find a cofounder</p>
                     </div>
                  </div>
               </label>
            </div>
            <div class="form-group ObjectivesMainBox">
               <input class="fields" type="checkbox" id="meet_interesting_people" name="meet_interesting_people" value="1">
               <label for="meet_interesting_people">
                  <div class="ObjectivesBox">
                     <div class="objectivesImg">
                        <img src="{{ asset('/frontend/match-making/setup03/meet-interesting-people.png') }}"
                           alt="">
                     </div>
                     <div class="objectivesTitle">
                        <p>Meet interesting people</p>
                     </div>
                  </div>
               </label>
            </div>
            <div class="form-group ObjectivesMainBox">
               <input class="fields" type="checkbox" id="explore_new_perspectives" name="explore_new_perspectives" value="1">
               <label for="explore_new_perspectives">
                  <div class="ObjectivesBox">
                     <div class="objectivesImg">
                        <img src="{{ asset('/frontend/match-making/setup03/explore-new-perspectives.png') }}"
                           alt="">
                     </div>
                     <div class="objectivesTitle">
                        <p>Explore new perspectives</p>
                     </div>
                  </div>
               </label>
            </div>
            <div class="form-group ObjectivesMainBox">
               <input class="fields" type="checkbox" id="find_a_job" name="find_a_job" value="1">
               <label for="find_a_job">
                  <div class="ObjectivesBox">
                     <div class="objectivesImg">
                        <img src="{{ asset('/frontend/match-making/setup03/find-a-job.png') }}"
                           alt="">
                     </div>
                     <div class="objectivesTitle">
                        <p>Find a job</p>
                     </div>
                  </div>
               </label>
            </div>
         </div>
      </div>
      <div class="tab check_interestdata">
         <div class="step2ndtext">
            <h2>What are you interested in?</h2>
            <p>Select from the list and add your own interests.</p>
            <!-- <div class="FindCity">
               <input type="search" placeholder="Find Your City!">
               </div> -->
         </div>
         <div class="form-group main section">
            <h4>Business:</h4>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="entrepreneurship" type="checkbox" name="entrepreneurship"
                  value="1">
               <label for="entrepreneurship">
               <span>entrepreneurship</span>
               </label>
            </div>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" type="checkbox" id="marketing" name="marketing" value="1">
               <label for="marketing">
               <span>marketing</span>
               </label>
            </div>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="sales" type="checkbox" name="sales" value="1">
               <label for="sales">
               <span>sales</span>
               </label>
            </div>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="consulting" type="checkbox" name="consulting" value="1">
               <label for="consulting">
               <span>consulting</span>
               </label>
            </div>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="commerce" type="checkbox" name="e_commerce" value="1">
               <label for="commerce">
               <span>e-commerce</span>
               </label>
            </div>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="retail" type="checkbox" name="retail" value="1">
               <label for="retail">
               <span>retail</span>
               </label>
            </div>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="realestate" type="checkbox" name="real_estate" value="1">
               <label for="realestate">
               <span>real estate</span>
               </label>
            </div>
         </div>
         <div class="form-group main section">
            <h4>Investing & Finance:</h4>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="angelinvesting" type="checkbox" name="angel_investing" value="1">
               <label for="angelinvesting">
               <span>angel investing</span>
               </label>
            </div>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="crypto" type="checkbox" name="crypto" value="1">
               <label for="crypto">
               <span>crypto</span>
               </label>
            </div>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="quantfinance" type="checkbox" name="quant_finance" value="1">
               <label for="quantfinance">
               <span>quant finance</span>
               </label>
            </div>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="venturecapital" type="checkbox" name="venture_capital" value="1">
               <label for="venturecapital">
               <span>venture capital</span>
               </label>
            </div>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="investmentbanking" type="checkbox" name="investment_banking" value="1">
               <label for="investmentbanking">
               <span>investment banking</span>
               </label>
            </div>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="economics" type="checkbox" name="economics" value="1">
               <label for="economics">
               <span>economics</span>
               </label>
            </div>
         </div>
         <div class="form-group main section">
            <h4>Lifestyle:</h4>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="travel" type="checkbox" name="travel" value="1">
               <label for="travel">
               <span>travel</span>
               </label>
            </div>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="fitness" type="checkbox" name="fitness" value="1">
               <label for="fitness">
               <span>fitness</span>
               </label>
            </div>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="food" type="checkbox" name="food" value="1">
               <label for="food">
               <span>food</span>
               </label>
            </div>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="gaming" type="checkbox" name="gaming" value="1">
               <label for="gaming">
               <span>gaming</span>
               </label>
            </div>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="writing" type="checkbox" name="writing" value="1">
               <label for="writing">
               <span>writing</span>
               </label>
            </div>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="reading" type="checkbox" name="reading" value="1">
               <label for="reading">
               <span>reading</span>
               </label>
            </div>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="dinnerparties" type="checkbox" name="dinner_parties" value="1">
               <label for="dinnerparties">
               <span>dinner parties</span>
               </label>
            </div>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="poker" type="checkbox" name="poker" value="1">
               <label for="poker">
               <span>poker</span>
               </label>
            </div>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="chess" type="checkbox" name="chess" value="1">
               <label for="chess">
               <span>chess</span>
               </label>
            </div>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="cooking" type="checkbox" name="cooking" value="1">
               <label for="cooking">
               <span>cooking</span>
               </label>
            </div>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="wellness" type="checkbox" name="wellness">
               <label for="wellness">
               <span>wellness</span>
               </label>
            </div>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="parenting" type="checkbox" name="parenting" value="1">
               <label for="parenting">
               <span>parenting</span>
               </label>
            </div>
            {{--
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="Cycling" type="checkbox" name="Cycling" value="1">
               <label for="Cycling">
               <span>Cycling</span>
               </label>
            </div>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="Pilates" type="checkbox" name="Pilates" value="1">
               <label for="Pilates">
               <span>Pilates</span>
               </label>
            </div>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="Yoga" type="checkbox" name="Yoga" value="1">
               <label for="Yoga">
               <span>Yoga</span>
               </label>
            </div>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="Sailing" type="checkbox" name="Sailing" value="1">
               <label for="Sailing">
               <span>Sailing</span>
               </label>
            </div>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="fishing" type="checkbox" name="fishing" value="1">
               <label for="fishing">
               <span>fishing</span>
               </label>
            </div>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="skiing" type="checkbox" name="skiing" value="1">
               <label for="skiing">
               <span>skiing</span>
               </label>
            </div>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="running" type="checkbox" name="running" value="1">
               <label for="running">
               <span>running</span>
               </label>
            </div>
            --}}
         </div>
         <div class="form-group main section">
            <h4>Science & Tech:</h4>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="ai" type="checkbox" name="ai" value="1">
               <label for="ai">
               <span>ai</span>
               </label>
            </div>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="biohacking" type="checkbox" name="biohacking" value="1">
               <label for="biohacking">
               <span>biohacking</span>
               </label>
            </div>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="machinelearning" type="checkbox" name="machine_learning" value="1">
               <label for="machinelearning">
               <span>machine learning</span>
               </label>
            </div>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="productdesign" type="checkbox" name="product_design" value="1">
               <label for="productdesign">
               <span>product design</span>
               </label>
            </div>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="programminglanguages" type="checkbox" name="programming_languages"
                  value="1">
               <label for="programminglanguages">
               <span>programming languages</span>
               </label>
            </div>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="vr_ar" type="checkbox" name="vr_ar" value="1">
               <label for="vr_ar">
               <span>vr/ar</span>
               </label>
            </div>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="productmanagement" type="checkbox" name="product_management" value="1">
               <label for="productmanagement">
               <span>product management</span>
               </label>
            </div>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="robotics" type="checkbox" name="robotics" value="1">
               <label for="robotics">
               <span>robotics</span>
               </label>
            </div>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="fintech" type="checkbox" name="fintech" value="1">
               <label for="fintech">
               <span>fintech</span>
               </label>
            </div>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="datascience" type="checkbox" name="data_science" value="1">
               <label for="datascience">
               <span>data science</span>
               </label>
            </div>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="lifesciences" type="checkbox" name="life_sciences" value="1">
               <label for="lifesciences">
               <span>life sciences</span>
               </label>
            </div>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="visualdesign" type="checkbox" name="visual_design" value="1">
               <label for="visualdesign">
               <span>visual design</span>
               </label>
            </div>
         </div>
         <div class="form-group main section">
            <h4>Social Causes:</h4>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="socialimpact" type="checkbox" name="social_impact" value="1">
               <label for="socialimpact">
               <span>social impact</span>
               </label>
            </div>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="diversity_and_inclusion" type="checkbox" name="diversity_and_inclusion"
                  value="1">
               <label for="diversity_and_inclusion">
               <span>diversity and inclusion</span>
               </label>
            </div>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="education" type="checkbox" name="education" value="1">
               <label for="education">
               <span>education</span>
               </label>
            </div>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="sustainability" type="checkbox" name="sustainability" value="1">
               <label for="sustainability">
               <span>sustainability</span>
               </label>
            </div>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="volunteering" type="checkbox" name="volunteering">
               <label for="volunteering">
               <span>volunteering</span>
               </label>
            </div>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="philanthropy" type="checkbox" name="philanthropy" value="1">
               <label for="philanthropy">
               <span>philanthropy</span>
               </label>
            </div>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="humanrights" type="checkbox" name="human_rights" value="1">
               <label for="humanrights">
               <span>human rights</span>
               </label>
            </div>
         </div>
         <div class="form-group main section">
            <h4>Sports & Entertainment:</h4>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="photography" type="checkbox" name="photography" value="1">
               <label for="photography">
               <span>photography</span>
               </label>
            </div>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="music" type="checkbox" name="music" value="1">
               <label for="music">
               <span>music</span>
               </label>
            </div>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="sports" type="checkbox" name="sports" value="1">
               <label for="sports">
               <span>sports</span>
               </label>
            </div>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="film" type="checkbox" name="film" value="1">
               <label for="film">
               <span>film</span>
               </label>
            </div>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="entertainment" type="checkbox" name="entertainment" value="1">
               <label for="entertainment">
               <span>entertainment</span>
               </label>
            </div>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="media" type="checkbox" name="media" value="1">
               <label for="media">
               <span>media</span>
               </label>
            </div>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="electronic_music" type="checkbox" name="electronic_music" value="1">
               <label for="electronic_music">
               <span>electronic music</span>
               </label>
            </div>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="cinematography" type="checkbox" name="cinematography" value="1">
               <label for="cinematography">
               <span>cinematography</span>
               </label>
            </div>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="fashion" type="checkbox" name="fashion" value="1">
               <label for="fashion">
               <span>fashion</span>
               </label>
            </div>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="fishing" type="checkbox" name="fishing" value="1">
               <label for="fishing">
               <span>fishing</span>
               </label>
            </div>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="skiing" type="checkbox" name="skiing" value="1">
               <label for="skiing">
               <span>skiing</span>
               </label>
            </div>
            <div class="form-group CommenCheckbox">
               <input class="fields_interestdata" id="running" type="checkbox" name="running" value="1">
               <label for="running">
               <span>running</span>
               </label>
            </div>
         </div>
      </div>
      <div class="tab instagram_section">
         <div class="step2ndtext">
            <h2>Tell us a little bit about yourself</h2>
         </div>
         <div class="InstagramTab">
            <div class="step2ndtext">
               <h2>Your profile</h2>
               <p>This Basic information will be shown to your matches every week. Tell us what you'd like to show!</p>
            </div>
            <div class="ProfilePic questionimage">
               <img src="{{ asset('/frontend/match-making/Professional-Profile-Picture.jpg') }}" name = "image" id="imagesp">
               <div class="BtnGroup">
                  <div class="customFileInput">
                     <input type="file" name="image" class="image-making" id="changeimage" accept="image/*">
                     <label for="changeimage">Upload image</label>
                  </div>
                  <input type="hidden" name="images" id="member_making_profile" />
                  <!-- <label for="changeimage">Upload image</label>
                  <button class="UploadImg">Upload image</button> -->
                  <button class="RemoveImg">Remove image</button>
               </div>
            </div>
            <input placeholder="Linkedin Url(required)" type="url" class="insta_fields" id="linkedin_url" name="linkedin_url">
            <p id="validation_result"></p>
         </div>
      </div>
      <div class="modal fade" id="modalim" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
         <div class="modal-dialog modal-md" role="document">
           <div class="modal-content">
             <div class="modal-header">
               <h5 class="modal-title" id="modalLabel">Profile Image</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">×</span>
               </button>
             </div>
             <div class="modal-body">
               <div class="img-container">
                 <div class="row">
                   
                   <div class="col-lg-11">
                     <img id="image" src="https://avatars0.githubusercontent.com/u/3456749">
                   </div>
                 </div>
               </div>
             </div>
             <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
               <button type="button" class="btn btn-primary btn-theme" id="cropsave">Crop and Save</button>
             </div>
           </div>
         </div>
       </div>

      <div class="tab How_Would_you_like">
         <div class="step2ndtext">
            <h2>Tell us a little bit about yourself</h2>
         </div>
         <div class="InstagramTab">
            <div class="step2ndtext">
               <h2>How Would you like to be intro'd?</h2>
               <p>This us whatever you'd like to share with your matches.</p>
            </div>
            <div class="typeFormBox">
               <textarea rows="4" class="insta_fields" name="introduction" id="yourself-TypeForm" placeholder="Type...........">{{(isset($usermeta->first_name) && $usermeta->first_name!='') ? ucfirst($usermeta->first_name) : ''}} is</textarea>
               <span class="text-yourself-error">0 characters (minimum 15 characters)</span>
            </div>
            <div class="Sapmleques">
               <p>Sample intros</p>
               <div class="SampleIntros">
                  <p>Kim is a Product Designer at Facebook who writes about design in everyday life. She loves working on impactful products, and talking to people about them.</p>
               </div>
               <div class="SampleIntros">
                  <p>Sami is a mechanical engineer who is working on a new startup idea in the EV battery space.</p>
               </div>
               <div class="SampleIntros">
                  <p>Omar is an opera singer who writes his own blog.</p>
               </div>
            </div>
         </div>
      </div>
      <div class="tab letsgettheconversation">
         <div class="step2ndtext">
            <h2>Tell us a little bit about yourself</h2>
         </div>
         <div class="InstagramTab">
            <div class="step2ndtext">
               <h2>Let's get the conversation rolling!</h2>
               <p>You can optionally pick some conversation startes from the list below. This Will help you strike up conversation with your new match.</p>
            </div>
            
            <div class="ConversationList">
                <div class="ListBlock">
                    <div class="Inlinedata">
                        <div class="InlineRow">
                           <div class="DataIcon">
                              <i class="fa-solid fa-circle-dot"></i>
                           </div>
                           <div class="DataTitle">
                              <h4>I'd like to learn about...</h4>
                           </div>

                        </div>
                        <div class="MesgData">
                            <div class="typeFormBox">
                               <textarea rows="4" class="insta_fields" id="learn_about" name="learn_about" placeholder="Type..........."></textarea>
                            </div>
                        </div>

                     </div>
                    <div class="Inlinedata">
                        <div class="InlineRow">
                            <div class="DataIcon">
                                <i class="fa-solid fa-circle-dot"></i>
                            </div>
                            <div class="DataTitle">
                                <h4>Ask me about...</h4>
                            </div>
                        </div>
                        <div class="MesgData">
                            <div class="typeFormBox">
                               <textarea rows="4" class="insta_fields" id="ask_me" name="ask_me" placeholder="Type..........."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="Inlinedata">
                        <div class="InlineRow">
                           <div class="DataIcon">
                              <i class="fa-solid fa-circle-dot"></i>
                           </div>
                           <div class="DataTitle">
                              <h4>Top of mind for me...</h4>
                           </div>
                        </div>
                        <div class="MesgData">
                            <div class="typeFormBox">
                               <textarea rows="4" class="insta_fields" id="top_mind" name="top_mind" placeholder="Type..........."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="Inlinedata">
                        <div class="InlineRow">
                           <div class="DataIcon">
                              <i class="fa-solid fa-circle-dot"></i>
                           </div>
                           <div class="DataTitle">
                              <h4>Something I just learned...</h4>
                           </div>
                        </div>
                        <div class="MesgData">
                            <div class="typeFormBox">
                               <textarea rows="4" class="insta_fields" id="something_learn" name="something_learn" placeholder="Type..........."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="Inlinedata">
                        <div class="InlineRow">
                           <div class="DataIcon">
                              <i class="fa-solid fa-circle-dot"></i>
                           </div>
                           <div class="DataTitle">
                              <h4>My side hustle...</h4>
                           </div>
                        </div>
                        <div class="MesgData">
                            <div class="typeFormBox">
                               <textarea rows="4" class="insta_fields" id="hustle" name="hustle" placeholder="Type..........."></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         </div>
      </div>

      <div class="tab EmailConfirmation">
          <div class="IconIamge">
            <img src="{{ asset('/frontend/match-making/Layer_1.png') }}">
            <p>Enter the code from your email to verify your account!</p>
          </div>
          <div class="OTPBox">
            <input type="text" id="otp" name="01">
            <input type="text" name="02">
            <input type="text" name="03">
            <input type="text" name="04">
            <input type="text" name="05">
            <input type="text" name="06">
          </div>
          <div class="OTPNote">
            <p>We use email from hello@springverse.ai to communicate with you. Please make sure <br> we're not filtered out</p>
          </div>
          <div class="ResndLinkMain">
              <a href="#" class="ResendLink">Did not receive an email? <br> Click here to resend.</a>
          </div>
          <div class="ButtonContinue">
            <button type="button">Continue</button>
          </div>
          <div class="OtpInbox">
            <p> We just sent you a login code. <br> <b>Check your inbox for the code!</b></p>
          </div>
      </div>
      {{-- 
      <div class="tab">
         Login Info:
         <p><input placeholder="Username..." oninput="this.className = ''" name="uname"></p>
         <p><input placeholder="Password..." oninput="this.className = ''" name="pword" type="password"></p>
      </div>
      --}}
      <div style="overflow:auto;">
         <div class="steps-button">
            <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
            <button type="button" id="nextBtn" onclick="nextPrev(1)" disabled>Next</button>
         </div>
      </div>
      <!-- Circles which indicates the steps of the form: -->
      <div style="text-align:center;margin-top:40px;">
         <span class="step"></span>
         <span class="step"></span>
         <span class="step"></span>
         <span class="step"></span>
         <span class="step"></span>
         <span class="step"></span>
         <span class="step"></span>
        


      </div>
   </form>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script>
      var currentTab = 0; // Current tab is set to be the first tab (0)
      showTab(currentTab); // Display the current tab
      var step_arr=[];
      function showTab(n) {
          console.log('showTab', n,currentTab)
         //  if(n==6){
         //    $('.steps-button').append('<button type="submit" id="submitbtn" onclick="nextPrev(1)">Submit</button>');
         //  }
          // This function will display the specified tab of the form...
          var x = document.getElementsByClassName("tab");
          x[n].style.display = "block";

         //  console.log('classList',x[n].classList.indexOf('step2nd'))
         //  ckecktab
          //... and fix the Previous/Next buttons:
          if (n == 0) {
            
              document.getElementById("prevBtn").style.display = "none";
          } else {
              document.getElementById("prevBtn").style.display = "inline";
          }
          console.log('length', n, '==', (x.length - 1))
         //  if (n == (x.length - 1)) {
            if(n==6){
            $('.steps-button').html('<button type="submit" id="submitbtn" onclick="nextPrev(1)" disabled>Submit</button>');
           

           // $('.steps-button').hide();
             // document.getElementById("nextBtn").innerHTML = "Submit";
              //document.getElementById("nextBtn").setAttribute("type", "submit");
          } else {
              document.getElementById("nextBtn").innerHTML = "Next";
          }
          //... and run a function that will display the correct step indicator:
         
          fixStepIndicator(n)
      }
      
      function nextPrev(n) {
          var button = document.getElementById("nextBtn");
          
          
          
          // This function will figure out which tab to display
          
          var x = document.getElementsByClassName("tab");
          
          button.setAttribute("disabled", "disabled");
          if(n==-1){
            button.removeAttribute("disabled");
            //alert('seddd');
          

          }
          
          // Exit the function if any field in the current tab is invalid:
            // console.log('currentTab',currentTab,'<',n);
            // if(currentTab<=n){
            // }else{
            //    console.log('removeAttribute',currentTab,'<',n);
            //    button.removeAttribute("disabled");
            // }
          // Hide the current tab:
          x[currentTab].style.display = "none";
          if(n==1){
             var classlist = x[currentTab].getAttribute('class');
             var replace_classlist = classlist.replace(' ','.');
            console.log('ckecktab',replace_classlist,$('.'+step_arr[currentTab + n]).find('input[type=checkbox]:checked').length>0 , $('.'+step_arr[currentTab + n]).find('input[type=radio]:checked').length>0 , $('.'+step_arr[currentTab + n]).find('input[type=text]').val()!='');


            if($('.'+step_arr[currentTab + n]).find('input[type=checkbox]:checked').length>0 || $('.'+step_arr[currentTab + n]).find('input[type=radio]:checked').length>0){
               button.removeAttribute("disabled");
            }
            if((currentTab+n)==1 && ($('.step2nd').find('input[name=city]').val()!='')){
               button.removeAttribute("disabled");

            }
            if(step_arr.indexOf(replace_classlist)==-1){
               step_arr.push(replace_classlist)
               // $('.tab.ckecktab')
            }
         }
         console.log('step_arr',step_arr);
          // Increase or decrease the current tab by 1:
          currentTab = currentTab + n;
          
            
          // if (n == 1 && !validateForm()) return false;
          // if you have reached the end of the form...

          

          if (currentTab >= x.length) {
              // ... the form gets submitted:
      
      
              document.getElementById("regForm").submit();
              return false;
          }
          // Otherwise, display the correct tab:
          showTab(currentTab);
      
      }

      function validateForm() {
          // This function deals with validation of the form fields
          var x, y, i, valid = true;
          x = document.getElementsByClassName("tab");
          y = x[currentTab].getElementsByTagName("input");
          // A loop that checks every input field in the current tab:
          for (i = 0; i < y.length; i++) {
              // If a field is empty...
              if (y[i].value == "") {
                  // add an "invalid" class to the field:
                  y[i].className += " invalid";
                  // and set the current valid status to false
                  valid = false;
              }
          }
          // If the valid status is true, mark the step as finished and valid:
          if (valid) {
           
              document.getElementsByClassName("step")[currentTab].className += " finish";
          }
          return valid; // return the valid status
      }
      
      function fixStepIndicator(n) {
          // This function removes the "active" class of all steps...
          var i, x = document.getElementsByClassName("step");
          for (i = 0; i < x.length; i++) {
              x[i].className = x[i].className.replace(" active", "");
          }
      
          //... and adds the "active" class on the current step:
          x[n].className += " active";
      }
      
      $(function() {
         
         $('body').on('click keyup','.step2nd', function() {
            console.log('click')
              var button = document.getElementById("nextBtn");
      
              //Make groups
              var names = []
              $('input:radio').each(function() {
                  var rname = $(this).attr('name');
                  if ($.inArray(rname, names) == -1) names.push(rname);
              });
              var radioError = true;
              $.each(names, function(i, name) {
                  if ($('input[name="' + name + '"]:checked').length == 0) {
                      radioError = false;
                  }
              });
              
              if($('input[type=text][name=city]').val()!=''){
               radioError = true;
              }
              //check for error
              if (radioError) {
                  // button.setAttribute("disabled", "disabled");
                  
                  button.removeAttribute("disabled");
               }
               // else{
               // $("#error-message").text("You need to select atleast 1 option").css('color','red');
               // }
         });
      });
      
      
      
      /*
        $('.ckecktab').click('#nextBtn', function(e) {
          var button = document.getElementById("nextBtn");
      
          //Make groups
          var names = []
          $('.ckecktab input:checkbox').each(function () {
              var rname = $(this).attr('name');
              if ($.inArray(rname, names) == -1) names.push(rname);
          });
          var radioError = false;
          console.log(names)
          $.each(names, function (i, name) {
          console.log('name',name, i)
      
              if ($('.fields:checked').length == 0) {
                  radioError = true;
              }else{
              radioError = false;
      
              }
          });
      
          //check for error
          if(radioError) {
            console.log('asdasd');
            button.setAttribute("disabled");
          // button.setAttribute("disabled", "disabled");
          $("#error-message").text("You need to select atleast 1 option");
      
            
          }else{
            console.log('gergre')
            button.removeAttribute("disabled");
          }
        });
      */
      
      
      $('.ckecktab').on('change', '.fields', function(e) {
      
          console.log('length', $('.fields').length, $('.fields:checked').length)
          if ($('.fields:checked').length == 0) {
              $('#nextBtn').attr("disabled", true);
          } else {
              $('#nextBtn').attr("disabled", false);
          }
          // if ($('input[class^=fields]:checked').length <= 0) {
          //   $('input[class^=fields]').parents('.ckecktab').append('<div class="error fields">Please select at least one option.</div>');
      
          // }else{
          //   $('input[class^=fields]').parents('.ckecktab').find('.activity').remove();
          //   returnval = true;
      
          // }
      });
      
      $('.check_interestdata').on('change', '.fields_interestdata', function(e) {
      
          console.log('length', $('.fields_interestdata').length, $('.fields_interestdata:checked').length)
          if ($('.fields_interestdata:checked').length == 0) {
              $('#nextBtn').attr("disabled", true);
          } else {
              $('#nextBtn').attr("disabled", false);
          }
      
      });
      
      window.onload = function() {
         var firstName = document.getElementById("first_name").value;
         console.log(firstName)
         var lastName = document.getElementById("last_name").value;
         var button = document.getElementById("nextBtn");
         
         if (firstName.trim() !== '' && lastName.trim() !== '') {
               // e.preventDefault();
            button.removeAttribute("disabled");
         } else {
            button.setAttribute("disabled", "disabled");
         }
      }
      $('.step1st').on('keyup load', 'input.fields_firststep', function(e) {
      
      
          var firstName = document.getElementById("first_name").value;
          console.log(firstName)
          var lastName = document.getElementById("last_name").value;
          console.log(lastName)
      
          var button = document.getElementById("nextBtn");
      
      
          if (firstName.trim() !== '' && lastName.trim() !== '') {
            var yourself_TypeForm = document.getElementById('yourself-TypeForm');
            yourself_TypeForm.value=firstName;
              // e.preventDefault();
              button.removeAttribute("disabled");
      
          } else {
              button.setAttribute("disabled", "disabled");
          }
      
      });
      
      $('.instagram_section').on('keyup', 'input.insta_fields', function(e) {
      
         // console.log('asdasd');
         var image = document.getElementById("imagesp").value;
         //  alert(image)
                   var url = document.getElementById("linkedin_url").value;

          console.log(url)
          
          var resultElement = document.getElementById("validation_result");
        
          var button = document.getElementById("nextBtn");
      
          var isValid = isValidLinkedInURL(url);
      
          if (url.trim() !=='' &&  isValid) {

            $('#validation_result').remove();
           
               button.removeAttribute("disabled");
        
            
         } else {
             $('#validation_result').text('Invalid LinkedIn URL').css('color','red');
              button.setAttribute("disabled", "disabled");
          }
      
      });

      // Function to validate a LinkedIn URL
         function isValidLinkedInURL(url) {
         // LinkedIn profile URL pattern
         var pattern = /^(https?:\/\/)?([a-z]{2,3}\.)?linkedin\.com\/in\/[a-zA-Z0-9-]+(\/.*)?$/;

         // Check if the URL matches the pattern
         return pattern.test(url);
         }


      
      $('.How_Would_you_like').on('keyup', 'textarea.insta_fields', function(e) {
      
         var intro = document.getElementById('yourself-TypeForm').value;
         var button = document.getElementById("nextBtn");
         //console.log('asdasd');
         console.log($(this).val().length);
        
     
         if($(this).val().length>15){
            button.removeAttribute("disabled");
            $('.text-yourself-error').text(300-($(this).val().length)+' characters remaining').css('color','#999');
         }else{
            $('.text-yourself-error').text($(this).val().length+' characters (minimum 15 characters)').css('color','red');
            button.setAttribute("disabled", "disabled");

         }
            
          // console.log(date)
          // var month = document.getElementById("mm").value;
          // console.log(month)
      
          // var year = document.getElementById("yyyy").value;
          // console.log(year)
      
    
      
      });
       $('.letsgettheconversation').on('keyup', 'textarea.insta_fields', function(e) {
      
     
          var learn = document.getElementById("learn_about").value;
          console.log('learn',learn)
          var ask = document.getElementById("ask_me").value;
          console.log('ask',ask)
      
          var top = document.getElementById("top_mind").value;
          console.log('top',top)
      
          var something = document.getElementById("something_learn").value;
          console.log('something',something)

          var hustle = document.getElementById("hustle").value;
          console.log('hustle',hustle)
          var button = document.getElementById("nextBtn");
      
      
         //  document.getElementById("nextBtn").innerHTML = "Submit";
         console.log(document.getElementById("nextBtn"));
         //  var submit =  document.getElementById("nextBtn").setAttribute("type", "submit");
          

          var sub_button = document.getElementById("submitbtn");
         if (learn.trim() !== '' && ask.trim() !== '' && top.trim() !=='' && something.trim() !=='' &&  hustle.trim() !=='' ) {
            // $('.steps-button').html('<button type="submit" id="submitbtn" onclick="nextPrev(1)">Submit</button>');
            
           // $('.steps-button').hide();
              // e.preventDefault();
              console.log(sub_button)
              sub_button.removeAttribute("disabled");
          }
      
      });

      $('.EmailConfirmation').on('keyup', 'input.insta_fields', function(e) {
      
          // console.log('asdasd');
          var date = document.getElementById("otp").value;
          alert(date)
          console.log(date)
          // // var month = document.getElementById("mm").value;
          // // console.log(month)
      
          // // var year = document.getElementById("yyyy").value;
          // // console.log(year)
      
          var button = document.getElementById("nextBtn");
      
      
          if (date.trim()!=='') {
      
              // e.preventDefault();
              button.removeAttribute("disabled");
      
          } else {
              button.setAttribute("disabled", "disabled");
          }
      
      }); 
       
   </script>
   <script></script>
   @endsection