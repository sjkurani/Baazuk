<!DOCTYPE html>
<html>
<head>
	<title></title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>

	<input type="text" name="text" id="info1">
	<input type="text" name="text" id="info2">
	<button  id="btn">Set</button>
	<button  id="load">load</button>

	<script src="https://www.gstatic.com/firebasejs/4.3.1/firebase.js"></script>
	<script src="https://cdn.firebase.com/js/simple-login/1.6.2/firebase-simple-login.js"></script>
	<script>
	  // Initialize Firebase
	  var config = {
	    apiKey: "AIzaSyBy6j0qwZpDvDA7NtQm9OhsscmBbXSrgoU",
	    authDomain: "baazuk-c44ba.firebaseapp.com",
	    databaseURL: "https://baazuk-c44ba.firebaseio.com",
	    projectId: "baazuk-c44ba",
	    storageBucket: "baazuk-c44ba.appspot.com",
	    messagingSenderId: "143403889425"
	  };
	  firebase.initializeApp(config);

	var myRef = firebase.database().ref().child('Shops');

	firebase.auth().signInAnonymously().catch(function(error) {
	  	// Handle Errors here.
		var errorCode = error.code;
		var errorMessage = error.message;
		// ...
	});
	firebase.auth().onAuthStateChanged(function(user) {
	  if (user) {
	    // User is signed in.
	    var isAnonymous = user.isAnonymous;
	    var uid = user.uid;
		console.log(user);

	    // ...
	  } else {
	    // User is signed out.
	    // ...
	  }
	  // ...
	});
	
/*	var authClient = new FirebaseSimpleLogin(myRef, function(error, user) {
	  if (error !== null) {
	    console.log("Login error:", error);
	  } else if (user !== null) {
	    console.log("User authenticated with Firebase:", user);
	  } else {
	    console.log("User is logged out");
	  }
	});

	// Log user in anonymously
	authClient.login("anonymous");*/

	/*$("#btn").click(function() {
		rootRef.set({
			info1: $("#info1").val(),
			info2: $("#info2").val()
		});
	});
	$("#load").click(function(){
		rootRef.on('value',  function(snapshot){
			$("#info1").val(snapshot.child('info1').val());
			$("#info2").val(snapshot.child('info2').val());
		});
	});*/

	myRef.on("child_added", function(snapshot) {
		console.log(snapshot.val());

	});
	</script>
</body>
</html>