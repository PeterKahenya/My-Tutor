	// Get the modals
var startmodal = document.getElementById("startDiscussionModal");
var allPostsModal=document.getElementById("allPostsModal");
var allDiscussionsModal=document.getElementById("allDiscussionsModal");

// Get the buttons that open the modals and set their onclick methods
var startDiscussionBtn = document.getElementById("startDiscussionBtn");
	startDiscussionBtn.onclick=startDiscussion();
var joinDiscussionBtn = document.getElementById("joinDiscussionBtn");
	joinDiscussionBtn.onclick=joinDiscussion();
var showAllDiscussionsBtn = document.getElementById("showAllDiscussionsBtn");
	showAllDiscussionsBtn.onclick=showAllDiscussions();
var postBtn=document.getElementById("postBtn");
	postBtn.onclick=post();
var showAllPostsBtn=document.getElementById("showAllPostsBtn");
	showAllPostsBtn.onclick=showAllPosts();

// Get the <span> elements that close the modals     // When the user clicks on <span> (x), close the modal
var startClose = document.getElementsByClassName("close")[0];
	startClose.onclick = function() {
    startDiscussionModal.style.display = "none";
}

var allPostscClose=document.getElementsByClassName("close")[1];
		allPostscClose.onclick = function() {
    allPostsModal.style.display = "none";
}

var allDiscussionsClose = document.getElementsByClassName("close")[2];
		allDiscussionsClose.onclick = function() {
    allDiscussionsModal.style.display = "none";
}



function startDiscussion() {	
	    // When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == startDiscussionModal) {
        startDiscussionModal.style.display = "none";
    }
}
		startmodal.style.display = "block";
		var subject=document.getElementById("subject");
		params="subject="+subject+"action='joinDiscussion'";
		request = new ajaxRequest()
    	request.open("POST", "../mytutor/functions/discussion.php", true)
    	request.setRequestHeader("Content-type","application/x-www-form-urlencoded")
		request.onreadystatechange = function()
											{
											if (this.readyState == 4)
											if (this.status == 200)
											if (this.responseText != '0')
											startDiscussionModal.style.display="none";
                                            showAllPosts();
											}
	request.send(params)

}




function joinDiscussion() {		
		params="action=joinDiscussion";
		request = new ajaxRequest()
		request.onreadystatechange = function()
											{
											if (this.readyState == 4)
											if (this.status == 200)
											if (this.responseText != '0')
                                            showAllPosts();
											}
	request.open("POST", "functions/discussion.php", true)
    request.setRequestHeader("Content-type","application/x-www-form-urlencoded")
	request.send(params)

}
function post(status) {		
         	var message=document.getElementById("messageBox").value;
         	params="action='post'"+"message='"+message;
         	request = new ajaxRequest()
    		request.open("POST", "../mytutor/functions/discussion.php", true)
    		request.setRequestHeader("Content-type","application/x-www-form-urlencoded")
			request.onreadystatechange = function()
											{
											if (this.readyState == 4)
											if (this.status == 200)
											if (this.responseText != '0')
                                            status.innerHTML='<span style="color:#008080;">&nbsp;&#x2714;</span>"';

											}
	request.send(params)
}

function showAllPosts(container) {
     params="action='showposts'";

     request = new ajaxRequest()
    		request.open("POST", "../mytutor/functions/discussion.php", true)
    		request.setRequestHeader("Content-type","application/x-www-form-urlencoded")
			request.onreadystatechange = function()
											{
											if (this.readyState == 4)
											if (this.status == 200)
											if (this.responseText != '0')
                                            result=JSON.parse(this.responseText)
                                        	for (var i = 0; i < result.length; i++) {
                                        		var row=container.insertRow(i)
                                        		var cell1=row.insertCell(0);
                                        		var cell2=row.insertCell(1);
                                        		var cell3=row.insertCell(2);
                                        		cell1.innerHTML=result[i].first_name;
                                        		cell2.innerHTML=result[i].last_name;
                                        		cell3.innerHTML=result[i].mtext;

                                        	}
											}
	request.send(params)
allPostsModal.style.display="block";

}

function showAllDiscussions() {	
          	params="action='showdiscussions'"+"message='"+message;
         	request = new ajaxRequest()
    		request.open("POST", "../mytutor/functions/discussion.php", true)
    		request.setRequestHeader("Content-type","application/x-www-form-urlencoded")
			request.onreadystatechange = function()
											{
											if (this.readyState == 4)
											if (this.status == 200)
											if (this.responseText != '0')
                                             result=JSON.parse(this.responseText)
                                        	for (var i = 0; i < result.length; i++) {
                                        		var row=container.insertRow(i)
                                        		var cell1=row.insertCell(0);
                                        		var cell2=row.insertCell(1);
                                        		cell1.innerHTML=result[i].created;
                                        		cell2.innerHTML=result[i].subject;

                                        	}
											}
	request.send(params)
	allDiscussionsModal.style.display="block";
}

function ajaxRequest()
{ 
try { 
	var request = new XMLHttpRequest() 
}
catch(e1) {
			try {
			 request = new ActiveXObject("Msxml2.XMLHTTP")
			  }
			catch(e2) {
				try {
				 request = new ActiveXObject("Microsoft.XMLHTTP") 
				}
				catch(e3) {
					request = false
							} 
						} 
					}
return request
}