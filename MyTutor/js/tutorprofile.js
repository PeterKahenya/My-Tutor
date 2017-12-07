var showing=false;
function showAssignments() {
    document.getElementById('allassignmentsModal').style.display="block";
}



function uploadFiles(uploadbtn) {
        var inp=document.getElementById('myFile');
        var form=document.getElementById('uploadform');

        form.onsubmit=function(event) {
            event.preventDefault();
            var files=inp.files;
             if (window.FormData) {
              var formdata=new FormData();
              for (var i = 0; i < files.length; i++) {
                  var file=files[i];
                  formdata.append('files[]',file);
              }
              var xhttp=new XMLHttpRequest();
                   xhttp.onreadystatechange=function () {
                  if (this.readyState == 4 && this.status == 200) {

                    alert(this.responseText);
                  }
              }


              xhttp.open('POST','message.php');
              xhttp.send(formdata);

         }
        }


    }

var x=function message(receiver,myid) {
    if (showing) {
        document.getElementById('chatmodal').style.display="block";
    }else{
        var chatlogs=document.getElementById('chatlogs');
        var receiverid=receiver;
        params="receiver="+receiverid+"&action='getmessage'";

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
       var obj=JSON.parse(this.responseText);
     for (var i = obj.length - 1; i >= 0; i--) {
         if(obj[i].sender==receiverid){

            container=document.createElement("DIV");
            container.className="mychat friend";
            container.innerHTML='<div class="user_photo"><img src="profilepics/'+receiverid+'.jpg"></div><p class="message">'+ 
                        obj[i].mtext+'</p>';
            chatlogs.appendChild(container);
         }else{
            container=document.createElement("DIV");
            container.className="mychat self";
            container.innerHTML='<div class="user_photo"><img src="profilepics/'+myid+'.jpg"></div><p class="message">'+ 
                        obj[i].mtext+'</p>';
            chatlogs.appendChild(container);
         }
     }
     }

    };
     xhttp.open("POST", "message.php", true);
     xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
     xhttp.send(params);
        document.getElementById('chatmodal').style.display="block";
        showing=true;
        document.getElementById('sendbtn').value=receiverid;

    }
}
    function sendMessage(thesendbtn) {
         receiver=thesendbtn.value;
         var chatlogs=document.getElementById('chatlogs');
         var message=document.getElementById('chattext').value;
         params="receiver="+receiver+"&action=send"+"&message="+message;
         var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
             var sender=this.responseText;
            container=document.createElement("DIV");
            container.className="mychat self";
            container.innerHTML='<div class="user_photo"><img src="profilepics/'+sender+'.jpg"></div><p class="message">'+ 
                        message+'</p><span style="color:#008080;">&nbsp;&#x2714;</span>';
            chatlogs.appendChild(container);
}
}
     
     xhttp.open("POST", "message.php", true);
     xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
     xhttp.send(params);
    }

    function vidchat() {
    	document.getElementById('videochatmodal').style.display="block";
    }

function newAssignment() {
    document.getElementById('assignmentsmodal').style.display="block";
}

function startDiscussion() {	
	var startmodal = document.getElementById("startDiscussionModal");
	var startbtn=document.getElementById('startDiscussionButton');
        startmodal.style.display = "block";

	    // When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
    if (event.target == startDiscussionModal) {
        startmodal.style.display = "none";
    	}
	} 
		startmodal.style.display = "block";
        startbtn.onclick=function () {
        var subject=document.getElementById("subject").value;
		params="subject="+subject+"&action=startDiscussion";
		var request = new XMLHttpRequest();
		request.onreadystatechange = function()
											{
											if (this.readyState == 4 && this.status == 200){
                                            if(this.responseText!='0'){
                                            	startDiscussionModal.style.display="none";
                                            	joinDiscussion(this.responseText);
                                            }
											}
										}
	request.open("POST", "discussion.php", true);
    request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	request.send(params);
        };
		

}

function showAllDiscussions() {
    var allD=document.getElementById('allDiscussionsModal').style.display='block';
}

function joinDiscussion(did) {	
		params="action=joinDiscussion&discussionid="+did;
		request = new XMLHttpRequest();
		request.onreadystatechange = function()
											{
											if (this.readyState == 4){
											if (this.status == 200){
											if (this.responseText != 0){
                                        	showAllPosts(this.responseText);
                                        }
											}}};
	request.open("POST", "discussion.php", true)
    request.setRequestHeader("Content-type","application/x-www-form-urlencoded")
	request.send(params)

}


function showAllPosts(did) {
    var allPostsModal=document.getElementById('allPostsModal');
     params="action=showposts&discussionid="+did;
     request = new XMLHttpRequest()
			request.onreadystatechange = function()
											{
									if (this.readyState == 4){
									if (this.status == 200){
									if (this.responseText !=""){
                                    var obj=JSON.parse(this.responseText)
                                    for (var i = 0; i < obj.length; i++) {
                                    var dlog=document.getElementById('discusslog');
                                    newD=document.createElement("li");
                                    newD.style='border-bottom:2px solid #ccc;"';
            						newD.className="mdl-list__item mdl-list__item--three-line";
            						newD.innerHTML='<span class="mdl-list__item-primary-content">'+
                                    '<img src="profilepics/'+obj[i].sender+
                                    '.jpg" class="classmateprofile"/>'+
                                    '<span>'+obj[i].first_name+" "+obj[i].last_name+'<span> '+
                                    obj[i].created+'</span></span>'+
                                    '<span class="mdl-list__item-text-body">'+obj[i].mtext+
                                    '</span></span>';
            									dlog.appendChild(newD);                                        		
            									
                                        	}}}
                                        	}
                                            allPostsModal.style.display="block";
											};
	request.open("POST", "discussion.php", true)
    request.setRequestHeader("Content-type","application/x-www-form-urlencoded")
	request.send(params)
}



function sendDiscussionPost() {
    var message=document.getElementById('myText').value;
    params="message="+message+"&action=post";
    console.log("message------>"+message);
         var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            console.log("state------>"+this.readyState);
            console.log("status------>"+this.status);
            console.log("responseText------>"+this.responseText);
    if (this.readyState == 4 && this.status == 200 && this.responseText!='') {
            var dlog=document.getElementById('discusslog');
                newD=document.createElement("li");
                    alert(this.responseText);
                    newD.style='border-bottom:2px solid #ccc;"';
                    newD.className="mdl-list__item mdl-list__item--three-line";
                    newD.innerHTML='<span class="mdl-list__item-primary-content">'+
                    '<img src="profilepics/'+this.responseText+'.jpg" class="classmateprofile"/>'+
                    '<span class="mdl-list__item-text-body">'+message+
                                                                '</span></span>';
                                                dlog.appendChild(newD);
}
};
     
     xhttp.open("POST", "discussion.php", true);
     xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
     xhttp.send(params);
    } 
function createNewAssignment(){
      var xhttp=new XMLHttpRequest();
      params="assignment="+document.getElementById('topic').value;
      xhttp.onreadystatechange=function () {
        console.log(this.responseText)
        if (this.readyState==4 && this.status==200 && this.responseText=="assignment_success") {
         
         document.getElementById('allassignmentsModal').style.display="block";   
         document.getElementById('assignmentsmodal').style.display="none";


        }
      };
      xhttp.open("POST","addassignment.php",true);
      xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
      xhttp.send(params)
}