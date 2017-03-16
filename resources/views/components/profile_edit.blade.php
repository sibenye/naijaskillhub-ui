<div>

    <div class="nsh-card mdl-card mdl-shadow--2dp">

        <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
        <h2 class="mdl-card__title-text">Profile</h2>
        </div>
        <div class="nsh-card-content">
        <form action="">
            <div>
                <div class="row">
                <div class="col-md-6">
                    <div>
	                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
	                        <input class="mdl-textfield__input" type="text" id="firstName" name="firstName" value="">
	                        <label class="mdl-textfield__label" for="firstName">First name</label>
	                    </div>
                   </div>
                </div>
                <div class="col-md-6">
                    <div>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" type="text" id="lastName" name="lastName" value="">
                            <label class="mdl-textfield__label" for="lastName">Last name</label>
                        </div>
                   </div>
                </div>
                </div>
                <div class="row">
                <div class="col-md-6">
                   <div>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" type="text" id="city" name="city" value="">
                            <label class="mdl-textfield__label" for="city">City</label>
                        </div>
                   </div>
                </div>
                <div class="col-md-6">
                    <div>
                        <div class="mdl-selectfield">
                            <label>State</label>
                            <select class="browser-default" name="state">
                              <option value="" disabled selected>State</option>
                              <option value="imo">Imo</option>
                              <option value="lagos">Lagos</option>
                            </select>
                        </div>
                   </div>
                </div>
                </div>
                <div class="row">
                <div class="col-md-6">
                    <div>
                        <div class="mdl-selectfield">
                            <label>Gender</label>
                            <select class="browser-default" name="gender">
                              <option value="" disabled selected>Gender</option>
                              <option value="male">Male</option>
                              <option value="female">Female</option>
                            </select>
                        </div>
                   </div>
                </div>
                <div class="col-md-6">
                   <div>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" type="number" id="yob" name="yob" value="">
                            <label class="mdl-textfield__label" for="yob">Year of birth</label>
                        </div>
                   </div>
                </div>
                </div>
            </div>
        </form>
        </div>

        <div class="mdl-card__actions mdl-card--border">
            <div>
                <button type="submit" class="mdl-button mdl-button--accent mdl-js-button mdl-js-ripple-effect nsh-left">
                    Save
                </button>
                <div id="mdl-spinner-profile" class="mdl-spinner mdl-spinner--single-color mdl-js-spinner"></div>
            </div>
        </div>
    </div>


<div class="nsh-card mdl-card mdl-shadow--2dp">

    <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
        <h2 class="mdl-card__title-text">Profile Image</h2>
    </div>
    <span >
    <img src="" width="80" height="87">
    </span>
    <div class="mdl-card__actions">
    <input type="file" name="file" id="file" class="nsh-profile-image-upload" accept="image/*" onchange="handleInputChange($event)"/>
    <button for="file" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--accent">Add Profile Image</button>
    <div id="mdl-spinner-profile-image" class="mdl-spinner mdl-spinner--single-color mdl-js-spinner"></div>
    </div>

</div>


</div>