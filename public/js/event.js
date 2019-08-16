function eventForm(){
    var selectvalue;

    if(document.getElementById("event1").checked){
        selectvalue = document.getElementById("event1").value;
        }
    else if(document.getElementById("event2").checked){
        selectvalue = document.getElementById("event2").value;
    }

    if(selectvalue == "ReservedEvent"){
        location.replace("/viewEvent");
        return true;    
    }
    else if(selectvalue == "AvailableEvent"){
        location.replace("/viewEvent");
        return true;    
    }
};  
 