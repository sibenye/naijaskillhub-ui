<div>

    <div class="nsh-card mdl-card mdl-shadow--2dp">

        <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
        <h2 class="mdl-card__title-text">Profile</h2>
        </div>
        <div class="nsh-card-content">
        <form id="profile-edit-form" action="">
            <div>
                <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
	                    <div class="">
                            <div><label class="control-label nsh-left" for="profile-firstName">First name</label></div>
	                        <input class="form-control" type="text" id="profile-firstName" name="profile-firstName" value="{{ $viewBag['attributes']['firstName'] }}">
	                    </div>
                   </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="">
	                        <div><label class="control-label nsh-left" for="profile-lastName">Last name</label></div>
	                        <input class="form-control" type="text" id="profile-lastName" name="profile-lastName" value="{{ $viewBag['attributes']['lastName'] }}">
                        </div>
                   </div>
                </div>
                </div>
                <div class="row">
                <div class="col-md-6">
                   <div class="form-group">
                        <div class="">
                            <div><label class="control-label nsh-left" for="profile-city">City</label></div>
                            <input class="form-control" type="text" id="profile-city" name="profile-city" value="{{ $viewBag['attributes']['city'] }}">
                            
                        </div>
                   </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="">
                            <div><label class="control-label nsh-left" for="profile-state">State</label></div>
                            <select class="form-control" name="profile-state" id="profile-state">
                              <option value="" disabled selected></option>
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
                    <div class="form-group">
                        <div class="">
                            <div><label class="control-label nsh-left" for="profile-gender">Gender</label></div>
                            <select class="form-control" name="profile-gender" id="profile-gender">
                              <option value="" disabled selected></option>
                              <option value="Male" @php if($viewBag['attributes']['gender'] == 'Male'): echo 'selected'; endif; @endphp>Male</option>
                              <option value=Female" @php if($viewBag['attributes']['gender'] == 'Female'): echo 'selected'; endif; @endphp>Female</option>
                            </select>
                        </div>
                   </div>
                </div>
                <div class="col-md-6">
                   <div class="form-group">
                        <div class="">
                            <div><label class="control-label nsh-left" for="profile-yob">Year of birth</label></div>
                            <input class="form-control" type="number" id="profile-yob" name="profile-yob" value="{{ $viewBag['attributes']['yob'] }}">
                        </div>
                   </div>
                </div>
                </div>
                <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="">
                            <div><label class="control-label nsh-left" for="profile-bio">Bio</label></div>
                            <textarea class="form-control" rows="10" maxlength="1000" wrap="hard" id="profile-bio" name="profile-bio" placeholder="Tell us a bit about yourself, preferably in the third person.">{{ $viewBag['attributes']['bio'] }}</textarea>
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
    <img id="profile-image"  @php echo 'src="'.$viewBag['attributes']['profileImage'].'"'; @endphp width="80" height="87" @php if(!$viewBag['attributes']['profileImage']): echo 'class="nsh-hide"'; endif; @endphp>
    </span>
    </div>
    <div class="mdl-card__actions">
    <div class="mdl-button mdl-button--accent mdl-button--file">
      <span id="upload-text-change" @php if(!empty($viewBag['attributes']['profileImage'])): echo 'class="nsh-show"'; else: echo 'class="nsh-hide"'; endif; @endphp>
            Change Profile Image
      </span>
      <span id="upload-text-add" @php if(empty($viewBag['attributes']['profileImage'])): echo 'class="nsh-show"'; else: echo 'class="nsh-hide"'; endif; @endphp>
            Add Profile Image
      </span>
      <input type="file" id="uploadProfileImageBtn">
    </div>
    <div id="mdl-spinner-profile-image" class="mdl-spinner mdl-spinner--single-color mdl-js-spinner"></div>
    <span id="profile-image-save-notice" class=""></span>
    </div>

</div>


</div>