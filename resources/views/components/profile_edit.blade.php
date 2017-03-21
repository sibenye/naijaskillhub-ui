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
	                        <input class="mdl-textfield__input" type="text" id="profile-firstName" name="firstName" value="{{ $viewBag['attributes']['firstName'] }}">
	                        <label class="mdl-textfield__label" for="profile-firstName">First name</label>
	                    </div>
                   </div>
                </div>
                <div class="col-md-6">
                    <div>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" type="text" id="profile-lastName" name="lastName" value="{{ $viewBag['attributes']['lastName'] }}">
                            <label class="mdl-textfield__label" for="profile-lastName">Last name</label>
                        </div>
                   </div>
                </div>
                </div>
                <div class="row">
                <div class="col-md-6">
                   <div>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" type="text" id="profile-city" name="city" value="{{ $viewBag['attributes']['city'] }}">
                            <label class="mdl-textfield__label" for="profile-city">City</label>
                        </div>
                   </div>
                </div>
                <div class="col-md-6">
                    <div>
                        <div class="mdl-selectfield">
                            <label>State</label>
                            <select class="browser-default" name="state" id="profile-state">
                              <option value="" disabled selected>State</option>
                                @foreach ($viewBag['stateList'] as $stateSingle)
                                    @if ($stateSingle == $viewBag['attributes']['state'])
                                        <option value="{{ $stateSingle }}" selected>{{ $stateSingle }}</option>
                                    @else
                                       <option value="{{ $stateSingle }}">{{ $stateSingle }}</option>
                                    @endif

                                @endforeach
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
                            <select class="browser-default" name="gender" id="profile-gender">
                              <option value="" disabled selected>Gender</option>
                              <option value="Male" @php if($viewBag['attributes']['gender'] == 'Male'): echo 'selected'; endif; @endphp>Male</option>
                              <option value=Female" @php if($viewBag['attributes']['gender'] == 'Female'): echo 'selected'; endif; @endphp>Female</option>
                            </select>
                        </div>
                   </div>
                </div>
                <div class="col-md-6">
                   <div>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" type="number" id="profile-yob" name="yob" value="{{ $viewBag['attributes']['yob'] }}">
                            <label class="mdl-textfield__label" for="profile-yob">Year of birth</label>
                        </div>
                   </div>
                </div>
                </div>
            </div>
        </form>
        </div>

        <div class="mdl-card__actions mdl-card--border">
            <div>
                <button id="profileSaveBtn" type="submit" class="mdl-button mdl-button--accent mdl-js-button mdl-js-ripple-effect nsh-left">
                    Save
                </button>
                <div id="mdl-spinner-profile" class="mdl-spinner mdl-spinner--single-color mdl-js-spinner"></div>
                <span id="profile-save-notice" class=""></span>
            </div>
        </div>
    </div>


<div class="nsh-card mdl-card mdl-shadow--2dp">

    <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
        <h2 class="mdl-card__title-text">Profile Image</h2>
    </div>
    <div class="nsh-card-content">
    <span >
    <img @php echo 'src="'.env('IMAGE_LOCATION_URL').$viewBag['attributes']['profileImage'].'"'; @endphp width="80" height="87">
    </span>
    </div>
    <div class="mdl-card__actions">
    <div class="mdl-button mdl-button--accent mdl-button--file">
      <span>
          @if (!empty($viewBag['attributes']['profileImage']))
            Change Profile Image
          @else
            Add Profile Image
          @endif
      </span><input type="file" id="uploadBtn" onchange=uploadProfileImage()>
    </div>
    <div id="mdl-spinner-profile-image" class="mdl-spinner mdl-spinner--single-color mdl-js-spinner"></div>
    </div>

</div>


</div>