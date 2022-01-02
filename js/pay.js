window.onload = function () {

    const cardnumber = document.getElementById('cardnumber');
    const securitycode = document.getElementById('securitycode');
    
    

    document.querySelector("#sub").addEventListener("click",(e)=>{
        
        if(cardnumber.value.length != 16)
        {
            e.preventDefault();
            alert("Please Enter The 16 digits on your credit card");
        }else if(securitycode.value.length != 4)
        {
            e.preventDefault();
            alert("Please Enter your 4 digit pin");
        }
    })
}