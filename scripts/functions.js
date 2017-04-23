/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function removeGuestFormOverlay(){
    document.getElementById('signup-form').style.display = "none";
}
function removeLoginFormOverlay(){
    document.getElementById('adminlogin-form').style.display = "none";
}

function showSignupForm(){
    document.getElementById('signup-form').style.display = "block";
}

function showAdminLogin(){
    document.getElementById('adminlogin-form').style.display = "block";
}