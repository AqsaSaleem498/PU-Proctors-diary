/* Login */
function validateLogin(){
let email=document.getElementById("email").value.trim();
let password=document.getElementById("password").value.trim();
if(email==""||password==""){
alert("Please fill all fields.");
return false;
}
return true;
}

/* Register */
function validateRegister(){
let name=document.getElementById("name").value.trim();
let email=document.getElementById("email").value.trim();
let phone=document.getElementById("phone").value.trim();
let password=document.getElementById("password").value.trim();
if(name==""||email==""||phone==""||password==""){
alert("Please fill all fields.");
return false;
}
if(password.length<6){
alert("Password must be at least 6 characters.");
return false;
}
return true;
}

/* Forgot Password */
function validateForgotPassword(){
let email=document.getElementById("email").value.trim();
if(email==""){
alert("Please enter your email.");
return false;
}
return true;
}

/* Welcome Message */
window.addEventListener("load",function(){
let msg=document.getElementById("welcomeMessage");
if(msg){
setTimeout(function(){
msg.style.display="none";
},3000);
}
});
/* Button Animation */
const formButtons=document.querySelectorAll('.form-box button');
formButtons.forEach(button=>{
button.addEventListener('click',()=>{
button.style.transform='scale(0.95)';
setTimeout(()=>{
button.style.transform='scale(1)';
},150);
});
});

/* Dashboard Box Animation */
const boxes=document.querySelectorAll('.box');
boxes.forEach(box=>{
box.addEventListener('click',()=>{
box.style.opacity='0.8';
box.style.transform='translateY(-5px)';
setTimeout(()=>{
box.style.opacity='1';
box.style.transform='translateY(0)';
},200);
});
});

/* Welcome Box */
const welcomeBox=document.querySelector('.welcome-box');
if(welcomeBox){
welcomeBox.addEventListener('mouseover',()=>{
welcomeBox.style.transform='scale(1.02)';
});
welcomeBox.addEventListener('mouseout',()=>{
welcomeBox.style.transform='scale(1)';
});
}

/* Table Hover */
const rows=document.querySelectorAll('table tr');
rows.forEach(row=>{
row.addEventListener('mouseover',()=>{
row.style.background='lightgray';
});
row.addEventListener('mouseout',()=>{
row.style.background='white';
});
});
/* Manage Center */
function validateCenter(){
let code=document.getElementById("center_code").value.trim();
let name=document.getElementById("center_name").value.trim();
if(code==""||name==""){
alert("Fill all fields.");
return false;
}
return true;
}

/* Manage Duty */
function validateDuty(){
let role=document.getElementsByName("role")[0].value;
let user=document.getElementsByName("user_id")[0].value;
if(role==""||user==""){
alert("Select role and user.");
return false;
}
return true;
}

/* My Duty Filter */
function filterDuty(){
let filter=document.getElementById("statusFilter").value;
let rows=document.querySelectorAll("#dutyTable tr");
for(let i=1;i<rows.length;i++){
let status=rows[i].cells[5].innerText.trim();
if(filter=="All"||status==filter){
rows[i].style.display="";
}
else{
rows[i].style.display="none";
}
}
}
/* Leave Request */
function validateLeave(){
let start=document.getElementsByName("start_date")[0].value;
let end=document.getElementsByName("end_date")[0].value;
let reason=document.getElementsByName("reason")[0].value;
if(start==""||end==""||reason==""){
alert("Fill all fields.");
return false;
}
if(start>end){
alert("End Date must be after Start Date.");
return false;
}
return true;
}

/* Attendance Validation */
function validateAttendance(){
let status=document.getElementById("attendance_status").value;
if(status==""){
alert("Select attendance status.");
return false;
}
if(status=="Present"){
let selfie=document.getElementById("selfie_data").value;
if(selfie==""){
alert("Capture your selfie first.");
return false;
}
}
return true;
}

/* Camera */
let stream=null;

function attendanceCheck(){
let status=document.getElementById("attendance_status").value;

if(status=="Present"){

document.getElementById("camera-section").style.display="block";

navigator.mediaDevices.getUserMedia({video:true})
.then(function(mediaStream){

stream=mediaStream;

document.getElementById("video").srcObject=mediaStream;

})
.catch(function(){

alert("Camera permission denied.");

});

}
else{

document.getElementById("camera-section").style.display="none";

if(stream){
stream.getTracks().forEach(track=>track.stop());
}

}
}

/* Capture Selfie */
function captureSelfie(){

const video=document.getElementById("video");
const canvas=document.getElementById("canvas");
const context=canvas.getContext("2d");

canvas.width=video.videoWidth;
canvas.height=video.videoHeight;

context.drawImage(video,0,0);

let imageData=canvas.toDataURL("image/png");

document.getElementById("selfie_data").value=imageData;

if(stream){
stream.getTracks().forEach(track=>track.stop());
}

document.getElementById("video").srcObject=null;

alert("Selfie captured successfully.");

}
/* Report Validation */
function validateReport(){
let file=document.querySelector('input[type=file]').value;
if(file==""){
alert("Select report file.");
return false;
}
return true;
}

/* Confirm Update */
function confirmUpdate(){
return confirm("Are you sure you want to update?");
}
