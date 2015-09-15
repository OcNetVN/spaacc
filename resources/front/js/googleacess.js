var helper = (function() {
  var BASE_API_PATH = 'plus/v1/';

  return {
    /**
     * Hides the sign in button and starts the post-authorization operations.
     *
     * @param {Object} authResult An Object which contains the access token and
     *   other authentication information.
     */
    onSignInCallback: function(authResult) {
      gapi.client.load('plus','v1').then(function() {          
        if (authResult['access_token']) {
          //$('#authOps').show('slow');
          //$('#gConnect').hide();
          helper.profile();
          //helper.people();               
          
        } else if (authResult['error']) {
          // There was an error, which means the user is not signed in.
          // As an example, you can handle by writing to the console:
          //console.log('There was an error: ' + authResult['error']);
          //$('#authResult').append('Logged out');
          //$('#authOps').hide('slow');
          //$('#gConnect').show();
        }
        console.log('authResult', authResult);
      });
    },

    /**
     * Calls the OAuth2 endpoint to disconnect the app for the user.
     */
    disconnect: function() {
      // Revoke the access token.
      $.ajax({
        type: 'GET',
        url: 'https://accounts.google.com/o/oauth2/revoke?token=' +
            gapi.auth.getToken().access_token,
        async: false,
        contentType: 'application/json',
        dataType: 'jsonp',
        success: function(result) {
          console.log('revoke response: ' + result);
          $('#authOps').hide();
          $('#profile').empty();
          $('#visiblePeople').empty();
          $('#authResult').empty();
          $('#gConnect').show();
        },
        error: function(e) {
          console.log(e);
        }
      });
    },

    /**
     * Gets and renders the list of people visible to this app.
     */
    people: function() {
      gapi.client.plus.people.list({
        'userId': 'me',
        'collection': 'visible' 
      }).then(function(res) {
        var people = res.result;
        
       
      });
    },

    /**
     * Gets and renders the currently signed in user's profile data.
     */
    profile: function(){
      gapi.client.plus.people.get({
        'userId': 'me'
      }).then(function(res) {
        var profile = res.result;
        
        $.ajax({
            type:"POST",
            url: getUrspal() + "register/googlelogin1",
            dataType:"json",
            data: {
                DuLieuGoogle:JSON.stringify(profile)
                },
            cache:false,
            success:function (data) {                
                    //LoginBangFb_Complete(data);
                    if(data.Return=="1" || data.Return==1)
                    {
                        parent.location =getUrspal() + "index";    
                    }
                    else
                    {
                        
                    }
                    
            }
            });
        
      }, function(err) {
        var error = err.result;
        $('#profile').empty();
        $('#profile').append(error.message);
      });
      //gapi.client.plus.people.getOpenIdConnect();
    }
  };
})();

/**
 * jQuery initialization
 */
$(document).ready(function() {
  $('.disconnect').click(helper.disconnect);
   
});

/**
 * Calls the helper method that handles the authentication flow.
 *
 * @param {Object} authResult An Object which contains the access token and
 *   other authentication information.
 */
function onSignInCallback(authResult) {
  helper.onSignInCallback(authResult);
}